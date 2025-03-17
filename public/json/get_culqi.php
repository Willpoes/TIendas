<?php

define("secret_key", "sk_test_3PIJCYT3vrE3tUG2");


//define("token", "sk_test_3PIJCYT3vrE3tUG2");


//function createCharge($token,$monto,$correo){

  $data = json_encode([
       'amount' => '39000',
      'currency_code' => 'PEN',
      'email' => 'torres.edto@gmail.com',
      'source_id' => 'tkn_test_q0EUDQmK1vYg96H1'
     // 'amount' => '$monto',
    ///  'currency_code' => 'PEN',
     // 'email' => '$correo',
     // 'source_id' => '$token'
  ]);

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
  $gist = json_decode($result, true);
//print_r($gist);
  //if($gist) {
   // return   print_r($gist);
  //}

/*}

$token=$_GET["token"];
$monto=$_GET["monto"];
$correo=$_GET["correo"];
$monto=$monto*100;
*/


//createCharge($token,$monto,$correo);

?>