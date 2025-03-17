<?php
class Database
{
    private $servidor = "localhost";
    private $puerto = "3306";
    private $db = "gamaishx_web_v2";
    private $usuario = "root";
    private $password = "69@35#";
    private $charset = "utf8";

    function conectar()
    {
        try {
            $conexion = "mysql:host=" . $this->servidor . ";port=" . $this->puerto . "; dbname=" . $this->db . "; charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $pdo = new PDO($conexion, $this->usuario, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}
