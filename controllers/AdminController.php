<?php 
namespace Controllers;
use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router){
        isAdmin();
        $fecha = $_GET["fecha"]??date("Y-m-d");
        $fechas = explode("-", $fecha);

        if(!checkdate($fechas[1],$fechas[2],$fechas[0])){
            header("Location: /404");
        }

        $consulta = "SELECT citas.id, citas.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) as nombreCliente, ";
        $consulta .= "usuarios.email, usuarios.telefono, CONCAT(barberos.nombre, ' ', barberos.apellido) AS nombreBarbero, ";
        $consulta .= "servicios.nombre as nombreServicio, servicios.precio ";
        $consulta .= "FROM citaservicios ";
        $consulta .= "LEFT OUTER JOIN citas ON citaservicios.id_cita = citas.id ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.id_usuario = usuarios.id ";
        $consulta .= "LEFT OUTER JOIN barberos ON citas.id_barbero = barberos.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON citaservicios.id_servicio = servicios.id ";
        $consulta .= " WHERE fecha =  '${fecha}';";

        $citas = AdminCita::SQL($consulta);

        $router->render("admin/index",[
            "nombre"=> $_SESSION["nombre"],
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
}
?>