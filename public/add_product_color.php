<?php require_once('../private/init.php');include "../configuration.php"; ?>
<?php

	$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";
	
	$admin_id = "";
	$username = "";
	$admin_info = logged_in();
	if(!empty($admin_info)){
		$admin_id = $admin_info[0];
		$username = $admin_info[1];
	}else{
		redirect_to_login();
	}
	
	$product_color = [];
	$color_id = "";
	$color_name = "";
	$color_code = "";
	
	if(!empty($_GET) && isset($_GET['color_id'])){
		$color_id = $_GET['color_id'];
		$product_color = find_color_by_id($color_id);
		$color_name = $product_color['color_name'];
		$color_code = $product_color['color_code'];
	}
	
	if(empty($product_color)){
		$redirected_link = "insert_color.php";
		$btn_text = 'añadir';
	}else{
		$redirected_link = "update_color.php?color_id=". $product_color['color_id'];					
		$btn_text = 'actualizar';
	}
	
?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>

	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
		
	
		<div class="main-contents">
		
			<div class="add-product">
				
				<?php if($error_msg != "") echo get_error_msg(); ?>

				<form action="<?php echo '../private/' . $redirected_link; ?>" method="POST" enctype="multipart/form-data">
				
					<input type="hidden" name="color_id" value="<?php echo $color_id; ?>">
					
					
					<input type="text" name="color_name" placeholder="<?php echo $lang['NombreColor'] ?>" value="<?php echo $color_name; ?>">
					<input type="text" name="color_code" placeholder="<?php echo $lang['CodigoColor'] ?>" value="<?php echo $color_code; ?>">
					
					<button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['Anadir'] ?></b></button>
				</form>

			</div><!-- add-product -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>