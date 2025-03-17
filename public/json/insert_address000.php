<?php

require_once('../../private/init.php');

if (!empty($_POST)) {

    $update_address = false;
    $address = [];
    $address['address_line_1'] = $_POST['address_line_1'];
    $address['address_line_2'] = $_POST['address_line_2'];
    $address['city'] = $_POST['city'];
    $address['zip_code'] = $_POST['zip_code'];
    $address['state'] = $_POST['state'];
    $address['country'] = $_POST['country'];
    $address['user_id'] = $_POST['user_id'];
    $address['province'] = $_POST['province'];
    $address['reception_name'] = $_POST['reception_name'];
    $address['email'] = $_POST['email'];
    $address['mobile'] = $_POST['mobile'];


    $allusers = find_user_by_id($address['user_id']);
    $address_id = $allusers['address'];
    $address['address_id'] = $address_id;

	
		
    if ($address_id == -1){

        $inserted_id = insert_address($address);
        if ($inserted_id > 0) {
            $user['user_id'] = $address['user_id'];
            $user['address'] = $inserted_id;

            if (update_adress_by_id($user)) echo "1";
            else echo "Algo salió mal. Inténtalo de nuevo.";

        } else  echo "Algo salió mal. Inténtalo de nuevo.";

    } else {

        $database_address = find_address_by_address_id($address_id);

        $Address_Line_1 = $database_address['address_line_1'];
        $Address_Line_2 = $database_address['address_line_2'];
        $City = $database_address['city'];
        $Zipcode = $database_address['zip_code'];
        $State = $database_address['state'];
        $Country = $database_address['country'];
        $Province = $database_address['province'];


        if (($Address_Line_1 != $address['address_line_1']) || ($Address_Line_2 != $address['address_line_2']) || ($City != $address['city']) ||
            ($Zipcode != $address['zip_code']) || ($State != $address['state']) || ($Country != $address['country'])
        ) {
            update_addres_table_by_address_id($address);
        }
    }
}

?>

