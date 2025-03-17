<?php require_once('../../private/init.php'); ?>
<?php

$pro_order = [];
if(!empty($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $orders = find_orders_of_user($user_id);

    foreach ($orders as $order){

        $product_orders['order_id'] = $order['order_id'];
        $product_orders['order_price'] = $order['order_amount'];
        $product_orders['order_method'] = $order['order_method'];
        $product_orders['order_status'] = get_order_status_str($order['order_status']);
        $product_orders['order_time'] = $order['order_time'];
        $product_orders['generated_order_id'] = generate_ordered_id(date("hmmjY", strtotime($order['order_time'])), $order['order_id']);

        array_push($pro_order, $product_orders);
    }

    echo json_encode($pro_order);
    
}

?>