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
$user_id=$admin_id;
//if(!empty($_GET) && isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $order = find_orders_by_id($order_id);
    $ordered_productsVER = find_ordered_products_user_by_order_id_user($order_id,$user_id );
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
     
<div class="add-product">
           

	<div class="message-wrapper">
	    <h5 class="message"><?php echo $message; ?> </h5>
	</div>


	<?php 

	$order_status_arr = get_order_status($order['order_status']); 

	$user = find_user_by_id($order['order_user_id']); 

	$user_address = find_address_by_user_id($user['address']); 



	?>





<form action="#" method="POST" enctype="multipart/form-data">


	<div class="input-wrap-new">
		<span class="titulos-input"><?php echo $lang['OrderId'] ?></span>
		<input type="text" name="order_id" placeholder="" value="<?=$order_id;?>" readonly>
	</div>



	<div class="input-wrap-new">
		<span class="titulos-input"><?php echo $lang['Cliente'] ?></span>
		<input type="text" name="cliente" placeholder="" value="<?php  echo  $user['first_name'];?>   <?php  echo  $user['last_name'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input"><?php echo $lang['NombresEntrega'] ?></span>
		<input type="text" name="reception_name" placeholder="" value="<?php  echo  $user_address['reception_name'];?> " readonly>
	</div>


	<div class="input-wrap-new">
		<span class="titulos-input"><?php echo $lang['DirecciónEntrega'] ?></span>
		<input type="text" name="address_line_1" placeholder="" value="<?php  echo  $user_address['address_line_1'];?>" readonly>
	</div>
    <div class="input-wrap-new">
		<span class="titulos-input">Referencia</span>
		<input type="text" name="address_line_1" placeholder="" value="<?php  echo  $user_address['address_line_2'];?>" readonly>
	</div>

</form>

</div>

   <div class="recent-products">


		<div class="mtb-40 plr-15">
		<div id="resultados_ajax2">

		</div>		



		</div>

            <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
	                <tr>
						<th>#</th>
						<th><?php echo $lang['Productos'] ?></th>
						<th><?php echo $lang['Tallas'] ?></th>
						<th><?php echo $lang['Color'] ?></th>
						<th><?php echo $lang['Cantidad'] ?></th>
						<th><?php echo $lang['Precio'] ?></th>
						<th><?php echo $lang['Total'] ?></th>

	                </tr>
	                </thead>

					<tbody>
					<?php $i = 1; $total_amount = 0; ?>


				<?php if(!empty($ordered_productsVER)){
				
					foreach ($ordered_productsVER as $ordered_product) {

					$ordered_id=$ordered_product['ordered_id'];
					$product = find_product_list_by_id($ordered_product['product_id']);
					$current_total = $ordered_product['ordered_quantity'] * $product['price']; 
$order_statusx=$ordered_product['order_statusx'];
					?>

					<tr class="order-row">
					<td><?php echo $i; ?></td>
					<td><?php echo $product['title']; ?> </td>

                   <?php
                        if($ordered_product['product_size_id'] == 0) $ordered_size = "N/A";
                        else $ordered_size = find_size_by_id($ordered_product['product_size_id'])['size_name']; ?>
                   <td class="w-15"><?php echo $ordered_size; ?></td>

                   <?php
                        if($ordered_product['ordered_color_id'] == 0) $ordered_color = "N/A";
                        else $ordered_color = find_color_by_id($ordered_product['ordered_color_id'])['color_name']; ?>

                   <td class="w-15"><?php echo $ordered_color; ?></td>



					<td><?php echo $ordered_product['ordered_quantity']; ?> </td>
					<td><?php echo get_currency() . " " .$product['price'];?></td>
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

				


				

		            

					
				</tbody>

            </table>
                
        </div><!-- recent-products -->
        <div class="row" style="margin-top: 2rem;">
            <div class="col-md-9" style="text-align: right;">
                <h4 class="mtb-5 ptb-5 brder-t-grey"><?php echo $lang['Total']?>(<?php echo get_currency(); ?>) : </h4>
            </div>
            <div class="col-md-3">
                <h4 class="mtb-5 ptb-5 brder-t-grey"><b><?php echo get_currency() . " " . ($vat + $total_amount); ?></b></h4>
            </div>
        </div>
    </div><!-- main-content -->
</section><!--main-body -->
<link rel="stylesheet" href="common/modal.css">



<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Editar</h2>

		<form class="form-horizontal" method="post" id="editar_datos" name="editar_datos">		

			<p>
				
			
				<div class="input-wrap-new">		
				    <select  id="status" name="status" required>
						<option value="">-- Selecciona estado --</option>
						<option value="1">Aprobado</option>
						<option value="0">Pendiente</option>
					  </select>

					<input type="hidden" name="id" id="id"  placeholder="" value="">
				</div>

				<div class="input-wrap-new">
					<span class="titulos-input">Tienda</span>
					<input type="text" name="store" id="store"  placeholder="Tienda" value="">
				</div>

				<div class="input-wrap-new">
					<span class="titulos-input">Galeria</span>
					<input type="text" name="gallery" id="gallery"  placeholder="Galeria" value="">
				</div>
				
				<div class="input-wrap-new">
					<span class="titulos-input">Empresa</span>
					<input type="text" name="business_name" id="business_name"  placeholder="Empresa" value="">
				</div>


				<div class="input-wrap-new">
					<span class="titulos-input">RUC</span>
					<input type="text" name="ruc" id="ruc"  placeholder="RUC" value="">
				</div>

			</p>


			<p>
				
			<a href="#close" class="btn btn-default" >Cerrar</a>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar</button>

			</p>

		</form>

	</div>
</div>

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









$( "#editar_datos" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "common/page.php?pagina=actualizar_user",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(data){
             var datos= data.trim();
             if (datos=="1"){
				datos="Actualizado Correctamente";
   

             }else{
				datos="Algo Fallo";
             }

			$("#resultados_ajax2").html(datos);

			setInterval(location.href="seller.php",5000);


			$('#actualizar_datos').attr("disabled", false);
			
		  }
	});


  event.preventDefault();
})

	
	function obtener_datos(id) {
	$("#resultados_ajax2").html("");
	var store =  $('#store'+id).val();
	var business_name =  $('#business_name'+id).val();
	var ruc =  $('#ruc'+id).val();
	var gallery =  $('#gallery'+id).val();
	var status =  $('#status'+id).val();
	

	$('#id').val(id);
	$('#store').val(store);
	$('#business_name').val(business_name);
	$('#ruc').val(ruc);
	$('#gallery').val(gallery);
	$('#status').val(status);


	}

 $("#drop").change(function () {
        var end = this.value;
        var firstDropVal = $('#pick').val();
    });
</script>

</body>
</html>