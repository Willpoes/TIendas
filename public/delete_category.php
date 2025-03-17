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
		$id = $_GET['category_id'];
		$category = find_category_by_id($id);
		if(delete_category_by_id($id) > 0){
			delete_image($category['image_name'], dir_category_from_php());
			set_category_deletion_msg();
			redirect_to_category();
		}
	}else{
		redirect_to_login();
	}

?>