<?php

require_once('../../private/init.php');

if(!empty($_POST)){
	
	$opinions = [];    

	$opinions['user_id'] = $_POST['user_id'];
	$opinions['subject'] = $_POST['subject'];
	$opinions['date'] = $_POST['date'];
	$opinions['suggestion'] = $_POST['suggestion'];
    $opinions['email'] = $_POST['email'];

    insert_opinions($opinions);


	
	
}

?>

