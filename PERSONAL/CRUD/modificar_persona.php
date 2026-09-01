<?php
include "models/conexion.php";
$id = $_GET["id"];
$sql = $conexion->query("SELECT * FROM tb_persona WHERE id=$id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Personas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0939c1b351.js" crossorigin="anonymous"></script>
</head>

<body>
    <form class="col-4 p-3 m-auto" method="POST">
        <h3 class="text-center text-secondary">Modificar Registros</h3>
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <?php
        include "controller/actualizar_persona.php";
        while ($datos = $sql->fetch_object()) { ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellido:</label>
                <input type="text" class="form-control" name="apellido" value="<?= $datos->apellido ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Documento:</label>
                <input type="text" class="form-control" name="documento" value="<?= $datos->documento ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" name="fecha" value="<?= $datos->fecha_nac ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo:</label>
                <input type="text" class="form-control" name="correo" value="<?= $datos->correo ?>">
            </div>
        <?php }
        ?>

        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok"><i class="fa-solid fa-floppy-disk"></i> Modificar Usuario</button>
    </form>
</body>

</html>