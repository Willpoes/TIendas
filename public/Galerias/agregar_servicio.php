<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

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

$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Validar el tipo de archivo
$allowed_types = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowed_types)) {
    die("Solo se permiten archivos JPG, JPEG, PNG y GIF.");
}

// Mover la imagen a la carpeta media
if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO servicios_generales (nombre, descripcion, precio_aprox, precio_oferta, telefono, correo, imagen, id_categoria, id_tienda) VALUES (:nombre, :descripcion, :precio_aprox, :precio_oferta, :telefono, :correo, :imagen, :id_categoria, :id_tienda)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':descripcion' => $descripcion,
        ':precio_aprox' => $precio_aprox,
        ':precio_oferta' => $precio_oferta,
        ':telefono' => $telefono,
        ':correo' => $correo,
        ':imagen' => $target_file,
        ':id_categoria' => $id_categoria,
        ':id_tienda' => $id_tienda
    ]);

    echo '<script>
    alert("El servicio ha sido agregado exitosamente.");
    window.location.href = "servicios.php";
  </script>';
} else {
    die("Hubo un error al subir la imagen.");
}
?>