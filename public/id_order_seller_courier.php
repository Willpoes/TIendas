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

// Actualizo que se vio los pedido nuevos
update_sellers_notif_courier();

$ordered_productsVER = [];
$order = [];
$user_id=$admin_id;
//if(!empty($_GET) && isset($_GET['ordered_id'])){
$ordered_id = $_GET['ordered_id'];


$ordered_productsVER = find_ordered_products_by_id($ordered_id);


//}
///  





    
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
        <div class="add-product">

            <div class="message-wrapper">
                <h5 class="message"><?php echo $message; ?> </h5>
            </div>




		<?php

		$users = find_user_by_id($ordered_productsVER['user_id']);

		$store = $users['store']; 

		$gallery = $users['gallery']; 

		$number_placed = $users['number_placed']; 

		$order_id=$ordered_productsVER['order_id'];

		$order = find_orders_by_id($order_id);

		$order_status_arr = get_order_statusx($ordered_productsVER['order_statusx']); 
		$order_status_arry = get_order_statusy($ordered_productsVER['order_statusy']); 

		$order_statusy= $ordered_productsVER['order_statusy'];

		$productos= $ordered_productsVER['title'];

		$cantidad= $ordered_productsVER['ordered_quantity'];

		$user = find_user_by_id($order['order_user_id']); 

		$user_address = find_address_by_user_id($user['address']); 


		//var_dump($user_address);
		?>









			








<form action="#" method="POST" enctype="multipart/form-data">


	<div class="input-wrap-new">
		<span class="titulos-input">Order Id</span>
		<input type="text" name="order_id" placeholder="" value="<?=$order_id;?>" readonly>
	</div>



	<div class="input-wrap-new">
		<span class="titulos-input">Vendedor</span>
		<input type="text" name="vendedor" placeholder="" value="<?php  echo  $users['first_name'];?>   <?php  echo  $users['last_name'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Celular vendedor</span>
		<input type="text" name="vendedor" placeholder="" value="<?php  echo  $users['mobile'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Tienda</span>
		<input type="text" name="store" placeholder="" value="<?php  echo $store;?>" readonly>
	</div>


	<div class="input-wrap-new">
		<span class="titulos-input">Galeria</span>
		<input type="text" name="gallery" placeholder="" value="<?php  echo $gallery;?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Stand</span>
		<input type="text" name="number_placed" placeholder="" value="<?php  echo $number_placed;?>" readonly>
	</div>



	<div class="input-wrap-new">
		<span class="titulos-input">Productos</span>
		<input type="text" name="productos" placeholder="" value="<?php  echo $productos;?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Cantidad</span>
		<input type="text" name="cantidad" placeholder="" value="<?php  echo $cantidad;?>" readonly>
	</div>









	<div class="input-wrap-new">
		<span class="titulos-input">Cliente</span>
		<input type="text" name="cliente" placeholder="" value="<?php  echo  $user['first_name'];?>   <?php  echo  $user['last_name'];?>" readonly>
	</div>
    <div class="input-wrap-new">
		<span class="titulos-input">Celular Cliente</span>
		<input type="text" name="vendedor" placeholder="" value="<?php  echo  $user['mobile'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Persona que recibe</span>
		<input type="text" name="reception_name" placeholder="" value="<?php  echo  $user_address['reception_name'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input"> Dirección recibe</span>
		<input type="text" name="address_line_1" placeholder="" value="<?php  echo  $user_address['address_line_1'];?>" readonly>
	</div>



	<div class="input-wrap-new">
		<span class="titulos-input">Distrito</span>
		<input type="text" name="pdistrict" placeholder="" value="<?php  echo  $user_address['city'];?>" readonly>
	</div>


	<div class="input-wrap-new">
		<span class="titulos-input">Provincia</span>
		<input type="text" name="pprovince" placeholder="" value="<?php  echo  "Lima"; //$user_address['pprovince'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Fecha Preparación:</span>
		<input type="text" name="datex" placeholder="" value="<?php  echo  $order['datex'];?>" readonly>
	</div>

	<div class="input-wrap-new">
		<span class="titulos-input">Estado Pedido:</span>
		<input type="text" name="estadopedido" placeholder="" value="<?php echo $order_status_arr[1]; ?>" readonly>
	</div>


	<select  id="status" name="status" onchange="cargar_estado('<?=$ordered_id;?>',this.value);" required>
	 
		<?php if ($order_statusy==1){?>
		<option value="">-- Estado --</option>
		<option value="1" selected>Enviado</option>
		<option value="0">Sin enviar</option>
		<?php

		}else if ($order_statusy==0){

		?>
		<option value="">-- Estado --</option>
		<option value="1">Enviado</option>
		<option value="0" selected>Sin enviar</option>

		<?php

		}else{

		?>
		<option value="" selected>-- Estado --</option>
		<option value="1">Enviado</option>
		<option value="0">Sin enviar</option>

		<?php

		}

		?>

	</select>




</form>






	</div>
























		<div class="mtb-40 plr-15">
		<div id="resultados_ajax2">

		</div>		




        </div>

            

        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->
<link rel="stylesheet" href="common/modal.css">



<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


<script>



function cargar_estado(id,status){

	//var parametros = $(this).serialize();
	var order_id="<?=$_GET['order_id']?>";

	 $.ajax({
			type: "POST",
			url: "common/page.php?pagina=actualizar_estadoy_order",
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

			//setInterval(location.href="id_order_seller_courier.php?order_id="+order_id,5000);


			//$('#actualizar_datos').attr("disabled", false);
			
		  }
	});
}






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