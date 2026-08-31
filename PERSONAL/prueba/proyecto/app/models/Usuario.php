<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {

    public static function obtenerPorId($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Nuevo método para insertar datos
    public static function crear($nombre, $email, $rol) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, rol) VALUES (:nombre, :email, :rol)");
        return $stmt->execute([
            'nombre' => $nombre,
            'email'  => $email,
            'rol'    => $rol
        ]);
    }
}