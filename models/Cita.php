<?php 

namespace Model;

class Cita extends ActiveRecord{
    

    protected static $tabla = "citas";
    protected static $columnasDB = ["id","fecha","hora","id_usuario","id_barbero"];

    public $id;
    public $fecha;
    public $hora;
    public $id_usuario;
    public $id_barbero;

    public function __construct($args = []){
        $this->id = $args["id"]??null;
        $this->fecha = $args["fecha"]??"";
        $this->hora = $args["hora"]??"";
        $this->id_usuario = $args["id_usuario"]??"";
        $this->id_barbero = $args["id_barbero"]??"";
    }
}

?>