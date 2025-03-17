<?php

require_once('../private/init.php');

if(!empty($_POST)){
	
	$user = [];
	$user['first_name'] = $_POST['first_name'];
	$user['last_name'] = $_POST['last_name'];
	$user['email'] = $_POST['email'];
	$user['password'] = $_POST['password'];
	$user['image_name'] = $_POST['image_name'];
	$user['username'] = $_POST['username'];
	$user['address'] = $_POST['address'];
	$user['number'] = $_POST['number'];
	$user['membership'] = $_POST['membership'];


	$user['department'] = $_POST['department'];
	$user['district'] = $_POST['district'];
	$user['province'] = $_POST['province'];
	$user['mobile'] = $_POST['mobile'];
	$user['useraddress'] = $_POST['useraddress'];


	
	
	if(find_user_by_email($user['email'])) echo "User Already Exists";
	else {
		$inserted_user_id = insert_user($user);
		if($inserted_user_id  > 0) echo $inserted_user_id;
		else echo "Algo salió mal. Inténtalo de nuevo.";
	}
}

?>

