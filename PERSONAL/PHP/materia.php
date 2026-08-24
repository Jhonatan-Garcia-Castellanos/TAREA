<?php

class Materia {

    public function setEstudainte($estudiante) {
        $this->estudiante = $estudiante;
    }
    public function getEstudainte() {
        return $this->estudiante;
    }
    // 1. Atributos / Propiedades
    public $id;
    public $codigo;
    public $nombreMateria;          
    public $descripcion;           

    // 2. Constructor (para inicializar la materia fácilmente)
    public function setInfo($id, $codigo, $nombre, $descripcion) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombreMateria = $nombre;
        $this->descripcion = $descripcion;
    }

    // 3. Métodos o Getters/Setters (Ejemplo)
    public function getInfo() {
    return "{$this->nombreMateria} - {$this->descripcion} ({$this->codigo} Codigo)";
    }
}

?>