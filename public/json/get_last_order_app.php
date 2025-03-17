<?php require_once('../../private/init.php'); ?>
<?php

$ordenes = get_last_order();
echo json_encode($ordenes);

?>