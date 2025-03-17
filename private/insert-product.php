<?php
ini_set('display_errors', 1);

require_once('init.php');

$errors = [];
$success = false;

$admin_info = logged_in();
if (!empty($admin_info)) {
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
}

/*
    $product['title'] = ;
    $product['category'] = ;
    $product['description'] = ;
    $product['purchase_price'] = ;
    $product['price'] = $_POST['price'];
    $product['previous_price'] = $_POST['previous_price'];
    $product['date'] = '2017-2-2';
    $product['sort'] = 2;
*/


// ===========================================
// Cambio a poner solo un campo de PRECIO

// $parametros="title=".$_POST['title']."&category=".$_POST['category']."&description=".$_POST['description']."&purchase_price=".$_POST['purchase_price']."&price=".$_POST['price']."&previous_price=".$_POST['previous_price']."&weight=".$_POST['weight']."&longs=".$_POST['longs']."&long_sleeve=".$_POST['long_sleeve']."&back_width=".$_POST['back_width']."&breast_contour=".$_POST['breast_contour']."&breast_contour=".$_POST['breast_contour']."&waist=".$_POST['waist']."&hip=".$_POST['hip']."&statu=".$_POST['statu']."&brand=".$_POST['brand'];
$parametros = "title=" . $_POST['title'] . "&category=" . $_POST['category'] . "&description=" . $_POST['description'] . "&purchase_price=" . $_POST['price'] . "&price=" . $_POST['price'] . "&previous_price=" . $_POST['price'] . "&weight=" . $_POST['weight'] . "&longs=50"  . "&long_sleeve=50" . "&back_width=20" . "&breast_contour=10" . "&waist=" . $_POST['waist'] . "&hip=" . $_POST['hip'] . "&statu=" . $_POST['statu'] . "&brand=" . $_POST['brand'];

// $sizes = $_POST['sizes'];

// $medidasX = $_POST['medidasX'];

// $medidasY = $_POST['medidasY'];
// $medidasZ = $_POST['medidasZ'];

//$parametros="title=".$_POST['title']."&category=".$_POST['category']."&description=".$_POST['description']."&purchase_price=".$_POST['purchase_price']."&price=".$_POST['price']."&previous_price=".$_POST['previous_price']."&longs=".$_POST['longs']."&long_sleeve=".$_POST['long_sleeve']."&breast_contour=".$_POST['breast_contour']."&breast_contour=".$_POST['breast_contour']."&waist=".$_POST['waist']."&hip=".$_POST['hip']."&statu=".$_POST['statu']."&brand=".$_POST['brand'];

// ============ FIX ==========
/* header("location: ../public/recent_products.php"); */

//if(!empty($_POST)){

$product = [];
$product['title'] = $_POST['title'];
$product['category'] = $_POST['category'];


if (empty($product['category'])) {
    $errors[] = is_empty("Categoría", $product_sizes);
}


// Tallas.
$arr_tag = $_POST['tag'];

$palabras_claves = '';
foreach ($arr_tag as $keyword) {
    $palabras_claves .= $keyword . ", ";
}
$product['palabras_claves'] = substr($palabras_claves, 0, strlen($palabras_claves) - 2);

// var_dump($product);
// exit();
$comision=0;
$nuevo_precio=0;
$traer_comision=traer_comision_activa();
foreach ($traer_comision as $comi) {
     $id=$comi['id_comision'];
    $tipo=$comi['tipo'];
    $cantidad=$comi['cantidad'];
    if ($id==1) {
        $comision=($cantidad/100)*$_POST['price'];
        $nuevo_precio=$_POST['price']+$comision;
        $comi_pasarela=0.05*$nuevo_precio;
        $igv_pasarela=0.18*$comi_pasarela;
        $precio_vender=$nuevo_precio+$comi_pasarela+$igv_pasarela;
        
    }else{
        $comision=$cantidad;
        $nuevo_precio=$_POST['price']+$comision;
        $comi_pasarela=0.05*$nuevo_precio;
        $igv_pasarela=0.18*$comi_pasarela;
        $precio_vender=$nuevo_precio+$comi_pasarela+$igv_pasarela;
    }
}

$product['description'] = $_POST['description'];
$product['purchase_price'] = $_POST['price'];
$product['price'] = ceil($precio_vender);
$product['previous_price'] = $comision;
$product['date'] = '2017-2-2';
$product['sort'] = 2;
$product['user_id'] = $admin_id;



$product['weight'] = $_POST['weight'];
$product['back_width'] = 50;

$product['longs'] = 50;
$product['long_sleeve'] = 50;

$product['breast_contour'] = 50;
$product['waist'] = $_POST['waist'];



$product['hip'] = $_POST['hip'];


$product['statu'] = $_POST['statu'];

$product['brand'] = $_POST['brand'];

// New change product
// $product['fotos_talla'] = $_POST['fotos_talla'];

// Script para agregar foto talla
// portadas
$uploads_portadas = '../public/uploads/fotos-tallas/';
$name_porta = "";

// ========= valida si subio imagen y video ======
/* if (is_uploaded_file($_FILES['fotos_talla']['tmp_name'])) {



    // get image info
    $menu_image = $_FILES['fotos_talla']['name'];
    $image_error = $_FILES['fotos_talla']['error'];
    $image_type = $_FILES['fotos_talla']['type'];

    // common image file extensions
    $allowedExts = array("gif", "jpeg", "jpg", "png");

    // Get extesion imagen
    $extension = end(explode(".", $_FILES["fotos_talla"]["name"]));
    $name_prim = current(explode(".", $_FILES["fotos_talla"]["name"]));

    // create random imagen file name
    // $string = '0123456789';
    // $file = preg_replace("/\s+/", "_", $_FILES['foto']['name']);
    // $function = new functions;
    // $name_porta = $function->get_random_string($string, 4)."-".date("Y-m-d"). "." . $extension;
    $name_porta = $name_prim . "-" . date("Y-m-d") . "." . $extension;

    // upload new foto de medidas
    $upload = move_uploaded_file($_FILES['fotos_talla']['tmp_name'], "$uploads_portadas/$name_porta");
} */

// change quito foto par Tabala dinamica - 10.11.2020
$product['fotos_talla'] = ''; // $name_porta;

// =============

if (empty($product['previous_price'])) $product['previous_price'] = 0;

//if(empty($product['weight'])) $product['weight'] = 0;

if (empty($product['back_width'])) $product['back_width'] = 0;

if (empty($product['longs'])) $product['longs'] = 0;

if (empty($product['long_sleeve'])) $product['long_sleeve'] = 0;




if (empty($product['breast_contour'])) $product['breast_contour'] = 0;
if (empty($product['waist'])) $product['waist'] = 0;
if (empty($product['hip'])) $product['hip'] = 0;

$product_images = [];
$images_color=[];
/*
	foreach($product as $key => $value) {
		if(empty($value)){
            if($key == "previous_price") continue;
            if($key == "breast_contour") continue;
            if($key == "waist") continue;
			//$errors[] = is_empty($key, $value);
		}
	}
*/
// $product_inventory = [];
// $product_sizes = $sizes;
// $product_colors = $_POST['colors'];
// $product_qty = $_POST['available_qty'];


// if (empty($product_sizes)) {
//     $errors[] = is_empty("Talla", $product_sizes);
// }


// if (empty($product_colors)) {
//     $errors[] = is_empty("Color", $product_colors);
// }
// if (empty($product_qty)) {
//     $errors[] = is_empty("Cantidad", $product_qty);
// }

/**/
if (empty($errors)) {

    // for ($i = 0; $i < count($product_sizes); $i++) {
    //     $product_inventory_obj['size_id'] = $product_sizes[$i];
    //     $product_inventory_obj['color_id'] = $product_colors[0];
    //     $product_inventory_obj['available_qty'] = $product_qty[$i];

    //     if (!is_numeric($product_qty[$i])) {
    //         $errors[] = invalid_price_msg("Cantidad ");
    //     }

    //     if (empty($errors)) {
    //         array_push($product_inventory, $product_inventory_obj);
    //     }
    // }
    

    if (!is_numeric($product['price']) || !is_numeric($product['previous_price'])) {
        $errors[] = invalid_price_msg("Precio");
        //$errors[] = invalid_price_msg("Price");
    }
    
    if (empty($errors)) {

        $j = 0;     // Variable for indexing uploaded image.
        // Declaring Path for uploaded images.
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            if ($_FILES['file']['name'][$i] != null) {
                $target_path = "../public/uploads/recent-products/";

                // Loop to get individual element from the array
                $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
                $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
                $file_extension = end($ext); // Store extensions in the variable.
                $unique_image_ext = $ext[count($ext) - 1];
                $unique_image_id = md5(uniqid());

                $target_path = $target_path . $unique_image_id . '.' . $unique_image_ext;     // Set the target path with a new name of image.
                $j = $j + 1;      // Increment the number of uploaded images according to the files in array.


                ///list($width, $height, $type, $attr) = getimagesize($file);
                /*echo "Ancho: " .$width;
                echo "Alto: " .$height;
                echo "Tipo: " .$type;
                echo "Atributos: " .$attr;*/

                            /*$file=fopen($file,"w+"); 
                fwrite ($file,$buffer); */






                if (($_FILES["file"]["size"][$i] < 50000000)     // Approx. 500kb files can be uploaded.
                    && in_array($file_extension, $validextensions)
                ) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {

                        $file = $target_path;  // Dirección de la imagen  

                        chmod($file, 0777);
                        $target_path = "";
                        $datos_imagen=['name_img'=>$unique_image_id . '.' . $unique_image_ext,
                                        'color_id'=>$_POST['color_img'][$i]];
                        array_push($product_images, $datos_imagen);
                        echo $j . ').<span id="noerror">Imagen cargada con éxito !.</span><br/><br/>';
                    } else {
                        echo $j . ').<span id="error">¡Inténtalo de nuevo!.</span><br/><br/>';
                    }
                } else {
                    $errors[] = "Max Image size 500kb";
                    echo $j . ').<span id="error">*** Tamaño o tipo de archivo no válido ***</span><br/><br/>';
                }

                $imagen = getimagesize($file);    //Sacamos la información
                $ancho = $imagen[0];              //Ancho
                $alto = $imagen[1];
                // if (( $ancho <=500) && ( $alto <=400)) {

                // }else{

                // $errors[] = "El tamaño de la imagen debe ser máximo 400x500";
                // echo $j . ').<span id="error">*** ¡Inténtalo de nuevo subiendo otra imagen!. ***</span><br/><br/>';

                // }
            }
            





        }
 
        if (empty($errors)) {

            $product["image_name"] = $product_images[0]['name_img'];
           echo $product_inserted_id = insert_product($product);
           echo "<br> des";
        //   if($medidasX!=="" || $medidasY!=="" || $medidasZ!==""){
        //      insert_sizes_product($product_inserted_id, $sizes, $medidasX, $medidasY, $medidasZ);  
        //   }
        echo "<br> des2";
            if ($product_inserted_id > -1) {

                foreach ($product_images as $image) {
                    $images['image_name']=$image['name_img'];
                    $images['id_color']=$image['color_id'];
                    $images['product_id']=$product_inserted_id;
                    if (insert_product_images($images) > -1) {
                        $_SESSION['product_msg'] = "Producto añadido con éxito.";
                    }
                }
                 echo "<br> des3";
                // foreach ($product_inventory as $color_qty) {
                    
                //     if (empty($product_inserted_id)) {
                //         echo $color_qty['product_id'] = 10000000;
                //     } else {
                //         $color_qty['product_id'] = $product_inserted_id;
                //     }
                //     echo print_r($color_qty);
                //       $id_product = insert_available_inventory($color_qty);
                //     if ($id_product > -1) {
                //         $_SESSION['product_msg'] = "Producto añadido con éxito.";
                //     }
                    
              
                // }
                

                $success = true;
                $_SESSION['product_msg'] = "Producto añadido con éxito.";
            }
        }
    }
}

 $_SESSION['errors'] = $errors;

if ($success) {
    $redirect_to = root_dir() . 'add_product_stock.php?produc_id='.$product_inserted_id;
    header('Location: ' . $redirect_to);
} else {

    $redirect_to = root_dir() . 'add_recent_products.php?errormsg=true&' . $parametros;
    header('Location: ' . $redirect_to);
}
echo "fin";
//}
