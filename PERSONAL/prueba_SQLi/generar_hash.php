<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Hash</title>
</head>
<body>
    <?php
    $password = "admin123"; // Colocamos entre comillas la contraseña
                             // Para generar el hash 
    $hash = password_hash($password, PASSWORD_DEFAULT); 
    echo $hash;
    ?>
    
</body>
</html>