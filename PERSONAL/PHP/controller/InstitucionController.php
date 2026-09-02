<?php

class InstitucionController {

    private $modelo;
    private $estudiante;

    public function __construct() {
        // 1. Requerir los archivos antes de usar las clases
        require_once "models/estudiante.php";
        require_once "models/materia.php";
        require_once "models/profesor.php";
        require_once "models/institucion.php"; // Asegúrate del nombre del archivo

        // 2. Instanciar la clase usando el nombre exacto declarado en institucion.php
        $this->modelo = new Institucion(); 
    }

    public function index() {
        // 1. Crear el Estudiante
        $jhonatan = new Estudiante();
        $jhonatan->setNombre("Jhonatan Garcia");

        // 2. Crear la Materia y asignarle el estudiante
        $materiaa = new Materia();
        $materiaa->setInfo(1, "MAT-101", "Matemáticas", "Cálculo y álgebra");
        $materiaa->setEstudiante($jhonatan);

        // 3. Crear el Profesor y asignarle la materia
        $profesorr = new Profesores();
        $profesorr->setNombreProfesor("David Cabezas");
        $profesorr->setMateria($materiaa);

        // 4. Crear la Institución y asignarle el profesor
        $insti = new Institucion();
        $insti->setNombreInstitucion("Centro de Diseño y Metrología (SENA)");
        $insti->setProfesor($profesorr);

        // 5. Imprimir la cadena completa desde $insti
        echo "<b>Institución:</b> " . $insti->getNombreInstitucion() . "<br>";
        echo "<b>Profesor:</b> " . $insti->getProfesor()->getNombreProfesor() . "<br>";
        echo "<b>Materia:</b> " . $insti->getProfesor()->getMateria()->getInfo() . "<br>";
        echo "<b>Estudiante:</b> " . $insti->getProfesor()->getMateria()->getEstudiante()->getNombre() . "<br>";
    }
    public function crearEstudiante() {
        $this->estudiante = new Estudiante();
        return $this->estudiante;
    }
}
?>