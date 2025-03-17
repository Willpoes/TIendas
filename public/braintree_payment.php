<?php


	// Db Connect
	include_once('../private/database.php');
	
	$db = db_connect();
	
	function update_braintree($braintree) {
		global $db;
		
		$sql  = "UPDATE braintree_credentials SET ";
		$sql .= "environment='".db_escape($db, $braintree['environment'])."', ";
		$sql .= "merchant_id='".db_escape($db, $braintree['merchant_id'])."', ";
		$sql .= "public_key='".db_escape($db, $braintree['public_key'])."', ";
		$sql .= "private_key='".db_escape($db, $braintree['private_key'])."', ";
		$sql .= "user_id=".db_escape($db, $braintree['user_id'])." ";
		$sql .= "WHERE id=".db_escape($db, $braintree['id'])." ";
		$sql .= "LIMIT 1";

		$result = mysqli_query($db, $sql);
		// For UPDATE statements, $result is true/false
		if($result) {
		  return true;
		} else {
		  // UPDATE failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}
	function find_braintree() {
		global $db;

		$sql = "SELECT * FROM braintree_credentials";
		
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
		
	}
	
	
$all_braintree = find_braintree();


$braintree = [];
$i = 1;
foreach($all_braintree as $btree){
	$braintree = $btree;
	if($i > 1) break;
	$i++;	
}


include_once 'braintree-php-3.34.0/lib/Braintree.php';

$environment = $braintree["environment"];
$merchantId = $braintree["merchant_id"];
$publicKey = $braintree["public_key"];
$privateKey = $braintree["private_key"];

Braintree_Configuration::environment($environment);
Braintree_Configuration::merchantId($merchantId);
Braintree_Configuration::publicKey($publicKey);
Braintree_Configuration::privateKey($privateKey);


if(isset($_POST["NONCE"])&&($_POST["amount"])){
  $nonceFromTheClient = $_POST["NONCE"];
  $amountFromClient=$_POST["amount"];
  $result = Braintree_Transaction::sale([
    'amount' => $amountFromClient,
    'paymentMethodNonce' => $nonceFromTheClient,
    'options' => ['submitForSettlement' => true ]
  ]);


  if ($result->success) {
      //echo("success!: " . $result->transaction->id);
	  echo($result->transaction->paymentInstrumentType);
  } else if ($result->transaction) {
      echo "Error processing transaction: \n" . " code: " . $result->transaction->processorResponseCode . " \n " . " text: " . $result->transaction->processorResponseText;
  } else {
      echo "Validation errors: \n"; //+ $result->errors->deepAll();
  }

}else{
  echo($clientToken = Braintree_ClientToken::generate());
}




?>