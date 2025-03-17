<?php require_once('../../private/init.php'); ?>
<?php
	
	$products = "";
	if(!empty($_GET['category'])){
		$category = $_GET['category'];
		$products = get_products_by_category($category);
		
	}else{
		$products = find_all_products();
	}
	
	echo json_encode($products);
	
	
?>