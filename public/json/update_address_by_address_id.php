<?php

require_once('../../private/init.php');

if(!empty($_POST)){
	
	$address = [];
	$address['address_line_1'] = $_POST['address_line_1'];
	$address['address_line_2'] = $_POST['address_line_2'];
	$address['city'] = $_POST['city'];
	$address['zip_code'] = $_POST['zip_code'];
	$address['state'] = $_POST['state'];
	$address['country'] = $_POST['country'];
    $address['user_id'] = $_POST['user_id'];
    


    $usersAll=find_user_by_id($address['user_id']);
    $userAddressid=$usersAll['address'];

    $address['address_id']=$userAddressid;

    update_addres_table_by_address_id($address);


	
	
}

?>

