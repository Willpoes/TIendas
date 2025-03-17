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

$ordered_productsVER = [];
$order = [];

if(!empty($_GET) && isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $order = find_orders_by_id($order_id);
    $ordered_productsVER = find_ordered_products_by_order_id($order_id);
    $order_user = find_user_by_id($order["order_user_id"]);
    $order_user_address=find_address_by_address_id($order_user["address"]);

}

$message_param = "order_status";
$message = get_msg_all($message_param);
unset_msg_all($message_param);

$order_custom_id = generate_ordered_id(date("hmmjY", strtotime($order['order_time'])), $order_id);

echo '<script>';
echo 'var order_custom_id = ' .  json_encode($order_custom_id) . ';';
echo '</script>';

?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common/sidebar.php"); ?>

    <div class="main-contents invoice-wrapper">
        <div class="invoice-inner">
            <div class="recent-products">

                <div class="invoice-main">
                    <div id="content">

                       <div class="message-wrapper">
                           <h5 class="message"><?php echo $message; ?></h5>
                       </div>

                       <div class="mtb-40 plr-15">
                           <h4 class="brder-b-grey pb-30">Documento : <?php echo $order_custom_id; ?></h4>
                       </div>

                       <div class="invoice-area plr-15">
                           <div class="invoice-address mb-30">

                               <div class="left-area">
                                   <?php $admin = find_admin_by_id($admin_id); ?>
                                   <h5 class="mb-10"><?php echo $admin["first_name"] . " " . $admin["last_name"]; ?></h5>
                                   <p><?php
                                   
                                   $admin_address=find_address_by_address_id($admin["address"]);
                                   $admin_address_display = concate_address($admin_address);
                                   
                                   echo $admin_address_display; ?></p>
                               </div><!--left-area-->
                               <div class="right-area">
                                   <h5><b>Documento a</b></h5>
                                   <h5 class="mb-10"><?php echo $order_user["first_name"] . " " . $order_user["last_name"]; ?></h5>

                                   <?php  $new_address = concate_address($order_user_address);  ?>

                                   <p><?php echo $new_address; ?></p>

                               </div><!--right-area-->
                           </div><!--invoice-address-->

                           <p class="mb-30">Fecha : <?php echo  date("g:ia, d-m-Y", strtotime($order["order_time"]));?></p>
                       </div><!--invoice-address-->

                        <div class="plr-15">
                           <table class="invoice-table order-table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>producto</th>
                                       <th>talla</th>
                                       <th>Color</th>
                                       <th>cantidad</th>
                                       <th>precio(<?php echo get_currency(); ?>)</th>
                                       <th>Total(<?php echo get_currency(); ?>)</th>
                                   </tr>
                               </thead>

                               <tbody>
                                    <?php $i = 1; $total_amount = 0; ?>
                                    <?php if(!empty($ordered_productsVER)){
                                    foreach ($ordered_productsVER as $ordered_product) { ?>

                                       <?php
                                       $product = find_product_by_id($ordered_product['product_id']);
                                       $current_total = $ordered_product['ordered_quantity'] * $product['price']; ?>

                                       <tr class="order-row">
                                           <td class="w-30x"><?php echo $i; ?></td>

                                           <td class="w-200x"><?php echo $product['title']; ?></td>

                                           <?php
                                                if($ordered_product['product_size_id'] == 0) $ordered_size = "N/A";
                                                else $ordered_size = find_size_by_id($ordered_product['product_size_id'])['size_name']; ?>
                                           <td class="w-15"><?php echo $ordered_size; ?></td>

                                           <?php
                                                if($ordered_product['ordered_color_id'] == 0) $ordered_color = "N/A";
                                                else $ordered_color = find_color_by_id($ordered_product['ordered_color_id'])['color_name']; ?>

                                           <td class="w-15"><?php echo $ordered_color; ?></td>

                                           <td class="w-15"><?php echo $ordered_product['ordered_quantity']; ?></td>
                                           <td class="w-15"><?php echo get_currency() ." ". $product['price']; ?></td>
                                           <td class="w-15"><?php echo get_currency() ." ".$current_total; ?></td>
                                       </tr>

                                       <?php $i++; $total_amount += $current_total; ?>

                                   <?php } ?>
                               <?php } ?>

                               </tbody>
                           </table>
                        </div><!-- plr-15 -->

                        <div class="total-area mt-20">

                            <?php $vat =  $total_amount * (get_vat() /100); ?>
<!--
                            <h5>SubTotal : <b><?php echo get_currency() . " " . $total_amount; ?></b></h5>
                            <h5>IGV (<?php echo get_vat(); ?>%) : <b><?php echo get_currency() . " " . $vat; ?></b></h5>-->
                            <h4 class="mtb-10 ptb-5 brder-t-grey">Total : <b><?php echo get_currency() ." ". ($vat + $total_amount); ?></b></h4>
                        </div><!-- total-area -->

                    </div><!-- id="content" -->
                </div><!-- border-grey-->

                <div class="print_btn_wrapper">
                    <div data-html2canvas-ignore="true">
                        <h6 id="pdf-new" class="text-right mt-30"><a class="btn" href="javascript:demoFromHTML()">imprimir</a></h6>
                    </div>
                </div><!-- print_btn_wrapper -->

            </div><!-- invoice-inner -->
        </div><!-- recent-products -->

    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

<script src="plugin-frameworks/html2canvas.min.js"></script>
<script src="plugin-frameworks/jspdf.min.js"></script>
<!-- Main Script -->
<script src="common/script.js"></script>

<script>


    function demoFromHTML() {

        var sectionHeight = $('#content').height();
        var sectionwidth = $('#content').width();

        var pdf = new jsPDF('p', 'pt', [sectionwidth, sectionHeight]);
        var options = {
            background: '#fff' //background is transparent if you don't set it, which turns it black for some reason.
        };

        var trimmed = order_custom_id.substring(1);

        pdf.addHTML($('#content')[0], options, function () {
            pdf.save('Invoice_'+ trimmed +'.pdf');
        });

    }
</script>

</body>
</html>