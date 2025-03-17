<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

// Obtener el término de búsqueda desde la solicitud GET
$searchTerm = $_GET['search'];

// Consultar los servicios que coincidan con el término de búsqueda
$sql = "SELECT * FROM servicios_generales WHERE nombre LIKE :searchTerm OR descripcion LIKE :searchTerm";
$stmt = $conn->prepare($sql);
$stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los servicios en formato JSON
echo json_encode($servicios);
?>