<?php require_once('../../private/init.php'); ?>
<?php

//$address = find_all_address();
// echo json_encode($address);

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user_address = find_user_by_id($user_id);

    $address = find_address_by_address_id($user_address['address']);
    if(!empty($address)) echo json_encode($address);

}

?>