<?php
class Estudiante {
    public $id;
    public $nombre;
    public $apellido;

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }
}
?>