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
	$user['user_number'] = $_POST['number'];
	$user['membership'] = $_POST['membership'];
	
	$user_frm_db = find_user_by_username($user['username']);
	if(!empty($user_frm_db)){
		echo $user_frm_db['user_id'];
	}else{
		$inserted_user_id = insert_user_social($user);
		if($inserted_user_id  > 0) echo $inserted_user_id;
		else echo "Algo salió mal. Inténtalo de nuevo.";
	}
}

?>

