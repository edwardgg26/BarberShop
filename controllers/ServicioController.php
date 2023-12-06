<?php 
    namespace Controllers;
    use Model\Servicio;
    use MVC\Router;

    class ServicioController{

        public static function index(Router $router){
            isAdmin();
            $servicios = Servicio::all();
            $router->render("servicios/index",[
                "nombre"=>$_SESSION["nombre"],
                "servicios"=>$servicios
            ]);
        }

        public static function crear(Router $router){
            isAdmin();
            $alertas = [];
            $servicio = new Servicio;

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $servicio->sincronizar($_POST);
                $alertas = $servicio->validar();

                if(empty($alertas)){
                    $servicio->guardar();
                    header("Location: /servicios");
                }
            }

            $router->render("servicios/crear",[
                "nombre"=>$_SESSION["nombre"],
                "alertas"=> $alertas,
                "servicio"=>$servicio
            ]);
        }

        public static function actualizar(Router $router){
            isAdmin();
            $alertas = [];
            $error = false;

            if(!is_numeric($_GET["id"])){
                Servicio::setAlerta("danger","Id no valido.");
                $error = true;
            }

            $servicio = Servicio::find(intval($_GET["id"]));

            if(is_null($servicio)){
                Servicio::setAlerta("danger","No existe el registro.");
                $error = true;
            }

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $servicio->sincronizar($_POST);
                $alertas = $servicio->validar();

                if(empty($alertas)){
                    $servicio->guardar();
                    header("Location: /servicios");
                }
            }

            $alertas = Servicio::getAlertas();

            $router->render("servicios/actualizar",[
                "nombre"=>$_SESSION["nombre"],
                "alertas"=> $alertas,
                "servicio" => $servicio,
                "error"=>$error
            ]);
        }

        public static function eliminar(){
            isAdmin();
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $servicio = Servicio::find($_POST["id"]);
                $servicio->eliminar();
                header("Location: /servicios");
            }
        }
    }
?>