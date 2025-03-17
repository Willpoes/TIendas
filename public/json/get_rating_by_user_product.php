<?php require_once('../../private/init.php'); ?>
<?php

if(!empty($_GET['product_id']) && !empty($_GET['user_id'])){
    $product_rating['product_id'] = $_GET['product_id'];
    $product_rating['user_id'] = $_GET['user_id'];

    $p_rating = get_rating_by_user_product($product_rating);

    if(empty($p_rating["rating"])){
        echo json_encode(0);
    }else{
        echo json_encode($p_rating["rating"]);
    }
}

?>