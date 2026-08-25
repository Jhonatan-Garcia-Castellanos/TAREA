<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        Usuario: <input type="text" name="username"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" value="Ingresar">
    </form>

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $conn = new mysqli('localhost', 'root', '', 'prueba_db');

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // 1. Buscamos solo por el nombre de usuario
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?"); 
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // 2. Verificamos la contraseña encriptada O en texto plano (para los usuarios viejos)
            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['username'] = $user['username'];
                
                session_write_close();
                header("Location: principal.php");
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>