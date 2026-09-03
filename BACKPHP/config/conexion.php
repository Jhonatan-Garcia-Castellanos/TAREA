<?php
// config/conexion.php
class Conexion {
    private $host = "localhost";
    private $dbname = "projecto_acido";
    private $user = "root";
    private $password = "";
    public $conn;

    public function __construct() {
        try {
            // Se añade charset=utf8mb4 para el correcto manejo de texto
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->user, $this->password);
            
            // Corrección: PDO en mayúsculas (PDO::ERRMODE_EXCEPTION)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
?>