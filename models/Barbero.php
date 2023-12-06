<?php 

namespace Model;

class Barbero extends ActiveRecord{

    protected static $tabla = "barberos";
    protected static $columnasDB = ["id","nombre","apellido","telefono","email"];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;

    public function __construct($args = []){
        $this->id = $args["id"]??null;
        $this->nombre = $args["nombre"]??"";
        $this->apellido = $args["apellido"]??"";
        $this->telefono = $args["telefono"]??"";
        $this->email = $args["email"]??"";
    }

    public function validar(){
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
        
        return self::$alertas;
    }
}
?>