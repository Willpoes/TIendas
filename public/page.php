<?php require_once('../private/init.php'); 


if ($_GET['pagina']=="elimnar_image_products"){

$product = delete_product_images_by_id($_GET['id']);

echo $product;

}else if ($_GET['pagina']=="image_products"){


}




 ?>