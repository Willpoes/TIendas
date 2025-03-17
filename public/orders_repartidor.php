<?php require_once('../private/init.php'); ?>
<?php

if ($_SESSION['grobaltype']==3){



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

$orders = find_orders_by_count(($page *$count), $count);


if(count($orders) > $count){
    $message = "Mostrar " . ($page * $count) . " a " . (($page * $count) + $count) . " pedidos.";
}else{
    $message = "Mostrar " . ($page * $count) . " a " . (($page * $count) + count($orders)) . " pedidos.";
}

$message_param = "order";
if(empty($orders)){
    $next = false;
    $message = "No se encontraron pedidos.";
}else if(!empty(get_msg_all($message_param))){
    $next = true;
    $message = get_msg_all($message_param);
    unset_msg_all($message_param);
}

?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common/sidebar.php"); ?>


    <div class="main-contents">
        <div class="recent-products">
            <div class="message-wrapper">
                <h5 class="message"><?php echo $message; ?></h5>
            </div>

            <div class="tbl-wrapper">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Usuario</th>
                            <th>Dirección de Envío</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Accion</th>

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

			<td><?php echo $user['first_name'] . " " . $user['last_name']; ?>
			</td>


        
            <?php
                $find_address = find_address_by_address_id($user['address']);
                $new_address = concate_address($find_address);
             ?>

            <td><?php echo $new_address; ?></td>

            <td><?php echo date("d-m-Y", strtotime($order['order_time'])); ?><br>

            <?php echo date("h:ma", strtotime($order['order_time'])); ?>


            </td>

            <?php $order_status_arr = get_order_status($order['order_status']); ?>

            <td class="color-<?php echo $order_status_arr[0]; ?>"><b><?php echo $order_status_arr[1]; ?></b></td>



            <td>
               
				<a class="update-btn" href="../consultas/index2.php?order_id=<?php echo $order['order_id']; ?>" target="_blank"><i class="fas fa-print"></i></a>

                
            </td>
        </tr>
    
                            <?php } ?>
                        <?php } ?>
    
                    </tbody>
                </table>
    
            </div><!-- recent-products -->


            <div class="mt-30 center-text nxt-link">
                <?php if($prev){ ?>
                    <a href="orders_repartidor.php?prev=<?php echo ($page -1); ?>"> Anterio</a>
                <?php } ?>
                <?php if($next){ ?>
                    <a href="orders_repartidor.php?next=<?php echo ($page + 1); ?>"> Siguiente</a>
                <?php } ?>
            </div>


        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>

<?php }
 ?>