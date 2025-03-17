<?php require_once('../../private/init.php'); ?>
<?php

$product_sizes = find_all_types();
echo json_encode($product_sizes);

?>