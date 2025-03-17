<?php require_once('../private/init.php'); ?>
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

$ordered_productst = [];
$order = [];

//if(!empty($_GET) && isset($_GET['order_id'])){
   // $order_id = $_GET['order_id'];
    //$order = find_orders_by_id($order_id);

//$user_id=$admin_id;

$ordered_productst = find_ordered_seller_by_order_id();
$contarpedidos=count($ordered_productst);
//}

$message_param = "order_status";
$message = get_msg_all($message_param);
unset_msg_all($message_param);

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

            <div class="mtb-40 plr-15">
                <h4></h4>
                <h5>Listado de Pedidos por productos </h5>
            </div>

            <table class="order-table">
                <thead>
                <tr>
                    <th>#</th>

                  	<th>order</th>

                    <th style="width:200px">Titulo</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Cant</th>
                    <th>Precio (<?php echo get_currency();?>)</th>
                    <th>Total (<?php echo get_currency();?>)</th>
                    <th>Estado</th>
                </tr>
                </thead>

    <tbody>
        <?php $i = 1; $total_amount = 0; ?>
        <?php if(!empty($ordered_productst)){
            foreach ($ordered_productst as $ordered_product) { 

			$product = find_product_by_id($ordered_product['product_id']);
			$order_id = $ordered_product['order_id']; 
			$current_total = $ordered_product['ordered_quantity'] * $product['price']; 
			//$order_status_arr = $ordered_product['order_statusx'];
			$order_status_arr = get_order_statusc($ordered_product['order_statusx']);
		?>
        <tr class="order-row">
        <td><?php echo $i; ?></td>
        <td><?php echo $order_id; ?></td>

        <td  >
            <?php echo $product['title']; ?><!-- <BR>
            Categoria:<?php echo $product['categoryname']; ?><br>
           Tienda:<?php echo $product['store']; ?><br>
            Galeria:<?php echo $product['gallery']; ?><br>-->

            
        </td>

        <?php if($ordered_product['product_size_id'] == 0) $ordered_size = "N/A";
        else $ordered_size = find_size_by_id($ordered_product['product_size_id'])['size_name']; ?>

        
        <td class="w-100"><?php echo $ordered_size; ?></td>

        <?php if($ordered_product['ordered_color_id'] == 0) $ordered_color = "N/A";
        else $ordered_color = find_color_by_id($ordered_product['ordered_color_id'])['color_name']; ?>

        <td ><?php echo $ordered_color; ?></td>
        <td ><?php echo $ordered_product['ordered_quantity']; ?></td>
        <td ><?php echo get_currency() . " " . $product['price']; ?></td>
        <td ><?php echo get_currency() . " " . $current_total; ?></td>

		<td><?php //echo $order_status_arr;
		echo $order_status_arr[1]; ?></td>


       


        </tr>

        <?php $i++; $total_amount += $current_total; ?>

            <?php } ?>
        <?php } ?>

    </tbody>

            </table>

            <div class="total-area">
                <?php $vat =  $total_amount * (get_vat() /100); ?>

                <h5>Subtotal: <b><?php echo get_currency() . " " . $total_amount; ?></b></h5>
                <h5>IGV<?php echo '(' . get_vat() . '%)'; ?> : <b><?php echo get_currency() ." " . $vat; ?></b></h5>
                <h4 class="mtb-5 ptb-5 brder-t-grey">Total : <b><?php echo get_currency() . " " . ($vat + $total_amount); ?></b></h4>

                <?php if($order['order_status'] == 2) { ?>
                    <h6 class="mt-40"><a class="btn" href="invoice.php?order_id=<?php echo $order_id; ?>"><b>Generar Documento</b></a></h6>
                <?php } ?>

            </div><!-- total-area -->

        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>