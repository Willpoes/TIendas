<?php

require_once('../../private/init.php');

if(!empty($_GET)){
	
	$opinions = [];    

	$opinions['user_id'] = $_GET['user_id'];
	$opinions['subject'] = $_GET['subject'];
	$opinions['date'] = $_GET['date'];
	$opinions['suggestion'] = $_GET['suggestion'];
    $opinions['email'] = $_GET['email'];

    insert_opinions($opinions);


	
	
}

?>

