<?php

require_once('../private/init.php');

if(!empty($_POST)){

	$ordered_products = [];
	$ordered_products['product_id'] = $_POST['product_id'];
	$ordered_products['order_id'] = $_POST['order_id'];
	$ordered_products['ordered_quantity'] = $_POST['ordered_quantity'];
	$ordered_products['product_size_id'] = $_POST['product_size_id'];
	$ordered_products['product_color_id'] = $_POST['product_color_id'];
	$ordered_products['inventory_id'] = $_POST['inventory_id'];
	//$ordered_products['ordered_color_id'] = 1;


	$product = get_product_by_id($ordered_products['product_id']);

	$users= find_user_by_id($product['user_id']);
	
	$destinatario=$users['email'];	

	$emisor="bloggerfredd@gmail.com";
	$asunto="Pedido";
	$empresa="GAMARRA APP";

	$cuerpo = "<p> Estimado Vendedor, tiene un pedido:</p>";	
	$cuerpo .= "<h1>Tiene un pedido <a href='https://mishasho.com/moda-admin/consultas/index.php?order_id=".$_POST['order_id']."#'>CLICK AQUI</a></h1>";
	$cuerpo .= "<p>atte</p>";
	$cuerpo .= "<p>GAMARRA APP</p>";
	$cabeceras="MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: ".$emisor." ";


	mail($destinatario,$asunto,$cuerpo,$cabeceras);



	if(insert_ordered_products($ordered_products) > -1){

		
		$existing_inventory = get_inventory_by_id($ordered_products['inventory_id']);

		//echo $existing_inventory['available_qty'];
		$inventory['available_qty'] = $existing_inventory['available_qty'] - $ordered_products['ordered_quantity'];
		$inventory['inventory_id'] = $existing_inventory['inventory_id'];
		if(update_inventory_by_id($inventory)){
			echo "1";
		}else{
			echo "2";
		}

	}else{
		echo "2";
	}
}

?>


