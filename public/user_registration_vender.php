<?php

require_once('../private/init.php');

if(!empty($_POST)){
	
	$user = [];
	$user['first_name'] = $_POST['first_name'];
	$user['last_name'] = $_POST['last_name'];
	$user['username'] = $_POST['username'];	
	$user['email'] = $_POST['email'];
	$user['password'] = $_POST['password'];
	$user['image_name'] = $_POST['image_name'];

	$user['address'] = $_POST['address'];
	$user['membership'] = $_POST['membership'];
	$user['number'] = $_POST['number'];

	$user['dni'] = $_POST['dni'];
	$user['ruc'] = $_POST['ruc'];
	$user['business_name'] = $_POST['razonsocial'];
	$user['mobile'] = $_POST['telefono'];
	$user['store'] = $_POST['nombretienda'];

	$user['gallery'] = $_POST['galeria'];
	$user['useraddress'] = $_POST['direcciontienda'];

	$user['number_placed'] = $_POST['numstand'];

/*
	$user['department'] = $_POST['department'];
	$user['district'] = $_POST['district'];
	$user['province'] = $_POST['province'];
*/
	
	
	if(find_user_by_email($user['email'])) echo "User Already Exists";
	else {
		$inserted_user_id = insert_user_vender($user);
		if($inserted_user_id  > 0) echo $inserted_user_id;
		else echo "Algo salió mal. Inténtalo de nuevo.";
	}
}

?>

