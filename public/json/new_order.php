<?php

require_once('../private/init.php');
	date_default_timezone_set("America/Lima");	

if(!empty($_POST)){

	//date_default_timezone_set('UTC');
	//date_default_timezone_set("America/Lima");

	$order = [];
	$order['order_method'] = $_POST['order_method'];
	$order['order_amount'] = $_POST['order_amount'];
	$order['order_user_id'] = $_POST['order_user_id'];
	$order['order_status'] = 1;
	//$order['order_time'] = date("Y-m-d H:i:s");
	$order['order_noti'] = 0;

	$inserted_id = insert_order($order);



	$users= find_user_by_id($order['order_user_id']);
	$destinatario=$users['email'];

//	$emisor="hovertvi@gmail.com";
	$emisor="bloggerfredd@gmail.com";
	$motor="fredd_zx@hotmail.com";
	$administrador="bloggerfredd@gmail.com";

	$asunto="Pedido";
	$empresa="GAMARRA APP";
	//Estoy recibiendo el formulario, compongo el cuerpo

	$cuerpo = "<p> Estimado usuario, tiene un pedido:</p>";	
	$cuerpo .= "<h1>Tiene un pedido <a href='https://gamarritas.com/consultas/index2.php?order_id=".$inserted_id."#'>CLICK AQUI</a></h1>";
	$cuerpo .= "<p>atte</p>";
	$cuerpo .= "<p>GAMARRA APP</p>";
	//$cabeceras="MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: ".$emisor." < GAMARRA APP >";

	$cabeceras="MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: ".$emisor." ";
	/*	$cabeceras = 'From: ' .$emisor. "\r\n" .
	'Reply-To: '.$emisor . "\r\n" .
	'X-Mailer: PHP/' . phpversion();*/
	//mando el correo...
	//utf8mail($destinatario,$asunto,$cuerpo,$empresa,$emisor, $emisor);

	mail($motor,$asunto,$cuerpo,$cabeceras);

	mail($administrador,$asunto,$cuerpo,$cabeceras);

	mail($destinatario,$asunto,$cuerpo,$cabeceras);

	if($inserted_id > 0) echo json_encode($inserted_id);
	else echo json_encode(0);
}

?>

