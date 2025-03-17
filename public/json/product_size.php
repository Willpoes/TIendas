<?php require_once('../../private/init.php'); ?>
<?php
if (isset($_GET['product_id'])) {
    $id_product = $_GET['product_id'];
    $product_sizes = find_all_sizes_product($id_product);
    echo json_encode($product_sizes);
}else {
    $product_sizes = [];
    echo json_encode($product_sizes);
}


?>