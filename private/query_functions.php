<?php require_once('init.php'); 
date_default_timezone_set("America/Lima");

?>



<?php




/*FCM APP TOKEN*/

function insert_fcm_token($token) {
	global $db;

	$sql = "INSERT INTO firebase_tokens ";
	$sql .= "(firebase_token) ";
	$sql .= "VALUES (";
	$sql .= "'" . db_escape($db, $token['firebase_token']) . "' ";
	$sql .= ")";

	$result = mysqli_query($db, $sql);
	mysqli_set_charset($db,"utf8");
	// For INSERT statements, $result is true/false
	if($result)  return mysqli_insert_id($db);
	else {
		// INSERT failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}


function find_fcm_tokens() {
	global $db;

	$sql = "SELECT * FROM firebase_tokens ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}

function find_fcm_tokens_val($token) {
	global $db;
	$sql = "SELECT COUNT(*) AS countToken FROM firebase_tokens ";
	$sql .= "WHERE firebase_token='" . db_escape($db, $token) . "' ";
	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;
}

function get_last_order() {
	global $db;
	$sql = "SELECT * FROM orders WHERE order_id = (Select Max(order_id)FROM orders)";
	//$sql .= "WHERE firebase_token='" . db_escape($db, $token) . "' ";
	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;
}

function get_keys_fcm() {
	global $db;
	$sql = "SELECT * FROM firebase_fcm";
	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;
}

/*SETTINGS*/

function insert_setting($setting) {
	global $db;

	$sql = "INSERT INTO settings ";
	$sql .= "(panel_logo_name, panel_site_name, panel_tag_line, panel_currency) ";
	$sql .= "VALUES (";
	$sql .= "'" . db_escape($db, $setting['panel_logo_name']) . "', ";
	$sql .= "'" . db_escape($db, $setting['panel_site_name']) . "', ";
	$sql .= "'" . db_escape($db, $setting['panel_tag_line']) . "', ";
	$sql .= "'" . db_escape($db, $setting['panel_currency']) . "' ";

	$sql .= ")";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	// For INSERT statements, $result is true/false
	if($result) {
		return mysqli_insert_id($db);
	} else {
		// INSERT failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function update_setting_by_id($setting) {
	global $db;

	$sql  = "UPDATE settings SET ";
	$sql .= "panel_logo_name='".db_escape($db, $setting['panel_logo_name'])."', ";
	$sql .= "panel_site_name='".db_escape($db, $setting['panel_site_name'])."', ";
	$sql .= "panel_tag_line='".db_escape($db, $setting['panel_tag_line'])."', ";
	$sql .= "panel_currency='".db_escape($db, $setting['panel_currency'])."', ";
	$sql .= "politicas='".db_escape($db, $setting['politicas'])."' ";

	$sql .= "WHERE setting_id=".db_escape($db, $setting['setting_id'])." ";
	$sql .= "LIMIT 1";

	mysqli_set_charset($db,"utf8");
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



function find_setting_of_admin($admin_id) {
	global $db;

	$sql = "SELECT * FROM settings ";
	///$sql .= "WHERE admin_id='" . db_escape($db, $admin_id) . "' ";
    $sql .= "WHERE admin_id='1' ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$admin = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $admin; // returns an assoc. array

}

/*ADDMOB*/

function find_admob_by_admin_id($admin_id) {

	global $db;

	$sql = "Select * FROM addmob_credentials ";
	//$sql .= "WHERE admin_id=" . db_escape($db, $admin_id) . " ";
	$sql .= "WHERE admin_id='1' ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$admin = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $admin; // returns an assoc. array

}

function get_admob() {

	global $db;

	$sql = "Select * FROM addmob_credentials ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$admin = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $admin; // returns an assoc. array

}

function update_admob_by_id($admob) {
	global $db;

	$sql  = "UPDATE addmob_credentials SET ";
	$sql .= "app_id='".db_escape($db, $admob['app_id'])."', ";
	$sql .= "add_unit_id='".db_escape($db, $admob['add_unit_id'])."' ";
	$sql .= "WHERE admob_id=".db_escape($db, $admob['admob_id'])." ";
	$sql .= "LIMIT 1";

	mysqli_set_charset($db,"utf8");
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




function update_order_noti_by_id($order_id) {
	global $db;

	$sql  = "UPDATE orders SET ";
	$sql .= "order_noti=1 ";
	$sql .= "WHERE order_id='".db_escape($db, $order_id)."' ";
	$sql .= "LIMIT 1";

	mysqli_set_charset($db,"utf8");
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

function find_orders_between_dates($start, $end) {
	global $db;

	$sql = "SELECT * FROM orders ";
	$sql .= "WHERE DATE(`order_time`) BETWEEN '" . db_escape($db, $end) . "' AND '" . db_escape($db, $start) . "' ";
	$sql .= "ORDER BY order_id DESC ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}

function find_orders_of_today() {
	global $db;

	$sql = "SELECT * FROM orders ";
	$sql .= "WHERE DATE(`order_time`) = CURDATE() ";
	$sql .= "ORDER BY order_id DESC ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}

function get_revenue_by_orders($todays_order){
	$todays_revenue = 0;
	if(!empty($todays_order)){
		foreach($todays_order as $order){

			$product_orders = find_ordered_products_by_order_id($order['order_id']);
			foreach($product_orders as $product_order){

				$quantity = $product_order['ordered_quantity'];
				$product = find_product_by_id($product_order['product_id']);
				$revenue = $product['purchase_price'] - $product['price'];
				$total_revenue = $quantity * $revenue;

				if($total_revenue > 0){
					$todays_revenue += $total_revenue;
				}

			}
		}
	}
	return $todays_revenue;
}

function order_by_current_date(){
	global $db;

	$sql = "SELECT * FROM orders WHERE DATE(`order_time`) = CURDATE()";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}

function update_adress_by_id($user) {
	global $db;
	
	$sql  = "UPDATE users SET ";
	$sql .= "address='".db_escape($db, $user['address'])."'";
	$sql .= "WHERE user_id='".db_escape($db, $user['user_id'])."' ";
	$sql .= "LIMIT 1";

	mysqli_set_charset($db,"utf8");
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


function update_dest_by_id($prod,$iddes) {
	global $db;
	
	$sql  = "UPDATE products SET ";
	$sql .= "outstanding='". $iddes."' ";
	$sql .= "WHERE id=".db_escape($db, $prod)." ";
	$sql .= "LIMIT 1";

	mysqli_set_charset($db,"utf8");
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


	function update_user_id($user) {
		global $db;

		$sql  = "UPDATE users SET ";
		$sql .= "status='".db_escape($db, $user['status'])."', ";
		//$sql .= "store='".db_escape($db, $user['store'])."', ";
		$sql .= "business_name='".db_escape($db, $user['business_name'])."', ";
		$sql .= "ruc='".db_escape($db, $user['ruc'])."' ";
		//$sql .= "gallery='".db_escape($db, $user['gallery'])."' ";
		$sql .= "WHERE user_id='".db_escape($db, $user['user_id'])."' ";

		$sql .= "LIMIT 1";
		
		mysqli_set_charset($db,"utf8");
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


	function update_status_order_id($user) {
		global $db;

		$sql  = "UPDATE ordered_products SET ";
		$sql .= "order_statusx='".db_escape($db, $user['status'])."', ";
		$sql .= "datex='".db_escape($db, $user['datex'])."' ";

		if (trim($user['status']) =='1' )  {
			$sql.= " ,visto='no' ";

		}
		$sql .= "WHERE ordered_id='".db_escape($db, $user['id'])."' ";

		$sql .= "LIMIT 1";
		
		mysqli_set_charset($db,"utf8");
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
     function update_status_order_cabecera_id($user) {
		global $db;

		$sql  = "UPDATE orders SET ";
		$sql .= "status_despacho='".db_escape($db, $user['status'])."', ";
		$sql .= "date_status='".db_escape($db, $user['datex'])."' ";

		$sql .= "WHERE order_id='".db_escape($db, $user['id'])."' ";

		$sql .= "LIMIT 1";
		
		mysqli_set_charset($db,"utf8");
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

	function update_statusy_order_id($user) {
		global $db;

		$sql  = "UPDATE ordered_products SET ";
		$sql .= "order_statusy='".db_escape($db, $user['status'])."', ";
		$sql .= "datey='".db_escape($db, $user['datey'])."' ";

		$sql .= "WHERE ordered_id='".db_escape($db, $user['id'])."' ";

		$sql .= "LIMIT 1";
		
		mysqli_set_charset($db,"utf8");
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

function update_addres_table_by_address_id($address){
	global $db;
	
	$sql  = "UPDATE address SET ";
	$sql .= "address_line_1='".db_escape($db, $address['address_line_1'])."', ";
	$sql .= "address_line_2='".db_escape($db, $address['address_line_2'])."', ";
	$sql .= "city='".db_escape($db, $address['city'])."', ";
	$sql .= "zip_code='".db_escape($db, $address['zip_code'])."', ";
	$sql .= "state='".db_escape($db, $address['state'])."', ";
	$sql .= "province='".db_escape($db, $address['province'])."', ";
	$sql .= "reception_name='".db_escape($db, $address['reception_name'])."', ";
	$sql .= "mobile='".db_escape($db, $address['mobile'])."', ";
	$sql .= "email='".db_escape($db, $address['email'])."', ";
	$sql .= "country='".db_escape($db, $address['country'])."' ";
	$sql .= "WHERE address_id='".db_escape($db, $address['address_id'])."' ";
	$sql .= "LIMIT 1";
     //echo $sql;

	mysqli_set_charset($db,"utf8");
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


function insert_opinions($opinions){
	global $db;
	

	$sql = "INSERT INTO opinions ";
	$sql .= "(user_id, subject, date, suggestion, email) ";
	$sql .= "VALUES (";
	$sql .= "'" . db_escape($db, $opinions['user_id']) . "',";
	$sql .= "'" . db_escape($db, $opinions['subject']) . "',";
	$sql .= "'" . db_escape($db, $opinions['date']) . "',";
	$sql .= "'" . db_escape($db, $opinions['suggestion']) . "',";
	$sql .= "'" . db_escape($db, $opinions['email']) . "'";
	$sql .= ")";

    //echo $sql;
	mysqli_set_charset($db,"utf8");
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


function update_paymentaddres_table_by_address_id($address){
	global $db;
	
	$sql  = "UPDATE address SET ";

	$sql .= "paddress_line_1='".db_escape($db, $address['paddress_line_1'])."', ";
	$sql .= "paddress_line_2='".db_escape($db, $address['paddress_line_2'])."', ";
	$sql .= "pcity='".db_escape($db, $address['pcity'])."', ";
	$sql .= "pzip_code='".db_escape($db, $address['pzip_code'])."', ";
	$sql .= "pstate='".db_escape($db, $address['pstate'])."', ";
	$sql .= "pcountry='".db_escape($db, $address['pcountry'])."', ";

	$sql .= "pdistrict='".db_escape($db, $address['pdistrict'])."', ";
	$sql .= "pprovince='".db_escape($db, $address['pprovince'])."', ";

	$sql .= "first_name='".db_escape($db, $address['first_name'])."', ";
	$sql .= "last_name='".db_escape($db, $address['last_name'])."', ";
	$sql .= "business_name='".db_escape($db, $address['business_name'])."', ";
	$sql .= "mobile='".db_escape($db, $address['mobile'])."', ";
	$sql .= "email='".db_escape($db, $address['email'])."' ";


	$sql .= "WHERE address_id='".db_escape($db, $address['address_id'])."' ";
	$sql .= "LIMIT 1";
     //echo $sql;
	mysqli_set_charset($db,"utf8");
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

	/*START OF ORDER*/

	function find_ordered_products_by_order_id($order_id) {

		global $db;

		$sql = "SELECT * FROM ordered_products ";
		$sql .= "WHERE order_id='".db_escape($db, $order_id)."'";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}



	function find_ordered_products_by_order_id_new($order_id) {

		global $db;

		$sql = "SELECT * FROM ordered_products WHERE order_id='".db_escape($db, $order_id)."'";

		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array


	}
	
	








	function find_ordered_products_user_by_order_id($user_id) {

		global $db;

		$sql = "Select ordered_products.*,products.* FROM ordered_products,products ";
		$sql .= "WHERE products.id=ordered_products.product_id and user_id='".db_escape($db, $user_id)."' order by `ordered_id` desc; ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}



	function find_ordered_seller_by_order_id() {

		global $db;

		$sql = "SELECT ordered_products.*,products.* FROM ordered_products,products 

		WHERE 
		 products.id=ordered_products.product_id  order by `ordered_id` desc;";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}
	
	function dar_color_ordenes(){
	   global $db;

		$sql = "SELECT DISTINCT(ordered_products.order_id) FROM ordered_products,products 
		WHERE products.id=ordered_products.product_id order by `ordered_id` desc";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array 
	}





	function find_ordered_products_user_by_order_id_user($order_id,$user_id) {

		global $db;

		$sql = "Select ordered_products.*,products.* FROM ordered_products,products ";
		$sql .= "WHERE order_id='".db_escape($db, $order_id)."' and  products.id=ordered_products.product_id and user_id='".db_escape($db, $user_id)."' order by `ordered_id` desc; ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}






	function find_order_list_user_by_order_id($user_id) {

		global $db;

		$sql="SELECT ordered_products.* FROM ordered_products WHERE  product_id in (SELECT id FROM products where user_id='".db_escape($db, $user_id)."' ORDER BY id)group by order_id    order by order_id DESC";
		///SELECT orders.*,(SELECT first_name FROM users WHERE user_id=orders.order_user_id) as cliente   FROM orders WHERE order_id in ( SELECT order_id FROM ordered_products WHERE  product_id in (SELECT id FROM products where user_id='".db_escape($db, $user_id)."' ORDER BY id)  group by order_id order by order_id DESC) ORDER BY `order_id`  DESC
//
		//echo  $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}

	function find_order_list_user_all($dateIni = null ,$dateEnd = null) {

		global $db;

		if ($dateIni!= null && $dateEnd!=null) {
			$sql="SELECT ordered_products.order_id FROM ordered_products WHERE  product_id in (SELECT id FROM products where 1 ORDER BY id) and ordered_products.date > '".db_escape($db, $dateIni)."' and ordered_products.date < '".db_escape($db, $dateEnd)."' group by order_id    order by order_id DESC";
		}
		else {
			$sql="SELECT ordered_products.order_id FROM ordered_products WHERE  product_id in (SELECT id FROM products where 1 ORDER BY id)group by order_id    order by order_id DESC";
		}
		
		///SELECT orders.*,(SELECT first_name FROM users WHERE user_id=orders.order_user_id) as cliente   FROM orders WHERE order_id in ( SELECT order_id FROM ordered_products WHERE  product_id in (SELECT id FROM products where user_id='".db_escape($db, $user_id)."' ORDER BY id)  group by order_id order by order_id DESC) ORDER BY `order_id`  DESC
//
		//echo  $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}

	function find_seller_list_user_by_order_id($user_id) {

		global $db;

		$sql="SELECT ordered_products.order_id FROM ordered_products WHERE  product_id in (SELECT id FROM products where user_id='".db_escape($db, $user_id)."' ORDER BY id)group by order_id    order by order_id DESC";
		///SELECT orders.*,(SELECT first_name FROM users WHERE user_id=orders.order_user_id) as cliente   FROM orders WHERE order_id in ( SELECT order_id FROM ordered_products WHERE  product_id in (SELECT id FROM products where user_id='".db_escape($db, $user_id)."' ORDER BY id)  group by order_id order by order_id DESC) ORDER BY `order_id`  DESC
//
		//echo  $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}







/*

,(SELECT CONCAT(first_name, " ", last_name)   FROM `users`  WHERE  `user_id`=orders.order_user_id) as cliene 

*/






	function insert_ordered_products($ordered_products) {
		global $db;
		date_default_timezone_set("America/Lima");
		$hoy = date("Y-m-d H:i:s"); 

		$sql = "INSERT INTO ordered_products ";
		$sql .= "(product_id, order_id, ordered_quantity, product_size_id, date, ordered_color_id) ";
		$sql .= "VALUES (";
		$sql .= "" . db_escape($db, $ordered_products['product_id']) . ",";
		$sql .= "" . db_escape($db, $ordered_products['order_id']) . ",";
		$sql .= "" . db_escape($db, $ordered_products['ordered_quantity']) . ",";
		$sql .= "" . db_escape($db, $ordered_products['product_size_id']) . ",";
		//$sql .= "" . db_escape($db, $hoy) . ",";
	    $sql .= "'" . db_escape($db, $hoy) . "', ";
		$sql .= "" . db_escape($db, $ordered_products['product_color_id']) . "";
		
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function insert_order($order) {
		global $db;
		date_default_timezone_set("America/Lima");
		$hoy = date("Y-m-d H:i:s"); 
		
		$sql = "INSERT INTO orders ";
		$sql .= "(order_method, order_amount, order_status, order_user_id, order_time, order_noti) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $order['order_method']) . "',";
		$sql .= "" . db_escape($db, $order['order_amount']) . ",";
		$sql .= "" . db_escape($db, $order['order_status']) . ",";
		$sql .= "" . db_escape($db, $order['order_user_id']) . ",";
		//$sql .= "'" . db_escape($db, $order['order_time']) . "', ";
		$sql .= "'" . db_escape($db, $hoy) . "', ";
		$sql .= "" . db_escape($db, $order['order_noti']) . "";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

    function find_all_orders() {
        global $db;

        $sql = "SELECT * FROM orders";

        mysqli_set_charset($db,"utf8");
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        mysqli_free_result($result);
        return $rows;

    }

	function find_orders_by_count() {
		global $db;

		$sql = "SELECT * FROM orders ";
		$sql .= "ORDER BY order_id DESC ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	function find_orders_by_notification() {
		global $db;

		$sql = "SELECT * FROM orders ";
		$sql .= "WHERE order_noti=0 ";
		$sql .= "ORDER BY order_id DESC";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	function find_orders_of_user($user_id) {
		global $db;

		$sql = "SELECT * FROM orders ";
		$sql .= "WHERE order_user_id='".db_escape($db, $user_id)."' ";
		$sql .= "ORDER BY order_id DESC";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}



	function find_orders_by_id($order_id) {
		global $db;

		$sql = "SELECT * FROM orders ";
		$sql .= "WHERE order_id='".db_escape($db, $order_id)."' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}




	function update_order_status($order) {
		global $db;

		$sql  = "UPDATE orders SET ";
		$sql .= "order_status='".db_escape($db, $order['order_status'])."' ";
		$sql .= "WHERE order_id='".db_escape($db, $order['order_id'])."' ";
		$sql .= "LIMIT 1";

		mysqli_set_charset($db,"utf8");
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

	function delete_order_by_id($order_id) {
		global $db;

		$sql = "DELETE FROM orders ";
		$sql .= "WHERE order_id='" . db_escape($db, $order_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}


	function delete_product_images_by_id($idx) {
		global $db;

		$sql = "DELETE FROM product_images ";
		$sql .= "WHERE id='" . db_escape($db, $idx) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}


	function delete_order_by_user_order_id($order_id) {
		global $db;

		$sql = "DELETE FROM orders ";
		$sql .= "WHERE order_user_id='" . db_escape($db, $order_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}




	// START OF USER
	function find_all_users() {
		global $db;
	
		$sql = "SELECT * FROM users";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	
	}

	function find_users_by_count($start, $finish) {
		global $db;

		$sql = "SELECT * FROM users WHERE type='1' ";
		$sql .= "ORDER BY user_id DESC ";
		$sql .= "LIMIT " . $start. ", " . $finish;

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}



	function find_sellers_by_count($types) {
		global $db;

		$sql = "SELECT * FROM users where  type='".$types."'";
		$sql .= " ORDER BY user_id DESC ";

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	// New return number of notifiacion view
	function total_view_noti() {
		global $db;

		$sql = "SELECT * FROM users WHERE type='2' AND view_noti='0'";
		

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		// $rows = [];
		// while($row = mysqli_fetch_assoc($result)){
		// 	$rows[] = $row;
		// }
		$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		return $rows;

	}


	// PEDIDOS NUEVOS para notifacaciones
	function total_view_noti_pedidos_new() {
		global $db;

		$sql = "SELECT * FROM orders WHERE view_noti='0'";
		

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		// $rows = [];
		// while($row = mysqli_fetch_assoc($result)){
		// 	$rows[] = $row;
		// }
		$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		return $rows;

	}


	// New return number of notifiacion view
	function total_visto_courier_pedidos() {
		global $db;

		$sql = "SELECT * FROM ordered_products WHERE visto = 'no'";
		

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		// $rows = [];
		// while($row = mysqli_fetch_assoc($result)){
		// 	$rows[] = $row;
		// }
		$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		return $rows;

	}

	// para las notificaiocna lcourier
		function update_sellers_notif_courier() {
		global $db;

		$sql = "UPDATE ordered_products SET visto='si'";	

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		//confirm_result_set($result);
		// $rows = [];
		// while($row = mysqli_fetch_assoc($result)){
		// 	$rows[] = $row;
		// }
		//$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		//return $rows;

	}

	// Actualiza el status de notifacion de Vendedores
	// Vendedores => 2
	// Courier => 3
	function update_sellers_notif() {
		global $db;

		$sql = "UPDATE users SET view_noti='1'";	

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		//confirm_result_set($result);
		// $rows = [];
		// while($row = mysqli_fetch_assoc($result)){
		// 	$rows[] = $row;
		// }
		//$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		//return $rows;

	}

	// Actuliza a pedido Nuevo a visto
	function update_sellers_pedido_visto() {
		global $db;

		$sql = "UPDATE orders SET view_noti='1'";	

		// echo ($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		//confirm_result_set($result);
		// $rows = [];
		// while($row = mysqli_fetch_assoc($result)){
		// 	$rows[] = $row;
		// }
		//$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		//return $rows;

	}

	
	function delete_user_by_id($user_id) {
		global $db;
	
		$sql = "DELETE FROM users ";
		$sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array
	
	}
	function delete_address_by_userid($user_id) {
		global $db;
	
		$sql = "DELETE FROM address ";
		$sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array
	
	}

	
	function find_user_by_id($user_id) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}
    
    function find_products_tienda($order_id) {
		global $db;

		$sql = "SELECT DISTINCT p.user_id AS user_id FROM ordered_products AS o, products AS p WHERE o.product_id=p.id ";
		$sql .= "AND o.order_id=" . db_escape($db, $order_id) . "";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
    function fin_product_tienda_de_orden($order_id,$id_tienda) {

		global $db;

		$sql = "SELECT * FROM ordered_products AS o, products AS p WHERE o.product_id=p.id AND o.order_id='".db_escape($db, $order_id)."' ";
        $sql.="AND p.user_id='".db_escape($db, $id_tienda)."' ";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;


	}



	function find_products_user_by_id($user_id) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}




	function find_user_by_mail($mail_id) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE email='" . db_escape($db, $mail_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}



	function find_mail_by_id($mail_id) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE email='" .  $mail_id . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		$num_rows = mysqli_num_rows($result);

		/*confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);*/
		return $num_rows; // returns an assoc. array

	}




	function find_address_by_user_id($user_id) {
		global $db;

		$sql = "SELECT * FROM address ";
		$sql .= "WHERE address_id='" . db_escape($db, $user_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}

	function find_address_by_address_id($address_id) {
		global $db;

		$sql = "SELECT * FROM address ";
		$sql .= "WHERE address_id='" . db_escape($db, $address_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}
	function user_exists_by_id($user_id){

		global $db;
		$sql = "SELECT user_id FROM users ";
		$sql .= "WHERE user_id=" . db_escape($db, $user_id) . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		return ( $user['user_id'] > 0 ) ? true : false;
	}

	function find_user_by_email($email) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE email='" . db_escape($db, $email) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $user;
	}

	function find_user_by_username($username) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE username='" . db_escape($db, $username) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $user;
	}
	
function insert_user_social($user) {
		global $db;

		$sql = "INSERT INTO users ";
		$sql .= "(first_name, last_name, username, email, password, image_name, address, user_number,membership) ";
		
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $user['first_name']) . "',";
		$sql .= "'" . db_escape($db, $user['last_name']) . "',";
		$sql .= "'" . db_escape($db, $user['username']) . "',";
		$sql .= "'" . db_escape($db, $user['email']) . "',";
		$sql .= "'" . db_escape($db, $user['password']) . "',";
		$sql .= "'" . db_escape($db, $user['image_name']) . "',";
		$sql .= "'" . db_escape($db, $user['address']) . "',";
		$sql .= "'" . db_escape($db, $user['user_number']) . "', ";
		$sql .= "'" . db_escape($db, $user['membership']) . "' ";

		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}


	function insert_user($user) {
		global $db;

		$sql = "INSERT INTO users ";
		$sql .= "(first_name, last_name, username, email, password, image_name, address, user_number,membership,department,district,province,mobile,useraddress) ";
		
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $user['first_name']) . "',";
		$sql .= "'" . db_escape($db, $user['last_name']) . "',";
		$sql .= "'" . db_escape($db, $user['username']) . "',";
		$sql .= "'" . db_escape($db, $user['email']) . "',";
		$sql .= "'" . db_escape($db, $user['password']) . "',";
		$sql .= "'" . db_escape($db, $user['image_name']) . "',";
		$sql .= "'" . db_escape($db, $user['address']) . "',";
		$sql .= "'" . db_escape($db, $user['number']) . "', ";
		$sql .= "'" . db_escape($db, $user['membership']) . "', ";

		$sql .= "'" . db_escape($db, $user['department']) . "', ";
		$sql .= "'" . db_escape($db, $user['district']) . "', ";
		$sql .= "'" . db_escape($db, $user['province']) . "', ";
		$sql .= "'" . db_escape($db, $user['mobile']) . "', ";
		$sql .= "'" . db_escape($db, $user['useraddress']) . "'";
		$sql .= ")";


		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}



	function insert_user_vender($user) {
		global $db;

		$sql = "INSERT INTO users ";
		$sql .= "(type,accept_terms,first_name, last_name, username, email, password, 
			image_name,membership,user_number,
			dni,ruc,business_name,
			mobile,store,gallery,
			useraddress,number_placed) ";
		
		$sql .= "VALUES ('2','1',";

		$sql .= "'" . db_escape($db, $user['first_name']) . "',";
		$sql .= "'" . db_escape($db, $user['last_name']) . "',";
		$sql .= "'" . db_escape($db, $user['username']) . "',";
		$sql .= "'" . db_escape($db, $user['email']) . "',";
		$sql .= "'" . db_escape($db, $user['password']) . "',";

		$sql .= "'" . db_escape($db, $user['image_name']) . "',";
		$sql .= "'" . db_escape($db, $user['membership']) . "', ";
		$sql .= "'" . db_escape($db, $user['number']) . "', ";

		$sql .= "'" . db_escape($db, $user['dni']) . "',";
		$sql .= "'" . db_escape($db, $user['ruc']) . "', ";
		$sql .= "'" . db_escape($db, $user['business_name']) . "', ";

		$sql .= "'" . db_escape($db, $user['mobile']) . "', ";
		$sql .= "'" . db_escape($db, $user['store']) . "', ";
		$sql .= "'" . db_escape($db, $user['gallery']) . "', ";

		$sql .= "'" . db_escape($db, $user['useraddress']) . "', ";
		$sql .= "'" . db_escape($db, $user['number_placed']) . "'

		";



		$sql .= ")";


		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}






	function insert_address($address) {
		global $db;

		$sql = "INSERT INTO address ";
		$sql .= "(address_line_1,address_line_2,city,zip_code,state,province,reception_name,country) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $address['address_line_1']) . "',";
		$sql .= "'" . db_escape($db, $address['address_line_2']) . "',";
		$sql .= "'" . db_escape($db, $address['city']) . "',";
		$sql .= "'" . db_escape($db, $address['zip_code']) . "',";
		$sql .= "'" . db_escape($db, $address['state']) . "',";
		$sql .= "'" . db_escape($db, $address['province']) . "',";
		$sql .= "'" . db_escape($db, $address['reception_name']) . "',";
		$sql .= "'" . db_escape($db, $address['country']) . "' ";
	
		$sql .= ")";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}


	function update_user($user) {
		global $db;

		$sql  = "UPDATE users SET ";
		$sql .= "active=".db_escape($db, $user['active']).", ";
		$sql .= "hash='".db_escape($db, $user['hash'])."' ";
		$sql .= "WHERE user_id=".db_escape($db, $user['user_id'])." ";
		$sql .= "LIMIT 1";
		
		mysqli_set_charset($db,"utf8");
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

	function update_user_image($user) {
		global $db;

		$sql  = "UPDATE users SET ";
		$sql .= "image_name='".db_escape($db, $user['image_name'])."' ";
		$sql .= "WHERE user_id=".db_escape($db, $user['user_id'])." ";
		$sql .= "LIMIT 1";
		
		mysqli_set_charset($db,"utf8");
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

	// Check uses with email
	function user_exists($email) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE email='" . db_escape($db, $email) . "' ";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return ( $user['user_id'] > 0 ) ? true : false;
	}

	function user_active($email) {
		global $db;

		$sql = "SELECT user_id FROM users ";
		$sql .= "WHERE email='" . db_escape($db, $email) . "' AND active = 1";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return ( $user['user_id'] > 0 ) ? true : false;
	}

	function login($email, $password){

		$user = find_user_by_email($email);
		// $password = md5($password);
		$typed_password = $user['password'];

		return ( $typed_password == $password) ? $user : false;
	}

	// END OF USER

	// START OF ADMIN
	function admin_login($email, $typed_password){

		$admin = find_admin_by_email($email);
		$admin_password = $admin['password'];

		return ( $admin_password == $typed_password) ? $admin : false;

		//return ( $admin_password == md5($typed_password)) ? $admin : false;
	}

	// Ahora es por Celular - 04.11.2020
	function find_admin_by_email($email){

		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE mobile='" . db_escape($db, $email) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}

	function find_admin_by_id($user_id){

		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE user_id=" . db_escape($db, $user_id) . " ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}

	function update_admin_by_id($admin){
		global $db;
		$sql  = "UPDATE users SET ";
		$sql .= "email='".db_escape($db, $admin['email'])."', ";
	

		$sql .= "password='".db_escape($db, $admin['password'])."' ";
		$sql .= "WHERE user_id=".db_escape($db, $admin['user_id'])." ";
		$sql .= "LIMIT 1";

		mysqli_set_charset($db,"utf8");
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
	function update_admin_address_by_id($admin){
		global $db;
		$sql  = "UPDATE users SET ";
		$sql .= "username='".db_escape($db, $admin['username'])."', ";
		$sql .= "first_name='".db_escape($db, $admin['first_name'])."', ";
		$sql .= "last_name='".db_escape($db, $admin['last_name'])."', ";
		$sql .= "number='".db_escape($db, $admin['number'])."', ";
		$sql .= "email='".db_escape($db, $admin['email'])."', ";
		$sql .= "address='".db_escape($db, $admin['address'])."', ";
		$sql .= "gallery='".db_escape($db, $admin['gallery'])."', ";
		$sql .= "address_gallery='".db_escape($db, $admin['address_gallery'])."', ";
		$sql .= "store='".db_escape($db, $admin['store'])."', ";
		$sql .= "number_store='".db_escape($db, $admin['number_store'])."' ";
		$sql .= "WHERE user_id='".db_escape($db, $admin['user_id'])."' ";
		$sql .= "LIMIT 1";
		//echo $sql;
		 
		mysqli_set_charset($db,"utf8");
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

	function update_password_by_id($user_id, $new_password){
		global $db;


		$sql  = "UPDATE users SET ";
		$sql .= "password='".db_escape($db, $new_password)."' ";
		$sql .= "WHERE user_id='".db_escape($db, $user_id)."' ";
		$sql .= "LIMIT 1";

		mysqli_set_charset($db,"utf8");
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

	function find_admin_by_username($username) {
		global $db;

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE username='" . db_escape($db, $username) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$admin = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $admin; // returns an assoc. array

	}
	// END OF ADMIN



	// START OF PRODUCT AREA

function search_products_by_name($searched_textx) {
	global $db;


	$sql = "SELECT  products.*,
	(select gallery from users where user_id=products.user_id) as gallery,
	(select store from users where user_id=products.user_id)  as store,
	(select title from categories where id=products.category)  as categoryname 

	FROM products   ";

	//$porciones = explode("/", $searched_textx);
	$searched_textx=trim($searched_textx);

	$porciones = explode("/", $searched_textx);

	$searched=trim($porciones[0]);

	$searched_text=trim($porciones[1]);
	$var_text1=trim($porciones[2]);
	$var_text2=trim($porciones[3]);

	$searched0 = explode("-", trim($searched));

	$searched1 = trim($searched0[0]);
	$searched2 = trim($searched0[1]);


if ($searched2=="cat"){


	if ($searched_text=="relevantes"){
	
	$sql.= "  WHERE  category='".$searched1."' order by relevant desc ";
	
	}elseif ($searched_text=="menoramayor"){
	
	$sql.= "  WHERE category='".$searched1."' order by price asc ";
	
	}else if ($searched_text=="mayoramenor"){
	
	$sql.= "  WHERE category='".$searched1."' order by price desc ";

	}else if ($searched_text=="tallas"){

	$sql.= " WHERE category='".$searched1."' and  products.id in(SELECT product_id FROM `product_inventory` WHERE `size_id`=(SELECT size_id FROM `product_sizes` WHERE `size_name` = '".$var_text1."') group by product_id)";

	}else if ($searched_text=="rangoprecio"){
	
	//$sql.= " (category='". db_escape($db, $searched1) ."') and  price BETWEEN '".$var_text1."' AND '".$var_text2."'  order by price asc ";
	$sql.= "WHERE (category='".$searched1."') and price BETWEEN '".$var_text1."' AND '".$var_text2."' order by price asc";
	}else{
	
	$sql.= " WHERE category='".$searched1."' AND (`title` LIKE '%". db_escape($db, $searched_text) ."%' or `brand` LIKE '%". db_escape($db, $searched_text) ."%') ";
	
	}


}else{



	if ($searched_text=="relevantes"){
	
	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched1) ."%' OR `brand`='".$searched1."')  order by relevant desc ";
	
	}elseif ($searched_text=="menoramayor"){
	
	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched1) ."%' OR `brand`='".$searched1."') order by price asc ";
	
	}else if ($searched_text=="mayoramenor"){
	
	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched1) ."%' OR `brand`='".$searched1."')  order by price desc ";

	}else if ($searched_text=="tallas"){

	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched1) ."%' OR `brand`='".$searched1."') and  products.id in(SELECT product_id FROM `product_inventory` WHERE `size_id`=(SELECT size_id FROM `product_sizes` WHERE `size_name` = '".$var_text1."') group by product_id)";

	}else if ($searched_text=="rangoprecio"){
	
	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched1) ."%' OR `brand`='".$searched1."') and  price BETWEEN ".$var_text1." AND ".$var_text2."  order by price asc ";

	}else{
	
	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched1) ."%' OR `brand`='".$searched1."' OR palabras_claves LIKE '%". db_escape($db, $searched1) ."%' ) ";
	
	}




}

/*
	if ($searched_text=="relevantes"){
	
	$sql.= "  WHERE (`title` LIKE '%". db_escape($db, $searched) ."%')  order by relevant desc ";
	
	}elseif ($searched_text=="menoramayor"){
	
	$sql.= "  WHERE (`title` LIKE '%". db_escape($db, $searched) ."%')  order by price asc ";
	
	}else if ($searched_text=="mayoramenor"){
	
	$sql.= "  WHERE (`title` LIKE '%". db_escape($db, $searched) ."%')  order by price desc ";

	}else if ($searched_text=="tallas"){

	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched) ."%') and  products.id in(SELECT product_id FROM `product_inventory` WHERE `size_id`=(SELECT size_id FROM `product_sizes` WHERE `size_name` = '".$var_text1."') group by product_id)";

	}else if ($searched_text=="rangoprecio"){
	
	$sql.= "  WHERE (`title` LIKE '%". db_escape($db, $searched) ."%') and  price BETWEEN ".$var_text1." AND ".$var_text2."  order by price asc ";

	}else{
	
	$sql.= " WHERE (`title` LIKE '%". db_escape($db, $searched) ."%') ";
	
	}
*/

	$sql.= "  limit 10 ";


	mysqli_set_charset($db,"utf8");

	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}








function search_products_by_name_s($searched_textx) {
	global $db;


	$sql= "";

	$searched_textx=trim($searched_textx);

	$porciones = explode("/", $searched_textx);

///////////////////////////////////////
	$searched=trim($porciones[0]);
	$searched0 = explode("-", trim($searched));

	$searched1 = trim($searched0[0]);
	$searched2 = trim($searched0[1]);
////////////////////////////////////////	


	$searched_text=trim($porciones[1]);

	$var_text1=trim($porciones[2]);
	$var_text2=trim($porciones[3]);



	if ($searched_text=="store"){

	$sql.= " select user_id,store  from users where store LIKE '%". db_escape($db, $searched) ."%'  

	order by store desc ";

	}elseif ($searched_text=="gallery"){

	$sql.= " select user_id,gallery  from users where gallery LIKE '%". db_escape($db, $searched) ."%'  

	order by gallery asc ";


	}





	$sql.= "  limit 10 ";




	mysqli_set_charset($db,"utf8");

	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}










function list_store_gallery_id($searched) {
	global $db;

	$sql = "SELECT user_id,store,gallery,image_name from users where `type` = '2' and gallery LIKE '%". db_escape($db, $searched) ."%' order by gallery asc ";

	$sql.= "  limit 10 ";

	mysqli_set_charset($db,"utf8");

	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}







function search_products_by_name_new($searched_textx) {
	global $db;


	$sql = "SELECT  products.*,
	(select gallery from users where user_id=products.user_id) as gallery,
	(select store from users where user_id=products.user_id)  as store,
	(select title from categories where id=products.category)  as categoryname 

	FROM products   ";


	$searched_textx=trim($searched_textx);

	$porciones = explode("/", $searched_textx);

///////////////////////////////////////
	$searched=trim($porciones[0]);
	$searched0 = explode("-", trim($searched));

	$searched1 = trim($searched0[0]);
	$searched2 = trim($searched0[1]);
////////////////////////////////////////	


	$searched_text=trim($porciones[1]);

	$var_text1=trim($porciones[2]);
	$var_text2=trim($porciones[3]);

	//$var_text3=trim($porciones[4]);




	if ($searched_text=="store"){

	$sql.= " WHERE user_id = '". db_escape($db, $searched) ."' 	order by relevant desc ";

	}elseif ($searched_text=="gallery"){

	$sql.= " WHERE user_id = '". db_escape($db, $searched) ."'	order by relevant desc ";

	}





	$sql.= "  limit 10 ";




	mysqli_set_charset($db,"utf8");

	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}



function search_products_by_name_all($searched_text) {
	global $db;

	$sql = "SELECT  products.*,
	(select gallery from users where user_id=products.user_id) as gallery,
	(select store from users where user_id=products.user_id)  as store,
	(select title from categories where id=products.category)  as categoryname FROM products ";
	$sql.= "WHERE (`title` LIKE '%". db_escape($db, $searched_text) ."%') ";
	$sql .=	"OR (`description` LIKE '%" . db_escape($db, $searched_text) . "%') ";

	mysqli_set_charset($db,"utf8");
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	mysqli_free_result($result);
	return $rows;

}







	function insert_product($product){
		global $db;
		
		//
		$sql = "INSERT INTO products ";
		$sql .= "(title,category,description,purchase_price,price,previous_price,
			date,sort,image_name,user_id,weight,back_width,longs,long_sleeve,breast_contour,waist,hip,status,brand, fotos_talla, palabras_claves) ";
		$sql .= "VALUES (";

		$totales=$product['price'];

		$ptotales=$product['previous_price'];

		if (isset($product['longs'])){
			$longs=$product['longs'];
		}else{
			$longs=0;
		}

		if (isset($product['long_sleeve'])){
			$long_sleeve=$product['long_sleeve'];
		}else{
			$long_sleeve=0;
		}


		if (isset($product['breast_contour'])){
			$breast_contour=$product['breast_contour'];
		}else{
			$breast_contour=0;
		}



		if (isset($product['waist'])){
			$waist=$product['waist'];
		}else{
			$waist=0;
		}

		if (isset($product['hip'])){
			$hip=$product['hip'];
		}else{
			$hip=0;
		}




		$sql .= "'" . db_escape($db, $product['title']) . "',";
		$sql .= "" . db_escape($db, $product['category']) . ",";
		$sql .= "'" . db_escape($db, $product['description']) . "',";
		$sql .= "" . db_escape($db, $product['purchase_price']) . ",";
		$sql .= "" . db_escape($db, $totales) . ",";
		$sql .= "" . db_escape($db, $ptotales) . ",";
		$sql .= "'" . db_escape($db, $product['date']) . "',";
		$sql .= "" . db_escape($db, $product['sort']) . ",";
		$sql .= "'" . db_escape($db, $product['image_name']) . "', ";
		$sql .= "'" . db_escape($db, $product['user_id']) . "', ";
		
		$sql .= "" . db_escape($db, $product['weight']) . ",";
		$sql .= "" . db_escape($db, $product['back_width']) . ",";

		$sql .= "" . db_escape($db, $product['longs']) . ",";
		$sql .= "'" . db_escape($db, $product['long_sleeve']) . "',";
		
		$sql .= "'" . db_escape($db, $product['breast_contour']) . "', ";
		$sql .= "'" . db_escape($db, $product['waist']) . "', ";

		$sql .= "" . db_escape($db, $product['hip']) . ",";


		$sql .= "'" . db_escape($db, $product['statu']) . "', ";
		$sql .= "'" . db_escape($db, $product['brand']) . "', ";
		// new
		$sql .= "'" . db_escape($db, $product['fotos_talla']) . "', ";
		$sql .= "'" . db_escape($db, $product['palabras_claves']) . "' ";
		$sql .= ")";


		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}

	function product_exists_by_id($product_id){

		global $db;
		$sql = "SELECT id FROM products ";
		$sql .= "WHERE id=" . db_escape($db, $product_id) . " ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		if(!empty($product)) return true;
		else return false;
	}


	function find_products_by_count($start, $count) {
		global $db;

		$sql = "SELECT * FROM products ";
		$sql .= "ORDER BY id DESC ";
		$sql .= "LIMIT " . $start. ", " . $count . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function traer_todo_productos(){
	    global $db;

		$sql = "SELECT * FROM products ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	
	function actualizar_productos_comision($id,$comision,$nuevo_precio){
	    global $db;

		$sql  = "UPDATE products SET ";
		$sql .= "price='".db_escape($db, $nuevo_precio)."', ";
		$sql .= "previous_price='".db_escape($db, $comision)."' ";
		$sql .= "WHERE  id='".db_escape($db, $id)."'";

        mysqli_set_charset($db,"utf8");
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



	function find_products_by_count_system($types,$filtro,$start, $count) {


	if ($types==1){
		$where=" and user_id in (select user_id from users where store like '%".$filtro."%' order by store asc) ";
		$orderx=" id DESC";

	}else if ($types==2){
		$where=" and user_id in (select user_id from users where gallery like '%".$filtro."%' order by gallery asc) ";
		$orderx=" id DESC";

	}else if ($types==3){
		$where=" ";
		$orderx=" outstanding asc";

	}else{

		$where=" ";
		$orderx=" id DESC ";

	}

		global $db;

		$sql = "SELECT * FROM products where id>=1 $where ";
		$sql .= "ORDER BY $orderx ";
	//	$sql .= "LIMIT " . $start. ", " . $count . " ";

		//echo  $sql;
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


	function find_products_by_count_user($user_id) {
		global $db;

		$sql = "SELECT * FROM products ";
		$sql .= " where  user_id='$user_id'    ORDER BY id DESC ";
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}




	function find_all_products() {
		global $db;

		$sql = "SELECT products.*,
		(select gallery from users where user_id=products.user_id) as gallery,
		(select store from users where user_id=products.user_id)  as store,
		(select title from categories where id=products.category)  as categoryname
		FROM products where outstanding=2 ORDER BY outstanding DESC,id DESC";/**/


		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


	function delete_product_by_id($product_id) {
		global $db;

		$sql = "DELETE FROM products ";
		$sql .= "WHERE id='" . db_escape($db, $product_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}

	function find_product_by_id($product_id) {
		global $db;

		$sql = "SELECT products.*,
		(select gallery from users where user_id=products.user_id) as gallery,
		(select store from users where user_id=products.user_id)  as store,
		(select title from categories where id=products.category)  as categoryname,
		(select tipo_tabla from categories where id=products.category)  as tipotabla
		FROM products 

		WHERE id='".db_escape($db, $product_id)."' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product; // returns an assoc. array

	}


	function find_ordered_products_by_id($product_id) {
		global $db;

	$sql = "SELECT ordered_products.*,products.* FROM ordered_products,products 

		WHERE 

		products.id=ordered_products.product_id  

and ordered_id='".db_escape($db, $product_id)."' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product; // returns an assoc. array

	}





	function find_seller_by_id($product_id) {
		global $db;

		$sql = "SELECT products.*,
		(select gallery from users where user_id=products.user_id) as gallery,
		(select store from users where user_id=products.user_id)  as store,
		(select title from categories where id=products.category)  as categoryname
		FROM products 

		WHERE id='".db_escape($db, $product_id)."' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product; // returns an assoc. array

	}

	function find_order_by_id($order_id) {
		global $db;

		$sql = "SELECT orders.*,
		(SELECT first_name  FROM users WHERE  user_id=orders.order_user_id) as cliente,
	(SELECT city  FROM address WHERE  address_id= (SELECT address FROM users WHERE user_id= orders.order_user_id )) as district


		FROM orders 

		WHERE order_id='".db_escape($db, $order_id)."' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product; // returns an assoc. array

	}

	function find_order_by_id_admi($order_id) {
		global $db;

		$sql = "SELECT o.* , u.store, u.gallery, count(o.order_id) as count FROM orders o INNER JOIN ordered_products op ON o.order_id = op.order_id  INNER JOIN products p ON op.product_id=p.id INNER JOIN users u ON p.user_id = u.user_id   WHERE o.order_id='$order_id' GROUP BY o.order_id";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product; // returns an assoc. array

	}










	function find_product_list_by_id($product_id) {
		global $db;

		$sql = "SELECT products.*,
		(select gallery from users where user_id=products.user_id) as gallery,
		(select store from users where user_id=products.user_id)  as store,
		(select title from categories where id=products.category)  as categoryname
		FROM products 

		WHERE id='".db_escape($db, $product_id)."' ";

		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product; // returns an assoc. array

	}






	function get_products_by_category($category) {
		global $db;

		$sql = "SELECT products.*,
		(select gallery from users where user_id=products.user_id) as gallery,
		(select store from users where user_id=products.user_id)  as store,
		(select title from categories where id=products.category)  as categoryname
		FROM products ";
		$sql .= "WHERE category='" . db_escape($db, $category) . "' ";
		$sql.= "ORDER BY id DESC";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}



	function update_product($product) {
		global $db;




		$sqlp = "SELECT COUNT(id) FROM products where id='".db_escape($db, $product['id'])."' 
		and price='".db_escape($db, $product['price'])."'";

		$resultp = mysqli_query($db,$sqlp);
		$count_p = mysqli_fetch_array($resultp);
		mysqli_free_result($resultp);

		$num_filap= $count_p[0];



		$sqlpp = "SELECT COUNT(id) FROM products where id='".db_escape($db, $product['id'])."' 
		and previous_price='".db_escape($db, $product['previous_price'])."'";

		$resultpp = mysqli_query($db,$sqlpp);
		$count_pp = mysqli_fetch_array($resultpp);
		mysqli_free_result($resultpp);

		$num_filapp= $count_pp[0];



		$sql  = "UPDATE products SET ";
		$sql .= "title='".db_escape($db, $product['title'])."', ";
		$sql .= "category='".db_escape($db, $product['category'])."', ";
		$sql .= "description='".db_escape($db, $product['description'])."', ";
		$sql .= "purchase_price='".db_escape($db, $product['purchase_price'])."', ";
		// Verifiso si actualizo foto talla
		if ( !empty($product['fotos_talla']) ){
			$sql .= "fotos_talla='".db_escape($db, $product['fotos_talla'])."', ";
		}




		if ($num_filapp==0){

		$previous_price=$product['previous_price'];

		$sql .= "previous_price='".db_escape($db, $previous_price)."', ";	
		}


		if ($num_filap==0){

		$price=$product['price'];
		
		$sql .= "price='".db_escape($db, $price)."', ";
		}

		// $sql .= "image_name='".db_escape($db, $product['image_name'])."', ";
		$sql .= "sort='".db_escape($db, $product['sort'])."', ";

		$sql .= "weight='".db_escape($db, $product['weight'])."', ";
		$sql .= "longs='".db_escape($db, $product['longs'])."', ";
		$sql .= "long_sleeve='".db_escape($db, $product['long_sleeve'])."', ";
		$sql .= "back_width='".db_escape($db, $product['back_width'])."', ";
		$sql .= "breast_contour='".db_escape($db, $product['breast_contour'])."', ";
		$sql .= "waist='".db_escape($db, $product['waist'])."', ";
		$sql .= "hip='".db_escape($db, $product['hip'])."', ";
		$sql .= "status='".db_escape($db, $product['statu'])."', "; 
		$sql .= "brand='".db_escape($db, $product['brand'])."' ";

		$sql .= "WHERE id='".db_escape($db, $product['id'])."' ";
		$sql .= "LIMIT 1";
		//echo$sql;
		mysqli_set_charset($db,"utf8");

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
	function insert_product_images($product_images){
		global $db;

		$sql = "INSERT INTO product_images ";
		$sql .= "(image_name, color_id, product_id) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $product_images['image_name']) . "',";
		$sql .= "'" . db_escape($db, $product_images['id_color']) . "',";
		$sql .= "" . db_escape($db, $product_images['product_id']) . "";
		$sql .= ")";
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}
	function update_product_images($product_images){
		global $db;
        if($product_images['image_name']==""){
            $sql = "UPDATE product_images ";
		$sql .= "SET ";
		$sql .= "color_id ='" . db_escape($db, $product_images['id_color']) . "'";
		$sql .= " WHERE id =".db_escape($db, $product_images['id_imagen'])."";
        }else{
           $sql = "UPDATE product_images ";
		$sql .= "SET ";
		$sql .= "image_name ='" . db_escape($db, $product_images['image_name']) . "', ";
		$sql .= "color_id ='" . db_escape($db, $product_images['id_color']) . "'";
		$sql .= " WHERE id =".db_escape($db, $product_images['id_imagen']).""; 
        }
		
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}
	function get_images_by_product_id($product_id){
		global $db;

		$sql = "SELECT * FROM product_images ";
		$sql .= "INNER JOIN colors on product_images.color_id = colors.color_id ";
		$sql .= "WHERE product_id=" . db_escape($db, $product_id) . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	
	function get_color_images_by_product_id($product_id){
		global $db;

		$sql = "SELECT * FROM product_images AS p, colors AS c ";
		$sql .= "WHERE p.color_id=c.color_id AND p.product_id=" . db_escape($db, $product_id) . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


	function get_all_images(){
		global $db;

		$sql = "SELECT * FROM product_images ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function delete_product_image_by_product($product_id) {
		global $db;

		$sql = "DELETE FROM product_images ";
		$sql .= "WHERE product_id=" . db_escape($db, $product_id) . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}
	// END OF PRODUCT IMAGE


	// START OF CATEGORY AREA
	function insert_category($category){
		global $db;

		$sql = "INSERT INTO categories ";
		$sql .= "(title, sort, image_name,types,status, tipo_tabla) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $category['title']) . "',";
		$sql .= "" . db_escape($db, $category['sort']) . ",";
		$sql .= "'" . db_escape($db, $category['image_name']) . "',";
		$sql .= "'" . db_escape($db, $category['type']) . "',";
		$sql .= "'" . db_escape($db, $category['statu']) . "',";
		$sql .= "'" . db_escape($db, $category['tabla_tallas']) . "'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}



	// START OF CATEGORY AREA
	function insert_slider($slider){
		global $db;

		$sql = "INSERT INTO slider ";
		$sql .= "(title, sort, image_name,status) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $slider['title']) . "',";
		$sql .= "" . db_escape($db, $slider['sort']) . ",";
		$sql .= "'" . db_escape($db, $slider['image_name']) . "',";
		$sql .= "'" . db_escape($db, $slider['statu']) . "'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}



	function find_all_categories() {
		global $db;

		$sql = "SELECT * FROM categories";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function find_all_categories_types() {
		global $db;

		$sql = "SELECT c.id,c.title as categorie, t.title FROM categories c LEFT JOIN types t ON c.types = t.id";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		$res = [];
		foreach ($rows as $key) {
			$cat = $key['id'];
			$sql = "SELECT p.* FROM products p  Where p.category = $cat LIMIT 4";
			mysqli_set_charset($db,"utf8");
			$result = mysqli_query($db, $sql);
			confirm_result_set($result);
			$rows2 = [];
			while($row = mysqli_fetch_assoc($result)){
				$rows2[] = $row;
			}
			$aux = [ 'id_category' => $key['id'] ,
			  'categorie' => $key['categorie'] ,
			  'title' => $key['title'] ,
			  'products' => $rows2 ];
			array_push($res,$aux);
		}

		mysqli_free_result($result);
		return $res;

	}


/*
	function find_all_slider() {
		global $db;

		$sql = "SELECT * FROM slider";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
*/
    function get_categoria_id_type($id_type){
        global $db;

		$sql = "SELECT * FROM categories WHERE types='".$id_type."'";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
    }




	function find_all_categories_type($id_type) {
		global $db;

		$sql = "SELECT cat.id, cat.title, cat.sort, cat.image_name, cat.types, cat.status, 
(SELECT count(*) from products WHERE category= cat.id AND status=1) as count
FROM categories cat
 where cat.types='".$id_type."'";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}



	function find_all_types() {
		global $db;

		$sql = "SELECT * FROM types";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


		function find_all_slider() {
		global $db;

		$sql = "SELECT * FROM slider";

		mysqli_set_charset($db,"utf8");

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


	function find_all_settings() {
		global $db;

		$sql = "SELECT politicas FROM settings where setting_id='1'";

		mysqli_set_charset($db,"utf8");

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}



	function find_all_culqi() {
		global $db;

		$sql = "SELECT culqi_title,culqi_authorization,culqi_publickey FROM settings where setting_id='1'";

		mysqli_set_charset($db,"utf8");

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


	function get_culqi_id($product_id) {
		global $db;


	$sql = "SELECT culqi_title,culqi_authorization,culqi_publickey FROM settings where setting_id='" . db_escape($db, $product_id) . "'";



		mysqli_set_charset($db,"utf8");

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}







	// START OF type AREA
	function insert_type($type){
		global $db;

		$sql = "INSERT INTO types ";
		$sql .= "(title, sort, image_name) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $type['title']) . "',";
		$sql .= "" . db_escape($db, $type['sort']) . ",";
		$sql .= "'" . db_escape($db, $type['image_name']) . "'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}







	function find_type_by_id($type_id) {
		global $db;

		$sql = "SELECT * FROM types ";
		$sql .= "WHERE id='" . db_escape($db, $type_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$type = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $type; // returns an assoc. array

	}

	function update_type($type) {
		global $db;

		$sql  = "UPDATE types SET ";
		$sql .= "title='".db_escape($db, $type['title'])."', ";
		$sql .= "image_name='".db_escape($db, $type['image_name'])."', ";
		$sql .= "sort=".db_escape($db, $type['sort'])." ";
		$sql .= "WHERE id=".db_escape($db, $type['id'])." ";
		$sql .= "LIMIT 1";

mysqli_set_charset($db,"utf8");
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





			

	function find_all_status() {
		global $db;

		$sql = "SELECT * FROM status";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}



	function find_all_address() {
		global $db;

		$sql = "SELECT * FROM address";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	function delete_category_by_id($category_id) {
		global $db;

		$sql = "DELETE FROM categories ";
		$sql .= "WHERE id='" . db_escape($db, $category_id) . "' ";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}


	function delete_slider_by_id($slider_id) {
		global $db;

		$sql = "DELETE FROM slider ";
		$sql .= "WHERE id='" . db_escape($db, $slider_id) . "' ";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}


	function find_category_by_id($category_id) {
		global $db;

		$sql = "SELECT * FROM categories ";
		$sql .= "WHERE id='" . db_escape($db, $category_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$category = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $category; // returns an assoc. array

	}
	function find_adds_by_id($adds_id) {
		global $db;

		$sql = "SELECT * FROM anuncios ";
		$sql .= "WHERE id_anuncio='" . db_escape($db, $adds_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$adds = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $adds; // returns an assoc. array

	}
	

function find_slider_by_id($slider_id) {
		global $db;

		$sql = "SELECT * FROM slider ";
		$sql .= "WHERE id='" . db_escape($db, $slider_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$slider = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $slider; // returns an assoc. array

	}

	function update_adds($adds) {
		global $db;

		$sql  = "UPDATE anuncios SET ";
		$sql .= "titulo='".db_escape($db, $adds['title'])."', ";
		if (isset($adds['image_name'])) {
			$sql .= "url_foto='".db_escape($db, $adds['image_name'])."', ";
		}
		
		$sql .= "descripcion='".db_escape($db, $adds['description'])."', ";
		$sql .= "tipo_anuncio='".db_escape($db, $adds['type'])."', ";
		$sql .= "fecha_registro='".db_escape($db, $adds['fecha_registro'])."', ";
		$sql .= "fecha_expira='".db_escape($db, $adds['fecha_expira'])."', ";
		$sql .= "RazonSocial='".db_escape($db, $adds['RazonSocial'])."', ";
		$sql .= "Celular=".db_escape($db, $adds['Celular']).", ";
		$sql .= "Correo='".db_escape($db, $adds['Correo'])."', ";
		$sql .= "Contacto='".db_escape($db, $adds['Contacto'])."' ";
		$sql .= "WHERE id_anuncio=".db_escape($db, $adds['adds_id'])." ";
		$sql .= "LIMIT 1";


		mysqli_set_charset($db,"utf8");
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

	function update_category($category) {
		global $db;

		$sql  = "UPDATE categories SET ";
		$sql .= "title='".db_escape($db, $category['title'])."', ";
		$sql .= "image_name='".db_escape($db, $category['image_name'])."', ";
		$sql .= "types='".db_escape($db, $category['type'])."', ";
		$sql .= "status='".db_escape($db, $category['statu'])."', ";
		$sql .= "sort=".db_escape($db, $category['sort']).", ";
		$sql .= "tipo_tabla=".db_escape($db, $category['tabla_tallas'])." ";
		$sql .= "WHERE id=".db_escape($db, $category['id'])." ";
		$sql .= "LIMIT 1";


mysqli_set_charset($db,"utf8");
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
	// END OF CATEGORY AREA


	function update_slider($slider) {
		global $db;

		$sql  = "UPDATE slider SET ";
		$sql .= "title='".db_escape($db, $slider['title'])."', ";
		$sql .= "image_name='".db_escape($db, $slider['image_name'])."', ";
		$sql .= "status='".db_escape($db, $slider['statu'])."', ";
		$sql .= "sort=".db_escape($db, $slider['sort'])." ";
		$sql .= "WHERE id=".db_escape($db, $slider['id'])." ";
		$sql .= "LIMIT 1";

mysqli_set_charset($db,"utf8");
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
	// END OF CATEGORY AREA

	// START OF AVAILABLE PRODUCT COLOR
	function get_inventory_by_product_id($product_id){
		global $db;

		$sql = "SELECT s.size_name,p.available_qty,p.inventory_id,p.color_id,p.size_id,c.color_name FROM product_inventory AS p, product_sizes AS s, colors AS c  
		WHERE s.size_id=p.size_id AND c.color_id=p.color_id AND p.product_id=" . db_escape($db, $product_id) . " 
		";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function delete_medidas($id_medida){
	    global $db;

        $sql  = "DELETE FROM product_sizes_2 ";
        $sql .= "WHERE id_zize=".db_escape($db, $id_medida)."";

        mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
	}
	
	function medidas_product_by_id($product_id){
	    global $db;

		$sql = "SELECT * FROM product_sizes_2 AS p, product_sizes AS s WHERE p.size=s.size_id AND p.product_id=" . db_escape($db, $product_id) . " 
		 ORDER BY `p`.`id_zize` ASC";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}



	// START OF AVAILABLE PRODUCT COLOR
/*	function get_product_id($product_id){
		global $db;


		$sql = "SELECT store,gallery 
		FROM products, users 
		WHERE products.user_id=users.user_id and  products.id='" . db_escape($db, $product_id) . "' 
		";


		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
*/


	function get_product_id($product_id) {
		global $db;

		$sql = "SELECT weight,longs,long_sleeve,back_width,breast_contour,waist,hip,brand,store,gallery,additional,politics, products.user_id as user_id
		FROM products, users 
		WHERE products.user_id=users.user_id and  products.id='" . db_escape($db, $product_id) . "' 
		";

		mysqli_set_charset($db,"utf8");

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}






	function get_inventory_by_id($inventory_id){
		global $db;

		$sql = "SELECT * FROM product_inventory ";
		$sql .= "WHERE inventory_id=" . db_escape($db, $inventory_id) . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}


	function get_product_by_id($id){
		global $db;

		$sql = "SELECT products.*,
		(select email from users where user_id=products.user_id) as email
		 FROM products ";
		$sql .= "WHERE id=" . db_escape($db, $id) . " ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}






	function insert_available_inventory($product_color_qty){
		global $db;

		$sql = "INSERT INTO product_inventory ";
		$sql .= "(color_id, size_id, product_id, available_qty) ";
		$sql .= "VALUES (";
		$sql .= "" . db_escape($db, $product_color_qty['color_id']) . ", ";
		$sql .= "" . db_escape($db, $product_color_qty['size_id']) . ", ";
		$sql .= "" . db_escape($db, $product_color_qty['product_id']) . ", ";
		$sql .= "" . db_escape($db, $product_color_qty['available_qty']) . "";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}

	function insert_sizes_product($id,$sizes,$medidasX,$medidasY,$medidasZ){
		global $db;
			$sql = "INSERT INTO product_sizes_2 ";
			$sql .= "(product_id, medidax, mediday, medidaz, size) ";
			$sql .= "VALUES (";
			$sql .= "'" . db_escape($db, $id) . "',";
			$sql .= "'" . db_escape($db, $medidasX) . "',";
			$sql .= "'" . db_escape($db, $medidasY) . "',";
			$sql .= "'" . db_escape($db, $medidasZ) . "',";
			$sql .= "'" . db_escape($db, $sizes) . "'";
			$sql .= ")";
			mysqli_set_charset($db,"utf8");
			$result = mysqli_query($db, $sql);
		
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}
    function delete_inventory($product_inventory){
        global $db;

        $sql  = "DELETE FROM product_inventory ";
        $sql .= "WHERE inventory_id=".db_escape($db, $product_inventory)."";

        mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
    }


    function update_inventory($product_inventory) {
        global $db;

        $sql  = "UPDATE product_inventory SET ";

        $sql .= "color_id='".db_escape($db, $product_inventory['color_id'])."', ";
        $sql .= "size_id='".db_escape($db, $product_inventory['size_id'])."', ";
        $sql .= "available_qty='".db_escape($db, $product_inventory['available_qty'])."' ";
        $sql .= "WHERE inventory_id=".db_escape($db, $product_inventory['inventory_id'])." ";
        $sql .= "LIMIT 1";

mysqli_set_charset($db,"utf8");
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


	function update_inventory_by_size_p_id($product_inventory) {
		global $db;

		$sql  = "UPDATE product_inventory SET ";
		$sql .= "available_qty=".db_escape($db, $product_inventory['available_qty'])." ";
		$sql .= "WHERE product_id=".db_escape($db, $product_inventory['product_id'])." ";
		$sql .= "AND size_id='".db_escape($db, $product_inventory['size_id'])."' ";
		$sql .= "LIMIT 1";

        mysqli_set_charset($db,"utf8");
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

function update_inventory_by_id($product_inventory) {
	global $db;

	$sql  = "UPDATE product_inventory SET ";
	$sql .= "available_qty=".db_escape($db, $product_inventory['available_qty'])." ";
	$sql .= "WHERE inventory_id=".db_escape($db, $product_inventory['inventory_id'])." ";
	$sql .= "LIMIT 1";

mysqli_set_charset($db,"utf8");
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


	function find_inventory_by_size_p_id($inventory){
		global $db;

		$sql = "SELECT * FROM product_inventory ";
		$sql .= "WHERE product_id=" . db_escape($db, $inventory['product_id']) . " ";
		$sql .= "AND size_id=" . db_escape($db, $inventory['size_id']) . " ";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}


	// END OF AVAILABLE PRODUCT COLOR


	// START OF COLOR AREA
	function insert_color($color){
		global $db;

		$sql = "INSERT INTO colors ";
		$sql .= "(color_name, color_code) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $color['color_name']) . "',";
		$sql .= "'" . db_escape($db, $color['color_code']) . "'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}

	function find_all_colors() {
		global $db;

		$sql = "SELECT * FROM colors";

mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function get_color_producto_id($id_producto) {
		global $db;

		$sql = "SELECT DISTINCT(c.color_name),p.color_id FROM product_inventory AS p, colors AS c WHERE c.color_id=p.color_id AND p.product_id=". db_escape($db, $id_producto) . " ";

        mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$product = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $product;

	}

	function delete_color_by_id($color_id) {
		global $db;

		$sql = "DELETE FROM colors ";
		$sql .= "WHERE color_id='" . db_escape($db, $color_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}

	function find_color_by_id($color_id) {
		global $db;

		$sql = "SELECT * FROM colors ";
		$sql .= "WHERE color_id='".db_escape($db, $color_id)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}

	function update_color($color) {
		global $db;

		$sql  = "UPDATE colors SET ";
		$sql .= "color_name='".db_escape($db, $color['color_name'])."', ";
		$sql .= "color_code='".db_escape($db, $color['color_code'])."' ";
		$sql .= "WHERE color_id='".db_escape($db, $color['color_id'])."'";
		$sql .= "LIMIT 1";

		mysqli_set_charset($db,"utf8");
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
	// END OF CATEGORY AREA

	/* START OF SIZE*/

	function insert_size($product_size){
		global $db;

		$sql = "INSERT INTO product_sizes ";
		$sql .= "(size_name, category_id) ";
		$sql .= "VALUES (";
		$sql .= "'".db_escape($db, $product_size['size_name'])."',";
		$sql .= "'".db_escape($db, $product_size['category'])."'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	// Cambios para categorias con tallas
	function find_all_sizes() {
		global $db;

		$sql = "SELECT size.size_id, size.size_name, size.category_id, cate.title FROM product_sizes size INNER JOIN categories cate on size.category_id = cate.id";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	function get_sizes_product($product_id) {
		global $db;

		$sql = "SELECT * FROM product_sizes_2 size Where product_id = $product_id";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	// Cambios para categorias con tallas de un producto
	function find_all_sizes_product($id_product) {
		global $db;

		$sql = "SELECT size.size_id, size.size_name, size.category_id, cate.title FROM product_sizes size INNER JOIN categories cate on size.category_id = cate.id INNER JOIN products pro on pro.category = cate.id WHERE pro.id = $id_product";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	
	// ===================================
    // Nuevos cambios - 26.05.2021
    function find_all_sizes_category() {
		global $db;

		$sql = "SELECT cate.id as id ,cate.title FROM categories cate ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	
	function find_size_by_category_id($category_id) {
		global $db;

		// $sql = "SELECT * FROM product_sizes ";
		$sql = "SELECT size.size_name as size_name FROM product_sizes size ";

		$sql .= " WHERE size.category_id='".db_escape($db, $category_id)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql) or die("Error: " . mysqli_error($db));
		confirm_result_set($result);
		
// 		var_dump($sql);
		
		$tallas = [];
		while($row = mysqli_fetch_assoc($result)){
			$tallas[] = $row;
		}
		
// 		var_dump($tallas);
		
		mysqli_free_result($result);
		return $tallas; // returns an assoc. array

	}
	
	
	// Actualiza la talla y categoria
	function update_size_for_Category($product_size) {
		global $db;

		$sql  = "UPDATE product_sizes SET ";
		$sql .= "size_name='".db_escape($db, $product_size['size_name'])."', ";
		$sql .= "category_id='".db_escape($db, $product_size['category'])."' ";
		$sql .= "WHERE size_id='".db_escape($db, $product_size['size_id'])."' ";
		$sql .= "LIMIT 1";

		mysqli_set_charset($db,"utf8");
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
	
	// Busca si existe Talla y Categoria.
	 function find_size_and_category($talla, $id_category) {
		global $db;

		$sql = "SELECT size_name FROM product_sizes ";
		$sql .= " WHERE category_id='".db_escape($db, $id_category)."' ";
		$sql .= " AND TRIM(UPPER(size_name))='".db_escape($db, $talla)."' ";
		
// 		var_dump($sql);

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		
		$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		
		if ($rows > 0) {
		    return true;
		} else {
		    return false;
		}

	}

    // Aqui registra nueva talla 
    function insert_size_for_catego($product_size, $size){
		global $db;

		$sql = "INSERT INTO product_sizes ";
		$sql .= "(size_name, category_id) ";
		$sql .= "VALUES (";
		$sql .= "'".db_escape($db, $size)."',";
		$sql .= "'".db_escape($db, $product_size['category'])."'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}
	
	// Me lista las tallas de acuerdo a las categoria seleccionada.
	function find_all_sizes_for_category($id_category) {
		global $db;

		$sql = "SELECT size.size_id, size.size_name, size.category_id, cate.title FROM product_sizes size INNER JOIN categories cate on size.category_id = cate.id";
        $sql .= " WHERE category_id='".db_escape($db, $id_category)."' ";
        
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}


//  ======================================== 


	function delete_size_by_id($size_id) {
		global $db;

		$sql = "DELETE FROM product_sizes ";
		$sql .= "WHERE size_id='" . db_escape($db, $size_id) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}






	function delete_type_by_id($type_id) {
		global $db;

		$sql = "DELETE FROM types ";
		$sql .= "WHERE id='".db_escape($db, $type_id)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array

	}


	function update_size($product_size) {
		global $db;

		$sql  = "UPDATE product_sizes SET ";
		$sql .= "size_name='".db_escape($db, $product_size['size_name'])."', ";
		$sql .= "category_id='".db_escape($db, $product_size['category'])."' ";
		$sql .= "WHERE size_id='".db_escape($db, $product_size['size_id'])."' ";
		$sql .= "LIMIT 1";

		mysqli_set_charset($db,"utf8");
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

	function find_size_by_id($size_id) {
		global $db;

		// $sql = "SELECT * FROM product_sizes ";
		$sql = "SELECT size.size_id, size.size_name, size.category_id, cate.id, cate.title FROM product_sizes size INNER JOIN categories cate on size.category_id = cate.id";

		$sql .= " WHERE size.size_id='".db_escape($db, $size_id)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql) or die("Error: " . mysqli_error($db));
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}
	function find_size_name_id($id_size) {
		global $db;

		$sql = "SELECT * FROM product_sizes ";
		$sql .= "WHERE size_id='" . db_escape($db, $id_size) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}

	function find_size_by_size_name($size_name) {
		global $db;

		$sql = "SELECT * FROM product_sizes ";
		$sql .= "WHERE size_name='" . db_escape($db, $size_name) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$color = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $color; // returns an assoc. array

	}



	/* END OF SIZE*/


	/*START OF PRODUCT RATING */

	function insert_product_rating($product_rating) {
		global $db;

		$sql = "INSERT INTO product_rating";
		$sql .= "(product_id, user_id, rating) ";
		$sql .= "VALUES (";
		$sql .= "" . db_escape($db, $product_rating['product_id']) . ", ";
		$sql .= "'" . db_escape($db, $product_rating['user_id']) . "', ";
		$sql .= "" . db_escape($db, $product_rating['rating']) . "";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function update_rating($product_rating) {
		global $db;

		$sql  = "UPDATE product_rating SET ";
		$sql .= "rating=".db_escape($db, $product_rating['rating'])." ";
		$sql .= "WHERE user_id='" . db_escape($db, $product_rating['user_id']) . "' ";
		$sql .= "AND product_id='".db_escape($db, $product_rating['product_id'])."' ";

		mysqli_set_charset($db,"utf8");
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

	function get_avg_rating_of_product($product_id) {
		global $db;

		$sql = "SELECT AVG(rating) FROM product_rating ";
		$sql .= "WHERE product_id='".db_escape($db, $product_id)."' ";
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$avg_raing = mysqli_fetch_array($result);
		mysqli_free_result($result);
		return $avg_raing[0]; // returns an assoc. array

	}

	function get_rating_count_of_product($product_id) {
		global $db;

		$sql = "SELECT count(rating_id) FROM product_rating ";
		$sql .= "WHERE product_id='".db_escape($db, $product_id)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$count_raing = mysqli_fetch_array($result);
		mysqli_free_result($result);
		return $count_raing[0]; // returns an assoc. array

	}

	function get_rating_by_user_product($product_rating){

		global $db;
		$sql = "SELECT * FROM product_rating ";
		$sql .= "WHERE user_id='" . db_escape($db, $product_rating['user_id']) . "' ";
		$sql .= "AND product_id='".db_escape($db, $product_rating['product_id'])."' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$p_rating = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		return $p_rating;

	}

	function rating_exists_by_user_product($product_rating){

		global $db;
		$sql = "SELECT * FROM product_rating ";
		$sql .= "WHERE user_id='" . db_escape($db, $product_rating['user_id']) . "' ";
		$sql .= "AND product_id='".db_escape($db, $product_rating['product_id'])."' ";

		// echo $sql;
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$p_rating = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		return ( $p_rating['user_id'] > 0 ) ? true : false;

	}

	/*END OF PRODUCT RATING*/

	/*START OF PRODUCT FAVOURITE*/

	function insert_product_favourite($product_favourite) {
		global $db;

		$sql = "INSERT INTO product_favourites ";
		$sql .= "(user_id, product_id) ";
		$sql .= "VALUES (";
		$sql .= "" . db_escape($db, $product_favourite['user_id']) . ", ";
		$sql .= "" . db_escape($db, $product_favourite['product_id']) . "";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
			// INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}



	function delete_product_favourite($product_favourite) {
		global $db;

		$sql = "DELETE FROM product_favourites ";
		$sql .= "WHERE user_id='".db_escape($db, $product_favourite['user_id'])."' ";
		$sql .= "AND product_id='".db_escape($db, $product_favourite['product_id'])."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result; // returns an assoc. array
	}

	function get_fav_count_of_product($product_id) {
		global $db;

		$sql = "SELECT count(product_id) FROM product_favourites ";
		$sql .= "WHERE product_id='".db_escape($db, $product_id)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$fav_count = mysqli_fetch_array($result);
		mysqli_free_result($result);
		return $fav_count[0]; // returns an assoc. array

	}

	/*END OF PRODUCT FAVOURITE*/

	// START OF BRAINTREE

	function insert_braintree($braintree) {
		global $db;

		$sql = "INSERT INTO braintree_credentials ";
		$sql .= "(environment, merchant_id, public_key, private_key, user_id) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $braintree['environment']) . "',";
		$sql .= "'" . db_escape($db, $braintree['merchant_id']) . "',";
		$sql .= "'" . db_escape($db, $braintree['public_key']) . "',";
		$sql .= "'" . db_escape($db, $braintree['private_key']) . "',";
		$sql .= "" . db_escape($db, $braintree['user_id']) . "";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}


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

		mysqli_set_charset($db,"utf8");
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

	function find_braintree_by_user_id($user_id) {
		global $db;

		$sql = "SELECT * FROM braintree_credentials ";
		$sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$braintree = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $braintree; // returns an assoc. array

	}

	function find_braintree() {
		global $db;

		$sql = "SELECT * FROM braintree_credentials";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	// END OF BRAINTREE

	function find_stores() {
		global $db;
		$sql = "SELECT * FROM users WHERE store != NULL or store != '' or gallery != NULL or gallery != '' ";
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function find_ads_api() {
		global $db;
		$date = date('Y-m-d');
		$sql = "SELECT * FROM anuncios WHERE '$date' > fecha_registro and '$date' < fecha_expira";
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function find_ads() {
		global $db;
		$date = date('Y-m-d');
		$sql = "SELECT * FROM anuncios WHERE 1";
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	function insert_adds($adds){
		global $db;

		$sql = "INSERT INTO anuncios ";
		$sql .= "(titulo , descripcion , fecha_registro ,tipo_anuncio ,url_foto , fecha_expira, RazonSocial, Celular, Correo, Contacto ) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $adds['title']) . "',";
		$sql .= "'" . db_escape($db, $adds['description']) . "',";
		$sql .= "'" . db_escape($db, $adds['fecha_registro']) . "',";
		$sql .= "'" . db_escape($db, $adds['type']) . "',";
		$sql .= "'" . db_escape($db, $adds['url_foto']) . "',";
		$sql .= "'" . db_escape($db, $adds['fecha_expira']) . "',";
		$sql .= "'" . db_escape($db, $adds['RazonSocial']) . "',";
		$sql .= "'" . db_escape($db, $adds['Celular']) . "',";
		$sql .= "'" . db_escape($db, $adds['Correo']) . "',";
		$sql .= "'" . db_escape($db, $adds['Contacto']) . "'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}
	
	function traer_departamentos_registrados($id_departamento) {
		global $db;

		$sql = "SELECT * FROM destinos WHERE id_departamento='" . db_escape($db, $id_departamento) . "'";
		
		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function actualizar_por_departamentos($id_destino,$estado)
	{
		global $db;

		$sql  = "UPDATE destinos SET ";
		$sql .= "estado='".db_escape($db, $estado)."' ";
		$sql .= "WHERE id_destino='".db_escape($db, $id_destino)."'";

		mysqli_set_charset($db,"utf8");
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
	
	function traer_departamentos_activos() {
		global $db;

		$sql = "SELECT DISTINCT(d.id_departamento), ud.name FROM ubigeo_peru_departments AS ud, destinos AS d WHERE d.id_departamento=ud.id AND d.estado='Activo'";
		
		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	function traer_departamentos_destino() {
		global $db;

		$sql = "SELECT DISTINCT(d.id_departamento), ud.name FROM ubigeo_peru_departments AS ud, destinos AS d WHERE d.id_departamento=ud.id";
		
		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}

	function traer_departamentos() {
		global $db;

		$sql = "SELECT * FROM ubigeo_peru_departments";
		
		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	
	function traer_provincias_destino($id_departamento)
	{
		global $db;

		$sql = "SELECT DISTINCT(d.id_departamento),d.id_provincia, p.name FROM destinos AS d, ubigeo_peru_provinces AS p WHERE d.id_provincia=p.id ";
		$sql .= "AND d.id_departamento='" . db_escape($db, $id_departamento) . "' ";


		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	function traer_provincias_all($id_departamento,$id_provincia)
	{
		global $db;

		$sql = "SELECT * FROM destinos  WHERE id_provincia='" . db_escape($db, $id_provincia) . "' ";
		$sql .= "AND id_departamento='" . db_escape($db, $id_departamento) . "' ";


		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	
	function actualizar_por_provincias($id_destino,$estado)
	{
		global $db;

		$sql  = "UPDATE destinos SET ";
		$sql .= "estado='".db_escape($db, $estado)."' ";
		$sql .= "WHERE id_destino='".db_escape($db, $id_destino)."'";

		mysqli_set_charset($db,"utf8");
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
    
	function traer_provincias($id_departamento)
	{
		global $db;

		$sql = "SELECT * FROM ubigeo_peru_provinces ";
		$sql .= "WHERE department_id='" . db_escape($db, $id_departamento) . "' ";


		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	function traer_provincia_activa($id_departamento)
	{
		global $db;

		$sql = "SELECT DISTINCT(d.id_provincia),p.department_id,p.name FROM destinos AS d, ubigeo_peru_provinces AS p WHERE p.id=d.id_provincia AND d.estado='Activo' ";
		$sql .= "AND p.department_id='" . db_escape($db, $id_departamento) . "' ";


		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}

	function traer_distrito($id_provincia,$id_departamento)
	{
		global $db;

		$sql = "SELECT * FROM ubigeo_peru_districts ";
		$sql .= "WHERE province_id='" . db_escape($db, $id_provincia) . "' ";
		$sql .= "AND department_id='" . db_escape($db, $id_departamento) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	function traer_distrito_avtiva($id_provincia,$id_departamento)
	{
		global $db;
		$sql="SELECT d.id_distrito, di.name, di.province_id, di.department_id FROM destinos AS d, ubigeo_peru_districts AS di WHERE di.id=d.id_distrito AND d.estado='Activo' ";
		$sql .= "AND di.province_id='" . db_escape($db, $id_provincia) . "' ";
		$sql .= "AND di.department_id='" . db_escape($db, $id_departamento) . "' ";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}

	function insertar_destino($datos_destino)
	{
		global $db;

		$sql = "INSERT INTO destinos ";
		$sql .= "(id_departamento, id_provincia, id_distrito, precio, estado) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $datos_destino['CodD']) . "',";
		$sql .= "'" . db_escape($db, $datos_destino['CodP']) . "',";
		$sql .= "'" . db_escape($db, $datos_destino['CodDi']) . "',";
		$sql .= "'" . db_escape($db, $datos_destino['Precio']) . "',";
		$sql .= "'" . db_escape($db, $datos_destino['Estado']) . "'";
		$sql .= ")";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		// For INSERT statements, $result is true/false
		if($result) {
			return mysqli_insert_id($db);
		} else {
		  // INSERT failed
		  echo mysqli_error($db);
		  db_disconnect($db);
		  exit;
		}
	}

	function traer_destinos()
	{
		global $db;

		$sql = "SELECT d.id_destino,de.name AS departamento, p.name AS provincia, di.name AS distrito, d.precio, d.estado FROM destinos AS d, ubigeo_peru_provinces AS p, ubigeo_peru_departments AS de, ubigeo_peru_districts AS di WHERE d.id_provincia=p.id AND d.id_departamento=de.id AND d.id_distrito=di.id";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}

	function eliminar_destino($id_destino)
	{
		global $db;
		$sql = "DELETE FROM destinos ";
		$sql .= "WHERE id_destino='".db_escape($db, $id_destino)."' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function traer_destino_id($id_destino)
	{
		global $db;

		$sql = "SELECT d.id_destino,de.name AS departamento, p.name AS provincia, di.name AS distrito, d.precio, d.estado FROM destinos AS d, ubigeo_peru_provinces AS p, ubigeo_peru_departments AS de, ubigeo_peru_districts AS di WHERE d.id_provincia=p.id AND d.id_departamento=de.id AND d.id_distrito=di.id ";
		$sql .= "AND d.id_destino='" . db_escape($db, $id_destino) . "' ";


		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	function editar_destino_id($id_destino,$precio,$estado)
	{
		global $db;

		$sql  = "UPDATE destinos SET ";
		$sql .= "precio='".db_escape($db, $precio)."', ";
		$sql .= "estado='".db_escape($db, $estado)."' ";
		$sql .= "WHERE id_destino=".db_escape($db, $id_destino);

		mysqli_set_charset($db,"utf8");
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

	function evaluar_existe_destino($datos_destino)
	{
		global $db;

		$sql = "SELECT * FROM destinos AS d "; 
		$sql.="WHERE d.id_departamento='" . db_escape($db, $datos_destino['CodD']) . "' ";
		$sql.="AND d.id_provincia='" . db_escape($db, $datos_destino['CodP']) . "' ";
		$sql .= "AND d.id_distrito='" . db_escape($db, $datos_destino['CodDi']) . "' ";


		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		
		$rows = mysqli_num_rows($result);
		mysqli_free_result($result);
		
		if ($rows > 0) {
		    return true;
		} else {
		    return false;
		}
	}
	function traer_destino_precio($cod_depa,$cod_prov,$cod_dis)
	{
		global $db;

		$sql = "SELECT * FROM destinos AS d "; 
		$sql.="WHERE d.id_departamento='" . db_escape($db, $cod_depa) . "' ";
		$sql.="AND d.id_provincia='" . db_escape($db, $cod_prov) . "' ";
		$sql .= "AND d.id_distrito='" . db_escape($db, $cod_dis) . "' ";

		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}

	function traer_comisiones()
	{
		global $db;

		$sql = "SELECT * FROM comisiones";

		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}
	
	function traer_comision_activa(){
	    global $db;

		$sql = "SELECT * FROM comisiones ";
        $sql.= "WHERE estado='1'";
		// echo $sql;
		mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;
	}

	function actualizar_comision($id_activo,$monto,$estado)
	{
		global $db;

		$sql  = "UPDATE comisiones SET ";
		$sql .= "cantidad='".db_escape($db, $monto)."', ";
		$sql .= "estado='".db_escape($db, $estado)."' ";
		$sql .= "WHERE id_comision='".db_escape($db, $id_activo)."'";

		mysqli_set_charset($db,"utf8");
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

	function actualizar_comision_activa($id_comision,$estado)
	{
		global $db;

		$sql  = "UPDATE comisiones SET ";
		$sql .= "estado='".db_escape($db, $estado)."' ";
		$sql .= "WHERE id_comision='".db_escape($db, $id_comision)."'";

		mysqli_set_charset($db,"utf8");
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
	
	//TRAER MEDIDAS LARGO DEL PRODUCTO ,  CONTORNO DEL PECHO , LARGO DE LA MANGA
	
	function obtener_productos_tallas($product_id,$size){
		global $db;

		//$sql = "SELECT id_zize,product_id,medidax,mediday,medidaz,size FROM product_sizes_2 WHERE product_id='" . db_escape($db, $product_id) ."'";
		$sql = "SELECT id_zize,product_id,medidax,mediday,medidaz,size FROM product_sizes_2 WHERE product_id='" . db_escape($db, $product_id) ." ' AND size='" . db_escape($db, $size) ."'";


mysqli_set_charset($db,"utf8");
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		mysqli_free_result($result);
		return $rows;

	}
	
?>
