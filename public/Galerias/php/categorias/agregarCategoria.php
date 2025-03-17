<?php
include_once 'conexion.php';

if (isset($_POST['registrarcategoria'])) {

    $nombre = $_POST['nombreCategoria'];
    $idrubro = $_POST['idrubro'];
    $idcategoria = $_POST['idcategoria'];

    $db = new Database();
    $pdo = $db->conectar();

    $sql = "INSERT INTO categorias_general (nombre, id_rubro, id_tipo) 
                         VALUES (:nombre, :idrubro, :idtipo)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':idrubro', $idrubro);
    $stmt->bindParam(':idtipo', $idcategoria);

    if ($stmt->execute()) {
        echo "<script>
                alert('Categoria agregado correctamente');
                window.location.href = window.location.origin + '/TIENDAS/public/Galerias/misCategorias.php';
            </script>";
    } else {
        echo '<h3>ERROR EN INGRESO CON BDD</h3>';
    }
}

if (isset($_GET['pedirCategoria'])) {
    $categoria_id = $_GET['pedirCategoria'];
    $con = connection();

    $sql = "SELECT cg.id_categorias as idCategoria, cg.nombre as nombreCategoria, r.nombre_rubro as nombreRubro, cat.nombre as nombreTipoCategoria
    FROM categorias_general as cg
    INNER JOIN rubro_general as r
    ON r.id_rubro = cg.id_rubro
    INNER JOIN tipo_categoria AS cat
    ON cat.id_tipo = cg.id_tipo
    WHERE id_categorias = :id";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $categoria_id);
    $stmt->execute();

    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        die("Categoría no encontrada");
    }
} else {
    die("falta algo chamre");
}


?>