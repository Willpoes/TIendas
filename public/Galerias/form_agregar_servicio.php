<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Servicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/agregar_servicio.css">
</head>

<body>
    <div class="container">
        <h2>Crear Servicio</h2>
        <form action="agregar_servicio.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre del Servicio</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

            <label for="precio_aprox">Precio Aprox.</label>
            <input type="number" step="0.01" id="precio_aprox" name="precio_aprox" min="0" required>

            <label for="precio_oferta">Precio de Oferta</label>
            <input type="number" step="0.01" id="precio_oferta" name="precio_oferta" min="0" required>

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" pattern="[0-9]{9}" minlength="9" maxlength="9" required>

            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" required>

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <label for="id_categoria">Categoría del Servicio</label>
            <select id="id_categoria" name="id_categoria" required>
                <option value="" disabled selected>Seleccione una categoría</option>
                <?php
                $sql = "SELECT id_categorias, nombre FROM categorias_general WHERE id_rubro = 1 AND id_tipo = 2";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    foreach ($result as $row) {
                        echo "<option value='" . $row['id_categorias'] . "'>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay categorías disponibles</option>";
                }
                ?>
            </select>

            <label for="id_tienda">Tienda</label>
            <select id="id_tienda" name="id_tienda" required>
                <option value="" disabled selected>Seleccione una tienda</option>
                <?php
                $sql = "SELECT user_id, username FROM users";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    foreach ($result as $row) {
                        echo "<option value='" . $row['user_id'] . "'>" . $row['username'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay tiendas disponibles</option>";
                }
                ?>
            </select>

            <button type="submit">Agregar Servicio</button>
        </form>
    </div>
</body>

</html>