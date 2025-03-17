<?php require_once('../private/init.php'); include "../configuration.php";?>
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
	
	$slider = [];
	$slider_id = "";
	$slider_title = "";
	$slider_image = "";

	$image_link = "";
	$slider_statu = "";


	if(!empty($_GET) && isset($_GET['slider_id'])){
		$slider_id = $_GET['slider_id'];
		$slider = find_slider_by_id($slider_id);
		$slider_title = $slider['title'];
		$slider_image = $slider['image_name'];
		$slider_statu = $slider['status'];
	}
	$image_link = dir_slider() . $slider_image;
	
//$image_link = "../public/uploads/recent-products/" . $slider_image;
	


	if(empty($slider)){
		$redirected_link = "insert_slider.php";
		$btn_text = 'añadir';
	}else{
		$redirected_link = "update_slider.php?slider_id=". $slider['id'];					
		$btn_text = 'actualizar';
	}

	$all_types = find_all_types();
	$all_status = find_all_status();
	
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
				
					<input type="hidden" name="slider_id" value="<?php echo $slider_id; ?>">
					<input type="hidden" name="slider_img_name" value="<?php echo $slider_image; ?>">

					
					<div class="img-uploader">
						<h5 class="upload-title"><?php echo $lang['UploadPhoto'] ?></h5>
						<img id="img-uploaded" src="<?php echo $image_link; ?>" alt="" />
						<div class="file-wrapper">
							<a href="#" class="upload-btn"></a>
							<input type="file" name="slider_image" class="uploader">
						</div>
					</div><!-- img-uploader -->

					
					

						
				<input type="text" name="title" placeholder="<?php echo $lang['Titulo'] ?>" value="<?php echo $slider_title;?>">


		<select name="statu">
			<option class="first" selected disabled hidden ><?php echo $lang['SeleccionaEstado'] ?></option>
			<?php 
				foreach($all_status as $statu){ ?>
					<option value="<?php echo $statu["id"]?>" <?php if($statu["id"] == $slider_statu){
						echo " selected ";
					}
						?>><?php echo $statu["title"]; ?></option>
				<?php } ?>
		</select>




					
					<button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['Anadir'] ?> </b></button>
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