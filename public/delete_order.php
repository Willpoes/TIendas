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
		$id = $_GET['order_id'];
		if(delete_order_by_id($id) > 0){
			
			set_deletion_msg_all("order");
			redirect_to_link("orders.php");
		}
	}else{
		redirect_to_link("orders.php");
	}

?>