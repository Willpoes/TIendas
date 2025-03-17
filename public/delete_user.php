<?php require_once('../private/init.php'); ?>
<?php

	// Start of redirected if admin is not logged in
	$admin_id = "";
	$username = "";
	$admin_info = logged_in();
	if(!empty($admin_info)){
		$admin_id = $admin_info[0];
		$username = $admin_info[1];
	}else{
		redirect_to_login();
	}
	// End of redirected if admin is not logged in
	
	$success = false;
	if(!empty($_GET)){
		$id = $_GET['user_id'];
		$user = find_user_by_id($id);
		if(delete_user_by_id($id) > 0){
			delete_order_by_user_order_id($id);
		
			set_users_deletion_msg();
			redirect_to_users();
		}
	}else{
		redirect_to_users();
	}

?>