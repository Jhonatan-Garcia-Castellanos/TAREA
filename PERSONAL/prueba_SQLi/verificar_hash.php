<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Hash</title>
</head>
<body>
    <h1>Informacion del Hash</h1>
    <?php
    $hash = password_hash("admin123", PASSWORD_DEFAULT);
    $info = password_get_info($hash);
    echo "<pre>";
    print_r($info);
    echo "</pre>";
    ?>
</body>
</html>