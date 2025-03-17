<?php

require_once('init.php');

$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$category = [];
	$category_image =  $_FILES["category_image"]["name"];
	$category['title'] = $_POST['title'];
	$category['sort'] = 2;
	$category['id'] = $_POST['category_id'];
	$category['image_name'] = $_POST['category_img_name'];
	$category['type'] = $_POST['type'];
	$category['statu'] = $_POST['statu'];

	$category['tabla_tallas'] = trim($_POST['tabla']);
	
	foreach($category as $key => $value) {
		if(empty($value)){
			if($key == 'image_name') continue;
			$errors[] = is_empty($key, $value);
		}
	}
	
	if(empty($errors)){
		
		if (!empty($category_image)) {
			$file_name_no_ext = md5(uniqid(rand(), true));
			$uploaded_msg = upload_img($file_name_no_ext, dir_category(), category_post_name());

			delete_image($category['image_name'], dir_category());
			
			$category['image_name'] = $uploaded_msg[0];
			
		}
		
		if(update_category($category)){ 
			$success = true;
			$_SESSION['product_msg'] = "Categoría actualizada con éxito.";
		}

	}
	
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'categories.php';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'add_category.php?category_id='. $category['id'] .'&&errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>