<?php require_once('../../private/init.php'); ?>
<?php

$orders = find_orders_by_notification();
echo count($orders);

?>
