<?php
// model/Usuario.php
require_once "config/conexion.php";

class Usuario {
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->conn;
    }

    public function login($username, $password) {
        // Solo buscamos por usuario, el hash se verifica abajo
        $query = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        
        // Asignación correcta con fetch en mayúsculas/minúsculas correctas
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Comprobamos si el usuario existe y si el hash coincide
        if ($user && password_verify($password, $user["password"])) {
            return $user;
        }

        return false;
    }

    public function registrar($username, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        // Corrección de INSERTO -> INSERT
        $query = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hash);
        return $stmt->execute();
    }
}
?>
