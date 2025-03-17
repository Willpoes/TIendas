<?php require_once('../../private/init.php'); ?>
<?php
	
	$categories = find_all_categories();
	echo json_encode($categories);
	
?>