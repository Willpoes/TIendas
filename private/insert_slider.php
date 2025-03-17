<?php

require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$slider = [];
	$slider['slider_image'] =  $_FILES["slider_image"]["name"];

	$slider['statu'] = $_POST['statu'];
	$slider['sort'] = 2;
	
	foreach($slider as $key => $value) {
		if(empty($value)) $errors[] = is_empty($key, $value);
	}
	
	if(empty($errors)){
		
		if(empty($errors)){
			$file_name_no_ext = md5(uniqid(rand(), true));
			//$uploaded_msg = upload_img($file_name_no_ext, dir_slider(), slider_post_name());
			$uploaded_msg = upload_img($file_name_no_ext, dir_slider(), slider_post_name());

			
	$slider['title'] = $_POST['title'];

			$slider['image_name'] = $uploaded_msg[0];
			
			
			
			if(insert_slider($slider) > -1){
				$success = true;
				$_SESSION['slider_msg'] = "Slider agregada con éxito.";
			}
		}
		
	}
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'slider.php';
		header('Location: ' . $redirect_to); 
	}else{
		
		$redirect_to = root_dir().'add_slider.php?errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>