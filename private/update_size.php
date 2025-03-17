<?php

require_once('init.php');

$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$product_size = [];
// 	$product_size['size_id'] = $_POST['size_id'];
// 	$product_size['size_name'] = $_POST['size_name'];
	$product_size['category'] = $_POST['category'];
	
	// Tallas.
	$arr_tag = $_POST['tag'];
	
	

	foreach($product_size as $key => $value) {
		if(empty($value)){
			$errors[] = is_empty($key, $value);
		}
	}
	
	// Testing category
	var_dump($errors);
	exit();
	
	// Recorrer cada tag
	foreach ($arr_tag as $talla) {
	    
	    if(empty($errors)){

    		if(update_size($product_size, $talla)){
    			$success = true;
    			$_SESSION['product_size_msg'] = "Talla actualizado con éxito.";
    		}
	    }
	    
	}
	
	
	
	
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'product_sizes.php';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'add_product_size.php?size_id='. $product_size['size_id'] .'&&errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>