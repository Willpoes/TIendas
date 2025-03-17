<?php

require_once('init.php');

$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$adds = [];
    $adds['adds_id'] = $_POST['adds_id'];
	
	$adds['title'] = $_POST['title'];
    $adds['description'] = $_POST['description'];
	$adds['type'] = $_POST['type'];
	$adds['fecha_expira'] = $_POST['fecha_expira'];
    $adds['fecha_registro'] = $_POST['fecha_create'];
	$adds['RazonSocial'] = $_POST['RazonSocial'];
    $adds['Celular'] = $_POST['celular'];
    $adds['Correo'] = $_POST['Correo'];
    $adds['Contacto'] = $_POST['Contacto'];
	
	foreach($adds as $key => $value) {
		if(empty($value)) $errors[] = is_empty($key, $value);
	}
	$adds['url_foto'] =  $_FILES["adds_image"]["name"];
	
	if(empty($errors)){
		
		if (!empty($adds['url_foto'])) {
			$file_name_no_ext = md5(uniqid(rand(), true));
			$uploaded_msg = upload_img($file_name_no_ext, dir_adds(), adds_post_name());

			delete_image($adds['url_foto'], dir_adds());
			
			$adds['image_name'] = $uploaded_msg[0];
			
		}
		
		if(update_adds($adds)){ 
			$success = true;
			$_SESSION['product_msg'] = "Anuncio actualizado con éxito.";
		}

	}
	
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'ads.php';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'add_ads.php?adds_id='. $adds['adds_id'] .'&&errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>