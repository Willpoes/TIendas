<?php require_once('../../private/init.php'); ?>
<?php

if(!empty($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $avg_rating = get_avg_rating_of_product($product_id);
    $avg_rating = number_format((float)$avg_rating, 1, '.', '');

    $rating_count = get_rating_count_of_product($product_id);

    $rating_obj[0] = $avg_rating;
    $rating_obj[1] = $rating_count;
    echo json_encode($rating_obj);
}

?>