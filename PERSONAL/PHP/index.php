<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOLA</title>
</head>
<body>
    <?php
    include("estudiante.php");
    $jhonatan = new Estudiante();
    $jhonatan->setNombre("Jhonatan");
    echo $jhonatan->getNombre();

    echo "<br>";

    include("materia.php");
    $materiaa = new Materia(1,"MAT-101", "Matematicas", "Materia de calculo y algebra");
    $materiaa->getInfo();
    echo $materiaa->getInfo();

    // echo "<br>";
    // echo "<br>";
    // for ($i = 1; $i <= 5; $i++) {
    //     echo "Numero: ". $i ."<br>";
    // }
    // echo "<br>";
    ?>
</body>
</html>


