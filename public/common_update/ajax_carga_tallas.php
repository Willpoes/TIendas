<?php 
require_once('../../private/init.php');

if( !empty($_GET) ) {

    $id_cateogry = trim($_GET['cod_cate']);
    
    $category_all = find_all_sizes_for_category($id_cateogry);
    echo '<option class="first" selected disabled hidden >Seleccionar talla</option>';
    foreach($category_all as $category) {
        echo '<option value="'.$category['size_id']. '">'.$category['size_name']. '</option>';
    }

}
exit();