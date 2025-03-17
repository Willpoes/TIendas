<?php require_once('../private/init.php'); ?>
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
	
	$type = [];
	$type_id = "";
	$type_title = "";
	$type_image = "";
	$image_link = "";
	
	if(!empty($_GET) && isset($_GET['type_id'])){
		$type_id = $_GET['type_id'];
		$type = find_type_by_id($type_id);
		$type_title = $type['title'];
		$type_image = $type['image_name'];
	}
	$image_link = dir_type() . $type_image;
	
	if(empty($type)){
		$redirected_link = "insert_type.php";
		$btn_text = 'añadir';
	}else{
		$redirected_link = "update_type.php?type_id=". $type['id'];					
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
				
					<input type="hidden" name="type_id" value="<?php echo $type_id; ?>">
					<input type="hidden" name="type_img_name" value="<?php echo $type_image; ?>">
					
					<div class="img-uploader">
						<h5 class="upload-title">Suelta / Sube tu imagen aquí</h5>
						<img id="img-uploaded" src="<?php echo $image_link; ?>" alt="" />
						<div class="file-wrapper">
							<a href="#" class="upload-btn"></a>
							<input type="file" name="type_image" class="uploader">
						</div>
					</div><!-- img-uploader -->
						
					<input type="text" name="title" placeholder="Titulo categoria" value="<?php echo $type_title; ?>">
					
					<button class="mt-20 btn" name="submit" type="submit"><b><?php echo $btn_text; ?> categoria</b></button>
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