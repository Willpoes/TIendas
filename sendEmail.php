<?php

use PHPMailer\PHPMailer\PHPMailer;

require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';


$fechaRegistro = date('d/m/y');
$nombre = $_POST['nombre'];
$email = $_POST['correo'];
$celular = $_POST['celular'];
$edad = $_POST['edad'];


if ($nombre == "") {
    echo "Ingresar Dato";
} else if ($email == "") {
    echo "Ingresar Dato";
} else if ($celular == "") {
    echo "Ingresar Dato";
} else if ($edad == "") {
    echo "Ingresar Dato";
} else {

    $mail = new PHPMailer(true);
    $contenido = '<html>' .
            '<head><title>FulVentas</title></head>' .
            '<body>'.
            '<img src="cid:logo_2u" style="width:100px">' .
            '<h2>Formulario Contacto - FulVentas</h2>' .
            'Datos del Cliente' .
            '<hr>' .
            '<p><b>Nombre: </b>' . $nombre . '</p>' .
            '<p><b>Email: </b>' . $email . '</p>' .
            '<p><b>Celular: </b>' . $celular . '</p>' .
            '<p><b>Edad: </b>' . $edad . '</p>' .
            '</body>' .
            '</html>';

    try {

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        //$mail->Username = 'diazgmiguel@gmail.com';
        //$mail->Password = 'jjdncwaosrceiofd';
        $mail->Username = 'fullventas.formulario@gmail.com';
        $mail->Password = 'fbhwlotkivqqejfu';
        
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //$mail->setFrom('diazgmiguel@gmail.com', 'FULVENTAS');
        $mail->setFrom('fullventas.formulario@gmail.com','FULVENTAS');
        //$mail->addAddress('diazgmiguel@gmail.com');
        $mail->addAddress('fullventas.formulario@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Formulario Contacto - FulVentas';
        $mail->AddEmbeddedImage('img/logo.png', 'logo_2u');
        $mail->Body = $contenido;

        $mail->send();
         echo "Gracias por Registrarte";
    } catch (Exception $ex) {
        echo "Hubo un error al enviar el mensaje: ", $mail->ErrorInfo;
    }
}