<?php

require_once('init.php');
$errors = [];
$success = false;
$product = [];

if(!empty($_POST)){
	
	$admin = [];
	$admin['user_id'] = $_POST['user_id'];
    $admin['username']=$_POST['username'];
	//$admin['first_name']= ""; //$_POST['first_name'];
    //$admin['last_name']= "" ; //$_POST['last_name'];
    //$admin['number']= "" ;//$_POST['number'];
    
    $admin['first_name']= $_POST['first_name'];
    //$admin['last_name']= $_POST['last_name'];
    //$admin['last_name']= " ";
    $admin['last_name']= " ";
    $admin['number']= $_POST['number'];
    $admin['email']= $_POST['email'];
    
    //Campos de galeria
    
    $admin['fgallery']= $_POST['fgallery'];
    $admin['fdirection']= $_POST['fdirection'];
    $admin['fstand']= $_POST['fstand'];
    $admin['fstore']= $_POST['fstore'];
    

	$insert_admin_address = [];
	$insert_admin_address['address_line_1'] = $_POST['address_line_1'];
	$insert_admin_address['address_line_2'] = $_POST['address_line_2'];
	$insert_admin_address['city'] = "";  //$_POST['city'];
	$insert_admin_address['zip_code'] = "";  //$_POST['zip_code'];
	$insert_admin_address['state'] = ""; //$_POST['state'];
	$insert_admin_address['country'] = ""; //$_POST['country'];
	
	foreach($admin as $key => $value) {
		if(empty($value)) $errors[] = is_empty($key, $value);
	}
	
	if(empty($errors)){
		
		$admin_from_db = find_admin_by_id($admin['user_id']);
		$admin_address_id = $admin_from_db['address'];
		$insert_admin_address['address_id'] = $admin_address_id;

		if($admin_address_id == 0){

			$updated_admin = [];
			$inserted_address_id = insert_address($insert_admin_address);
			$updated_admin["user_id"] = $admin['user_id'];
            $updated_admin["email"] = $admin['email'];
            $updated_admin["username"] = $admin['username'];
			$updated_admin["first_name"]=$admin['first_name'];
            $updated_admin["last_name"]=$admin['last_name'];
			$updated_admin["number"]=$admin['number'];
			$updated_admin["email"]=$admin['email'];
			$updated_admin["address"]=$inserted_address_id;
			$updated_admin["gallery"]=$admin['fgallery'];
			$updated_admin["address_gallery"]=$admin['fdirection'];
			$updated_admin["store"]=$admin['fstore'];
			$updated_admin["number_store"]=$admin['fstand'];

			if(update_admin_address_by_id($updated_admin)){
				$success = true;
				set_admin_address_update_msg();
			}
		}else{

			$updated_admin = [];
			$updated_admin["user_id"] = $admin['user_id'];
            $updated_admin["email"] = $admin['email'];
            $updated_admin["username"] = $admin['username'];
			$updated_admin["first_name"]=$admin['first_name'];
            $updated_admin["last_name"]=$admin['last_name'];
			$updated_admin["number"]=$admin['number'];
			$updated_admin["address"]=$admin_address_id;
			$updated_admin["gallery"]=$admin['fgallery'];
			$updated_admin["address_gallery"]=$admin['fdirection'];
			$updated_admin["store"]=$admin['fstore'];
			$updated_admin["number_store"]=$admin['fstand'];
			
			update_addres_table_by_address_id($insert_admin_address);
			
			if(update_admin_address_by_id($updated_admin)){
				$success = true;
				set_admin_address_update_msg();
			}
		}
	}
	
	$_SESSION['address_errors'] = $errors;
	$redirect_to="";
	//if($success) $redirect_to = root_dir() . 'admin_profile.php?user_id='.$admin['user_id'].'&successmsg=true';
	if($success) $redirect_to = root_dir() . 'recent_products.php?&successmsg=true';
	else $redirect_to = root_dir().'admin_profile.php?user_id='.$admin['user_id'].'&errormsg=true';
	header('Location: ' . $redirect_to); 
}
	

?>