<?php
	include '../private/init.php';
	
	$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";
	
	$user_id = "";
	$username = "";
	$admin_info = logged_in();
	if(!empty($admin_info)){
		$user_id = $admin_info[0];
		$username = $admin_info[1];
	}else{
		redirect_to_login();
	}
	
	$success_message = "";
	
	if(!empty($_GET)){
		
		$admin = find_admin_by_id($user_id);

		$admin_address = find_address_by_address_id($admin['address']);
		if(!empty($_GET["successmsg"])){
			
			$success_message = get_admin_update_msg();
			unset_admin_update_msg();
		}
	}

	$success_message_address = "";
	
	if(!empty($_GET)){
		
		$admin = find_admin_by_id($user_id);
		if(!empty($_GET["successmsg"])){
			
			$success_message_address = get_admin_update_address_msg();
			unset_admin_address_update_msg();
		}
	}
	
	
	
?>


<?php require("common/head.php"); ?>

<!-- ====== Cambios movil ====== -->
<style>
  @media screen and (max-width: 767px) {
  	.display-table-cell {
  		display: block !important;
  		width: 100% !important;
  	}

  	.login-container {
  		padding-bottom: .1em;
  		padding-top: .2em;
  	}
  }
</style>

<body>

<?php require("common/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
		
	
		<div class="main-contents">
			<div class="display-table">
				<div class="display-table-cell">
					<div class="login-container">
					
						<?php if($success_message != "") echo $success_message; ?>
						
						<form action="../private/update_admin.php" method="POST">
						
							<input type="hidden" name="user_id" value="<?php echo $admin['user_id']; ?>">
							<input class="" type="text" name="first_name" placeholder="Nombres" value="<?php echo $admin['first_name']?>" readonly >
<input class="" type="text" name="last_name" placeholder="Apellidos" value="<?php echo $admin['last_name'] ." ". $admin['mother_last_name']?>" readonly>
<input class="" type="text" name="number" placeholder="Télefono" value="<?php echo $admin['mobile']?>" readonly>

							<input name="fruc" id="fruc" placeholder="RUC o DNI *" class="form-control" type="text" required  value="<?= (!empty($admin['dni']) ? $admin['dni'] : $admin['ruc']) ?>" readonly> 

							<input class="email" type="text" name="email" placeholder="Email" value="<?php echo $admin['email']?>">
							<h6 class="validation-msg"></h6>
							
							<!-- <input class="password" type="password" name="prev-password" placeholder="Contraseña actual" >
							<h6 class="validation-msg"></h6>
							<input class="new-password" type="password" name="new-password" placeholder="Nueva contraseña" >
							<h6 class="validation-msg"></h6>
							<input class="confirm-password" type="password" name="confirm-password" placeholder="Confirmar contraseña" >
							<h6 class="validation-msg"></h6> -->
							<!-- <button class="submit btn" type="submit"><b>ACTUALIZAR</b></button> -->
						</form>
						
						<?php if($error_msg != "") echo get_error_msg(); ?>
						
					</div><!-- login-container -->
					
				</div><!-- display-table-cell -->
				<div class="display-table-cell">
					<div class="login-container" >
					
						<?php if($success_message_address != "") echo $success_message_address; ?>
						
<form action="../private/update_admin_address.php" method="POST">

<input type="hidden" name="user_id" value="<?php echo $admin['user_id']; ?>">

<h6 class="validation-msg"></h6>
<!-- <input class="" type="text" name="username" placeholder="Usuario" value="<?php echo $admin['username']?>"> -->

<!-- ===== Add Fields ====  -->
<input name="fgallery" id="fgallery" placeholder="GALERIA*" class="form-control" type="text" required >
<input name="fdirection" id="fdirection" placeholder="Direccion de la Tienda *" class="form-control" type="text" required > 
<input name="fstand" id="fstand" placeholder="Numero Stand *" class="form-control" type="text" required > 
<input name="fstore" id="fstore" placeholder="Nombre de la Tienda *" class="form-control" type="text" required > 



<!-- <input class="" type="text" name="address_line_1" placeholder="Dirección Línea 1" value="<?php echo $admin_address['address_line_1']?>" >
<input class="" type="text" name="address_line_2" placeholder="Dirección Línea 2" value="<?php echo $admin_address['address_line_2']?>">
 -->
<!-- <input class="city" type="text" name="city" placeholder="city" value="<?php echo $admin_address['city']?>">
<input class="zipcode" type="text" name="zip_code" placeholder="Codigo postal" value="<?php echo $admin_address['zip_code']?>" >
<input class="state" type="text" name="state" placeholder="Provincia"  value="<?php echo $admin_address['state']?>" >
<input class="country" type="text" name="country" placeholder="Pais"  value="<?php echo $admin_address['country']?>" > -->


<button class="submit btn" type="submit"><b>ACTUALIZAR</b></button>
</form>
						
						<?php if($error_msg != "") echo get_address_error_msg(); ?>
						
					</div><!-- login-container -->
					
				</div><!-- display-table-cell -->

				
			</div><!-- display-table -->

			
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>