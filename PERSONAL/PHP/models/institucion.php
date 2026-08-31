<?php
class Institucion{
    public $nombreInstitucion;
    public $profesor;
    public $estudiante;
    public function setNombreInstitucion($nombreInstitucion){
        $this->nombreInstitucion=$nombreInstitucion;
    }
    public function getNombreInstitucion(){
        return $this->nombreInstitucion;
    }
    // ESTE ES EL MÉTODO QUE LE FALTA A INSTITUCION:
    public function setProfesor($profesor) {
        $this->profesor = $profesor;
    }

    public function getProfesor() {
        return $this->profesor;
    }
    public function setEstudiante($estudiante){
        $this->estudiante=$estudiante;
    }
    public function getEstudiante() {
        return $this->estudiante;
    }
}
?>