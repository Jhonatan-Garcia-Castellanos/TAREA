<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        /* Estilos css */
    </style>
</head>
<body>
    <?php
    session_start();

    // 1. Si NO existe la sesión, redirigir al login
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    // 2. Conexión a la base de datos 
    $conn = new mysqli("localhost", "root", "", "prueba_db");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $message = "";

    // 3. Crear nuevo usuario si se envía el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_user'])) {
        $new_user = $_POST['new_username'] ?? '';
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        // Insertar en la tabla 'users'
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $new_user, $new_password);

        if ($stmt->execute()) {
            $message = '<div class="success-message">Usuario creado exitosamente.</div>'; 
        } else {
            $message = '<div class="error-message">Error al crear el usuario.</div>';
        }

        $stmt->close();
    }

    // 4. Obtener datos del usuario logueado desde la tabla 'users'
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
    ?>
    <h1 class="welcome-container">
        <h1>Bienvenido, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <form class="create-user-form" method="POST">
            <input type="text" name="new_username" placeholder="Nuevo Usuario" required>
            <input type="password" name="new_password" placeholder="Nueva contraseña" required>
            <input type="submit" name="create_user" value="Crear Usuario">
        </form>

        <br>

        <form action="logout.php" method="POST">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>