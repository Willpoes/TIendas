<?php
function connection() {
    $host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
    $usuario = 'root'; // Usuario de la base de datos
    $contraseña = '69@35#'; // Contraseña de la base de datos
    $nombre_base_datos = 'gamaishx_web_v2'; // Nombre de la base de datos

    try {
        // Crear una nueva conexión PDO
        $con = new PDO("mysql:host=$host;dbname=$nombre_base_datos", $usuario, $contraseña);
        // Configurar el modo de error de PDO para que lance excepciones
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con; // Retornar la conexión
    } catch (PDOException $e) {
        // Manejar errores de conexión
        die("Conexión fallida: " . $e->getMessage());
    }
}
?>