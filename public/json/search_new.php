<?php require_once('../../private/init.php'); ?>
<?php

$products = "";
if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $products = search_products_by_name_new($search);

}

echo json_encode($products);


?>