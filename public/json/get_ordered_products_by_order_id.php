<?php require_once('../../private/init.php'); ?>
<?php

$pro_order = [];
if(!empty($_GET['order_id'])){
    $order_ids = $_GET['order_id'];
    $order_id_arr = explode(',', $order_ids);

    foreach ($order_id_arr as $order_id){

        $ordered_products = find_ordered_products_by_order_id($order_id);

        $ordered = [];
        foreach ($ordered_products as $ordered_p){

            $product = find_product_by_id($ordered_p['product_id']);
            $color = find_color_by_id($ordered_p['ordered_color_id']);
            $size = find_size_by_id($ordered_p['product_size_id']);

            $ordered['ordered_id'] = $ordered_p['ordered_id'];
            $ordered['order_id'] = $ordered_p['order_id'];
            $ordered['product_id'] = $ordered_p['product_id'];
            $ordered['product_price'] = $product['price'];
            $ordered['product_image'] = $product['image_name'];
            $ordered['product_title'] = $product['title'];
            $ordered['product_color'] = $color['color_name'];
            $ordered['product_size'] = $size['size_name'];
            $ordered['ordered_quantity'] = $ordered_p['ordered_quantity'];

            array_push($pro_order, $ordered);
        }
    }

    echo json_encode($pro_order);
    
}

?>