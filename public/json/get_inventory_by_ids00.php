<?php require_once('../../private/init.php'); ?>
<?php

if(!empty($_GET['inventory_ids'])){
    $inventory_ids = $_GET['inventory_ids'];
    $ids = explode("-", $inventory_ids);


    $inventory = [];
    foreach ($ids as $id){
        if(!empty($id)){
            $i = get_inventory_by_id($id);

            $color = find_color_by_id($i['color_id']);
            $i['color_name'] = $color['color_name'];
            $i['color_code'] = $color['color_code'];

            $size = find_size_by_id($i['size_id']);
            $i['size_name'] = $size['size_name'];
            array_push($inventory, $i);

        }
    }

    echo json_encode($inventory);
}

?>