<?php require_once('../../private/init.php');


if ($_GET['pagina'] == "elimnar_image_products") {
	$product = delete_product_images_by_id($_POST['id']);
} else if ($_GET['pagina'] == "actualizar_user") {

	$user['status'] = $_POST['status'];
	$user['business_name'] = $_POST['business_name'];
	$user['store'] = $_POST['store'];
	$user['ruc'] = $_POST['ruc'];
	$user['gallery'] = $_POST['gallery'];
	$user['user_id'] = $_POST['id'];

	$users = update_user_id($user);

	echo $users;
} else if ($_GET['pagina'] == "actualizar_estadoy_order") {

	$user['status'] = $_POST['status'];

	$user['id'] = $_POST['id'];

	$user['datey'] = date("Y-m-d H:i:s");


	$users = update_statusy_order_id($user);

	echo $users;

} else if ($_GET['pagina'] == "actualizar_estado_order") {

	$user['status'] = $_POST['status'];

	$user['id'] = $_POST['id'];

	$user['datex'] = date("Y-m-d H:i:s");


	$users = update_status_order_cabecera_id($user);

	echo $users;

} else if ($_GET['pagina'] == "mandarvariable") {

	$_SESSION['SWVV'] = $_GET['swvv'];
	//echo $product;

} else if ($_GET['pagina'] == "contarpedidos") {


	header('Content-Type: application/json');
	header("Access-Control-Allow-Origin: *");

	$user_id = $_GET['user_id'];
	//echo $user_id;
	$ordered_products = find_ordered_products_user_by_order_id($user_id);

	$ix = 0;
	if (!empty($ordered_products)) {
		foreach ($ordered_products as $ordered_product) {

			$ix = $ix + 1;
		}
	}

	$conttarpedidos = $ix;

	echo $conttarpedidos;


}




?>