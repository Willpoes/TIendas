<?php

require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$category = [];
	$category['category_image'] =  $_FILES["category_image"]["name"];
	$category['title'] = $_POST['title'];
	$category['type'] = $_POST['type'];
	$category['statu'] = $_POST['statu'];
	$category['sort'] = 2;

	$category['tabla_tallas'] = trim($_POST['tabla']);
	
	foreach($category as $key => $value) {
		if(empty($value)) $errors[] = is_empty($key, $value);
	}
	
	if(empty($errors)){
		
		if(empty($errors)){
			$file_name_no_ext = md5(uniqid(rand(), true));
			$uploaded_msg = upload_img($file_name_no_ext, dir_category(), category_post_name());
			$category['image_name'] = $uploaded_msg[0];
			
			
			
			if(insert_category($category) > -1){
				$success = true;
				$_SESSION['category_msg'] = "Categoría agregada con éxito.";
			}
		}
		
	}
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'categories.php';
		header('Location: ' . $redirect_to); 
	}else{
		
		$redirect_to = root_dir().'add_category.php?errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>