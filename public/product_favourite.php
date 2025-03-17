<?php

require_once('../private/init.php');

if(!empty($_GET)){

	if(!empty($_GET['user_id']) && !empty($_GET['product_id']) && !empty($_GET['liked'])) {

		$product_favourite = [];
		$product_favourite['user_id'] = $_GET['user_id'];
		$product_favourite['product_id'] = $_GET['product_id'];
		$liked = $_GET['liked'];

		if ($liked == 1) {
			if (insert_product_favourite($product_favourite) > 0) echo "1";
			else echo "0";
		}else if($liked == 2){
			if (delete_product_favourite($product_favourite) > 0) echo "1";
			else echo "0";
		}

		if(is_numeric($product_favourite['user_id']) && is_numeric($product_favourite['product_id']) && is_numeric($liked)) {



		}
	}

}

?>

