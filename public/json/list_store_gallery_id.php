<?php require_once('../../private/init.php'); ?>
<?php

$products = "";
if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $products = list_store_gallery_id($search);

}

echo json_encode($products);


?>