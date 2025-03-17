<?php

require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$type = [];
	$type['type_image'] =  $_FILES["type_image"]["name"];
	$type['title'] = $_POST['title'];
	$type['sort'] = 2;
	
	foreach($type as $key => $value) {
		if(empty($value)) $errors[] = is_empty($key, $value);
	}
	
	if(empty($errors)){
		
		if(empty($errors)){
			$file_name_no_ext = md5(uniqid(rand(), true));
			$uploaded_msg = upload_img($file_name_no_ext, dir_type(), type_post_name());
			$type['image_name'] = $uploaded_msg[0];
			
			
			
			if(insert_type($type) > -1){
				$success = true;
				$_SESSION['type_msg'] = "Categoría agregada con éxito.";
			}
		}
		
	}
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'types.php';
		header('Location: ' . $redirect_to); 
	}else{
		
		$redirect_to = root_dir().'add_type.php?errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>