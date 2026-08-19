<?php
require_once "controller/UsuarioController.php";

session_start();
$controller = new UsuarioController();




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {

    // Cambiado de "registrar" a "register" para coincidir con el HTML
    if ($_POST["action"] == "register") { 
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($controller->registrar($username, $password)) {
            echo "Usuario registrado correctamente. <a href='index.php'>Ir al Login</a>";
            exit(); // Detiene la ejecución para que no cargue la vista de login abajo
        } else {
            echo "Error al registrar el usuario.";
            exit();
        }
    }

    if ($_POST["action"] == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];

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

if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_SESSION["user"])) {
    require_once "view/dashboard.php";
} else {
    require_once "view/login.php";
}
?>
