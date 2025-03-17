<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php

$admin_id = "";
$username = "";
$admin_info = logged_in();
if(!empty($admin_info)){
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
}else{
    redirect_to_login();
}

$ordered_productsVER = [];
$order = [];

//if(!empty($_GET) && isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $order = find_orders_by_id($order_id);
    $ordered_productsVER = find_ordered_products_by_order_id_new($order_id);
//}

$message_param = "order_status";
$message = get_msg_all($message_param);
unset_msg_all($message_param);

?>

<?php require("common_update/head.php"); ?>
<link rel="stylesheet" href="common/styles.css">
<link href="./custom-accordions.css" rel="stylesheet" type="text/css" />
<body>

<?php require("common_update/heading_menu.php"); ?>

<section class="main-body">
    <?php require("common_update/sidebar.php"); ?>

    <div class="main-contents">
        <div class="recent-products">

            <div class="message-wrapper">
                <h5 class="message"><?php echo $message; ?> </h5>
            </div>


    		<?php 
    
    		$order_status_arr = get_order_status($order['order_status']); 
    
    		$user = find_user_by_id($order['order_user_id']); 
    
    		if (isset($user['address'])) {
    			$user_address = find_address_by_user_id($user['address']); 
    		}else{
    			$user_address = '';
    		}
    		
    
    
    
    		?>


		    

        </div>
        <div class="mtb-40 plr-15">
            <h4><?php echo $lang['Pedido'] ?> Id  : <?=$order_id;?> <?php //echo generate_ordered_id(date("hmmjY", strtotime($order['order_time'])), $order_id); ?></h4>

            <h5> <?php echo $lang['Comprado'] ?>: <?php  echo  $user['first_name'];?>   <?php  echo  $user['last_name'];?>    </h5>





            <h5> <?php echo $lang['NombreEntrega'] ?>: <?php  echo  $user_address['reception_name'];?>    </h5>


            <h5> <?php echo $lang['DireccionEntrega'] ?>: <?php  echo  $user_address['address_line_1'];?>    </h5>

		    <h5><?php echo $lang['EstadoPedido'] ?>: <span class="color-<?php echo $order_status_arr[0]; ?>"> <b><?php echo $order_status_arr[1]; ?></b></span></h5>

    		<?php $opposite_order_status_arr = get_order_status(get_opposite_status($order['order_status'])); ?>
    		<a class="change_status_btn bg-<?php echo $opposite_order_status_arr[0]; ?>"
    		href="update_order_status.php?order_id=<?php echo $order_id . "&&order_status=" . get_opposite_status($order['order_status']); ?>">
    		<?php echo $lang['HacerPedido'] ?> <?php echo $opposite_order_status_arr[1];?> 
    		</a>
        

        </div>
        <div class="widget-content widget-content-area creative2-accordion-content">
            <div id="creativeAccordion">
                <?php
                $tiendas=find_products_tienda($_GET['order_id']);
                if(count($tiendas)>=1){
                    foreach ($tiendas as $tien) {
                        $user_vendedor = find_user_by_id($tien['user_id']); 
                        ?>
                       <div class="card mb-3">
                        <div class="card-header" id="creative2<?php echo $tien['user_id'];?>">
                          <h5 class="mb-0 mt-0">
                            <span role="menu" class="" data-toggle="collapse" data-target="#creative2Collapse<?php echo $tien['user_id'];?>" aria-expanded="true" aria-controls="creative2Collapse<?php echo $tien['user_id'];?>">
                                <span class="icon">
                                     <i class="fas fa-minus"></i>
                                </span>
                                <span class="text ml-2">
                                   Tienda - <?php echo strtoupper($user_vendedor['store']);?>
                                </span>
                            </span>
                          </h5>
                        </div>
        
                        <div id="creative2Collapse<?php echo $tien['user_id'];?>" class="collapse show" aria-labelledby="creative2<?php echo $tien['user_id'];?>" data-parent="#creativeAccordion">
                          <div class="card-body">
                            <div class="mb-40 plr-15">
                    
                                <h5> DUEÑO: <?php  echo  ucfirst($user_vendedor['first_name']);?>   <?php  echo  $user_vendedor['last_name'];?>    </h5>
                    
                    
                    
                    
                    
                                <h5> WHATTSAP: <?php  echo  $user_vendedor['mobile'];?>    </h5>
                    
                    
                                <h5>Nro DE CUENTA: <?php  echo  $user_vendedor['bank_account'];?>    </h5>
                    
                    		    <h5>BANCO: <?php  echo  $user_vendedor['bank'];?></h5>
                    
                        		
                            
                    
                            </div>

                            <table class="order-table">
                                <thead>
                	                <tr>
                						<th>#</th>
                						<th><?php echo $lang['Pedido'] ?></th>
                						<th><?php echo $lang['Talla'] ?></th>
                						<th><?php echo $lang['Color'] ?></th>
                						<th><?php echo $lang['Cantidad'] ?></th>
                						<th><?php echo $lang['Precio'] ?></th>
                						<th><?php echo $lang['Total'] ?></th>
                
                	                </tr>
                	                </thead>
                
                					<tbody>
                					<?php $i = 1; $total_amount = 0; 
                					
                					$productos_tienda=fin_product_tienda_de_orden($_GET['order_id'],$tien['user_id']);
                					?>
                
                                    
                					<?php if(!empty($productos_tienda)){
                					
                						foreach ($productos_tienda as $pt) {
                
                				// 		$product = find_product_list_by_id($ordered_product['product_id']);
                						$current_total = $pt['ordered_quantity'] * $pt['purchase_price']; 
                
                					?>
                
                					<tr class="order-row">
                					<td><?php echo $i; ?></td>
                					<td><?php echo $pt['title']; ?> </td>
                
                                   <?php
                                   $ordered_size = "N/A";
                                        if($pt['product_size_id'] >= 1) {
                                            $ordered_size = find_size_name_id($pt['product_size_id'])['size_name'];
                                        
                                        }?>
                                   <td class="w-15"><?php echo $ordered_size; ?></td>
                
                                   <?php
                                        if($pt['ordered_color_id'] == 0) $ordered_color = "N/A";
                                        else $ordered_color = find_color_by_id($pt['ordered_color_id'])['color_name']; ?>
                
                                   <td class="w-15"><?php echo $ordered_color; ?></td>
                
                
                
                					<td><?php echo $pt['ordered_quantity']; ?> </td>
                					<td><?php echo get_currency() . " " .$pt['purchase_price'];?></td>
                					<td><?php echo get_currency() . " " . $current_total; ?></td>
                					</tr>
                
                					<?php $i++; $total_amount += $current_total; ?>
                
                					    <?php } ?>
                					<?php }
                
                						?>
                
                <?php $vat =  $total_amount * (get_vat() /100); ?>
                <!--				
                				<tr class="order-row">
                				<td></td>
                				<td> </td>
                				<td> </td>
                				<td> Subtotal: <b></td>
                				<td> <h5><?php echo get_currency() . " " . $total_amount; ?></b></h5> </td>
                				</tr>
                
                
                				<tr class="order-row">
                				<td></td>
                				<td> </td>
                				<td> </td>
                				<td> IGV</td>
                				<td> <h5><?php echo '(' . get_vat() . '%)'; ?> : <b><?php echo get_currency() ." " . $vat; ?></b></h5> </td>
                				</tr>
                -->
                
                				<tr class="order-row">
                				<td></td>
                				<td> </td>
                				<td> </td>
                								<td> </td>
                				<td> </td>
                				<td> <?php echo $lang['Total'] ?> : </td>
                				<td>  <h4 class="mtb-5 ptb-5 brder-t-grey"><b><?php echo get_currency() . " " . ($vat + $total_amount); ?></b></h4> </td>
                				</tr>
                
                
                				<tr class="order-row">
                				<td></td>
                				<td> </td>
                				<td> </td>
                				<td> </td>
                				<td> </td>
                				<td> </td>
                				<td>
                				<?php //if($order['order_status'] == 2) { ?>
                		        <h6 class="mt-40"><a class="btn" href="invoice.php?order_id=<?php echo $order_id; ?>"><b><?php echo $lang['GenerarDocumento'] ?></b></a></h6>
                		        <?php //} ?> 
                		        </td>
                				</tr>
                
                		            
                
                					
                				</tbody>
                
                            </table>
                          </div>
                        </div>
                      </div> 
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>
<script src="./ui-accordions.js"></script>

</body>
</html>