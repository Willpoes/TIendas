<?php

require_once('init.php');

$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$type = [];
	$type_image =  $_FILES["type_image"]["name"];
	$type['title'] = $_POST['title'];
	$type['sort'] = 2;
	$type['id'] = $_POST['type_id'];
	$type['image_name'] = $_POST['type_img_name'];
	
	foreach($type as $key => $value) {
		if(empty($value)){
			if($key == 'image_name') continue;
			$errors[] = is_empty($key, $value);
		}
	}
	
	if(empty($errors)){
		
		if (!empty($type_image)) {
			$file_name_no_ext = md5(uniqid(rand(), true));
			$uploaded_msg = upload_img($file_name_no_ext, dir_type(), type_post_name());

			delete_image($type['image_name'], dir_type());
			
			$type['image_name'] = $uploaded_msg[0];
			
		}
		
		if(update_type($type)){
			$success = true;
			$_SESSION['product_msg'] = "Categoría actualizada con éxito.";
		}

	}
	
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'types.php';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'add_type.php?type_id='. $type['id'] .'&&errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>