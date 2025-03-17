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
//}

$message_param = "order_status";
$message = get_msg_all($message_param);
unset_msg_all($message_param);

?>

<?php require("common_update/head.php"); ?>

<body>

<?php require("common_update/heading_menu.php"); ?>

<section class="main-body">
    <?php require("common_update/sidebar.php"); ?>

    <div class="main-contents">
        <div class="recent-products">

            <div class="message-wrapper">
                <h5 class="message"><?php echo $message; ?></h5>
            </div>

            <div class="mtb-40 plr-15">
                <h4></h4>
                <h5>Listado de Pedidos por productos </h5>
            </div>

            <table id="example"  class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th>#</th>

                  	<th>ORDER</th>

                    <th>TIENDA</th>
                    <th>GALERIA</th>
                    <th>NRO TIENDA </th>
                    <th>CLIENTE</th>

                    <th>ESTADO</th>
                    <th>ESTADO ENVIDO</th>
                     <th>ACCIONES</th>
                </tr>
                </thead>

    <tbody>
        <?php $i = 0; $total_amount = 0; $color1="background: #00abf7;"; $color2="background: #4caf50;"; $color3="background: #ebcf7c;"; $color="";
        $orde_ant=3;
        
        ?>
        
        <?php if(!empty($ordered_productst)){
            foreach ($ordered_productst as $ordered_product) { 
            
// var_dump($ordered_product);
            
			$ordered_id= $ordered_product['ordered_id'];
			$product = find_product_by_id($ordered_product['product_id']);
			$orders = find_order_by_id($ordered_product['order_id']);
			$cliente = $orders['cliente']; 
			$users = find_user_by_id($ordered_product['user_id']);
			$store = $users['store']; 
			$gallery = $users['gallery']; 
			$number_placed = $users['number_placed']; 
			$order_id = $ordered_product['order_id']; 
			$i++;
			if(($order_id%2)==0 && ($orde_ant%2)==0 && $orde_ant!==$order_id){
			  $color=$color3;
			  $orde_ant=$order_id;
			  }elseif(($order_id%2)!==0 && ($orde_ant%2)!==0 && $orde_ant!==$order_id){
			   $color=$color3;
			  $orde_ant=$order_id;   
			  
			 }elseif(($order_id%2)==0){
			     $color=$color1;
			   $orde_ant=$order_id;  
			  
			}else{
			   $color=$color2; 
			   $orde_ant=$order_id; 
			}
			
			
			
			//$current_total = $ordered_product['ordered_quantity'] * $product['price']; 
			//$order_status_arr = $ordered_product['order_statusx'];
            // var_dump($ordered_product['order_statusx']);
            
			$order_status_arr = get_order_statusx($orders['status_despacho']);

            // saber el estado envio
            $order_estado_envio = $ordered_product['order_statusy'];
		?>
        <tr class="order-row" style="<?php echo $color;?>">

        <td><?php echo $i;?></td>

        <td><?php echo $order_id;?></td>

        <td><?php echo $store;?></td>

        <td><?php echo $gallery;?></td>

        <td><?php echo $number_placed;?> </td>

        <td><?php echo $cliente;?> </td>

		<td style="color:<?php echo $order_status_arr[0]; ?>"><?php echo $order_status_arr[1]; ?></td>
        <td>

            <?
              //  var_dump($order_estado_envio);

                if ($order_estado_envio == 1) {
                    echo "<mark>Enviado</mark>";
                } else {
                    echo "No Enviado";
                }
            ?>
        </td>

		<td>
		<a class="btn btn-primary" style="padding: 3px !important;line-height: 5px;height:20px;" href="id_order_seller_courier.php?ordered_id=<?=$ordered_id;?>"><i ></i> ver</a> 
		</td>

        </tr>


            <?php } ?>
        <?php } ?>

    </tbody>

            </table>


        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->

<!-- Sonido para la notifiacion  -->
<audio  id="miSonido"  >
          <source src="https://mishasho.com/moda-admin/public/audio/got-it-done.ogg" type="audio/ogg">
        </audio>

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
    $('#example').DataTable();
} );
     // Funciona para notifiacion
function prueba_notificacion_courier() {
    if (Notification) {
        if (Notification.permission !== "granted") {
            Notification.requestPermission()
        }
        var title = "Gamarrita"
        var extra = {
            icon: "https://gamarritas.com/public/uploads/user-images/6833c988dc459228c8b2490a4760b8b3.png",
            body: "Tienes Nuevo Pedido para Recoger."
        }
        var noti = new Notification(title, extra)
        noti.onclick = {
            // Al hacer click
        }
        noti.onclose = {
            // Al cerrar
        }
        setTimeout(function() {
            noti.close()
        }, 10000)
    }
}

// Cada 5 segundos verifica que si tiene Pedidos Listo para recoger
setInterval(function() {

   $.post("common/obtener_pedidos_nuevos.php", {}, function(data){
                // console.log(data, data.length);
            if (data.trim() == "si"){
              document.getElementById("miSonido").play();
              prueba_notificacion_courier();
            }
   });

}, 5000);

</script>

</body>
</html>