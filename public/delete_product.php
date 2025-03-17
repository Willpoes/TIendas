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
		$id = $_GET['product_id'];
		$product = find_product_by_id($id);
		$product_images = get_images_by_product_id($id);
		if(delete_product_by_id($id) > 0){
			
			foreach($product_images as $img){
				delete_image($img['image_name'], dir_recent_product_from_php());
			}
			
			delete_product_image_by_product($id);
			
			set_product_deletion_msg();
			redirect_to_recent_product();
		}
	}else{
		redirect_to_login();
	}

?>