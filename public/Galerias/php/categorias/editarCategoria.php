<?php
include_once 'conexion.php';

if (isset($_POST['modificarcategoria'])) {
    $nombre = $_POST['nombreCategoria'];
    $idrubro = $_POST['idrubro'];
    $idtipocategoria = $_POST['idtipocategoria'];
    $idcategoria = $_POST['idCategoria'];

    $db = new Database();
    $pdo = $db->conectar();

    $sql = "UPDATE categorias_general SET 
                nombre = :nombre, 
                id_rubro = :idrubro, 
                id_tipo = :idtipocategoria
            WHERE id_categorias = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':idrubro', $idrubro);
    $stmt->bindParam(':idtipocategoria', $idtipocategoria);
    $stmt->bindParam(':id', $idcategoria);

    if ($stmt->execute()) {
        echo "<script>
                alert('Categoría modificada correctamente');
                window.location.href = window.location.origin + '/TIENDAS/public/Galerias/misCategorias.php';
            </script>";
    } else {
        echo '<h3>ERROR EN LA MODIFICACIÓN DE LOS DATOS</h3>';
    }
}
?>