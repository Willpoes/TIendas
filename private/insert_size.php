<?php

require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$size = [];
    // 	$size['size_name'] = $_POST['size_name'];
	$size['category'] = $_POST['category'];
	
	
	// Tallas.
	$arr_tag = $_POST['tag'];

	foreach($size as $key => $value) {
		if(empty($value)){
			$errors[] = is_empty($key, $value);
		}
	}
	

	// Recorrer cada tag
	foreach ($arr_tag as $talla) {
	    	
		if(empty($errors)){
		    if ( !find_size_and_category( trim(strtoupper($talla)), $size['category']) ) {
		         if(insert_size_for_catego($size, trim(strtoupper($talla)) ) > -1) {
			    	$success = true;
				    $_SESSION['product_size_msg'] = "Tallas añadido con éxito.";
        		 }
		    } 
		}
		
    }
    
    // exit();
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'product_sizes.php';
		header('Location: ' . $redirect_to); 
	}else{
		
		$redirect_to = root_dir().'add_product_size.php?errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>