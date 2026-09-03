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
            // REDIRECCIÓN CORRECTA: Corta la ejecución y evita que se cargue la vista inferior
            header("Location: index.php?action=login&error=invalid_credentials");
            exit();
        }
    }
}

// 2. PROCESAR ACCIONES POR URL (GET)
if (isset($_GET["action"])) {
    
    // Si la acción es logout, destruye la sesión
    if ($_GET["action"] === "logout") {
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }

    // Si la acción es pedir el login explícitamente
    if ($_GET["action"] === "login") {
        require_once "view/login.php";
        exit(); 
    }

    // Si la acción es abrir el CRUD de registros
    if ($_GET["action"] === "crud") {
        if (isset($_SESSION["user"])) {
            require_once "view/crud.php"; 
            exit();
        } else {
            header("Location: index.php?action=login");
            exit();
        }
    }
}

// 3. CARGAR VISTA POR DEFECTO SEGÚN LA SESIÓN
if (isset($_SESSION["user"])) {
    require_once "view/dashboard.php"; 
} else {
    require_once "view/login.php";
}
?>
