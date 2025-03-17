<?php require_once('../../private/init.php'); ?>

<?php

    $is_updated = 2;
    if(!empty($_POST['id']) && !empty($_POST['iddes'])){

        $prod['id'] = $_POST['id'];
        $prod['iddes'] = $_POST['iddes'];

       //$prod['id'] = $_POST['id'];
       // $prod['iddes'] = 1;


        if(update_dest_by_id($_POST['id'],$_POST['iddes'])){
            $is_updated = 1;
        }


    }

    echo $is_updated;

?>