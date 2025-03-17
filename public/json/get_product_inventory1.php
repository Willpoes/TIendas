<?php require_once('../../private/init.php'); ?>
<?php

if(!empty($_GET['product_ids'])){
    $product_ids = $_GET['product_ids'];
    $ids = explode("-", $product_ids);

    $inventory = [];
    foreach ($ids as $id){
        if(!empty($id)){
            $inv = get_inventory_by_product_id($id);
            foreach ($inv as $i){

                $color = find_color_by_id($i['color_id']);
                $i['color_name'] = $color['color_name'];
                $i['color_code'] = $color['color_code'];


                
                $size = find_size_by_id($i['size_id']);
                $i['size_name'] = $size['size_name'];



                $user = get_product_id($product_ids);

                $i['store_name'] = $user['store'];
                $i['gallery_name'] = $user['gallery'];
                $i['brand'] = $user['brand'];

                $i['weight'] = $user['weight'];
                $i['longs'] = $user['longs'];
                $i['long_sleeve'] = $user['long_sleeve'];


                $i['back_width'] = $user['back_width'];
                $i['breast_contour'] = $user['breast_contour'];
                $i['waist'] = $user['waist'];
                $i['hip'] = $user['hip'];


                $i['additional'] = $user['additional'];
                
                //$i['additional'] = "Peso del producto:".$user['weight']."|Largo del producto:".$user['longs']."|Largo de manga:".$user['long_sleeve']."|Ancho de Espalda:".$user['back_width']."|Contorno de Pecho:".$user['breast_contour']."|Cintura:".$user['waist']."|Cadera:".$user['hip'];


                $i['politics'] = $user['politics'];
                $i['user_id'] = $user['user_id'];


                array_push($inventory, $i);


//get_product_id



            }
        }
    }

    echo json_encode($inventory);
}

?>