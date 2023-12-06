<?php 
    namespace Controllers;
    use Classes\Email;
    use Model\Usuario;
    use MVC\Router;

    class LoginController{

        public static function login(Router $router){
            isLogged();
            $alertas = [];

            if($_SERVER["REQUEST_METHOD" ] == "POST"){
                $auth = new Usuario($_POST);
                $alertas = $auth->validarLogin();

                if(empty( $alertas )){
                    $usuario = Usuario::where("email", $auth->email);
                    if($usuario){
                        if($usuario->comprobarPasswordYVerificacion($auth->password)){
                            session_start();
                            $_SESSION["id"] = $usuario->id;
                            $_SESSION["nombre"] = $usuario->nombre." ".$usuario->apellido;
                            $_SESSION["email"] = $usuario->email;
                            $_SESSION["login"] = true;

                            if($usuario->admin == 1){
                                $_SESSION["admin"] = $usuario->admin??null;
                                header("Location: /admin");
                            }else{
                                header("Location: /cita");
                            }
                        }
                    }else{
                        Usuario::setAlerta("danger", "Usuario no encontrado");
                    }
                }
            }
        
            $alertas = Usuario::getAlertas();
            $router->render("auth/login",[
                "alertas"=> $alertas,
            ]);
        }

        public static function crear(Router $router){
            isLogged();
            $usuario = new Usuario;
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();

                if(empty($alertas)){
                    $resultado = $usuario->existeUsuario();

                    if($resultado->num_rows){
                        $alertas = Usuario::getAlertas();
                    }else{
                        $usuario->hashPassword();
                        $usuario->crearToken();
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        $usuario->guardar();
                        header("Location: /mensaje-creado");
                    }
                }
            }

            $router->render("auth/crear",[
                "alertas"=> $alertas,
                "usuario" => $usuario
            ]);
        }

        public static function mensaje(Router $router){
            isLogged();
            $router->render("auth/mensaje");
        }

        public static function confirmar(Router $router){
            isLogged();
            $alertas = [];
            $token = s($_GET["token"]);
            $usuario = Usuario::where("token",$token);

            if(empty($usuario) || $usuario->token === ""){
                Usuario::setAlerta("danger","Token no valido.");
            }else{
                $usuario->confirmado = 1;
                $usuario->token = null;
                $usuario->guardar();
                Usuario::setAlerta("success","Cuenta confirmada con exito.");
            }

            $alertas = Usuario::getAlertas();
            $router->render("auth/confirmar",[
                "alertas" => $alertas
            ]);
        }

        public static function olvide(Router $router){
            isLogged();
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $auth = new Usuario($_POST);
                $alertas = $auth->validarRecuperarPassword();

                if(empty($alertas)){
                    $usuario = Usuario::where("email",$auth->email);

                    if($usuario && $usuario->confirmado == 1){
                        $usuario->crearToken();
                        $usuario->guardar();
                        Usuario::setAlerta("success","Se han enviado las instrucciones para recuperar la contraseña a tu correo.");
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarRetornoDePassword();
                    }else{
                        Usuario::setAlerta("danger","El usuario no existe o no está confirmado."); 
                    }
                }
            }

            $alertas = Usuario::getAlertas();

            $router->render("auth/olvide",[
                "alertas"=> $alertas
            ]);
        }

        public static function recuperar(Router $router){
            isLogged();
            $alertas = [];

            $token = s($_GET["token"]);
            $errorToken = false;
            $usuario = Usuario::where("token",$token);

            if(empty($usuario) || !$usuario->token ){
                Usuario::setAlerta("danger","Token no valido.");
                $errorToken = true;
            }

            if(!$errorToken && $_SERVER["REQUEST_METHOD"] === "POST"){
                $password = new Usuario($_POST);
                $alertas = $password->validarPassword();

                if(empty($alertas)){
                    $usuario->password = null;
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;
                    $resultado = $usuario->guardar();
                    
                    if($resultado){
                        header("Location: /");
                    }
                }
            }

            $alertas = Usuario::getAlertas();

            $router->render("auth/recuperar",[
                "alertas"=> $alertas,
                "errorToken"=> $errorToken
            ]);
        }

        public static function logout(){
            $_SESSION = [];
            header("Location: /");
        }
    }


?>