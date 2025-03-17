<?php

require_once('../../private/init.php');

if(!empty($_POST)){
	
	$address = [];

    $address['paddress_line_1'] = $_POST['paddress_line_1'];
    $address['paddress_line_2'] = $_POST['paddress_line_2'];
    $address['pcity'] = $_POST['pcity'];
    $address['pzip_code'] = $_POST['pzip_code'];
    $address['pstate'] = $_POST['pstate'];
    $address['pcountry'] = $_POST['pcountry'];

    $address['pdistrict'] = $_POST['pdistrict'];
    $address['pprovince'] = $_POST['pprovince'];
    $address['first_name'] = $_POST['first_name'];

    $address['last_name'] = $_POST['last_name'];
    $address['business_name'] = $_POST['business_name'];
    $address['mobile'] = $_POST['mobile'];
    $address['email'] = $_POST['email'];


    $usersAll=find_user_by_id($address['user_id']);
    $userAddressid=$usersAll['address'];

    $address['address_id']=$userAddressid;

    update_paymentaddres_table_by_address_id($address);


	
	
}

?>

