<?php require_once('../private/init.php');
include "../configuration.php"; ?>
<?php

// Verifica si hay PEDIDOS NUEVOS para la Notificacion
// si la hay actualiza
if (!empty($_GET['view_pedidos']) && $_GET['view_pedidos'] == 'si') {
	update_sellers_pedido_visto();
	header("location: list_order_user.php");
}

$admin_id = "";
$username = "";
$admin_info = logged_in();
if (!empty($admin_info)) {
	$admin_id = $admin_info[0];
	$username = $admin_info[1];
} else {
	redirect_to_login();
}

$ordered_productsc = [];
$order = [];

//if(!empty($_GET) && isset($_GET['order_id'])){
// $order_id = $_GET['order_id'];
//$order = find_orders_by_id($order_id);

$user_id = $admin_id;

$ordered_productsc = find_order_list_user_by_order_id($user_id);
$contarpedidos = mysqli_num_rows($ordered_productsc);

//}
/*
$message_param = "order_status";
$message = get_msg_all($message_param);
unset_msg_all($message_param);*/

?>

<?php require("common_update/head.php"); ?>

<body>

	<?php require("common_update/heading_menu.php"); ?>

	<section class="main-body">
		<?php require("common_update/sidebar.php"); ?>

		<div class="main-contents">
			<div class="recent-products">

				<div class="message-wrapper">
				
				</div>

				<div class="mtb-40 plr-15">
					
					<h5><?php echo $lang['ListadoPedidos'] ?>
						<!--(<?= $contarpedidos; ?>)-->
					</h5>
					<h4><?php echo $lang['Total']?>(<?php echo get_currency(); ?>) : <?php echo get_currency(); ?>
					<?php
					if (!empty($ordered_productsc)){
					    foreach ($ordered_productsc as $ordered_total) {
					        $order_id = $ordered_product['order_id'];
								$order_t = find_order_by_id($ordered_total['order_id']);
					        if (isset($order_t['order_amount'])) {
									$current_total1 = $order_t['order_amount'];
								} else {

									$current_total1 = 0;
								}
							$total_amount1 += $current_total1;	
					    }
					}
					echo $total_amount1 
					?></h4>
				</div>


				<table id="example2" class="table table-striped table-bordered dt-responsive nowrap">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo $lang['Pedido'] ?></th>
							<th style="width:200px"><?php echo $lang['EstadoDespacho'] ?> </th>
							<th><?php echo $lang['fecha'] ?> </th>
							<th><?php echo $lang['Distrito'] ?></th>
							<th><?php echo $lang['accion'] ?></th>
						</tr>
					</thead>

					<tbody>
						<?php $i = 1;
						$total_amount = 0; ?>

						<?php

						if (!empty($ordered_productsc)) {

							foreach ($ordered_productsc as $ordered_product) {

								$order_id = $ordered_product['order_id'];
								$orderx = find_order_by_id($ordered_product['order_id']);
								$order_status =$orderx['status_despacho'];
								if (isset($orderx['order_time'])) {
									$order_time = $orderx['order_time'];
								}else{
									$order_time = 'sin registrar';
								}
								
								if (isset($orderx['order_amount'])) {
									$current_total = $orderx['order_amount'];
								} else {

									$current_total = 0;
								}

								if (isset($orderx['district'])) {
									$district = $orderx['district'];
								}else{
									$district = 'sin registrar';
								}
								

								



						?>

								<tr class="order-row">
									<td><?php echo $i; ?></td>
									<td><?php echo $order_id; ?></td>
									<td>
									    
									    <?php
									    if ($order_status==1){
									        $atributo="disabled";
									    }else{
									       $atributo=""; 
									    }
									    ?>
									    <select  id="status" name="status" <?php echo $atributo;?> onchange="cargar_estado('<?=$order_id;?>',this.value);" required>
					 
                    						<?php if ($order_status==1){?>
                    						<option value="">-- Estado --</option>
                    						<option value="1" selected>Preparado</option>
                    						<option value="0">Sin preparado</option>
                    						<?php
                    
                    						}else if ($order_status==0){
                    
                    						?>
                    						<option value="">-- Estado --</option>
                    						<option value="1">Preparado</option>
                    						<option value="0" selected>Sin preparado</option>
                    
                    						<?php
                    
                    						}else{
                    
                    						?>
                    						<option value="" selected>-- Estado --</option>
                    						<option value="1">Preparado</option>
                    						<option value="0">Sin preparado</option>
                    
                    						<?php
                    
                    						}
                    
                    						?>
                    
                    					</select>
									</td>
									<td><?php echo $order_time; ?></td>
									<td><?php echo $district; ?></td>


									<td>
										<a class="btn btn-primary" href="id_order_seller.php?order_id=<?= $order_id; ?>"><i class="glyphicon glyphicon-edit"></i> <?php echo $lang['Ver'] ?></a>
									</td>

									<!--<td><?php //echo $order_status_arr;
											echo $order_status_arr[1]; ?></td>onclick="obtener_datos(<?= $order_id; ?>)"-->


								</tr>

								<?php $i++;
								$total_amount += $current_total; ?>

							<?php } ?>
						<?php } ?>
					

					</tbody>

				</table>







			</div><!-- recent-products -->
		</div><!-- main-content -->
	</section>
	<!--main-body -->
	<link rel="stylesheet" href="common/modal.css">



	<div id="openModal" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<h2>Editar</h2>

			<form class="form-horizontal" method="post" id="editar_datos" name="editar_datos">

				<p>
				<div id="resultados_ajax2">

				</div>

				<div class="input-wrap-new">
					<select id="status" name="status" required>
						<option value="">-- Selecciona estado --</option>
						<option value="1">Aprobado</option>
						<option value="0">Pendiente</option>
					</select>

					<input type="hidden" name="id" id="id" placeholder="" value="">
				</div>

				<div class="input-wrap-new">
					<span class="titulos-input">Tienda</span>
					<input type="text" name="store" id="store" placeholder="Tienda" value="">
				</div>

				<div class="input-wrap-new">
					<span class="titulos-input">Galeria</span>
					<input type="text" name="gallery" id="gallery" placeholder="Galeria" value="">
				</div>

				<div class="input-wrap-new">
					<span class="titulos-input">Empresa</span>
					<input type="text" name="business_name" id="business_name" placeholder="Empresa" value="">
				</div>


				<div class="input-wrap-new">
					<span class="titulos-input">RUC</span>
					<input type="text" name="ruc" id="ruc" placeholder="RUC" value="">
				</div>

				</p>


				<p>

					<a href="#close" class="btn btn-default">Cerrar</a>
					<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar</button>

				</p>

			</form>

		</div>
	</div>

	<!-- jQuery library -->


</body>

<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>
<script src="./plugin-frameworks/js/jquery.dataTables.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.responsive.min.js"></script>
<script src="./plugin-frameworks/js/responsive.bootstrap4.min.js"></script>


	<!-- Main Script -->
	<script src="common_update/script.js"></script>

    <script>
	    $(document).ready(function() {
            $('#example2').DataTable();
        } );
    </script>

	<script>
        
		$("#editar_datos").submit(function(event) {
			$('#actualizar_datos').attr("disabled", true);

			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "common/page.php?pagina=actualizar_user",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_ajax2").html("Mensaje: Cargando...");
				},
				success: function(data) {
					var datos = data.trim();
					if (datos == "1") {
						datos = "Actualizado Correctamente";


					} else {
						datos = "Algo Fallo";
					}

					$("#resultados_ajax2").html(datos);

					setInterval(location.href = "seller.php", 5000);


					$('#actualizar_datos').attr("disabled", false);

				}
			});
			event.preventDefault();
		})


		function obtener_datos(id) {
			$("#resultados_ajax2").html("");
			var store = $('#store' + id).val();
			var business_name = $('#business_name' + id).val();
			var ruc = $('#ruc' + id).val();
			var gallery = $('#gallery' + id).val();
			var status = $('#status' + id).val();


			$('#id').val(id);
			$('#store').val(store);
			$('#business_name').val(business_name);
			$('#ruc').val(ruc);
			$('#gallery').val(gallery);
			$('#status').val(status);


		}
		
function cargar_estado(id,status){

	//var parametros = $(this).serialize();
	var order_id="<?=$_GET['order_id']?>";

	 $.ajax({
			type: "POST",
			url: "common/page.php?pagina=actualizar_estado_order",
			data: "id="+id+"&status="+status,

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

			location.reload();


		       
			
		  }
	});
}
	</script>

</html>