<?php require_once('init.php'); ?>
<?php

function sendGCM($message){

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        'to'  => '/topics/message',
        'data' => array(
            "message" => $message,
        )
    );
    $fields = json_encode($fields);

    $headers = array(
        'Authorization:key = AAAAZ2f2Rck:APA91bGxp5D3Fm5adr_bdB0pu6z04SXzetyrOZE72WRhoiqY2F0b2UuQbrzxxFHPKHtBbaqr-VetGQjghzPfBHfL7sge9rVlAf6e5na6vzattnlEEv5V0YN1x5CviqpX4TpiKQIkm7GM',
        'Content-Type: application/json',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);

    curl_close($ch);
    return true;

}

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message['title'] = $_POST['push_title'];
    $message['desc'] = $_POST['push_desc'];

    foreach($message as $key => $value) {
        if(empty($value)) $errors[] = is_empty($key, $value);
    }



    if(empty($errors)){
        $m = json_encode($message);
        if(sendGCM($m)) set_session_msg('push_notification', "Notificación enviada con éxito.");
        else set_session_msg('push_notification', "Se produjo un error. Inténtalo de nuevo");
    }else $_SESSION['errors'] = $errors;

    redirect_to('../public/push-notification.php');
}

?>