<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

// Obtener el ID del servicio a eliminar
$id = $_GET['id'];

// Eliminar el servicio de la base de datos
$sql = "DELETE FROM servicios_generales WHERE id_servicios = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

// Mostrar mensaje de éxito y redirigir
echo '<script>
        alert("El servicio ha sido eliminado exitosamente.");
        window.location.href = "servicios.php";
      </script>';
?>
