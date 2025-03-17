<?php
require_once('../private/init.php');

if(!empty($_POST)){
	
	$user = [];
	$user['email'] = $_POST['email'];
	$user['password'] = $_POST['password'];
	$retruned_user = [];
	
	if(login($user['email'], $user['password'])){
		$retruned_user = find_user_by_email($user['email']);
		echo json_encode($retruned_user);
	}
}
?>




