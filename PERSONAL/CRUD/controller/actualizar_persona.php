<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["documento"]) and !empty($_POST["fecha"]) and !empty($_POST["correo"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $documento = $_POST["documento"];
        $fecha = $_POST["fecha"];
        $correo = $_POST["correo"];

        $sql = $conexion->query("UPDATE tb_persona set nombre='$nombre', apellido='$apellido', documento='$documento', fecha_nac='$fecha', correo='$correo' WHERE id=$id");
        if ($sql == 1) {
            header("location:index.php");
        } else {
            echo '<div class="alert alert-danger">Error al modificar al usuario, intentelo de nuevo.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Campos vacios</div>';
    }
}
