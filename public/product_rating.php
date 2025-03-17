<?php

require_once('../private/init.php');

if (!empty($_GET)) {

    if (!empty($_GET['user_id']) && !empty($_GET['product_id']) && !empty($_GET['rating'])) {
        $product_rating = [];
        $product_rating['user_id'] = $_GET['user_id'];
        $product_rating['product_id'] = $_GET['product_id'];
        $product_rating['rating'] = $_GET['rating'];

        if (is_numeric($product_rating['user_id']) && is_numeric($product_rating['product_id'])) {

            if (rating_exists_by_user_product($product_rating)) {

                if (update_rating($product_rating) > 0) echo "1";
                else echo "0";

            } else {

                if (insert_product_rating($product_rating) > 0) echo "1";
                else echo "0";

            }
        }
    }
}

?>

