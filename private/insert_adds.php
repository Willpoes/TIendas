<?php

require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$adds = [];
	$adds['url_foto'] =  $_FILES["adds_image"]["name"];
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
	
	if(empty($errors)){
		
		if(empty($errors)){
			$file_name_no_ext = md5(uniqid(rand(), true));
			$uploaded_msg = upload_img($file_name_no_ext, dir_adds(), adds_post_name());
			$adds['url_foto'] = $uploaded_msg[0];
			
			
			
			if(insert_adds($adds) > -1){
				$success = true;
				$_SESSION['adds_msg'] = "Anuncio agregado con éxito.";
			}
		}
		
	}
	
	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'ads.php';
		header('Location: ' . $redirect_to); 
	}else{
		
		$redirect_to = root_dir().'ads.php?errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>