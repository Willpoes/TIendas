<?php require_once('../../private/init.php'); ?>
<?php

if (isset($_GET['product_ids']) && isset($_GET['size_id'])) {
    $id_product = $_GET['product_ids'];
    $id_size = $_GET['size_id'];
     $product_sizes = obtener_productos_tallas($id_product,$id_size);
    echo json_encode($product_sizes);
}else {
     $product_sizes = [];
    echo json_encode($product_sizes);
}


?>