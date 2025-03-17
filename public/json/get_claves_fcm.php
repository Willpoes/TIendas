<?php require_once('../../private/init.php'); ?>
<?php

$claves = get_keys_fcm();
echo json_encode($claves);

?>