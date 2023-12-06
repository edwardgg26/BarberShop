<?php 
    namespace Controllers;
    use Model\Barbero;
    use Model\CitaServicio;
    use Model\Servicio;
    use Model\Cita;

    class APIController {
        public static function servicios(){
           $servicios = Servicio::all();
           
           echo json_encode($servicios);
        }

        public static function barberos(){
            $barberos = Barbero::all();
            
            echo json_encode($barberos);
        }

        public static function guardarCita(){
            $cita = new Cita($_POST);
            $resultado = $cita->guardar();
            $idCita = $resultado["id"];

            $idServicios = explode(",",$_POST["servicios"]);
            foreach( $idServicios as $servicio){
                $args = [
                    "id_cita"=> $idCita,
                    "id_servicio"=> $servicio
                ];

                $citaServicio = new CitaServicio($args);
                $citaServicio->guardar();
            }

            echo json_encode(["resultado"=>$resultado]);
        }

        public static function eliminarCita(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $id = $_POST["id"];
                $cita = Cita::find($id);
                $cita->eliminar();
                header("Location:".$_SERVER["HTTP_REFERER"]);
            }
        }
    }
?>