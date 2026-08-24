<?php

class Materia {
    // 1. Atributos / Propiedades
    public $id;
    public $codigo;
    public $nombreMateria;          
    public $descripcion; 
    public $estudiante; // Objeto Estudiante

    // 2. Setters y Getters para el Estudiante
    public function setEstudiante($estudiante) {
        $this->estudiante = $estudiante;
    }

    public function getEstudiante() {
        return $this->estudiante;
    }

    // 3. Método para asignar toda la información de la materia
    public function setInfo($id, $codigo, $nombre, $descripcion) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombreMateria = $nombre;
        $this->descripcion = $descripcion;
    }

    // 4. Método para obtener el resumen en texto
    public function getInfo() {
        return "{$this->nombreMateria} - {$this->descripcion} (Código {$this->codigo})";
    }
}

?>