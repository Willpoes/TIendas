<?php require_once('../../private/init.php'); ?>
<?php

$product_slider = find_all_slider();
echo json_encode($product_slider);

?>