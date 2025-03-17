<?php require_once('../../private/init.php'); ?>
<?php

$products = "";
if(!empty($_GET['types'])){
    $types = $_GET['types'];
    $products = find_all_categories_type($types);

}

echo json_encode($products);


?>