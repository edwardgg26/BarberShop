<?php 

    namespace Model;
    class Servicio extends ActiveRecord{
        protected static $tabla = "servicios";
        protected static $columnasDB = ["id","nombre","precio","duracion"];
        public $id;
        public $nombre;
        public $precio;
        public $duracion; 

        public function __construct($args = []){
            $this->id = $args["id"]??null;
            $this->nombre = $args["nombre"]??"";
            $this->precio = $args["precio"]??0;
            $this->duracion = $args["duracion"]??0;
        }

        public function validar(){
            if(!$this->nombre){
                self::$alertas["danger"][] = "Debe ingresar un nombre para el servicio.";
            }

            if(!$this->precio || $this->precio <= 0 || $this->precio > 999999){
                self::$alertas["danger"][] = "Debe ingresar un precio valido.";
            }

            if(!$this->duracion || $this->duracion <= 0 || $this->duracion > 999){
                self::$alertas["danger"][] = "Debe ingresar una duración de servicio valida.";
            }

            return self::$alertas;
        }
    }
?>