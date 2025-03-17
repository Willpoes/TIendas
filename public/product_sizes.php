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

	$sizes = find_all_sizes_category();

	$message_param = "product_size";
	$message = $lang['mostrar'] .' '. sizeof($sizes) . " ". $lang['talla'] .".";
	if(empty($sizes)){
		$message = "No Sizes Found.";
	}else if(!empty(get_msg_all($message_param))){
		$message = get_msg_all($message_param);
		unset_msg_all($message_param);
	}
	
?>

<?php require("common/head.php"); ?>


<style>
	.category {
		float: none;
	    width: 50%;
	}
</style>

<body>

<?php require("common/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
	
		<div class="main-contents">
			<div class="recent-products">
				<div class="message-wrapper">
					<h5 class="message"><?php echo $message; ?></h5>
					<!--<h6><a class="add-product-btn btn" href="add_product_size.php">+ Añadir tamaño</a></h6>-->
				</div>

				<div class="catg-wrapper">

					<div class="" style=" width: 25%;background-color: black; padding: .4em 2em; color: white;">
						# &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp; <?php echo $lang['Categoria'] ?> &nbsp;&nbsp;&nbsp; &nbsp; - &nbsp;&nbsp;&nbsp;<?php echo $lang['Talla'] ?>
					</div>
					<?php if(!empty($sizes)){

						$cont = 1;
						foreach ($sizes as $size) { ?>

							<div class="category">
								<div class="category-inner">
								<div class="right-top-area">
								    
									<a class="update-btn" href="add_product_size.php?size_id=<?php echo $size['id']; ?>"><i class="fas fa-edit"></i></a>
									<a class="delete-btn" href="delete_size.php?size_id=<?php echo $size['id']; ?>"><i class="fas fa-trash-alt"></i></a>
								</div><!-- right-top-area -->

								
								<h4 class="size-name title">
								   <strong> <?= $cont++ ?>.&nbsp;&nbsp; </strong>  <b><?php echo $size['title']; ?> &nbsp;&nbsp;- </b> &nbsp;&nbsp;&nbsp; 
								   <?php
								   
								    $tallas = find_size_by_category_id($size['id']);
								    // var_dump($tallas);
								    
								    $tallin = '';
								    foreach($tallas as $talla) {
								        $tallin .= '<small style="font-size: .8em; background-color: green; color: white; padding: 5px 7px; border-radius: 10px; margin-right: 8px; font-size: 14px" >'.$talla['size_name'].'</small>';
								    }
								    echo $tallin;
								  
								    ?>
								</h4>

								</div><!-- category-->
							</div><!-- category-->

						<?php } ?>
					<?php } ?>

				</div><!--  recent-products -->
			</div><!--  recent-products -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>