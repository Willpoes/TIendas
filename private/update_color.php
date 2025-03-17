<?php

require_once('init.php');

$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$product_color = [];
	$product_color['color_id'] = $_POST['color_id'];
	$product_color['color_name'] = $_POST['color_name'];
	$product_color['color_code'] = $_POST['color_code'];
	
	foreach($product_color as $key => $value) {
		if(empty($value)){
			$errors[] = is_empty($key, $value);
		}
	}
	
	if(empty($errors)){

		if(update_color($product_color)){
			$success = true;
			$_SESSION['color_msg'] = "Color actualizado con éxito.";
		}
	}
	
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'colors.php';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'add_product_color.php?color_id='. $product_color['color_id'] .'&&errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>