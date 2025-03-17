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
	
	$colors = find_all_colors();
	$message = $lang['mostrar'] .' ' . sizeof($colors) . " ".  $lang['colores'].".";
	if(empty($colors)){
		$message = "No se encontraron colores.";
	}else if(!empty(get_color_msg())){
		$message = get_color_msg();
		unset_color_msg();
	}
	
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
					<h6><a class="add-product-btn btn" href="add_product_color.php">+ <?php echo $lang['Newcolor']; ?></a></h6>
				</div>

				<div class="catg-wrapper">

					<?php if(!empty($colors)){
						foreach ($colors as $color) { ?>

							<div class="category">
								<div class="category-inner">
								<div class="right-top-area">
									<a class="update-btn" href="add_product_color.php?color_id=<?php echo $color['color_id']; ?>"><i class="fas fa-edit"></i></a>
									<a class="delete-btn" href="delete_color.php?color_id=<?php echo $color['color_id']; ?>"><i class="fas fa-trash-alt"></i></a>
								</div><!-- right-top-area -->

								<div class="color-area" style="background-color:<?php echo $color['color_code'];?>"></div>
								<h4 class="color-name title"><b><?php echo $color['color_name']; ?></b></h4>

								</div><!-- category-->
							</div><!-- category-->

						<?php } ?>
					<?php } ?>

				</div><!-- recent-products -->
			</div><!-- recent-products -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>