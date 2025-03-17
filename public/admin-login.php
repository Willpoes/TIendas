<?php
	
	include '../private/init.php';
	include '../configuration.php';
	$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";
	
	$admin_id = "";
	$username = "";
	$admin_info = logged_in();
	if(!empty($admin_info)){
		redirect_to_root();
	}

?>



<?php require("common/head.php"); ?>

<body class="login-page">

	<div class="display-table">
		<div class="display-table-cell">
			<div class="login-container">
				<div class="logo-icon"><img src="images/logo.png" alt=""></div>
				<form action="../private/admin-login.php" method="POST">
					<input class="email" type="number" name="email" placeholder="<?php echo $lang['celular'] ?>" >
					<h6 class="validation-msg"></h6>
					<input class="password" type="password" name="password" placeholder="<?php echo $lang['contrasena'] ?>" >
					<h6 class="validation-msg"></h6>
					<button class="submit btn" type="submit"><b><?php echo $lang['Ingresar'] ?></b></button>
				</form>
				
				<?php if($error_msg != "") echo get_error_msg(); ?>
				
			</div><!-- login-container -->
		</div><!-- display-table-cell -->
	</div><!-- display-table -->
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>