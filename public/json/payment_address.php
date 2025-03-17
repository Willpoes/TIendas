<?php

require_once('../../private/init.php');

if (!empty($_POST)) {

    $update_address = false;
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
    $address['user_id'] = $_POST['user_id'];

    $allusers = find_user_by_id($address['user_id']);
    $address_id = $allusers['address'];
    $address['address_id'] = $address_id;

		
    if ($address_id == -1){

        $inserted_id = insert_address($address);
        if ($inserted_id > 0) {
            $user['user_id'] = $address['user_id'];
            $user['address'] = $inserted_id;

            if (update_adress_by_id($user)) echo "1";
            else echo "Something went wrong. Please try again.";

        } else  echo "Something went wrong. Please try again.";

    } else {

        $database_address = find_address_by_address_id($address_id);

        $Address_Line_1 = $database_address['address_line_1'];
        $Address_Line_2 = $database_address['address_line_2'];
        $City = $database_address['city'];
        $Zipcode = $database_address['zip_code'];
        $State = $database_address['state'];
        $Country = $database_address['country'];


        if (($Address_Line_1 != $address['address_line_1']) || ($Address_Line_2 != $address['address_line_2']) || ($City != $address['city']) ||
            ($Zipcode != $address['zip_code']) || ($State != $address['state']) || ($Country != $address['country'])
        ) {
            update_paymentaddres_table_by_address_id($address);
        }
    }
}

?>

