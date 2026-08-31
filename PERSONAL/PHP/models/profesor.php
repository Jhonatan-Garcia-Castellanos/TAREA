<?php
class Profesores {
    public $nombreProfesor;
    public $materia;

    public function setNombreProfesor( $nombreProfesor ) {
        $this->nombreProfesor = $nombreProfesor;
    }

    public function getNombreProfesor() {
        return $this->nombreProfesor;
    }
    public function setMateria( $materia ) {
        $this->materia = $materia;
    }
    public function getMateria() {
        return $this->materia;
    }
}
?>