<?php 
namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = "citaservicios";
    protected static $columnasDB = ["id","hora","nombreCliente","email","telefono", "nombreBarbero", "nombreServicio","precio"];

    public $id;
    public $hora;
    public $nombreCliente;
    public $email;
    public $telefono;
    public $nombreBarbero;
    public $nombreServicio;
    public $precio;

    public function __construct($args = []){
        $this->id = $args["id"]??null;
        $this->hora = $args["hora"]??"";
        $this->nombreCliente = $args["nombreCliente"]??"";
        $this->email = $args["email"]??"";
        $this->telefono = $args["telefono"]??"";
        $this->nombreBarbero = $args["nombreBarbero"]??"";
        $this->nombreServicio = $args["nombreServicio"]??"";
        $this->precio = $args["precio"]??"";
    }
}

?>