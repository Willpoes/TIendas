<?php

require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$color = [];
	$color['color_name'] = $_POST['color_name'];
	$color['color_code'] = $_POST['color_code'];
	
	foreach($color as $key => $value) {
		if(empty($value)){
			$errors[] = is_empty($key, $value);
		}
	}
	
	if(empty($errors)){
		
		if(empty($errors)){
		
			if(insert_color($color) > -1){
				$success = true;
				$_SESSION['color_msg'] = "Color Added Successfully.";
			}
		}
		
	}
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'colors.php';
		header('Location: ' . $redirect_to); 
	}else{
		
		$redirect_to = root_dir().'add_product_color.php?errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>