<?php require_once('../private/init.php');
include "../configuration.php"; ?>
<?php

$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";

$admin_id = "";
$username = "";
$admin_info = logged_in();

// var_dump( $admin_info );
if (!empty($admin_info)) {
	$admin_id = $admin_info[0];
	$username = $admin_info[1];
} else {
	redirect_to_login();
}

// busco data del user (vendedor)
$user = find_user_by_id($admin_id);

$correo = trim($user['email']);
// var_dump( $user['email'] );

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


$id_color="";


if (!empty($_GET) && isset($_GET['product_id']) && $_GET['product_id']!=="") {
	
	$product_id = $_GET['product_id'];

	$product = find_product_by_id($product_id);

	$product_title = $product['title'];
	$product_category = $product['category'];

	$product_desc = $product['description'];
	$purchase_price = $product['purchase_price'];
	$product_price = $product['purchase_price'];
	$product_previous_price = $product['previous_price'];
	$product_inventory = get_inventory_by_product_id($product_id);
	$product_images = get_images_by_product_id($product_id);
	$product_colors=get_color_producto_id($product_id);
	$color_name=$product_colors['color_name'];
	$id_color=$product_colors['color_id'];
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

	// New
	$product_keydowrds = $product['palabras_claves'];

	$sww = 1;
} else {
	
	$sww = 0;



	if (isset($_GET['description'])) {
		$product_desc = $_GET['description'];
	}

	if (isset($_GET['title'])) {
		$product_title = $_GET['title'];
	}


	if (isset($_GET['category'])) {
		$product_category = $_GET['category'];
	}

	if (isset($_GET['purchase_price'])) {
		$purchase_price = $_GET['purchase_price'];
	}

	if (isset($_GET['price'])) {
		$product_price = $_GET['price'];
	}

	if (isset($_GET['previous_price'])) {
		$product_previous_price = $_GET['previous_price'];
	} else {
		$product_previous_price = "";
	}



	if (isset($_GET['weight'])) {
		$product_weight = $_GET['weight'];
		/*}else{
				$product_weight = "";*/
	}

	if (isset($_GET['longs'])) {
		$product_longs = $_GET['longs'];
	} else {
		$product_longs = "";
	}


	if (isset($_GET['long_sleeve'])) {
		$product_long_sleeve = $_GET['long_sleeve'];
	} else {
		$product_long_sleeve = "";
	}


	if (isset($_GET['back_width'])) {
		$product_back_width = $_GET['back_width'];
	} else {
		$product_back_width = "";
	}



	if (isset($_GET['waist'])) {
		$product_waist = $_GET['waist'];
	} else {
		$product_waist = "";
	}




	if (isset($_GET['breast_contour'])) {
		$product_breast_contour = $_GET['breast_contour'];
	} else {
		$product_breast_contour = "";
	}



	if (isset($_GET['hip'])) {
		$product_hip = $_GET['hip'];
	} else {
		$product_hip = "";
	}

	if (isset($_GET['statu'])) {
		$product_statu = $_GET['statu'];
	} else {
		$product_statu = "";
	}



	if (isset($_GET['brand'])) {
		$product_brand = $_GET['brand'];
	} else {
		$product_brand = "";
	}
}

 $image_link = dir_recent_product() . $product_image;
$redirec_stock="";
if (empty($product)) {
	$redirected_link = "insert-product.php";
	$btn_text = 'PUBLICAR';
} else {
	$redirected_link = "update_product.php?product_id=" . $product['id'];
	$btn_text = 'actualizar';
	$redirec_stock="update_produc_stock.php?product_id=".$product['id'];
}

$all_status = find_all_status();
$all_types = find_all_types();

$all_categories = find_all_categories();

$all_colors = find_all_colors();

$all_sizes = find_all_sizes();
if (empty($product_inventory)) {
	$color_info["color_id"] = "1000000";
	$color_info["available_qty"] = "";
	$color_info["inventory_id"] = "100000000";
	$color_info["size_id"] = "1000000";
	$color_info['size_name']="Seleccione Talla";
	array_push($product_inventory, $color_info);
}


echo '<script>';
echo 'var all_colors = ' . json_encode($all_colors) . ';';
echo 'var all_sizes = ' . json_encode($all_sizes) . ';';

echo 'var valida_correo = "' . $correo . '";';
echo 'var user_idx = "' . $admin_id . '";';
echo '</script>';


?>

<?php require("common_update/head.php"); ?>

<!-- <link rel="stylesheet" href="common/colorPick.css">
<link rel="stylesheet" href="common/colorPick.dark.theme.css"> -->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<link href="./tag-basic-style.css" rel="stylesheet">

<style>
	.ui-selectmenu-button.ui-button {
		width: 100%;
	}

	.ui-widget.ui-widget-content {
		overflow-y: scroll;
		height: 12em;
	}

	.color-pick {
		width: 36px;
		height: 36px;
		background: yellow;
	}


	.ui-selectmenu-menu .ui-menu.customicons .ui-menu-item-wrapper {
		padding: 0.5em 0 0.5em 3em;
	}

	.ui-selectmenu-menu .ui-menu.customicons .ui-menu-item .ui-icon {
		height: 24px;
		width: 24px;
		top: 0.1em;
	}

	.ui-icon,
	.ui-widget-content .ui-icon {
		/*background: none !important;*/
	}

	li.ui-menu-item {
		display: block;
	}

	.ui-selectmenu-button {
		margin-top: 25px;
	}

	/* select with CSS avatar icons */
	option.avatar {
		background-repeat: no-repeat !important;
		padding-left: 20px;
	}

	.avatar .ui-icon {
		background-position: left top;
		background-image: none !important;
	}

	/*Plugin jQuery - colorPick */
	.product-color-qty {
		margin-bottom: 20px;
	}

	/* .product-color-qty, .product-color-qty-container {
  	overflow: visible !important;
  }
  .colorPickSelector {
  border-radius: 5px;
  width: 36px;
  height: 36px;
  margin-top: 15px;
  margin-left: 15px;
  cursor: pointer;
  -webkit-transition: all linear .2s;
  -moz-transition: all linear .2s;
  -ms-transition: all linear .2s;
  -o-transition: all linear .2s;
  transition: all linear .2s;
}*/

	/*#peso, #w_peso {
	z-index: 0;
}*/
	/*#w_peso{
	margin-top: 10px;
}
.input-wrap-new .titulos-input {
	top: 63px;
}*/
	/*.colorPickSelector:hover { transform: scale(1.1); }*/

	/*=========*/

	.rn-img-placeholder {
		position: absolute;
		text-align: center;
		color: #999;
		top: 25px;
		left: 50%;
		transform: translate(-50%);
		font-size: 1em;
		z-index: 5;
	}

	.add-product .abcd {
		position: absolute;
		z-index: 20;
	}

	/*Tabla dinamica por categoria */
	.table-dinamyc {
		border-collapse: collapse;
		margin-top: 15px;

	}

	.table-dinamyc th {
		background: #333;
		color: white;
	}

	.table-dinamyc td,
	.table-dinamyc th {
		border: 1px solid #555;
		padding: 2px 5px;
		text-align: center;
	}

	.table-dinamyc input {
		padding-left: 10px;
		margin-top: 2px;
	}
</style>
<link rel="stylesheet" type="text/css" href="./plugin-frameworks/dropify/dropify.min.css">

<body>

	<?php require("common_update/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common_update/sidebar.php"); ?>

		<div class="main-contents">

			<div class="add-product" style="max-width: 720px;">

				<?php if ($error_msg != "") echo get_error_msg(); ?>

				<form action="<?php echo '../private/' . $redirected_link; ?>" id="myform" method="POST" enctype="multipart/form-data" onsubmit="return enviar();">

					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
					<input type="hidden" name="product_img_name" value="<?php echo $product_image; ?>">


					<?php if ($sww == 1) { ?>
						<input name="totimagen" type="hidden" id="totimagen" value="1">
						<!--++ <button type="button" id="add_more" class="upload">
							<img class="add-icn" src="images/add.png">
							<h4 class="title"><b>Añadir imagen 

							<? //=$product_desc
							?></b></h4>
						</button> -->

					<?php } ?>


					<?php
					if ($product_upload) {
					    ?>
					    <div class="container_fluid">
                                <div class="row">
					    <?php
						$i = 1;
						foreach ($product_images as $img) {
							$idpx = $img["id"];
					?>

							
							<div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12 mb-2">
                                            <input name="id_imagen[]" type="hidden" value="<?php echo $idpx;?>">
                                            <div class="upload">
                                                <input type="file" id="input-file-max-fs" name="file[]" class="dropify" accept="image/*" data-default-file="uploads/recent-products/<?php echo $img["image_name"]; ?>" data-max-file-size="2M" />
                                            </div>  
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12" >
                                          <select name="color_img[]" id="color_img<?php echo $i;?>"  class="form-control" style="width:130px;" >
                                            <option value="">Color</option>
                                            <?php foreach ($all_colors as $color) { ?>
            									<option value="<?php if (isset($color["color_id"])) {
            									echo $color["color_id"];
            									}   
            									
            									?>" 
            									<?php
            									if($color["color_id"]==$img['color_id']){
            									    echo "selected";
            									}
            									?>
            									
            									
            									 ><?php echo $color["color_name"]; ?></option>
            								<?php } ?>
                                        </select>  
                                        </div>
                                    </div>
                                      
                                </div>
                                

						<?php $i++;
						}
						?>
						    </div>
                        </div>
						<?php
					} else { ?>
                        <div class="container_fluid">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12 mb-2">
                                            <div class="upload">
                                                <input type="file" id="input-file-max-fs" name="file[]" class="dropify" accept="image/*" data-default-file="" data-max-file-size="2M" />
                                            </div> 
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12" >
                                          <select name="color_img[]" id="color_img1" class="form-control" style="width:130px;" required >
                                            <option value="">Color</option>
                                            <?php foreach ($all_colors as $color) { ?>
            									<option value="<?php if (isset($color["color_id"])) {
            									echo $color["color_id"];
            									}   
            									
            									?>" 
            									<?php
            									if($color["color_id"]==$id_color){
            									    echo "selected";
            									}
            									?>
            									
            									
            									 ><?php echo $color["color_name"]; ?></option>
            								<?php } ?>
                                        </select>  
                                        </div>
                                    </div>
                                      
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12 mb-2">
                                            <div class="upload">
                                                <input type="file" id="input-file-max-fs" name="file[]" class="dropify" accept="image/*" data-default-file="" data-max-file-size="2M" />
                                            </div>  
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12" >
                                          <select name="color_img[]" id="color_img2" class="form-control" style="width:130px;" >
                                            <option value="">Color</option>
                                            <?php foreach ($all_colors as $color) { ?>
            									<option value="<?php if (isset($color["color_id"])) {
            									echo $color["color_id"];
            									}   
            									
            									?>" 
            									<?php
            									if($color["color_id"]==$id_color){
            									    echo "selected";
            									}
            									?>
            									
            									
            									 ><?php echo $color["color_name"]; ?></option>
            								<?php } ?>
                                        </select>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12 mb-2">
                                            <div class="upload">
                                                <input type="file" id="input-file-max-fs" name="file[]" class="dropify" accept="image/*" data-default-file="" data-max-file-size="2M" />
                                            </div>  
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12" >
                                          <select name="color_img[]" id="color_img3" class="form-control" style="width:130px;" >
                                            <option value="">Color</option>
                                            <?php foreach ($all_colors as $color) { ?>
            									<option value="<?php if (isset($color["color_id"])) {
            									echo $color["color_id"];
            									}   
            								// 		$color_name=$product_colors['color_name'];
                    //                             	$id_color=$product_colors['color_id'];
            									
            									?>" 
            									<?php
            									if($color["color_id"]==$id_color){
            									    echo "selected";
            									}
            									?>
            									
            									
            									 ><?php echo $color["color_name"]; ?></option>
            								<?php } ?>
                                        </select>  
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12 mb-2">
                                            <div class="upload">
                                                <input type="file" id="input-file-max-fs" name="file[]" class="dropify" accept="image/*" data-default-file="" data-max-file-size="2M" />
                                            </div>  
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-12 col-lg-12" >
                                          <select name="color_img[]" id="color_img4" class="form-control" style="width:130px;" >
                                            <option value="">Color</option>
                                            <?php foreach ($all_colors as $color) { ?>
            									<option value="<?php if (isset($color["color_id"])) {
            									echo $color["color_id"];
            									}   
            									
            									?>" 
            									<?php
            									if($color["color_id"]==$id_color){
            									    echo "selected";
            									}
            									?>
            									
            									
            									 ><?php echo $color["color_name"]; ?></option>
            								<?php } ?>
                                        </select>  
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
						<!--<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">-->
						<!--	<p class="rn-img-placeholder">Foto <br> Frente</p>-->
						<!--	<input data-validation="false" name="file[]" type="file" id="file" />-->
						<!--	<select name="color_img[]" class="form-control" required>-->
      <!--                          <option value="">Seleccione Color</option>-->
      <!--                          <option value="honda">Honda</option>-->
      <!--                          <option value="ford">Ford</option>-->
      <!--                      </select>-->
						<!--</div>-->

						<!-- New Changes - 09.11.2020 -->
						<!--<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">-->
						<!--	<p class="rn-img-placeholder">Foto <br> Espalda</p>-->
						<!--	<input data-validation="false" name="file[]" type="file" id="file" />-->
						<!--	<select name="color_img[]" class="form-control" required>-->
      <!--                          <option value="">Seleccione Color</option>-->
      <!--                          <option value="honda">Honda</option>-->
      <!--                          <option value="ford">Ford</option>-->
      <!--                      </select>-->
						<!--</div>-->

						<!--<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">-->
						<!--	<p class="rn-img-placeholder">Foto <br> Costado</p>-->
						<!--	<input data-validation="false" name="file[]" type="file" id="file" />-->
						<!--	<select name="color_img[]" class="form-control" required>-->
      <!--                          <option value="">Seleccione Color</option>-->
      <!--                          <option value="honda">Honda</option>-->
      <!--                          <option value="ford">Ford</option>-->
      <!--                      </select>-->
						<!--</div>-->

						<!--<div id="filediv" style="height:130px;width:130px;background-image: url('images/no-image.jpg');">-->
						<!--	<p class="rn-img-placeholder">Foto <br> Adicional</p>-->
						<!--	<input data-validation="false" name="file[]" type="file" id="file" />-->
						<!--	<select name="color_img[]" class="form-control" required>-->
      <!--                          <option value="">Seleccione Color</option>-->
      <!--                          <option value="honda">Honda</option>-->
      <!--                          <option value="ford">Ford</option>-->
      <!--                      </select>-->
						<!--</div>-->

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

						<?php if ($sww == 0) { ?>



							<!--++ <button type="button" id="add_more" class="upload">
									<img class="add-icn" src="images/add.png">
									<h4 class="title"><b>Añadir imagen 

									<? //=$product_desc
									?></b></h4>
								</button> -->
						<?php } ?>
					<?php 	} ?>


					<?php if ($sww == 0) {
					?>
						<!--	<input type="hidden" name="statu" value="1">-->




						<select name="statu" id="statu">
							<option class="first" selected disabled hidden>Porfavor seleccione un Estado <?= $product_statu; ?></option>
							<?php
							foreach ($all_status as $statu) { ?>
								<option value="<?php echo $statu["id"] ?>" <?= ($statu["id"] == '1' ? 'selected' : '') ?> <?php if ($statu["id"] == $product_statu) {
																																echo " selected ";
																															}
																															?>><?php echo $statu["title"]; ?></option>
							<?php } ?>
						</select>


					<?php

					} else {


					?>

						<select name="statu" id="statu">
							<option class="first" selected disabled hidden>Porfavor seleccione un Estado <?= $product_statu; ?></option>
							<?php
							foreach ($all_status as $statu) { ?>
								<option value="<?php echo $statu["id"] ?>" <?php if ($statu["id"] == $product_statu) {
																				echo " selected ";
																			}
																			?>><?php echo $statu["title"]; ?></option>
							<?php } ?>
						</select>



					<?php
					} ?>








					<select name="category" id="category">
						<option class="first" selected disabled hidden>Porfavor seleccione una categoría</option>
    					<?php
    					foreach($all_types as $type){
    					    $id_type=$type['id'];
    					    $title_type=$type['title'];
    					    ?>
    					    <optgroup label="<?php echo $title_type;?>">
    					        <?php
						        $categoria_id_type=get_categoria_id_type($id_type);
						        foreach ($categoria_id_type as $category) { ?>

							    <option value="<?php echo $category["id"] ?>" <?php if ($category["id"] == $product_category) {
																				echo " selected ";
																			}
																			?>> <?php $types = find_type_by_id($category["types"]);

																				echo $types["title"];

																				?> > <?php echo $category["title"]; ?>
							</option>
						    <?php } ?>
                            </optgroup>
                            <?php
    					}
    					?>
						
					</select>


					<div class="input-wrap-new">
						<span class="titulos-input">Titulo del producto</span>
						<input type="text" name="title" id="title" placeholder="Nombre de la Ropa. Ejem: Ropa 123" value="<?php echo $product_title; ?>">
					</div>


					<div class="input-wrap-new">
						<span class="titulos-input">Marca</span>
						<input type="text" name="brand" id="brand" placeholder="Marca de la Ropa" value="<?php echo $product_brand; ?>">
					</div>

					<!--Campo Nuevo para Keywords-->
					<div style="margin: 10px 0">Palabras claves</div>
					<div class="input-wrap-new">
						<!--<span class="titulos-input">Palabras claves</span>-->
						<!--<input type="text" name="brand" id="brand" placeholder="Marca de la Ropa" value="<?php echo $product_brand; ?>">-->
						<div data-tags-input-name="tag" id="tagBox"></div>

						<?
						// 		$product_keydowrds = split(',', $product_keydowrds);

						// 		foreach($product_keydowrds as $keyword) {

						// 		}
						?>
					</div>

                    <div class="input-wrap">
                        <span class="titulos-input">Descripción</span>
					<textarea name="description" id="description" placeholder="Hermosa Prenda y ligera para este verano" rows="4" cols="50">

<?php echo $product_desc; ?></textarea>
                    </div>
					<div class="input-wrap" style="display: none;">
						<span class="pre-input"><?php echo get_currency(); ?></span>
						<input type="number" name="purchase_price" id="purchase_price" placeholder="Precio de compra" value="<?php echo $purchase_price; ?>">
					</div>

					<div class="input-wrap">
						<span class="pre-input"><?php echo get_currency(); ?></span>
						<input type="number" name="price" id="price" placeholder="Precio" value="<?php echo $product_price; ?>">
					</div>

					<div class="input-wrap" style="display: none;">
						<span class="pre-input"><?php echo get_currency(); ?></span>
						<?php if ($product_previous_price == 0) {
							$product_previous_price = "";
						} ?>
						<input type="number" name="previous_price" id="previous_price" placeholder="Precio Normal" value="<?php echo $product_previous_price; ?>">
					</div>

					<!---->
					<!---->

					<div class="input-wrap-new" id="w_peso">
						<span class="titulos-input">Peso</span>
						<input type="number" name="weight" id="peso" placeholder="Peso del producto (Gramos)" value="<?php echo $product_weight; ?>" list="pesos" required>
						<datalist id="pesos">
							<option value="100">
							<option value="200">
							<option value="300">
							<option value="400">
							<option value="500">
							<option value="600">
							<option value="700">
							<option value="800">
							<option value="900">
							<option value="1000">
							<option value="1100">
							<option value="1200">
							<option value="1300">
							<option value="1400">
							<option value="1500">
						</datalist>
					</div>

					<!-- <div class="input-wrap-new">
	<span class="titulos-input">Ancho de Espalda</span>
	<input type="number" name="back_width" placeholder="Ancho de Espalda" value="<?php echo $product_back_width; ?>">
</div>

<div class="input-wrap-new">
	<span class="titulos-input">Largo del producto</span>
	<input type="number" name="longs" placeholder="Largo del producto" value="<?php echo $product_longs; ?>">
</div>


<div class="input-wrap-new">
	<span class="titulos-input">Largo del producto</span>
	<input type="number" name="long_sleeve" placeholder="Largo de manga" value="<?php echo $product_long_sleeve; ?>">
</div>

<div class="input-wrap-new">
	<span class="titulos-input">Contorno de Pecho</span>
	<input type="number" name="breast_contour" placeholder="Contorno de Pecho" value="<?php echo $product_breast_contour; ?>">
</div> -->

					<!-- <div class="input-wrap-new">
	<span class="titulos-input" style="bottom: auto;">Adjuntar Foto tallas</span>
	<input type="file" name="fotos_talla" id="fotos_talla" required >
	<p style="font-size: 1em;"><i class="far fa-file-excel"></i> Descargue el formato para <a class="add-color-qty" style="text-decoration: underline;" href="uploads/TALLAS-PANTALONES.xlsx">Pantalones</a> y <a style="text-decoration: underline;" class="add-color-qty" href="uploads/TALLAS-PRENDAS.xlsx">Camisas</a></p>
</div> -->

					<!-- ================ -->
					<!-- Tabla dinamica  -->

					<!-- MEDIDA DE LA "CAMISA / BLUSCA" -->
					<!-- <section id="all-tabla">
	
</section> -->

					<div class="table-dinamyc" id="medida-camisa-blusa" class="medida-camisa" style="display: none;">
						<table>
							<thead>
								<tr>
									<th width="20%">TALLA</th>
									<th>LARGO DE LA “CAMISA” DE FRENTE</th>
									<th>CONTORNO DEL PECHO</th>
									<th>LARGO DE LA MANGA</th>
								</tr>
							</thead>
							<tbody>
								<tr class="fila-talla-camisa">
									<td class="talla_camisa" id="talla_camisa"></td>
									<td>
										<input type="text" class="camisax" id="camisax" placeholder="ESCRBIR LA MEDIDA" autocomplete="off">
									</td>
									<td>
										<input type="text" class="camisay" id="camisay" placeholder="ESCRBIR LA MEDIDA" autocomplete="off">
									</td>
									<td>
										<input type="text" class="camisaz" id="camisaz" placeholder="ESCRBIR LA MEDIDA" autocomplete="off">
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- /.input-wrap-new -->

					<!-- MEDIDA DE LA "PANTALON / BUZO / BERMUDAS" -->
					<div class="table-dinamyc" id="medida-pantalon-buuzo" class="medida-pantalon" style="display: none;">
						<table>
							<thead>
								<tr>
									<th width="20%">TALLA</th>
									<th>LARGO DE "PANTALON"</th>
									<th>CONTORNO CINTURA</th>

								</tr>
							</thead>
							<tbody>
								<tr class="fila-talla-pantalon">
									<td class="talla_pantalon" id="talla_pantalon"></td>
									<td>
										<input type="text" class="pantalonx" name="pantalonx" placeholder="ESCRBIR LA MEDIDA">
									</td>
									<td>
										<input type="text" class="pantalony" name="pantalony" placeholder="ESCRBIR LA MEDIDA">
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- /.input-wrap-new -->



					<!--ZAPATOS ,  SANDALIAS  , ZAPATILLAS  , BOTAS , MOCASIN , SOMBRERO -->
					<div class="table-dinamyc" id="medida-zapatos" class="medida-zapatos" style="display: none;">
						<table>
							<thead>
								<tr>
									<th width="20%">TALLA</th>
									<th>LARGO</th>
									<th>ANCHO</th>

								</tr>
							</thead>
							<tbody>
								<tr class="fila-talla-pantalon">
									<td class="talla_zapatos" id="talla_zapatos"></td>
									<td>
										<input type="text" class="zapatosx" name="zapatosx" placeholder="ESCRBIR LA MEDIDA">
									</td>
									<td>
										<input type="text" class="zapatosy" name="zapatosy" placeholder="ESCRBIR LA MEDIDA">
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- /.input-wrap-new -->

					<!--MOCHILLA , MALETIN , BOLSA , CARTERA  , CANGURO , MORRAL , CELULAR  -->
					<div class="table-dinamyc" id="medida-mochilas" class="medida-mochilas" style="display: none;">
						<table>
							<thead>
								<tr>
									<th width="20%">TALLA / TAMAÑO</th>
									<th>LARGO</th>
									<th>ANCHO</th>

								</tr>
							</thead>
							<tbody>
								<tr class="fila-talla-pantalon">
									<td id="talla_zapatos"></td>
									<td>
										<input type="text" name="mochilasx" placeholder="ESCRBIR LA MEDIDA">
									</td>
									<td>
										<input type="text" name="mochilasy" placeholder="ESCRBIR LA MEDIDA">
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- /.input-wrap-new -->

                    




					<input type="hidden" name="waist" placeholder="Cintura" value="<?php echo $product_waist; ?>">

					<input type="hidden" name="hip" placeholder="Cadera" value="<?php echo $product_hip; ?>">
					
					 <!--<input type="hidden" name="sizes" value=""> -->
					<input type="hidden" class="xmedida"  name="medidasX" id="" value="">
					<input type="hidden" name="medidasY" value="">
					<input type="hidden" name="medidasZ" value="">
					<button class="mt-20 btn submit-btn bt_talla" type="button" style="display: none" onclick="carga()">Cargar tallas</button>
					<button class="mt-20 btn submit-btn sub_envio" name="submit"  type="submit"><b><?php echo $btn_text; ?> </b></button>
					<?php
					if(!empty($_GET) && isset($_GET['product_id']) && $_GET['product_id']!==""){
					    ?>
					    <a href="./<?php echo $redirec_stock;?>" class="mt-20 btn btn-success"><b>Editar Tallas y Stock</b></a>
					    <?php
					}
					?>
                    
				</form>

			</div><!-- add-product -->
		</div><!-- main-content -->
	</section>
	<!--main-body -->


	<!-- jQuery library -->
	<!-- <script src="plugin-frameworks/jquery-3.2.1.min.js"></script> -->
<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>
  
            <script>
                function enviar() {
    		    
    		
    			var formulario = document.getElementById("myform");
    		
    			//var statu = document.getElementById("statu");
    			//var title = document.getElementById("title");
    			//var peso = document.getElementById("peso");
    
    			var statu = $("#statu").val();
    			var category = $("#category").val();
    			var title = $("#title").val();
    			var brand = $("#brand").val();
    			var description = $("#description").val();
    			var peso = $("#peso").val();
    			if (document.querySelector("#color_img1") !== null) {
                    var img_1=$("#color_img1").val();
                }else{
                    var img_1="";
                }
                if (document.querySelector("#color_img2") !== null) {
                    var img_2=$("#color_img2").val();
                }else{
                    var img_2="";
                }
                if (document.querySelector("#color_img3") !== null) {
                    var img_3=$("#color_img3").val();
                }else{
                    var img_3="";
                }
                if (document.querySelector("#color_img4") !== null) {
                    var img_4=$("#color_img4").val();
                }else{
                    var img_4="";
                }
                
                if(img_1==img_2 && img_1!=="" && img_2!==""){
                  alert("El color de imagen no debe repetirse");
    				$("#color_img1").focus();
    				return false;  
                }
                if(img_1==img_3 && img_1!=="" && img_3!==""){
                  alert("El color de imagen no debe repetirse");
    				$("#color_img1").focus();
    				return false;  
                }
                if(img_1==img_4 && img_1!=="" && img_4!==""){
                  alert("El color de imagen no debe repetirse");
    				$("#color_img1").focus();
    				return false;  
                }
                if(img_3==img_2 && img_2!=="" && img_3!==""){
                  alert("El color de imagen no debe repetirse");
    				$("#color_img2").focus();
    				return false;  
                }
                if(img_4==img_2 && img_4!=="" && img_2!==""){
                  alert("El color de imagen no debe repetirse");
    				$("#color_img2").focus();
    				return false;  
                }
                if(img_4==img_3 && img_4!=="" && img_3!==""){
                  alert("El color de imagen no debe repetirse");
    				$("#color_img3").focus();
    				return false;  
                }
                
    			var fotos_talla = $("#fotos_talla").val();
    
    			var valor_cate = $("#category").val();
    
    			
    
    			if ((statu == "") || (statu == null)) {
    
    				alert("Seleccionar Estado");
    				$("#statu").focus();
    				return false;
    
    			} else if ((category == "") || (category == null)) {
    				alert("Seleccionar Categoria");
    				return false;
    
    			} else if ((title == "") || (title == null)) {
    				alert("Ingresar Titulo del producto");
    				return false;
    
    			} else if ((brand == "") || (brand == null)) {
    				alert("Ingresar marca");
    				return false;
    
    			} else if ((description == "") || (description == null)) {
    				alert("Ingresar descripcion");
    				return false;
    
    
    			} else if ((peso == "") || (peso == null)) {
    
    				alert("Ingresare el peso");
    				return false;
    
    			} else {
    				
    
    
    				document.getElementById('myform').submit();
    				//formulario.submit();
    				return true;
    			}
    
    
    
    		}   
            </script>
                
        
		


	<!-- Main Script -->
	<script src="common_update/script.js"></script>
	<!-- <script src="common/colorPick.js"></script> -->
<script src="./plugin-frameworks/dropify/dropify.min.js"></script> 
    <script>
        $('.dropify').dropify({
            messages: { 'default': 'Subir imagen', 'remove':  '<i class="fas fa-window-close"></i>', 'replace': 'Click para cargar imagen' }
        });
    </script>
	<script>
		// Lista Personalida
		$(function() {



			// Aqui validamos is el usuario no puso todo su datos
			if (!(valida_correo != "" && valida_correo.length > 0)) {
				console.log("Te direccionamos.");
				alert("Tiene que completar los demas Datos!!");

				location.href = 'admin_profile.php?admin_id=' + user_idx;
			} else {
				console.log(valida_correo);
			}

			/*  $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
	      _renderItem: function( ul, item ) {
	        var li = $( "<li>" ),
	          wrapper = $( "<div>", { text: item.label } );
	 
	        if ( item.disabled ) {
	          li.addClass( "ui-state-disabled" );
	        }
	 
	        $( "<span>", {
	          style: item.element.attr( "data-style" ),
	          "class": "ui-icon " + item.element.attr( "data-class" )
	        })
	          .appendTo( wrapper );
	 
	        return li.append( wrapper ).appendTo( ul );
	      }
	    }); */

			// $(".two-fila")
			// 	.iconselectmenu()
			// 	.iconselectmenu("menuWidget")
			// 	.addClass("ui-menu-icons avatar")
			//   .iconselectmenu({
			//   change: function( event, data ) {
			//      console.log('P', data.item.value );
			//   }
			// });

		})

		// $("#paleta-1, #paleta-2, #paleta-3").colorPick({
		//   'initialColor': '#3498db',
		//   'allowRecent': false,
		//   'recentMax': 5,
		//   'allowCustomColor': false,
		//   'palette': ["#1abc9c", "#16a085", "#2ecc71", "#27ae60", "#3498db", "#2980b9", "#9b59b6", "#8e44ad", "#34495e", "#2c3e50", "#f1c40f", "#f39c12", "#e67e22", "#d35400", "#e74c3c", "#c0392b", "#ecf0f1", "#bdc3c7", "#95a5a6", "#7f8c8d"],
		//   'onColorSelected': function() {
		//     this.element.css({'backgroundColor': this.color, 'color': this.color});
		//   }
		// });

		// For campo dinamico de "Color" y "Talla" mostrados 
		// id => product-qty
		// Para tallas
		$('.one-fila').on('change', function() {
			// class Padre => .product-color-qty
			var padre = $(this).parent().parent().parent();

			// valor de la categoria
			var valor_cate = $("#category").val();

			// Fila de tabla dinamica
			switch (padre.attr('id')) {
				case 'klon':
					var fila = $(fila_repetir).first()
					break;
				case 'klon2':
					var fila = $('#klonLine3').first()
					break;
				case 'klon3':
					var fila = $('#klonLine4').first()
					break;
			}

			var item_select = $(padre).find(".color-dropdown").eq(0).attr("data-item")
			item_select = parseInt(item_select);

			// Obtenemos las tallas 
			var talla = $(padre).find(".color-dropdown").eq(0).find("option:selected").text().trim();

			// Obtenemos los COlores
			var colores = $(padre).find(".color-dropdown").eq(1).find('option:selected').text();

			// campos a Mostrar - Validados
			var campo_val = $(padre).find(".product-qty").eq(0);


			// Campos de talal => Tabla
			console.log("ss", fila, item_select)

			if ((valor_cate == "49" || valor_cate == "59" || valor_cate == "60" || valor_cate == "61" || valor_cate == "62" || valor_cate == "63" || valor_cate == "64" || valor_cate == "65" || valor_cate == "66" || valor_cate == "67" || valor_cate=="82" 
			    || valor_cate=="85" || valor_cate=="86" || valor_cate=="87" || valor_cate=="88" || valor_cate=="89" || valor_cate=="90" || valor_cate=="91" || valor_cate=="92"  || valor_cate=="99" || valor_cate=="110" || valor_cate=="111" || valor_cate=="112" || valor_cate=="113" || valor_cate=="117")) { // si son CAMISA / BLUSA

				fila.find("#talla_camisa").text(talla);
				fila.find("#camisax").val("");
                fila.find("#camisay").val("");
                fila.find("#camisaz").val("");
				// PANTALONES , FALDAS ,  BERMUDAS  ,  BOXER  , LEGGIN , ROPA GIMNASIO , CONJUNTOS  
			} else if ((valor_cate == "68" || valor_cate == "69" || valor_cate == "70" || valor_cate == "71"
			 || valor_cate == "84" || valor_cate == "93" || valor_cate == "94" || valor_cate == "95"
			  || valor_cate == "96" || valor_cate == "97" || valor_cate == "98" || valor_cate == "100"
			   || valor_cate == "114" || valor_cate == "115" || valor_cate == "116" || valor_cate == "118" || valor_cate == "119")) { // Pantalon / Buzo /Bermudsa

				fila.find("#talla_pantalon").text(talla);
                fila.find("#pantalonx").val("");
                fila.find("#pantalony").val("");
				// medida-zapatos ---ZAPATOS ,  SANDALIAS  , ZAPATILLAS  , BOTAS , MOCASIN , SOMBRERO 
			}


			if (colores != 'Elija un color') {

				var cad = "Cantidad de Talla " + talla + ", Color " + colores;

				// console.warn(campo_val.eq(0).val())
				campo_val.attr('placeholder', cad)


			} else {
				console.log(talla, colores)
			}


			// invoco a la funcion Tabla Dinamica
			//+ llamarTablaDinamica(talla_val, talla)

		})

		// ========
		// Para Colores 
		$('.two-fila').on('change', function() {

			// class Padre => .product-color-qty
			var padre = $(this).parent().parent().parent();

			// Obtenemos las tallas 
			var talla = $(padre).find(".color-dropdown").eq(0).find("option:selected").text().trim();

			// Obtenemos los COlores
			var colores = $(padre).find(".color-dropdown").eq(1).find('option:selected').text();

			// campos a Mostrar - Validados
			var campo_val = $(padre).find(".product-qty").eq(0);

			// console.log("Varrr", talla, colores, campo_val)

			if (talla != 'Seleccionar talla') {

				var cad = "Cantidad de Talla " + talla + ", Color " + colores;


				campo_val.attr('placeholder', cad)

			} else {
				console.log(talla, colores)
			}

		})

		var fila_repetir = "";

		// ========== For tablas dinamicas por categoria
// 		$("#category").change("change", function() {
// 			// function llamarTablaDinamica(talla, talla_nombre) {
// 			var sub_envio = document.querySelector(".sub_envio");
// 			sub_envio.style.display = "inline";
// 			var bt_talla = document.querySelector(".bt_talla");
// 			bt_talla.style.display = "none";
// 			var bt_aviso = document.querySelector(".aviso");
// 			bt_aviso.style.display = "none";
// 			var valor_cate = $(this).val()
// 			console.log(valor_cate)

// 			// ============================
// 			// Carga talla - common/ajax_carga_tallas.php
// 			// 		console.info("Err", valor_cate);
// 			$.get('./common/ajax_carga_tallas.php', {
// 				cod_cate: valor_cate
// 			}, function(data) {
// 				// console.log(data);
// 				$("#list-talla").html(data);
// 			});
        

// 			// console.log( "ddd", talla_nombre )

// 			//if ( (valor_cate == "9" || valor_cate == "30" ) && (talla == "26" || talla == "26" || talla == "31") ){ // si son CAMISA / BLUSA
// 			// CAMISAS ,CASACAS ,POLERAS ,CHOMPAS,  PIJAMA ,  BLAZER , BUZOS
// 			if ((valor_cate == "49" || valor_cate == "59" || valor_cate == "60" || valor_cate == "61" || valor_cate == "62" || valor_cate == "63" || valor_cate == "64" || valor_cate == "65" || valor_cate == "66" || valor_cate == "67" || valor_cate=="82" 
// 			    || valor_cate=="85" || valor_cate=="86" || valor_cate=="87" || valor_cate=="88" || valor_cate=="89" || valor_cate=="90" || valor_cate=="91" || valor_cate=="92"  || valor_cate=="99" || valor_cate=="110" || valor_cate=="111" || valor_cate=="112" || valor_cate=="113" || valor_cate=="117")) { // si son CAMISA / BLUSA
//                 sub_envio.style.display = "none";
//                 bt_aviso.style.display = "inline";
//                 bt_aviso.style.padding = "13px";
//                 bt_talla.style.display = "inline";
//                 fila_repetir = ".fila-talla-camisa";
// 				$("#medida-camisa-blusa").fadeIn();
// 				$("#medida-pantalon-buuzo").hide() //oculta
// 				$("#medida-mochilas").hide();
// 				$("#medida-zapatos").hide();

// 				// $("#talla_camisa").html(talla_nombre);

// 				//} else if ( (valor_cate == "11" || valor_cate == "15") && (talla == "40" || talla == "42" || talla == "44") ) { // Pantalon / Buzo /Bermudsa
// 				// PANTALONES , FALDAS ,  BERMUDAS  ,  BOXER  , LEGGIN , ROPA GIMNASIO , CONJUNTOS  
// 			} else if ((valor_cate == "68" || valor_cate == "69" || valor_cate == "70" || valor_cate == "71"
// 			 || valor_cate == "84" || valor_cate == "93" || valor_cate == "94" || valor_cate == "95"
// 			  || valor_cate == "96" || valor_cate == "97" || valor_cate == "98" || valor_cate == "100"
// 			   || valor_cate == "114" || valor_cate == "115" || valor_cate == "116" || valor_cate == "118" || valor_cate == "119")) { // Pantalon / Buzo /Bermudsa
//                   sub_envio.style.display = "none";
//                 bt_aviso.style.display = "inline";
//                 bt_aviso.style.padding = "13px";
//                 bt_talla.style.display = "inline";
// 				fila_repetir = ".fila-talla-pantalon";

// 				$("#medida-pantalon-buuzo").fadeIn();
// 				$("#medida-camisa-blusa").hide() //oculta
// 				$("#medida-mochilas").hide();
// 				$("#medida-zapatos").hide();

// 				// $("#talla_pantalon").html(talla_nombre);

// 				// medida-zapatos ---ZAPATOS ,  SANDALIAS  , ZAPATILLAS  , BOTAS , MOCASIN , SOMBRERO 
// 			} else if ((valor_cate == "19" || valor_cate == "20" || valor_cate == "22" || valor_cate == "17")) {
//                 sub_envio.style.display = "none";
//                 bt_aviso.style.display = "inline";
//                 bt_aviso.style.padding = "13px";
//                 bt_talla.style.display = "inline";
// 				$("#medida-zapatos").fadeIn();
// 				$("#medida-pantalon-buuzo").hide();
// 				$("#medida-camisa-blusa").hide() //oculta
// 				$("#medida-zapatos").hide();


// 				// medida-mochilas ----  MOCHILLA , MALETIN , BOLSA , CARTERA  , CANGURO , MORRAL , CELULAR 
// 			} else if ((valor_cate == "20")) {
//                 sub_envio.style.display = "none";
//                 bt_aviso.style.display = "inline";
//                 bt_aviso.style.padding = "13px";
//                 bt_talla.style.display = "inline";
// 				$("#medida-mochilas").fadeIn();
// 				$("#medida-zapatos").hide();
// 				$("#medida-pantalon-buuzo").hide();
// 				$("#medida-camisa-blusa").hide() //oculta

// 			} else {
// 				$("#medida-camisa-blusa").hide() //oculta
// 				$("#medida-pantalon-buuzo").hide();
// 				$("#medida-mochilas").hide();
// 				$("#medida-zapatos").hide();

// 			}
// 			// }
// 		})


		function ver_prod(id) {

			//var mensaje=$("#mensaje"+id).val();

			$.ajax({
				type: "POST",
				url: "common/page.php?pagina=elimnar_image_products",
				data: "id=" + id,
				dataType: "html",
				success: function(datos) {

					var data = datos.trim();
					//alert(data);
					$(".abcdx" + id).html("");
					$(".abcdx" + id).css("display", "none");
					//$("#mensaje_fact").html(mensaje);

					var totimagen = $("#totimagen").val();

					totimagenx = parseFloat(totimagen)

					totimagenx = totimagenx - 1;

					$("#totimagen").val(totimagenx);


				}
			});
		}


		function submitform() {
			alert("Formulario enviado desde Java Script");
			document.getElementById('form').submit();
		}


		function carga(){
			var valor_cate = $("#category").val();

			var sizes = '';
			var medidax = '';
			var mediday = '';
			var medidaz = '';

			if ((valor_cate == "49" || valor_cate == "59" || valor_cate == "60" || valor_cate == "61" || valor_cate == "62" || valor_cate == "63" || valor_cate == "64" || valor_cate == "65" || valor_cate == "66" || valor_cate == "67" || valor_cate=="82" 
			    || valor_cate=="85" || valor_cate=="86" || valor_cate=="87" || valor_cate=="88" || valor_cate=="89" || valor_cate=="90" || valor_cate=="91" || valor_cate=="92"  || valor_cate=="99" || valor_cate=="110" || valor_cate=="111" || valor_cate=="112" || valor_cate=="113" || valor_cate=="117")) {
				// si son CAMISA / BLUSA
				$(".talla_camisa").each(function() {
					sizes += $(this).html() + '-';
				});
				$(".camisax").each(function() {
					medidax += $(this).val() + '-';
				});
				$(".camisay").each(function() {
					mediday += $(this).val() + '-';
				});
				$(".camisaz").each(function() {
					medidaz += $(this).val() + '-';
				});

		
			} else if (valor_cate == "68" || valor_cate == "69" || valor_cate == "70" || valor_cate == "71"
			 || valor_cate == "84" || valor_cate == "93" || valor_cate == "94" || valor_cate == "95"
			  || valor_cate == "96" || valor_cate == "97" || valor_cate == "98" || valor_cate == "100"
			   || valor_cate == "114" || valor_cate == "115" || valor_cate == "116" || valor_cate == "118" || valor_cate == "119") {
				// Pantalon / Buzo /Bermudsa
				$(".talla_pantalon").each(function() {
					sizes += $(this).html() + '-';
				});
				$(".pantalonx").each(function() {
					medidax += $(this).val() + '-';
				});
				$(".pantalony").each(function() {
					mediday += $(this).val() + '-';
				});

			}
			sizes = sizes.slice(0, -1);
			medidax = medidax.slice(0, -1);
			mediday = mediday.slice(0, -1);
			medidaz = medidaz.slice(0, -1);
			$("input[name=sizes]").val(sizes);
			$("input[name=medidasX]").val(medidax);
			$("input[name=medidasY]").val(mediday);
			$("input[name=medidasZ]").val(medidaz);
			stateHandle();

		}

        function stateHandle() {
            var sub_envio = document.querySelector(".sub_envio");
            var bt_talla = document.querySelector(".bt_talla");
            var bt_aviso = document.querySelector(".aviso");
          if (document.querySelector(".xmedida").value=="") {
            
			sub_envio.style.display = "none";
		
			bt_talla.style.display = "inline";
			
			bt_aviso.style.display = "inline";
			bt_aviso.style.padding = "13px";
          } else {
          sub_envio.style.display = "inline";
		
			bt_talla.style.display = "none";
			
			bt_aviso.style.display = "none";
          }
        }
        
        

		
	</script>

	<script src="./tagging.min.js"></script>

	<script>
		// init tag jQuery Plugin
		var t, $tag_box;

		// ================================= 
		// Capturo los tags con PHP

		var tags_elem = "<?= $product_keydowrds ?>";

		var tags_arr = tags_elem.split(",");

		// We call taggingJS init on all "#tag" divs
		t = $("#tagBox").tagging();

		// This is the $tag_box object of the first captured div
		$tag_box = t[0];

		// agrego los tags del registro que tiene
		$tag_box.tagging("add", tags_arr);
	</script>
    
</body>

</html>