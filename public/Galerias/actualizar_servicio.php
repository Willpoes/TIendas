<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

// Obtener el ID del servicio a actualizar
$id = $_POST['id'];

// Obtener los datos del servicio existente
$sql_servicio = "SELECT * FROM servicios_generales WHERE id_servicios = :id";
$stmt_servicio = $conn->prepare($sql_servicio);
$stmt_servicio->execute([':id' => $id]);
$servicio = $stmt_servicio->fetch(PDO::FETCH_ASSOC);

// Validar y sanitizar los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio_aprox = $_POST['precio_aprox'];
$precio_oferta = $_POST['precio_oferta'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$id_categoria = $_POST['id_categoria'];
$id_tienda = $_POST['id_tienda'];

// Validar que los precios no sean negativos
if ($precio_aprox < 0 || $precio_oferta < 0) {
    die("Los precios no pueden ser negativos.");
}

// Manejar la subida de la imagen
$target_dir = "media/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$imagen = $servicio['imagen']; // Mantener la imagen existente por defecto

if (!empty($_FILES["imagen"]["name"])) {
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validar el tipo de archivo
    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $allowed_types)) {
        // Mover la imagen a la carpeta media
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen = $target_file;
        } else {
            die("Hubo un error al subir la imagen.");
        }
    } else {
        die("Solo se permiten archivos JPG, JPEG, PNG y GIF.");
    }
}

// Actualizar los datos en la base de datos
$sql = "UPDATE servicios_generales SET nombre = :nombre, descripcion = :descripcion, precio_aprox = :precio_aprox, precio_oferta = :precio_oferta, telefono = :telefono, correo = :correo, imagen = :imagen, id_categoria = :id_categoria, id_tienda = :id_tienda WHERE id_servicios = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':nombre' => $nombre,
    ':descripcion' => $descripcion,
    ':precio_aprox' => $precio_aprox,
    ':precio_oferta' => $precio_oferta,
    ':telefono' => $telefono,
    ':correo' => $correo,
    ':imagen' => $imagen,
    ':id_categoria' => $id_categoria,
    ':id_tienda' => $id_tienda,
    ':id' => $id
]);

// Mostrar mensaje de éxito y redirigir
echo '<script>
        alert("El servicio ha sido actualizado exitosamente.");
        window.location.href = "servicios.php";
      </script>';
?>
