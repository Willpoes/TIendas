<?php
require_once('init.php');
if (isset($_POST['com_estado'])) {
    $estado=1;
    $comision=0;
    $nuevo_precio=0;
    if ($_POST['com_estado']==1) {
        $id_comision_acivo=$_POST['com_estado'];
        $monto=$_POST['mont_comision_1'];
        $title="Porcentaje";
    } else {
        $id_comision_acivo=$_POST['com_estado'];
        $monto=$_POST['mont_comision_2'];
        $title="Fija";
    }
    $actualizar_comision=actualizar_comision($id_comision_acivo,$monto,$estado);
    if ($actualizar_comision==true) {
        $desactivar=0;
        if ($id_comision_acivo==1) {
            $id_comision_des=2;
        } else {
            $id_comision_des=1;
        }
        $desacti=actualizar_comision_activa($id_comision_des,$desactivar);
        if ($desacti==true) {
            $productos=traer_todo_productos();
            foreach ($productos as $pro) {
                     $id=$pro['id'];
                    $precio_sin_comision=$pro['purchase_price'];
                    $precio_con_comision=$pro['price'];
                    if ($_POST['com_estado']==1) {
                        $comision=($monto/100)*$precio_sin_comision;
                        $nuevo_precio=$precio_sin_comision+$comision;
                        $comi_pasarela=0.05*$nuevo_precio;
        $igv_pasarela=0.18*$comi_pasarela;
        $precio_vender=$nuevo_precio+$comi_pasarela+$igv_pasarela;
                    }else{
                        $comision=$monto;
                        $nuevo_precio=$precio_sin_comision+$comision;
                        $comi_pasarela=0.05*$nuevo_precio;
        $igv_pasarela=0.18*$comi_pasarela;
        $precio_vender=$nuevo_precio+$comi_pasarela+$igv_pasarela;
                    }
                    $actualizar_producto=actualizar_productos_comision($id,$comision,ceil($precio_vender));
                }
            if($actualizar_producto==true){
                echo "Comision Actualizada a ".$title;
            }else{
                echo "No se pudo actualizar comisión de los productos.";
            }
            
        } else {
            echo "No Pudimos Actualizar La Comision Anterior.";
        }
        
        
    } else {
        echo "No Pudimos Actualizar La Comision.";
    }
    
} else {
    
}


?>