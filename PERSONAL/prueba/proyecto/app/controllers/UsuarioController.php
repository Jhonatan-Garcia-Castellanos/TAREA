<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {

    public function mostrarPerfil($id = 1) {
        $usuario = Usuario::obtenerPorId($id);
        if (!$usuario) {
            $usuario = ['nombre' => 'No encontrado', 'email' => 'N/A', 'rol' => 'N/A'];
        }
        require_once __DIR__ . '/../views/perfilVista.php';
    }

    // 1. Carga la vista del formulario (solicitud GET)
    public function crear() {
        require_once __DIR__ . '/../views/crearUsuarioVista.php';
    }

    // 2. Procesa los datos enviados desde el formulario (solicitud POST)
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capturar y desinfectar datos recibidos del formulario
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
            $email  = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $rol    = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_SPECIAL_CHARS);

            // Validar que los campos no estén vacíos
            if ($nombre && $email && $rol) {
                // Enviar datos al Modelo
                $exito = Usuario::crear($nombre, $email, $rol);

                if ($exito) {
                    // Redirigir al perfil del usuario recién creado o a la vista deseada
                    header('Location: /prueba/proyecto/public/usuario/mostrarPerfil/1');
                    exit();
                }
            } else {
                echo "Por favor llena todos los campos correctamente.";
            }
        }
    }
}