<?php 

    namespace Model;

    class Usuario extends ActiveRecord{

        protected static $tabla = 'usuarios';
        protected static $columnasDB = ["id","nombre","apellido","telefono","email","password", "admin","confirmado","token"];

        public $id;
        public $nombre;
        public $apellido;
        public $telefono;
        public $email;
        public $password;
        public $admin;
        public $confirmado;
        public $token;

        public function __construct($args = []){
            $this->id = $args["id"]??null;
            $this->nombre = $args["nombre"]??"";
            $this->apellido = $args["apellido"]??"";
            $this->telefono = $args["telefono"]??"";
            $this->email = $args["email"]??"";
            $this->password = $args["password"]??"";
            $this->admin = $args["admin"]??0;
            $this->confirmado = $args["confirmado"]??0;
            $this->token = $args["token"]??"";
        }

        public function validarLogin(){
            if(!$this->email){
                self::$alertas["danger"][] = "Debe ingresar un email.";
            }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas["danger"][] = "El email no es valido.";
            }

            if(!$this->password){
                self::$alertas["danger"][] = "Debe ingresar una contraseña.";
            }

            return self::$alertas;
        }
        public function validarPassword(){
            if(!$this->password){
                self::$alertas["danger"][] = "Debe ingresar una contraseña.";
            }else if (strlen($this->password) < 8 || 
                     strlen($this->password) > 16 || 
                     !preg_match('`[a-z]`',$this->password) || 
                     !preg_match('`[A-Z]`',$this->password) ||
                     !preg_match('`[0-9]`',$this->password)){
                self::$alertas["danger"][] = "La contraseña debe contener minimo 8 caracteres y maximo 16, debe contener por lo menos una mayuscula, una minuscula y un numero.";
            }

            return self::$alertas;
        }
        public function validarNuevaCuenta(){
            if(!$this->nombre){
                self::$alertas["danger"][] = "Debe ingresar un nombre.";
            }

            if(!$this->apellido){
                self::$alertas["danger"][] = "Debe ingresar un apellido.";
            }

            if(!$this->telefono){
                self::$alertas["danger"][] = "Debe ingresar un telefono.";
            }else if (strlen($this->telefono) !== 10 || 
                      preg_match('`[a-z]`',$this->telefono) || 
                      preg_match('`[A-Z]`',$this->telefono)){
                self::$alertas["danger"][] = "Debe ingresar un teléfono de 10 numeros exactamente.";
            }

            if(!$this->email){
                self::$alertas["danger"][] = "Debe ingresar un email.";
            }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas["danger"][] = "El email no es valido.";
            }

            $this->validarPassword();

            return self::$alertas;
        }
        public function validarRecuperarPassword(){
            if(!$this->email){
                self::$alertas["danger"][] = "Debe ingresar un email.";
            }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas["danger"][] = "El email no es valido.";
            }

            return self::$alertas;
        }

        public function existeUsuario(){
            $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1;";
            
            $resultado = self::$db->query($query);

            if($resultado->num_rows > 0){
                self::$alertas[] = "Ya existe un usuario registrado con ese correo.";
            }

            return $resultado;
        }

        public function hashPassword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function crearToken(){
            $this->token = uniqid();
        }

        public function comprobarPasswordYVerificacion($password){
            $resultado = password_verify($password, $this->password);

            if(!$resultado || !$this->confirmado){
                self::$alertas["danger"][] = "Contraseña incorrecta o usuario no confirmado.";
            }else{
                return true;
            }
        }
    }
?>