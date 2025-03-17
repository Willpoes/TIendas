<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php

if ($_SESSION['grobaltype']==0){



$admin_id = "";
$username = "";
$admin_info = logged_in();
if(!empty($admin_info)){
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
}else{
    redirect_to_login();
}


$page = 0;
$count = 15;
$prev = false;
$next = true;

if(!empty($_GET['next'])){
    $page = $_GET['next'];

}else if(!empty($_GET['prev'])){
    $page = $_GET['prev'];
}

if($page > 0) $prev = true;
else $prev = false;

$orders = find_orders_by_count();






?>

<?php require("common_update/head.php"); ?>

<body>

<?php require("common_update/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common_update/sidebar.php"); ?>


    <div class="main-contents">
        <div class="recent-products">

            <div class="tbl-wrapper">
                <table  id="example"  class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th><?php echo $lang['codigo'] ?></th>
                            <th><?php echo $lang['usuario'] ?></th>                
                            <th><?php echo $lang['DireccionEnvío'] ?></th>
                            <th><?php echo $lang['fecha'] ?></th>
                            <th><?php echo $lang['estado'] ?></th>
                            <th><?php echo $lang['monto'] ?>(<?php echo get_currency();?>)</th>
                            <th><?php echo $lang['accion'] ?></th>

                        </tr>
                    </thead>
    
                    <tbody>


<?php if(!empty($orders)){
    foreach ($orders as $order) {

        if($order['order_noti'] == 0){ ?>
            <tr class="order-row new-order">
            <?php update_order_noti_by_id($order['order_id']);
        } else{ ?>
            <tr class="order-row">
        <?php }?>


			<td>
			<?php 

			$order_id=$order['order_id'];

			$order_id2=str_pad($order_id, 5, "0", STR_PAD_LEFT);
			//print"$folio-$order_id2";  
			print"$order_id2"; ?>   
			<?php //echo generate_ordered_id(date("hmmjY", strtotime($order['order_time'])), $order['order_id']); ?>
			</td> 
			<?php $user = find_user_by_id($order['order_user_id']); ?>

			<td><?php 
            if (isset($user['first_name'])) {
                $searchString = " ";
$replaceString = "";
                echo str_replace($searchString,$replaceString,$user['first_name']) . " " . str_replace($searchString,$replaceString,$user['last_name']);
            }
             ?>
			</td>

			<!-- <td><?php echo $order['order_method']; ?></td>-->


        
            <?php
                $find_address = find_address_by_address_id($user['address']);
                $new_address = concate_address($find_address);
             ?>

            <td><?php echo $new_address; ?></td>

            <td><?php echo date("Y-m-d H:i:s", strtotime($order['order_time'])); ?></td>

            <?php $order_status_arr = get_order_status($order['order_status']); ?>

            <td class="color-<?php echo $order_status_arr[0]; ?>"><b><?php echo $order['order_status']."->".$order_status_arr[1]; ?></b></td>


            <td><?php echo get_currency() . " " . $order['order_amount']; ?></td>

            <td>
                <a class="update-btn" style="margin-left: 10px;" href="add_order.php?order_id=<?php echo $order['order_id']; ?>"><i class="fas fa-edit"></i></a>
                <a class="delete-btn" style="margin-left: 10px;" onclick="eliminar_orden_id('<?php echo $order['order_id']; ?>')"><i class="fas fa-trash-alt"></i></a>

				<a class="update-btn" style="margin-left: 10px;"  href="../consultas/index00.php?order_id=<?php echo $order['order_id']; ?>" target="_blank"><i class="fas fa-print"></i></a>

                
            </td>
        </tr>
    
                            <?php } ?>
                        <?php } ?>
    
                    </tbody>
                </table>
    
            </div><!-- recent-products -->


            


        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>
<script src="./plugin-frameworks/js/jquery.dataTables.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.responsive.min.js"></script>
<script src="./plugin-frameworks/js/responsive.bootstrap4.min.js"></script>

<!-- Main Script -->
<script src="common/script.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );

function eliminar_orden_id(id){
    var ans = confirm("Si deseas eliminar la orden presionar el boton ACEPTAR, caso contrario CANCELAR.");
		if(ans){
		     window.location.href = "./delete_order.php?order_id="+id;
		    
		}else{
		   return false;
		} 
}
</script>
</body>
</html>

<?php }
 ?>