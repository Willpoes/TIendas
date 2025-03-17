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
if(isset($_POST['accion']) && $_POST['accion']!==""){
    $product_id=$_POST['product_id'];
    $colore_imagen=get_color_images_by_product_id($product_id);
    $num_colores_img=count($colore_imagen);
    switch ($_POST['accion']) {
        case 'registrar':
            $tallas_stock=[];
            $tallas_medidas=[];
            $tallas_color=[];
            $stock_color=[];
            if(isset($_POST['stock']) && isset($_POST['medidas'])){
                $stock=$_POST['stock'];
                $medidas=$_POST['medidas'];
                $num_stock=count($stock);
                foreach ($stock as $st) {
                    array_push($stock_color,$st['color']);
                    if(!in_array($st['talla'],$tallas_stock)){
                        array_push($tallas_stock,$st['talla']);
                    }
                    array_push($tallas_color,$st['talla'].$st['color']);
                }
                
                $num_medidas=count($medidas);
                
                foreach ($medidas as $me) {
                    array_push($tallas_medidas,$me['talla']);
                }
                $result = array_intersect($tallas_stock, $tallas_medidas);
                
                if($num_stock > count(array_unique($tallas_color))){
                  echo "<script>alert('Hay talla y color duplicado, verifique.!');</script>";
                }elseif(count(array_unique($stock_color))<$num_colores_img){
                    echo "<script>alert('Debe registrar ".$num_colores_img." colores como minimo en total.');</script>";
                }elseif($num_medidas>count(array_unique($tallas_medidas))){
                    echo "<script>alert('Hay duplicado de medidas generales.');</script>";
                }elseif(count($tallas_stock)!==count(array_unique($tallas_medidas))){
                    echo "<script>alert('Toda talla con stock debe tener sus medidas y toda talla con medidas debe tener su ztock.1');</script>";
                }elseif(count($tallas_stock)!==count($result)){
                    echo "<script>alert('Toda talla con stock debe tener sus medidas y toda talla con medidas debe tener su ztock.2');</script>";
                    
                }else{
                //   insertamos inventario
                $errores_stok=[];
                $errores_medidas=[];
                    foreach ($stock as $stk) {
                        $datos_stock=['size_id'=>$stk['talla'],
                                        'color_id'=>$stk['color'],
                                        'available_qty'=>$stk['cantida'],
                                        'product_id'=>$product_id];
                            
                        $insert_stock = insert_available_inventory($datos_stock);
                        if ($insert_stock > -1) {
                            array_push($errores_stok,1);
                        }else{
                            array_push($errores_stok,2);
                        }
                    }
                    if(in_array(2,$errores_stok)){
                        echo "<script>alert('Error al registrar stock del producto');</script>";
                    }else{
                        foreach ($medidas as $med) {  
                            $insert_stock = insert_sizes_product($product_id,$med['talla'],$med['medidax'],$med['mediday'],$med['medidaz']);
                            if ($insert_stock > -1) {
                                array_push($errores_medidas,1);
                            }else{
                                array_push($errores_medidas,2);
                            }
                        }
                        if(in_array(2,$errores_medidas)){
                          echo "<script>alert('Error al registrar las medidas segun las tallas');</script>";  
                        }else{
                            $redirect_to = root_dir() . 'recent_products.php';
                            echo '<script>
                            location.href="'.$redirect_to.'";
                            </script>'; 
                        }
                    }
                }
    
                
                
            }else{
                echo "<script>alert('Ocurrio un error inesperado!');</script>";
            }
            break;
        case 'actualizar':
            $tallas_stock=[];
            $tallas_medidas=[];
            $tallas_color=[];
            $stock_color=[];
            if(isset($_POST['stock']) && isset($_POST['medidas'])){
                $stock=$_POST['stock'];
                $medidas=$_POST['medidas'];
                $num_stock=count($stock);
                foreach ($stock as $st) {
                    array_push($stock_color,$st['color']);
                    if(!in_array($st['talla'],$tallas_stock)){
                        array_push($tallas_stock,$st['talla']);
                    }
                    array_push($tallas_color,$st['talla'].$st['color']);
                }
                
                $num_medidas=count($medidas);
                
                foreach ($medidas as $me) {
                    array_push($tallas_medidas,$me['talla']);
                }
                $result = array_intersect($tallas_stock, $tallas_medidas);
                
                if($num_stock > count(array_unique($tallas_color))){
                  echo "<script>alert('Hay talla y color duplicado, verifique.!');</script>";
                }elseif(count(array_unique($stock_color))<$num_colores_img){
                    echo "<script>alert('Debe registrar ".$num_colores_img." colores como minimo en total.');</script>";
                }elseif($num_medidas>count(array_unique($tallas_medidas))){
                    echo "<script>alert('Hay duplicado de medidas generales.');</script>";
                }elseif(count($tallas_stock)!==count(array_unique($tallas_medidas))){
                    echo "<script>alert('Toda talla con stock debe tener sus medidas y toda talla con medidas debe tener su ztock.1');</script>";
                }elseif(count($tallas_stock)!==count($result)){
                    echo "<script>alert('Toda talla con stock debe tener sus medidas y toda talla con medidas debe tener su ztock.2');</script>";
                    
                }else{
                    // eliminamos inventory
                $inventory=get_inventory_by_product_id($product_id);
                foreach ($inventory as $inve) {
                    $eliminar_inventory=delete_inventory($inve['inventory_id']);
                }
                //   insertamos inventario
                $errores_stok=[];
                $errores_medidas=[];
                    foreach ($stock as $stk) {
                        $datos_stock=['size_id'=>$stk['talla'],
                                        'color_id'=>$stk['color'],
                                        'available_qty'=>$stk['cantida'],
                                        'product_id'=>$product_id];
                            
                        $insert_stock = insert_available_inventory($datos_stock);
                        if ($insert_stock > -1) {
                            array_push($errores_stok,1);
                        }else{
                            array_push($errores_stok,2);
                        }
                    }
                    if(in_array(2,$errores_stok)){
                        echo "<script>alert('Error al registrar stock del producto');</script>";
                    }else{
                        // eliminamos medidas
                        $medidas_dlate=medidas_product_by_id($product_id);
                        foreach ($medidas_dlate as $meded) {
                            $eliminamos_medidas=delete_medidas($meded['id_zize']);
                        }
                        
                        foreach ($medidas as $med) {  
                            $insert_stock = insert_sizes_product($product_id,$med['talla'],$med['medidax'],$med['mediday'],$med['medidaz']);
                            if ($insert_stock > -1) {
                                array_push($errores_medidas,1);
                            }else{
                                array_push($errores_medidas,2);
                            }
                        }
                        if(in_array(2,$errores_medidas)){
                          echo "<script>alert('Error al registrar las medidas segun las tallas');</script>";  
                        }else{
                           
                            $redirect_to = root_dir() . 'recent_products.php';
                            echo '<script>
                            location.href="'.$redirect_to.'";
                            </script>'; 
                        }
                    }
                }
    
                
                
            }else{
                echo "<script>alert('Ocurrio un error inesperado!');</script>";
            }
            break;
        default:
            # code...
            break;
    }
}

?>