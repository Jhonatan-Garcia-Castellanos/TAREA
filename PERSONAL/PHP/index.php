<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba PHP</title>
</head>
<body>
    <?php
    include("estudiante.php");
    include("materia.php");
    include("profesor.php");
    include("institucion.php");

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
    ?>
</body>
</html>