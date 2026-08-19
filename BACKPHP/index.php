<?php
require_once "controller/UsuarioController.php";

session_start();
$controller = new UsuarioController();

// 1. PROCESAR FORMULARIOS (POST)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {

    if ($_POST["action"] === "register") { 
        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        if ($controller->registrar($username, $password)) {
            echo "Usuario registrado correctamente. <a href='index.php'>Ir al Login</a>";
            exit();
        } else {
            echo "Error al registrar el usuario.";
            exit();
        }
    }

    if ($_POST["action"] === "login") {
        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        $user = $controller->login($username, $password);

        if ($user) {
            $_SESSION["user"] = $user;
            header("Location: index.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}

// 2. PROCESAR ACCIONES POR URL (GET)
if (isset($_GET["action"])) {
    // Si la acción es logout, destruye la sesión
    if ($_GET["action"] === "logout") {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    // Si la acción es pedir el login explícitamente, carga el login directamente
    if ($_GET["action"] === "login") {
        require_once "view/login.php";
        exit(); // Corta aquí para que NO cargue el dashboard
    }
}

// 3. CARGAR VISTA SEGÚN LA SESIÓN (Por defecto)
if (isset($_SESSION["user"])) {
    require_once "view/dashboard.php";
} else {
    require_once "view/login.php";
}
?>
