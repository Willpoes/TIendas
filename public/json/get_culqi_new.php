<?php require_once('../../private/init.php'); ?>
<?php

$datos = find_all_culqi();
echo json_encode($datos);

?>