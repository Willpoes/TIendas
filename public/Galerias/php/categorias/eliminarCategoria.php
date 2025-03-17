<?php
include_once 'conexion.php';

if (isset($_POST['eliminarCategoria'])) {

    $idcategoria = $_POST['idcategoria'];

    $db = new Database();
    $pdo = $db->conectar();

    $sql = "DELETE FROM categorias_general WHERE id_categorias = :idcategoria";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':idcategoria', $idcategoria);

    if ($stmt->execute()) {
        echo "<script>
                alert('Categoría eliminada correctamente');
                window.location.href = '/TIENDAS/public/Galerias/misCategorias.php';
            </script>";
    } else {
        echo '<h3>ERROR EN ELIMINACIÓN CON BDD</h3>';
    }
}

?>