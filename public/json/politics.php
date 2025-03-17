<?php require_once('../../private/init.php'); ?>
<?php

$datos = find_all_settings();
echo json_encode($datos);

?>