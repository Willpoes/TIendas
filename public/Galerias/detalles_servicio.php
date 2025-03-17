<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

// Obtener el ID del servicio desde la solicitud GET
$id = $_GET['id'];

// Consultar los detalles del servicio
$sql = "SELECT s.*, t.username AS nombre_tienda, c.nombre AS nombre_categoria
        FROM servicios_generales s
        JOIN users t ON s.id_tienda = t.user_id
        JOIN categorias_general c ON s.id_categoria = c.id_categorias
        WHERE s.id_servicios = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$servicio = $stmt->fetch(PDO::FETCH_ASSOC);

// Devolver los detalles del servicio en formato JSON
header('Content-Type: application/json');
echo json_encode($servicio);
?>