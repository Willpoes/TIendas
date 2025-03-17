<?php 
require_once('../../private/init.php'); 
if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'traer_provincia':
            $provi=[];
            $id_departamento=$_GET['id_depa'];
            $provincia=traer_provincia_activa($id_departamento);
            if(!empty($provincia)){
                echo json_encode($provincia);
            }else{
                echo json_encode($provi);
            }
            break;
        case 'traer_distrito':
            $dis=[];
            $id_departamento=$_GET['id_depa'];
            $id_provincia=$_GET['id_prov'];
            $distrito=traer_distrito_avtiva($id_provincia,$id_departamento);
            if(!empty($distrito)){
                echo json_encode($distrito);
            }else{
                echo json_encode($dis);
            }
            
            break;
        
        case 'traer_departamento':
            $depa=[];
            $departamento=traer_departamentos_activos();
            if(!empty($departamento)){
                echo json_encode($departamento);
            }else{
                echo json_encode($depa);
            }
            break;
        case 'traer_destino':
            $destino=[];
            $id_departamento=$_GET['id_depa'];
            $id_provincia=$_GET['id_prov'];
            $id_distrito=$_GET['id_dist'];
            $destino_costo=traer_destino_precio($id_departamento,$id_provincia,$id_distrito);
            if(!empty($destino_costo)){
                echo json_encode($destino_costo);
            }else{
                echo json_encode($destino);
            }
            // if(!empty($destino_costo)) echo json_encode($destino_costo);
            break;
        default:
            # code...
            break;
    }
}else{

}

?>