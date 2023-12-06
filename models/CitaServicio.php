<?php 

namespace Model;

class CitaServicio extends ActiveRecord{
    protected static $tabla = "citaservicios";
    protected static $columnasDB = ["id", "id_cita", "id_servicio"];
    public $id;
    public $id_cita;
    public $id_servicio;

    public function __construct($args = []){
        $this->id = $args["id"]??null;
        $this->id_cita = $args["id_cita"]??"";
        $this->id_servicio = $args["id_servicio"]??"";
    }
}
?>