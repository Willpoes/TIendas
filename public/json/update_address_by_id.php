<?php require_once('../../private/init.php'); ?>

<?php

    $is_updated = 2;
    if(!empty($_POST['user_id']) && !empty($_POST['address'])){

        $user['user_id'] = $_POST['user_id'];
        $user['address'] = $_POST['address'];

        if(update_adress_by_id($user)){
            $is_updated = 1;
        }


    }

    echo $is_updated;

?>