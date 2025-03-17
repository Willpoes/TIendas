<?php

require_once('init.php');

$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$admin = [];
	$admin['user_id'] = $_POST['user_id'];
	$admin['email'] = $_POST['email'];
	
	$admin['prev-password'] =  $_POST['prev-password'];
	$admin['new-password'] =  $_POST['new-password'];
	$admin['confirm-password'] =  $_POST['confirm-password'];
	
	foreach($admin as $key => $value) {
		if(empty($value)){
			$errors[] = is_empty($key, $value);
		}
	}
	
	if(empty($errors)){
		$admin_from_db = find_admin_by_id($admin['user_id']);
			
		if($admin_from_db['password'] == $admin['prev-password']){
			
			if($admin['new-password'] == $admin['confirm-password']){
				$new_password = $admin['new-password'];
				$updated_admin["user_id"] = $admin['user_id'];
				$updated_admin["email"] = $admin['email'];
				
				$updated_admin["password"] = $new_password;
				if(update_admin_by_id($updated_admin)){
					$success = true;
					set_admin_update_msg();
				
				}
			}else{
				$errors[] = "La contraseña no coincide";
			}
			
		}else{
			$errors[] = "Contraseña incorrecta.";
		}

	}
	
	
	$_SESSION['errors'] = $errors;
	
	
	if($success){ 
		$redirect_to = root_dir() . 'admin_profile.php?user_id='.$admin['user_id'].'&successmsg=true';
		header('Location: ' . $redirect_to); 
	}else{
		$redirect_to = root_dir().'admin_profile.php?user_id='.$admin['user_id'].'&errormsg=true';
		header('Location: ' . $redirect_to); 
	}
	
}
	

?>