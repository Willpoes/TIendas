<?php

require_once('../../private/init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token['firebase_token'] =  $_POST['firebase_token'];
    $firebae_token_id = insert_fcm_token($token);
    if($firebae_token_id > 0) echo $firebae_token_id;

}

?>

