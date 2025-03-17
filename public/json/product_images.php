<?php require_once('../../private/init.php'); ?>
<?php
	
	$image_names = "";
	if(!empty($_GET['product_id'])){
		$product_id = $_GET['product_id'];
		$image_names = get_images_by_product_id($product_id);
		echo json_encode($image_names);
	}else{
	echo json_encode([]);    
	}
	//echo json_encode($image_names);
	
	
?>