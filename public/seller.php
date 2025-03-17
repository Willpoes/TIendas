<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php
	
// Verifica si hay vedendor nuevo para la Notificacion
// si la hay actualiza
if ( !empty($_GET['view']) && $_GET['view'] == 'si') {
	update_sellers_notif();
	header("location: seller.php");
}





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

	$users = find_sellers_by_count(2);
										

	if(count($users) > $count){
		$message = $lang['mostrar'] .' '.($page * $count) . " a " . (($page * $count) + $count)  .' ' . $lang['usuarios'] .".";
	}else{
		$message = $lang['mostrar'] .' '.($page * $count) . " a " . (($page * $count) + count($users))  .' ' . $lang['usuarios'] .".";
	}


	if(empty($users)){
		$next = false;
		$message = "No se encontraron usuarios.";
	}else if(!empty(get_users_msg())){
		$next = true;
		$message = get_users_msg();
		unset_users_msg();
	}
	
?>

<?php require("common_update/head.php"); ?>

<body>

<?php require("common_update/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common_update/sidebar.php"); ?>
		
	
		<div class="main-contents">
			<div class="user-containe">
				
					<div class="mtb-40 plr-15">
					<h4></h4>
					<h5><?php echo $lang['ListVendedores'] ?></h5>
					</div>

				<div class="tbl-wrapper">
				<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
					<thead>
							<tr>

								<th><?php echo $lang['Vendedores'] ?></th>
								<th><?php echo $lang['Empresa'] ?></th>
								<th><?php echo $lang['FRegistro'] ?></th>
								<th><?php echo $lang['DNI'] ?></th>
								<th><?php echo $lang['RUC'] ?></th>
								<th><?php echo $lang['Galeria'] ?></th>


								<th><?php echo $lang['estado'] ?></th>
								<th><?php echo $lang['accion'] ?></th>
							</tr>
						</thead>

						<tbody>

							<?php if(!empty($users)){
								foreach ($users as $user) { ?>


<tr>

	<input  type="hidden" value='<?php echo $user["store"];?>' name='store<?php echo $user["user_id"];?>' id='store<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["business_name"];?>' name='business_name<?php echo $user["user_id"];?>' id='business_name<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["ruc"];?>' name='ruc<?php echo $user["user_id"];?>' id='ruc<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["gallery"];?>' name='gallery<?php echo $user["user_id"];?>' id='gallery<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["status"];?>' name='status<?php echo $user["user_id"];?>' id='status<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["image_name"];?>' name='image<?php echo $user["user_id"];?>' id='image<?php echo $user["user_id"];?>'>
	<!-- ==== Nuevos Campos ==== -->
	<input  type="hidden" value='<?php echo $user["first_name"];?>' name='first_name<?php echo $user["user_id"];?>' id='first_name<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["last_name"];?>' name='last_name<?php echo $user["user_id"];?>' id='last_name<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["mobile"];?>' name='mobile<?php echo $user["user_id"];?>' id='mobile<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["email"];?>' name='email<?php echo $user["user_id"];?>' id='email<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["business_name"];?>' name='business_name<?php echo $user["user_id"];?>' id='business_name<?php echo $user["user_id"];?>'>
	<input  type="hidden" value='<?php echo $user["date"];?>' name='date<?php echo $user["user_id"];?>' id='date<?php echo $user["user_id"];?>'>
	<!-- ==== Nuevos inputs ==== -->
	<input  type="hidden" value='<?php echo $user["address_gallery"];?>' name='address_gallery<?php echo $user["user_id"];?>' id='address_gallery<?php echo $user["user_id"];?>'>
    <input  type="hidden" value='<?php echo $user["number_store"];?>' name='number_store<?php echo $user["user_id"];?>' id='number_store<?php echo $user["user_id"];?>'>
    <!-- ==== DNI ==== -->
    <input  type="hidden" value='<?php echo $user["dni"];?>' name='dni<?php echo $user["user_id"];?>' id='dni<?php echo $user["user_id"];?>'>


<!-- <td><?php echo $user["store"]  ?></td> -->
<td><?php echo $user["first_name"] ."<br> ".$user["last_name"]; ?></td>
<td><?php echo $user["business_name"]; ?></td>
<td><?php echo substr($user["date"],0,10); ?></td>
<td><?php echo $user["dni"] ; ?></td>
<td><?php echo $user["ruc"] ; ?></td>
<td><?php echo $user["gallery"] ; ?></td>




<td>
<?php 

if ($user["status"] == 0) {
    echo $lang['Pendiente'];
} else if ($user["status"] == 1) {
    echo "<span style='background: green; color: white;'>" . $lang['Aprobado'] . "</span>";
} else if ($user["status"] == 2) {
    echo "<span style='background: red; color: white;'>" . $lang['Rechazado'] . "</span>";
}



?>

</td>
<td>
<a   onclick="obtener_datos(<?= $user['user_id'] ?>)" data-toggle="modal" data-target="#openModal"><i class="glyphicon glyphicon-edit"></i> <?php  echo $lang['Editar'] ?></a> 


<a class="delete-btn" href="delete_user.php?user_id=<?php echo $user['user_id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
</tr>


								<?php  }?>
							<?php } ?>
						</tbody>
					</table><!-- user -->
				</div>

				

			</div><!-- users -->
		</div><!-- main-content -->
	</section><!--main-body -->


<link rel="stylesheet" href="common/modal.css">

<style>
	.modalDialog > div {
		margin: 3% auto;
	}
</style>

<div id="openModal" class="modal">
<div class="modal-dialog">
    <div class="modal-content modal-lg">
	
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h2><?php echo $lang['Editar'] ?></h2>

		<form class="form-horizontal" method="post" id="editar_datos" name="editar_datos">		

			<p>
				<div id="resultados_ajax2">

				</div>		
			

			<div class="input-wrap-new">		
			    <select  id="status" name="status" required>
					<option value=""><?php echo $lang['SeleccionaEstado'] ?></option>
					<option value="0"><?php echo $lang['Pendiente'] ?></option>
					<option value="1"><?php echo $lang['Aprobado'] ?></option>
					<option value="2"><?php echo $lang['Rechazado'] ?></option>
				  </select>

				<input type="hidden" name="id" id="id"  placeholder="" value="">
			</div>
			<div class="input-wrap-new text-center">
				<img src="" alt="" id="imagen_user" style="width: 30% !important;" onclick="ver_dni();">
			</div>
			<!-- ===== Campos Nuevos =====  -->
			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Nombres'] ?></span>
				<input type="text" name="first_name" id="first_name"  placeholder="Nombres" value="" readonly>
			</div>

			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['DNI'] ?></span>
				<input type="text" name="dni" id="dni"  placeholder="dni" value="" readonly>
			</div>

			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Telefono'] ?></span>
				<input type="text" name="mobile" id="mobile"  placeholder="Celular" value="" readonly>
			</div>

			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Correo'] ?></span>
				<input type="text" name="email" id="email"  placeholder="Correo" value="" readonly>
			</div>

			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Tienda'] ?></span>
				<input type="text" name="store" id="store"  placeholder="Tienda" value="">
			</div>
			
			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Nro_Tienda'] ?></span>
				<input type="text" name="store" id="store_nro"  placeholder="Numero de Tienda" value="" readonly>
			</div>
			

			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Galeria'] ?></span>
				<input type="text" name="gallery" id="gallery"  placeholder="Galeria" value="" readonly>
			</div>
			
			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Direccion_Galeria'] ?></span>
				<input type="text" name="gallery" id="gallery_address"  placeholder="Direccion Galeria" value="" readonly>
			</div>
			

			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['FRegistro'] ?></span>
				<input type="text" name="date" id="date"  placeholder="Fecha Reg." value="" readonly>
			</div>
			
			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['Empresa'] ?></span>
				<input type="text" name="business_name" id="business_name"  placeholder="Empresa o Razón Social" value="">
			</div>


			<div class="input-wrap-new">
				<span class="titulos-input"><?php echo $lang['RUC'] ?></span>
				<input type="text" name="ruc" id="ruc"  placeholder="RUC" value="">
			</div>


		

			</p>


			<p>
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Cerrar'] ?></button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos"><?php echo $lang['Actualizar'] ?></button>

			</p>

		</form>

	</div>
	</div>
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <img src="" alt="" id="img_modal" width="100%" height="100%">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


</body>
<!-- jQuery library -->
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

window.onload = function() {
  $('#example').DataTable();
};
</script>
<script>
	function ver_dni() {
		$('#myModal').modal();
		$('#openModal').modal('hide');
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
		var imagen=$('#image'+id).val();
	// New Datos - 07/10/2020
	var first_name = $('#first_name'+id).val();
	var last_name = $('#last_name'+id).val();
	var mobile = $('#mobile'+id).val();
	var email = $('#email'+id).val();
	var date = $('#date'+id).val();
	//seteo nuevos inputs
	var address_gallery = $('#address_gallery'+id).val();
	var number_store = $('#number_store'+id).val();
	//dni
	var dni = $('#dni'+id).val();


	$('#id').val(id);
	$('#store').val(store);
	$('#business_name').val(business_name);
	$('#ruc').val(ruc);
	$('#gallery').val(gallery);
	$('#status').val(status);
	var vista_pre = document.getElementById('imagen_user');
    vista_pre.src='./uploads/user-images/'+imagen;
	var vista_modal = document.getElementById('img_modal');
	vista_modal.src='./uploads/user-images/'+imagen;
	// New Data
	$('#first_name').val(first_name);
	
	//if($('#last_name').val() ===" "){
	  //  last_name="";
	//}
	
	//$('#last_name').val(last_name);
	$('#dni').val(dni);
	

	$('#mobile').val(mobile);
	$('#email').val(email);
	$('#date').val(date);
	//nuevos input
	$('#gallery_address').val(address_gallery);
	$('#store_nro').val(number_store);



	}

		


</script>


</html>