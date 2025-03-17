<?php

require_once('../private/init.php');

$admin_id = "";
$username = "";
$admin_info = logged_in();
if(!empty($admin_info)){
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
}else{
    redirect_to_login();
}

$errors = [];
$success = false;

if(!empty($_GET)){

    $order = [];
    $order['order_id'] = $_GET['order_id'];
    $order['order_status'] = $_GET['order_status'];

    foreach($order as $key => $value) {
        if(empty($value)){
            $errors[] = is_empty($key, $value);
        }
    }

    if(empty($errors)){

        if(update_order_status($order)){
            $success = true;
            set_msg_all("order_status");
        }
    }

    $_SESSION['errors'] = $errors;

    if($success){
        $redirect_to = root_dir() . 'add_order.php?order_id=' . $order['order_id'];
        header('Location: ' . $redirect_to);
    }else{
        $redirect_to = root_dir() . 'add_order.php?order_id=' . $order['order_id'] .'&&errormsg=true';
        header('Location: ' . $redirect_to);
    }
}


?>