<?php require_once('../../private/init.php'); ?>
<?php

if (isset($_GET['tokencito'])) {
    $id_token = $_GET['tokencito'];
     $tokens = find_fcm_tokens_val($id_token);
    echo json_encode($tokens);
}else {
     $tokens = [];
    echo json_encode($tokens);
}

?>