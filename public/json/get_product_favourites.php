<?php require_once('../../private/init.php'); ?>
<?php

if(!empty($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $fav_count = get_fav_count_of_product($product_id);
    echo json_encode($fav_count);
}

?>