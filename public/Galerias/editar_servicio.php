<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

// Obtener el ID del servicio a editar
$id = $_GET['id'];

// Obtener los datos del servicio
$sql = "SELECT * FROM servicios_generales WHERE id_servicios = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$servicio = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener las categorías y tiendas
$categorias = $conn->query("SELECT id_categorias, nombre FROM categorias_general")->fetchAll(PDO::FETCH_ASSOC);
$tiendas = $conn->query("SELECT user_id, username FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/agregar_servicio.css">
</head>
<body>
    <div class="container">
        <h2>Editar Servicio</h2>
        <form action="actualizar_servicio.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $servicio['id_servicios']; ?>">
            <label for="nombre">Nombre del Servicio</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $servicio['nombre']; ?>" required>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" required><?php echo $servicio['descripcion']; ?></textarea>

            <label for="precio_aprox">Precio Aprox.</label>
            <input type="number" step="0.01" id="precio_aprox" name="precio_aprox" min="0" value="<?php echo $servicio['precio_aprox']; ?>" required>

            <label for="precio_oferta">Precio de Oferta</label>
            <input type="number" step="0.01" id="precio_oferta" name="precio_oferta" min="0" value="<?php echo $servicio['precio_oferta']; ?>" required>

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" pattern="[0-9]{9}" minlength="9" maxlength="9" value="<?php echo $servicio['telefono']; ?>" required>

            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" value="<?php echo $servicio['correo']; ?>" required>

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
            <img src="<?php echo $servicio['imagen']; ?>" width="50">

            <label for="id_categoria">Categoría del Servicio</label>
            <select id="id_categoria" name="id_categoria" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id_categorias']; ?>" <?php echo ($categoria['id_categorias'] == $servicio['id_categoria']) ? 'selected' : ''; ?>><?php echo $categoria['nombre']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="id_tienda">Tienda</label>
            <select id="id_tienda" name="id_tienda" required>
                <?php foreach ($tiendas as $tienda): ?>
                    <option value="<?php echo $tienda['user_id']; ?>" <?php echo ($tienda['user_id'] == $servicio['id_tienda']) ? 'selected' : ''; ?>><?php echo $tienda['username']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar Servicio</button>
        </form>
    </div>
</body>
</html>
