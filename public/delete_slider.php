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
		$id = $_GET['slider_id'];
		$slider = find_slider_by_id($id);
		if(delete_slider_by_id($id) > 0){
			delete_image($slider['image_name'], dir_slider_from_php());
			set_slider_deletion_msg();
			redirect_to_slider();
		}
	}else{
		redirect_to_login();
	}

?>