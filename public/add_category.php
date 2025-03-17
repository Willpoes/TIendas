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
	
	$category = [];
	$category_id = "";
	$category_title = "";
	$category_image = "";

	$image_link = "";
	
	$category_type = "";
	$category_statu = "";


	if(!empty($_GET) && isset($_GET['category_id'])){
		$category_id = $_GET['category_id'];
		$category = find_category_by_id($category_id);
		$category_title = $category['title'];
		$category_image = $category['image_name'];
		$category_type = $category['types'];
		$category_statu = $category['status'];
		
		$category_tipo_tabla = $category['tipo_tabla'];

		// var_dump( $category_tipo_tabla );
	}
	$image_link = dir_category() . $category_image;
	
	if(empty($category)){
		$redirected_link = "insert_category.php";
		$btn_text = 'añadir';
	}else{
		$redirected_link = "update_category.php?category_id=". $category['id'];					
		$btn_text = 'actualizar';
	}

	$all_types = find_all_types();
	$all_status = find_all_status();
	
?>


<?php require("common/head.php"); ?>

<style>
	.add-product input[type='radio'] {
		display: inline-block;
		width: auto;
		height: auto;
	}	
</style>


<body>

<?php require("common/heading_menu.php"); ?>

	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
	
		<div class="main-contents">
			<div class="add-product">
				<?php if($error_msg != "") echo get_error_msg(); ?>

				<form action="<?php echo '../private/' . $redirected_link; ?>" method="POST" enctype="multipart/form-data">
				
					<input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
					<input type="hidden" name="category_img_name" value="<?php echo $category_image; ?>">

					
					<div class="img-uploader">
						<h5 class="upload-title"><?php echo $lang['UploadPhoto'] ?></h5>
						<img id="img-uploaded" src="<?php echo $image_link; ?>" alt="" />
						<div class="file-wrapper">
							<a href="#" class="upload-btn"></a>
							<input type="file" name="category_image" class="uploader">
						</div>
					</div><!-- img-uploader -->

					
					<select name="type">
						<option class="first" selected disabled hidden ><?php echo $lang['SeleccioneTipo'] ?></option>
						<?php 
							foreach($all_types as $type){ ?>
								<option value="<?php echo $type["id"]?>" <?php if($type["id"] == $category_type){
									echo " selected ";
								}
									?>><?php echo $type["title"]; ?></option>
							<?php } ?>
					</select>
					
					

						
					<input type="text" name="title" placeholder=" <?php echo $lang['Titulo'] ?>  <?php echo $lang['Categoria'] ?>" value="<?php echo $category_title; ?>">

					<p style="font-weight: 500;margin-top: .6em; background-color: yellow; padding: .3em .4em"><?php echo $lang['SeleccioneTablaCategoría'] ?></p>
					<label> <input <?= $category_tipo_tabla=='1'?'checked':''; ?>  <?php if( !isset($_GET['category_id']) ) echo 'checked'; ?> type="radio" name="tabla" value="1"> <?php echo $lang['Camisas'] ?> / <?php echo $lang['Blusas'] ?></label>
					<label> <input <?= $category_tipo_tabla=='2'?'checked':''; ?>  type="radio" name="tabla" value="2"> <?php echo $lang['Pantalon'] ?> / <?php echo $lang['Faldas'] ?></label>


					<select name="statu">
						<option class="first" selected disabled hidden ><?php echo $lang['SeleccioneEstado'] ?></option>
						<?php 
							foreach($all_status as $statu){ ?>
								<option value="<?php echo $statu["id"]?>" <?php if($statu["id"] == $category_statu){
									echo " selected ";
								}
									?>><?php echo $statu["title"]; ?></option>
							<?php } ?>
					</select>




					
					<button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['Anadir'] ?> <?php echo $lang['Categoria'] ?> </b></button>
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