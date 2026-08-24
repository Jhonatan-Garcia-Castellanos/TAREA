<!DOCTYPE html>
<html lang="en">
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
    // echo "<br>";
    // echo "<br>";
    // for ($i = 1; $i <= 5; $i++) {
    //     echo "Numero: ". $i ."<br>";
    // }
    // echo "<br>";
    ?>
</body>
</html>


