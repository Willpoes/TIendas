<?php require_once('../../private/init.php'); ?>
<?php

$pro_order = [];
$orders = [];
if(!empty($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $orders = find_orders_of_user($user_id);

    foreach ($orders as $order){

        $product_orders['order_id'] = $order['order_id'];
        $product_orders['order_price'] = $order['order_amount'];
        $product_orders['order_method'] = $order['order_method'];
        $product_orders['order_status'] = $order['order_status'];

        $ordered_products = find_products_orders_by_orderid($order['order_id']);

        $ordered_product = [];
        $ordered = [];
        foreach ($ordered_products as $ordered_p){

            $product = find_product_by_id($ordered_p['product_id']);
            $color = find_color_by_id($ordered_p['ordered_color_id']);
            $size = find_size_by_id($ordered_p['product_size_id']);

            /*$ordered['ordered_products'] = array(
                'product_id'=> $ordered_p['product_id'],
                'product_title'=> $product['title'],
                'product_color' => $color['color_name'],
                'product_size' => $size['size_name'],
                'ordered_quantity' => $ordered_p['ordered_quantity']

            );*/

            $ordered['product_id'] = $ordered_p['product_id'];
            $ordered['product_title'] = $product['title'];
            $ordered['product_color'] = $color['color_name'];
            $ordered['product_size'] = $size['size_name'];
            $ordered['ordered_quantity'] = $ordered_p['ordered_quantity'];

            //print_r($ordered);

        }


        $product_orders['ordered_products'] = $ordered;

        array_push($pro_order, $product_orders);


    }

    echo json_encode($pro_order);
    
}

?>