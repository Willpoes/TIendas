<?php
include_once 'braintree-php-3.34.0/lib/Braintree.php';
require_once('init.php');

$errors = [];
$success = false;

if(!empty($_POST)){
	
	$braintree["id"] = $_POST["id"];
	$braintree["environment"] = $_POST["environment"];
	$braintree["merchant_id"] = $_POST["merchant_id"];
	$braintree["public_key"] = $_POST["public_key"];
	$braintree["private_key"] = $_POST["private_key"];
	$braintree["user_id"] = $_POST["user_id"];
	
	foreach($braintree as $key => $value) {
		if(empty($value)){
			$errors[] = is_empty($key, $value);
		}
	}
	if(empty($errors)){
		if(update_braintree($braintree)){
			
			$success = true;
			$_SESSION['braintree_msg'] = "Las credenciales de Braintree se actualizaron con éxito.";

		}
	}

	$_SESSION['errors'] = $errors;
	
	if($success){ 
		$redirect_to = root_dir() . 'braintree-config.php?braintree=true&&successmsg=true';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'braintree-config.php?braintree=true&&errormsg=true';
		header('Location: ' . $redirect_to); 
	}

}
?>