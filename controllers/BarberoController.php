<?php 
    namespace Controllers;
    use Model\Barbero;
    use MVC\Router;

    class BarberoController{

        public static function index(Router $router){
            isAdmin();
            $barberos = Barbero::all();
            $router->render("barberos/index",[
                "nombre"=>$_SESSION["nombre"],
                "barberos"=>$barberos
            ]);
        }

        public static function crear(Router $router){
            isAdmin();
            $alertas = [];
            $barbero = new Barbero;

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $barbero->sincronizar($_POST);
                $alertas = $barbero->validar();

                if(empty($alertas)){
                    $barbero->guardar();
                    header("Location: /barberos");
                }
            }

            $router->render("barberos/crear",[
                "nombre"=>$_SESSION["nombre"],
                "alertas"=> $alertas,
                "barbero"=>$barbero
            ]);
        }

        public static function actualizar(Router $router){
            isAdmin();
            $alertas = [];
            $error = false;

            if(!is_numeric($_GET["id"])){
                Barbero::setAlerta("danger","Id no valido.");
                $error = true;
            }

            $barbero = Barbero::find(intval($_GET["id"]));

            if(is_null($barbero)){
                Barbero::setAlerta("danger","No existe el registro.");
                $error = true;
            }

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $barbero->sincronizar($_POST);
                $alertas = $barbero->validar();

                if(empty($alertas)){
                    $barbero->guardar();
                    header("Location: /barberos");
                }
            }

            $alertas = Barbero::getAlertas();

            $router->render("barberos/actualizar",[
                "nombre"=>$_SESSION["nombre"],
                "barbero" => $barbero,
                "alertas"=> $alertas,
                "error"=>$error
            ]);
        }

        public static function eliminar(Router $router){
            isAdmin();
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $barbero = Barbero::find($_POST["id"]);
                $barbero->eliminar();
                header("Location: /barberos");
            }
        }
    }
?>