<?php require_once('../../private/init.php'); ?>

<?php


function sendApi($api, $method,$data){
     
  
     
 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_URL => "https://api.culqi.com/v2/charges",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 //CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => $data,
 CURLOPT_HTTPHEADER => array(
 "accept: application/json",
 "authorization: Bearer ".$api,
 "cache-control: no-cache",
 "content-type: application/json"
 ),
 ));
 $response = curl_exec($curl);
 $err = curl_error($curl);
 curl_close($curl);
 if ($err) {
 echo "cURL Error #:" . $err;
 }
 return $response;
 }




//define("secret_key", "sk_test_3PIJCYT3vrE3tUG2");


//define("token", "sk_test_3PIJCYT3vrE3tUG2");


//function createCharge($token,$monto,$correo){


  

//echo  $token;
/*

  $url = "https://api.culqi.com/v2/charges";
  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_HTTPHEADER,
      ['Content-Type: application/javascript',
  	'Authorization: Bearer sk_test_3PIJCYT3vrE3tUG2' ,
  	'User-Agent: php-curl']
  );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  $gist = json_decode($result, true);*/
  
//print_r($gist);
  //if($gist) {
   // return   print_r($gist);
  //}

/*}
*/



$token=$_GET["token"];
$monto=$_GET["monto"];
$correo=$_GET["correo"];
$monto=$monto*100;

  $data = json_encode([
      //   'amount' => '39000',
    ///   'currency_code' => 'PEN',
     //  'email' => 'torres.edto@gmail.com',
    //  'source_id' => 'tkn_test_p4Qtd0X4Rpf8XRcz'
    'amount' => $monto,
     'currency_code' => 'PEN',
     'email' => $correo,
      'source_id' => $token
  ]);   
     
    
$culqi = get_culqi_id(1);

$culqi_title = $culqi['culqi_title'];
$culqi_publickey = $culqi['culqi_publickey'];
$culqi_authorization = $culqi['culqi_authorization'];

//echo sendApi('sk_test_3PIJCYT3vrE3tUG2',$token, $data) ;
//'sk_test_Z8J42wIX9dTbBBs8'/

$datos= sendApi( $culqi_authorization, $token, $data) ;

//print_r($datos);


/*
$datos='{"object":"error","type":"parameter_error","merchant_message":"No puedes utilizar un token que ya expiró: tkn_test_3oUBJUT0pBgpOOzh. Los tokens expiran tras 5 minutos de creados y sólo se pueden usar una vez.","user_message":"La operación fue rechazada debido a que superó el tiempo de inactividad (más de 5 min).","param":"source_id"}

';*/


//echo $datos;


$someArray = json_decode($datos, true);


//echo  "<br>";
//$message[]="";

if ($someArray["object"]=="error"){

//echo $someArray["object"];
//echo  "<br>";


$message['m'] = $someArray["merchant_message"];
$message['p'] = 0;
}else{
//echo $someArray["object"];
//echo  "<br>";
//echo $someArray["outcome"]["merchant_message"];
$message['m'] = $someArray["outcome"]["merchant_message"];
$message['p'] = 1;

}



echo json_encode($message, JSON_UNESCAPED_UNICODE);


//createCharge($token,$monto,$correo);

?>