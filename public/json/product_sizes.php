<?php require_once('../../private/init.php'); ?>
<?php

if (isset($_GET['product_id'])) {
    $product_sizes = get_sizes_product($_GET['product_id']);
    echo json_encode($product_sizes);
}else
{
    echo json_encode([]);
}


?>