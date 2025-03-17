<?php require_once('../../private/init.php'); ?>
<?php
	
	$mail = "";
	$message = [];  
	$count_user= 0;


function utf8mail($to,$s,$body,$from_name,$from_a, $reply)
{
    $s= "=?utf-8?b?".base64_encode($s)."?=";
    $headers = "MIME-Version: 1.0\r\n";
    $headers.= "From: =?utf-8?b?".base64_encode($from_name)."?= <".$from_a.">\r\n";
    $headers.= "Content-Type: text/plain;charset=utf-8\r\n";
    $headers.= "Reply-To: $reply\r\n";  
    $headers.= "X-Mailer: PHP/" . phpversion();
    mail($to, $s, $body, $headers);
}





	if(!empty($_GET['mail'])){
		$mail = $_GET['mail'];

		$count_user=find_mail_by_id($mail);

		

		 $user_clave = find_user_by_mail($mail);

    	$password = $user_clave['password'];
    	//$first_name = $user_clave['first_name'];

		if ($count_user==1){


	$emisor="hovertvi@gmail.com";
	$destinatario=$mail ;
	$asunto="Recuperar contraseña";
	$empresa="GAMARRA APP";
	//Estoy recibiendo el formulario, compongo el cuerpo

	$cuerpo = "<p>Estimado Usuario, se te envía este mensaje:</p>";	
	$cuerpo .= "<h1>CONTRASEÑA RECUPERADA</h1>";
	$cuerpo .= "<p>Tu email: " . $destinatario . "</p>";
	$cuerpo .= "<p>Clave: " . $password . "</p>";

	//$cabeceras="MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: ".$emisor." < GAMARRA APP >";

	$cabeceras="MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: ".$emisor." ";
	/*	$cabeceras = 'From: ' .$emisor. "\r\n" .
	'Reply-To: '.$emisor . "\r\n" .
	'X-Mailer: PHP/' . phpversion();*/

	//mando el correo...

	//utf8mail($destinatario,$asunto,$cuerpo,$empresa,$emisor, $emisor);

	mail($destinatario,$asunto,$cuerpo,$cabeceras);




		}

		$message['m'] = $count_user;


	
		
	}else{
		$message['m'] = 0;
	}
	
	echo json_encode($message);
	
	
?>