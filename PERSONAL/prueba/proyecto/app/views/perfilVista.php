<?php /** @var array $usuario */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .card { background: #fff; padding: 20px; border-radius: 8px; max-width: 400px; }
    </style>
</head>
<body>

    <div class="card">
        <h1>Perfil del Usuario</h1>
        <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
        <p><strong>Correo:</strong> <?php echo $usuario['email']; ?></p>
        <p><strong>Rol:</strong> <?php echo $usuario['rol']; ?></p>
        <a href="/prueba/proyecto/public/usuario/crear" class="btn">
            Ir a registrar nuevo usuario
        </a>
    </div>

</body>
</html>