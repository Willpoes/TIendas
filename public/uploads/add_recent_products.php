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
	
	$product = [];
	$product_id = "";
	$product_title = "";
	$product_category = "";
	$product_desc = "";
	$product_price = "";
	$purchase_price = "";
	$product_previous_price = "";
	$product_image = "";
	$image_link = "";
	
	$product_inventory = [];
	
	$product_upload = false;
	$product_images = []; 




	
	if(!empty($_GET) && isset($_GET['product_id'])){
		
		$product_id = $_GET['product_id'];
		
		$product = find_product_by_id($product_id);

		$product_title = $product['title'];
		$product_category = $product['category'];

		$product_desc = $product['description'];
		$purchase_price = $product['purchase_price'];
		$product_price = $product['price'];
		$product_previous_price = $product['previous_price'];
		$product_inventory = get_inventory_by_product_id($product_id);
		$product_images = get_images_by_product_id($product_id);
		$product_upload = true;


		$product_weight = $product['weight'];
		$product_longs = $product['longs'];
		$product_long_sleeve = $product['long_sleeve'];
		$product_back_width = $product['back_width'];
		$product_breast_contour = $product['breast_contour'];
		$product_waist = $product['waist'];
		$product_hip = $product['hip'];
		$product_statu = $product['status'];
		$product_brand = $product['brand'];

		$sww=1;


	}else{

		$sww=0;



			if (isset($_GET['description'])){
				$product_desc = $_GET['description'];
			}

			if (isset($_GET['title'])){
				$product_title = $_GET['title'];
			}


			if (isset($_GET['category'])){
				$product_category = $_GET['category'];
			}

			if (isset($_GET['purchase_price'])){
				$purchase_price = $_GET['purchase_price'];
			}

			if (isset($_GET['price'])){
				$product_price = $_GET['price'];
			}

			if (isset($_GET['previous_price'])){
				$product_previous_price = $_GET['previous_price'];
			}else{
				$product_previous_price = "";
			}



			if (isset($_GET['weight'])){
				$product_weight = $_GET['weight'];
			/*}else{
				$product_weight = "";*/
			}

			if (isset($_GET['longs'])){
				$product_longs = $_GET['longs'];
			}else{
				$product_longs = "";
			}


			if (isset($_GET['long_sleeve'])){
				$product_long_sleeve = $_GET['long_sleeve'];
			}else{
				$product_long_sleeve = "";
			}


			if (isset($_GET['back_width'])){
				$product_back_width = $_GET['back_width'];
			}else{
				$product_back_width = "";
			}



			if (isset($_GET['waist'])){
				$product_waist = $_GET['waist'];
			}else{
				$product_waist = "";
			}




			if (isset($_GET['breast_contour'])){
				$product_breast_contour = $_GET['breast_contour'];
			}else{
				$product_breast_contour = "";
			}



			if (isset($_GET['hip'])){
				$product_hip = $_GET['hip'];
			}else{
				$product_hip = "";
			}

			if (isset($_GET['statu'])){
				$product_statu = $_GET['statu'];
			}else{
				$product_statu = "";
			}



			  if (isset($_GET['brand'])){
				$product_brand = $_GET['brand'];
			}else{
				$product_brand = "";
			}



  



	}
	
	$image_link = dir_recent_product() . $product_image;
	
	if(empty($product)){
		$redirected_link = "insert-product.php";
		$btn_text = 'añadir';
	}else{
		$redirected_link = "update_product.php?product_id=". $product['id'];					
		$btn_text = 'actualizar';
	}
	
	$all_status = find_all_status();

	$all_categories = find_all_categories();
	$all_colors = find_all_colors();
	$all_sizes = find_all_sizes();

	if(empty($product_inventory)){
		$color_info["color_id"] = "1000000";
		$color_info["available_qty"] = "";
		$color_info["inventory_id"] = "100000000";
		$color_info["size_id"] = "1000000";
		array_push($product_inventory, $color_info);
		
	}


	echo '<script>';
	echo 'var all_colors = ' . json_encode($all_colors) . ';';
	echo 'var all_sizes = ' . json_encode($all_sizes) . ';';
	echo '</script>';


?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common/sidebar.php"); ?>

		<div class="main-contents">
		
			<div class="add-product">
				
				<?php if($error_msg != "") echo get_error_msg(); ?>
				
				<form action="<?php echo '../private/' . $redirected_link; ?>" id="myform" method="POST" enctype="multipart/form-data" onsubmit="return enviar();">
				
					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
					<input type="hidden" name="product_img_name" value="<?php echo $product_image; ?>">


<?php if ($sww==1){ ?>
						<input name="totimagen" type="hidden" id="totimagen" value="1">
						<button type="button" id="add_more" class="upload">
							<img class="add-icn" src="images/add.png">
							<h4 class="title"><b>Añadir imagen 

							<?//=$product_desc?></b></h4>
						</button>

<?php } ?>


			<?php 
				if($product_upload){
					$i =1;
					foreach($product_images as $img){ 
						$idpx=$img["id"];
						?>
					
					<div id="filediv" class="abcdx<?php echo $idpx; ?>">
					<div id="abcd<?php echo $idpx; ?>" class="abcd update">
					<img id="img" src="../public/images/close.png" onclick="ver_prod(<?=$idpx?>)" alt="delete">
					<img id="previewimg<?php echo $i; ?>"    src="uploads/recent-products/<?php echo $img["image_name"]; ?>" style="height:130px;width: 130px;">
					</div>
					</div>
						
				<?php 	$i ++;
					}
				}else{ ?>
						
				<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">
				<input data-validation="false" name="file[]" type="file" id="file"/>
				</div>

				<!--<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">
				<input name="file[]" type="file" id="file"><br><br>
				</div>

				<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">
				<input name="file[]" type="file" id="file"><br><br>
				</div>

				<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">
				<input name="file[]" type="file" id="file"><br><br>
				</div>
-->

						<input name="totimagen" type="hidden" id="totimagen" value="1">

						<?php if ($sww==0){ ?>

								<button type="button" id="add_more" class="upload">
									<img class="add-icn" src="images/add.png">
									<h4 class="title"><b>Añadir imagen 

									<?//=$product_desc?></b></h4>
								</button>
						<?php } ?>
<?php 	} ?>


<?php if ($sww==0){
	?>
		<!--	<input type="hidden" name="statu" value="1">-->




	<select name="statu" id="statu">
			<option class="first" selected disabled hidden >Porfavor seleccione un Estado <?=$product_statu;?></option>
			<?php 
			foreach($all_status as $statu){ ?>
			<option value="<?php echo $statu["id"]?>" <?php if($statu["id"] == $product_statu){
			echo " selected ";
			}
			?>><?php echo $statu["title"]; ?></option>
			<?php } ?>
			</select>


	<?php 

	}else{


		?>

			<select name="statu" id="statu">
			<option class="first" selected disabled hidden >Porfavor seleccione un Estado <?=$product_statu;?></option>
			<?php 
			foreach($all_status as $statu){ ?>
			<option value="<?php echo $statu["id"]?>" <?php if($statu["id"] == $product_statu){
			echo " selected ";
			}
			?>><?php echo $statu["title"]; ?></option>
			<?php } ?>
			</select>



		<?php 
		} ?>
					




					
				

		<select name="category"  id="category">
			<option class="first" selected disabled hidden >Porfavor seleccione una categoría</option>
			<?php 
			foreach($all_categories as $category){ ?>

				<option value="<?php echo $category["id"]?>" <?php if($category["id"] == $product_category){
					echo " selected ";
				}
					?>>  <?php $types= find_type_by_id($category["types"]);

							echo $types["title"];

					 ?> >  <?php echo $category["title"]; ?>   
				</option>
			<?php } ?>
		</select>


				<div class="input-wrap-new">
					<span class="titulos-input">Titulo del producto</span>
					<input type="text" name="title" id="title" placeholder="Titulo del producto" value="<?php echo $product_title; ?>">
				</div>

					


						
					

					<div class="input-wrap-new">
						<span class="titulos-input">Marca</span>
						<input type="text" name="brand" id="brand" placeholder="Marca" value="<?php echo $product_brand; ?>">
					</div>

					
					<textarea name="description" id="description" placeholder="Descripción del producto" rows="4" cols="50"><?php echo $product_desc; ?></textarea>

					<div class="input-wrap">
						<span class="pre-input"><?php echo get_currency(); ?></span>
						<input type="number" name="purchase_price"  id="purchase_price"  placeholder="Precio de compra" value="<?php echo $purchase_price; ?>">
					</div>

					<div class="input-wrap">
						<span class="pre-input"><?php echo get_currency(); ?></span>
						<input type="number" name="price"  id="price"  placeholder="Precio Oferta" value="<?php echo $product_price; ?>">
					</div>

					<div class="input-wrap">
						<span class="pre-input"><?php echo get_currency(); ?></span>
						<?php if($product_previous_price == 0){
							$product_previous_price = "";
						}?>
						<input type="number" name="previous_price" id="previous_price"  placeholder="Precio Normal" value="<?php echo $product_previous_price; ?>">
					</div>

					<div class="inventory-wrapper">
						<h5 class="inventory-title">Inventario de productos</h5>
						<?php if(!$product_upload)
							echo '<h6 class="btn-container"><a class="add-color-qty" href="#"><span>+</span> Añadir más color</a></h6>';
						?>
					</div>

					<div class="product-color-qty-container">

						<div class="product-color-qty">
							<?php foreach($product_inventory as $single_inventory){ ?>

								<div class="product-color-left">
									<div class="product-color-left-inner">
										<select name="sizes[]" class="color-dropdown">
											<option class="first" selected disabled hidden >Seleccionar talla</option>

											<?php foreach($all_sizes as $size){ ?>
												<option value="<?php echo $size["size_id"];?>" <?php if($size["size_id"] == $single_inventory["size_id"]){
													echo " selected ";
												}
												?>><?php echo $size["size_name"]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="product-color-middle">
									<div class="product-color-middle-inner">
										<select name="colors[]" class="color-dropdown">
											<option class="first" selected disabled hidden >Elija un color</option>

											<?php foreach($all_colors as $color){ ?>
												<option value="<?php echo $color["color_id"];?>" <?php if($color["color_id"] == $single_inventory["color_id"]){
													echo " selected ";
												}
												?>><?php echo $color["color_name"]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<input type="hidden" name="inventory_id[]" value="<?php echo $single_inventory["inventory_id"]; ?>">

								<div class="product-color-right">
									<div class="product-color-right-inner">
										<input class="product-qty" type="text" name="available_qty[]" placeholder="Cantidad" value="<?php echo $single_inventory["available_qty"]; ?>">
									</div>
								</div>

							<?php } ?>
						</div><!-- product-color-qty -->
					</div><!-- product-color-qty-container -->

<!---->
<!---->

<div class="input-wrap-new">
	<span class="titulos-input">Peso</span>
	<input type="number" name="weight" id="peso" placeholder="Peso del producto" value="<?php echo $product_weight; ?>">
</div>

<!-- <div class="input-wrap-new">
	<span class="titulos-input">Ancho de Espalda</span>
	<input type="number" name="back_width" placeholder="Ancho de Espalda" value="<?php echo $product_back_width;?>">
</div>

<div class="input-wrap-new">
	<span class="titulos-input">Largo del producto</span>
	<input type="number" name="longs" placeholder="Largo del producto" value="<?php echo $product_longs; ?>">
</div>


<div class="input-wrap-new">
	<span class="titulos-input">Largo del producto</span>
	<input type="number" name="long_sleeve" placeholder="Largo de manga" value="<?php echo $product_long_sleeve;?>">
</div>

<div class="input-wrap-new">
	<span class="titulos-input">Contorno de Pecho</span>
	<input type="number" name="breast_contour" placeholder="Contorno de Pecho" value="<?php echo $product_breast_contour; ?>">
</div> -->

<div class="input-wrap-new">
	<span class="titulos-input">Adjuntar Foto tallas</span>
	<input type="file" name="fotos_talla" id="fotos_talla" required style="bottom: auto;">
	<p><i class="far fa-images"></i> Sube el formato</p>
</div>



<input type="hidden" name="waist" placeholder="Cintura" value="<?php echo $product_waist; ?>">

<input type="hidden" name="hip" placeholder="Cadera" value="<?php echo $product_hip; ?>">


<button class="mt-20 btn submit-btn" name="submit" type="submit" ><b><?php echo $btn_text; ?> </b></button>

				</form>

			</div><!-- add-product -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>

<script>

	function ver_prod(id){

		//var mensaje=$("#mensaje"+id).val();

		$.ajax({
		type: "POST",
		url: "common/page.php?pagina=elimnar_image_products",
		data: "id="+id, 
		dataType: "html",
          success: function(datos) {

          	var data=datos.trim();
			    //alert(data);
				$(".abcdx"+id).html("");
				$(".abcdx"+id).css("display","none");
				//$("#mensaje_fact").html(mensaje);
				
				var totimagen=$("#totimagen").val();

				totimagenx=parseFloat(totimagen)

				totimagenx=totimagenx-1;

				$("#totimagen").val(totimagenx);


			}
		});
	}


function submitform(){
      	alert("Formulario enviado desde Java Script");
      	document.getElementById('form').submit();
      }





function enviar() {
	var formulario = document.getElementById("myform");

	//var statu = document.getElementById("statu");
	//var title = document.getElementById("title");
	//var peso = document.getElementById("peso");

	var statu =$("#statu").val();
	var category =$("#category").val();
	var title =$("#title").val();
	var brand =$("#brand").val();
	var description =$("#description").val();
	var peso =$("#peso").val();


	var fotos_talla = $("#fotos_talla").val();

	console.log(fotos_talla);

 //   alert(statu);

  //  var dato = formulario['statu'];
 //alert(dato);
if ((statu=="")|| (statu == null)){

	alert("Seleccionar Estado");
	$("#statu").focus();
	return false;

}else if  ((category=="")|| (category == null)) {
	alert("Seleccionar Categoria");
	return false;

}else if  ((title=="")|| (title == null)) {
	alert("Ingresar Titulo del producto");
	return false;

}else if  ((brand=="")|| (brand == null)) {
	alert("Ingresar marca");
	return false;

}else if  ((description=="")|| (description == null)) {
	alert("Ingresar descripcion");
	return false;


}else if ((peso=="")|| (peso == null)){

	alert("Ingresare el peso");
	return false;

}else{

	document.getElementById('myform').submit();
	//formulario.submit();
    return true;
}



}



</script>

</body>
</html>