<?php

require_once('../../private/init.php');

if(!empty($_GET)){
	
	$user = [];
	$user['user_id'] = $_GET['user_id'];
	
	if(!empty($user['user_id'])){
		$retruned_user = find_user_by_id($user['user_id']);
		echo '['.json_encode($retruned_user).']';
	}
}

?>




