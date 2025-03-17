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
if(isset($_GET['product_id']) && $_GET['product_id']!==""){
    $product_id=$_GET['product_id'];
    $product = find_product_by_id($product_id);
    $product_category = $product['category'];
    $tipoTabla=$product['tipotabla'];
    $tallas=find_all_sizes_for_category($product_category);
    $colore_imagen=get_color_images_by_product_id($product_id);
    $inventory=get_inventory_by_product_id($product_id);
}






$redirected_link = "insert-stock-product.php";
$btn_text = 'ACTUALIZAR';







echo '<script>';
echo 'var valida_correo = "' . $correo . '";';
echo 'var user_idx = "' . $admin_id . '";';
echo '</script>';


?>

<?php require("common_update/head.php"); ?>
<link href="./custom-accordions.css" rel="stylesheet" type="text/css" />

<style>
 .form-control {
            border: 1px solid #ccc;
            color: #888ea8;
            font-size: 15px;
        }
        label { color: #3b3f5c; }
        .form-control::-webkit-input-placeholder { color: #888ea8; font-size: 15px; }
        .form-control::-ms-input-placeholder { color: #888ea8; font-size: 15px; }
        .form-control::-moz-placeholder { color: #888ea8; font-size: 15px; }
        .form-control:focus { border-color: #3862f5; }
.card {
    margin-bottom: 20px;
    background-color: transparent;
    border: none;
}
.card-default > .card-heading {
    color: #fff;
    padding: 10px 15px;
    background-color: #5247bd;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom: 1px solid #ffffff;
}
.card-title {
    margin: 0px;
    font-size: 18px;
    font-weight: 500;
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
		font-size: 0.8em;
	}

	.table-dinamyc input {
		padding-left: 10px;
		margin-top: 2px;
	}
	.table-dinamyc select {
		padding: 0 0 !important;
		margin-top: 2px;
	}
</style>

<body>

	<?php require("common_update/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common_update/sidebar.php"); ?>

		<div class="main-contents">

			<div class="add-product" style="max-width: 720px;">

				

				<form class="myStock" action="<?php echo '../private/' . $redirected_link; ?>" method="POST" enctype="multipart/form-data">

					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
					<input type="hidden" name="accion" value="actualizar">
					<div class="widget-content widget-content-area creative2-accordion-content">
                                <div id="creativeAccordion">
                                  <div class="card mb-3">
                                    <div class="card-header" id="creative2headingOne">
                                      <h5 class="mb-0 mt-0">
                                        <span role="menu" class="" data-toggle="collapse" data-target="#creative2CollapseOne" aria-expanded="true" aria-controls="creative2CollapseOne">
                                            <span class="icon">
                                                 <i class="fas fa-minus"></i>
                                            </span>
                                            <span class="text ml-2">
                                                Registrar Tallas, Color y Stock
                                            </span>
                                        </span>
                                      </h5>
                                    </div>

                                    <div id="creative2CollapseOne" class="collapse show" aria-labelledby="creative2headingOne" data-parent="#creativeAccordion">
                                      <div class="card-body">
                                        <div class="default-repeater">
                                            <div data-repeater-list="stock" class="pb-2">
                                                <?php
                                                if(count($inventory)>=1){
                                                    foreach ($inventory as $inv) {
                                                        ?>
                                                        <div class="r-container" data-repeater-item>
                                                            <div class="form-group mb-1">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-10 col-9">
                                                                       <div class="row">
                                                                            <div class="col-md-4 mb-1">
                                                                                <select name="talla" id="tallas_stock" class="form-control"  required>
                                                                                    <option value=""> Seleccione Talla</option>
                                                                                    <?php foreach ($tallas as $ta) { ?>
                                                    									<option value="<?php if (isset($ta["size_id"])) {
                                                    									echo $ta["size_id"];
                                                    									}?>"
                                                    									<?php
                                                    									if($ta["size_id"]==$inv["size_id"]){
                                                    									   echo "selected"; 
                                                    									}
                                                    									?>><?php echo $ta["size_name"]; ?></option>
                                                    								<?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mb-1">
                                                                                <select name="color" class="form-control" required>
                                                                                    <option value="">Seleccione Color</option>
                                                                                    <?php foreach ($colore_imagen as $col) { ?>
                                                    									<option value="<?php if (isset($col["color_id"])) {
                                                    									echo $col["color_id"];
                                                    									}?>"
                                                    									<?php
                                                    									if($col["color_id"]==$inv["color_id"]){
                                                    									   echo "selected"; 
                                                    									}
                                                    									?>><?php echo $col["color_name"]; ?></option>
                                                    								<?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mb-1">
                                                                                <input type="number" name="cantida" class="form-control" value="<?php echo $inv['available_qty']; ?>"  min="2" required/>
                                                                            </div> 
                                                                       </div> 
                                                                    </div>
                                                                    <div class="col-md-2 col-3">
                                                                        <span data-repeater-delete class="text-danger border-danger">
                                                                            <span class="fas fa-trash-alt"></span>
                                                                        </span>
                                                                    </div>
                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }else{
                                                  ?>
                                                    <div class="r-container" data-repeater-item>
                                                        <div class="form-group mb-1">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-10 col-9">
                                                                   <div class="row">
                                                                        <div class="col-md-4 mb-1">
                                                                            <select name="talla" id="tallas_stock" class="form-control"  required>
                                                                                <option value=""> Seleccione Talla</option>
                                                                                <?php foreach ($tallas as $ta) { ?>
                                                									<option value="<?php if (isset($ta["size_id"])) {
                                                									echo $ta["size_id"];
                                                									}
                                                									
                                                									?>"><?php echo $ta["size_name"]; ?></option>
                                                								<?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 mb-1">
                                                                            <select name="color" class="form-control" required>
                                                                                <option value="">Seleccione Color</option>
                                                                                <?php foreach ($colore_imagen as $col) { ?>
                                                									<option value="<?php if (isset($col["color_id"])) {
                                                									echo $col["color_id"];
                                                									}
                                                									
                                                									?>"><?php echo $col["color_name"]; ?></option>
                                                								<?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 mb-1">
                                                                            <input type="number" name="cantida" class="form-control" placeholder="Cantidad"  min="2" required/>
                                                                        </div> 
                                                                   </div> 
                                                                </div>
                                                                <div class="col-md-2 col-3">
                                                                    <span data-repeater-delete class="text-danger border-danger">
                                                                        <span class="fas fa-trash-alt"></span>
                                                                    </span>
                                                                </div>
                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                  <?php
                                                }
                                                ?>
                                                
                        
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <span data-repeater-create class="btn btn-button-7 btn-md">
                                                            <span class="fas">+</span> Agregar mas tallas
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card mb-3">
                                    <div class="card-header" id="creative2HeadingTwo">
                                      <h5 class="mb-0 mt-0">
                                        <span role="menu" class="collapsed" data-toggle="collapse" data-target="#creative2CollapseTwo" aria-expanded="false" aria-controls="creative2CollapseTwo">
                                            <span class="icon">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                            <span class="text ml-2">
                                                Registrar Medidas Generales
                                            </span>
                                        </span>
                                      </h5>
                                    </div>
                                    <div id="creative2CollapseTwo" class="collapse show" aria-labelledby="creative2HeadingTwo" data-parent="#creativeAccordion">
                                      <div class="card-body">
                                            <?php
                                            if(!empty($_GET) && isset($_GET['product_id']) && $_GET['product_id']!==""){
                                                $product_medidas = medidas_product_by_id($_GET['product_id']);
                                                if($tipoTabla==1){
                                                    ?>
                                                    <div class="default-repeater mt-3">
                                                        <div class="table-dinamyc" id="medida-camisa-blusa" class="medida-camisa">
                                    						<table>
                                    							<thead>
                                    								<tr>
                                    									<th width="25%">TALLA</th>
                                    									<th>LARGO DE LA “CAMISA” DE FRENTE</th>
                                    									<th>CONTORNO DEL PECHO</th>
                                    									<th>LARGO DE LA MANGA</th>
                                    									<th></th>
                                    								</tr>
                                    							</thead>
                                    							<tbody data-repeater-list="medidas">
                                    							    <?php
                                    							    if(count($product_medidas)>=1){
                                    							        foreach ($product_medidas as $med) {
                                    							    ?>
                                    								<tr class="r-container fila-talla-camisa" data-repeater-item>
                                    									<td>
                                    									    <select name="talla" class="camisax" required>
                                                                                <option value="">Talla</option>
                                                                                <?php foreach ($tallas as $ta) { ?>
                                                    									<option value="<?php if (isset($ta["size_id"])) {
                                                    									echo $ta["size_id"];
                                                    									}?>"
                                                    									<?php
                                                    									if($ta["size_id"]==$med['size']){
                                                    									    echo "selected";
                                                    									}
                                                    									?>><?php echo $ta["size_name"]; ?></option>
                                                    								<?php } ?>
                                                                            </select>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisax" name="medidax" value="<?php echo $med['medidax'];?>" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisay" name="mediday" value="<?php echo $med['mediday'];?>" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisaz" name="medidaz" value="<?php echo $med['medidaz'];?>" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    									    <span data-repeater-delete class="text-danger border-danger">
                                                                                <span class="fas fa-trash-alt"></span>
                                                                            </span>
                                    									</td>
                                    								</tr>
                                    								<?php } 
                                    								}else{
                                    								    ?>
                                    								    <tr class="r-container fila-talla-camisa" data-repeater-item>
                                        									<td>
                                        									    <select name="talla" class="camisax" required>
                                                                                    <option value="">Talla</option>
                                                                                    <?php foreach ($tallas as $ta) { ?>
                                                        									<option value="<?php if (isset($ta["size_id"])) {
                                                        									echo $ta["size_id"];
                                                        									}?>"
                                                        									><?php echo $ta["size_name"]; ?></option>
                                                        								<?php } ?>
                                                                                </select>
                                        									</td>
                                        									<td>
                                        										<input type="number" class="camisax" name="medidax" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                        									</td>
                                        									<td>
                                        										<input type="number" class="camisay" name="mediday" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                        									</td>
                                        									<td>
                                        										<input type="number" class="camisaz" name="medidaz" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                        									</td>
                                        									<td>
                                        									    <span data-repeater-delete class="text-danger border-danger">
                                                                                    <span class="fas fa-trash-alt"></span>
                                                                                </span>
                                        									</td>
                                        								</tr>
                                    								    <?php
                                    								}?>
                                    							</tbody>
                                    						</table>
                                    					</div>
                                                        <div class="form-group mt-2">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <span data-repeater-create class="btn btn-button-7 btn-md">
                                                                        <span class="fas">+</span> Agregar mas tallas
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <?php
                                                    
                                                }
                                                if($tipoTabla==2){
                                                    ?>
                                                    <div class="default-repeater mt-3">
                                                        <div class="table-dinamyc" id="medida-camisa-blusa" class="medida-camisa">
                                    						<table>
                                    							<thead>
                                    								<tr>
                                    									<th width="25%">TALLA</th>
                                    									<th>LARGO DE "PANTALON"</th>
                                    									<th>CONTORNO CINTURA</th>
                                    									<th></th>
                                    								</tr>
                                    							</thead>
                                    							<tbody data-repeater-list="medidas">
                                    							    <?php
                                    							    if(count($product_medidas)>=1){
                                    							        foreach ($product_medidas as $med) {
                                    							    ?>
                                    								<tr class="r-container fila-talla-camisa" data-repeater-item>
                                    									<td>
                                    									    <select name="talla" class="camisax" required>
                                                                                <option value="">Talla</option>
                                                                                <?php foreach ($tallas as $ta) { ?>
                                                    									<option value="<?php if (isset($ta["size_id"])) {
                                                    									echo $ta["size_id"];
                                                    									}
                                                    									
                                                    									?>"
                                                    									<?php
                                                    									if($ta["size_id"]==$med["size"]){
                                                    									    echo "selected";
                                                    									}
                                                    									?>><?php echo $ta["size_name"]; ?></option>
                                                    								<?php } ?>
                                                                            </select>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisax" name="medidax" value="<?php echo $med['medidax'];?>" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisay" name="mediday" value="<?php echo $med['mediday'];?>" autocomplete="off" required>
                                    										<input type="hidden" class="camisaz" name="medidaz" value="0">
                                    									</td>
                                    									<td>
                                    									    <span data-repeater-delete class="text-danger border-danger">
                                                                                <span class="fas fa-trash-alt"></span>
                                                                            </span>
                                    									</td>
                                    								</tr>
                                    								<?php }
                                    								}else{
                                    								    ?>
                                    								    <tr class="r-container fila-talla-camisa" data-repeater-item>
                                    									<td>
                                    									    <select name="talla" class="camisax" required>
                                                                                <option value="">Talla</option>
                                                                                <?php foreach ($tallas as $ta) { ?>
                                                    									<option value="<?php if (isset($ta["size_id"])) {
                                                    									echo $ta["size_id"];
                                                    									}
                                                    									
                                                    									?>"><?php echo $ta["size_name"]; ?></option>
                                                    								<?php } ?>
                                                                            </select>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisax" name="medidax" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisay" name="mediday" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                    										<input type="hidden" class="camisaz" name="medidaz" value="0">
                                    									</td>
                                    									<td>
                                    									    <span data-repeater-delete class="text-danger border-danger">
                                                                                <span class="fas fa-trash-alt"></span>
                                                                            </span>
                                    									</td>
                                    								</tr>
                                    								    <?php
                                    								}?>
                                    							</tbody>
                                    						</table>
                                    					</div>
                                                        <div class="form-group mt-2">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <span data-repeater-create class="btn btn-button-7 btn-md">
                                                                        <span class="fas">+</span> Agregar mas tallas
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <?php
                                                }
                                                if($product_category== "19" || $product_category== "20" || $product_category== "22" || $product_category== "17"){
                                                    ?>
                                                    <div class="default-repeater mt-3">
                                                        <div class="table-dinamyc" id="medida-camisa-blusa" class="medida-camisa">
                                    						<table>
                                    							<thead>
                                    								<tr>
                                    									<th width="25%">TALLA</th>
                                    									<th>LARGO</th>
                                    									<th>ANCHO</th>
                                    									<th></th>
                                    								</tr>
                                    							</thead>
                                    							<tbody data-repeater-list="medidas">
                                    							    <?php
                                    							    if(count($product_medidas)>=1){
                                    							        foreach ($product_medidas as $med) {
                                    							    ?>
                                    								<tr class="r-container fila-talla-camisa" data-repeater-item>
                                    									<td>
                                    									    <select name="talla" class="camisax" required>
                                                                                <option value="">Talla</option>
                                                                                <?php foreach ($tallas as $ta) { ?>
                                                    									<option value="<?php if (isset($ta["size_id"])) {
                                                    									echo $ta["size_id"];
                                                    									}
                                                    									
                                                    									?>"
                                                    									<?php
                                                    									if($ta["size_id"]==$med["size"]){
                                                    									    echo "selected";
                                                    									}
                                                    									?>><?php echo $ta["size_name"]; ?></option>
                                                    								<?php } ?>
                                                                            </select>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisax" name="medidax" value="<?php echo $med['medidax'];?>" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisay" name="mediday" value="<?php echo $med['mediday'];?>" autocomplete="off" required>
                                    										<input type="hidden" class="camisaz" name="medidaz" value="0">
                                    									</td>
                                    									<td>
                                    									    <span data-repeater-delete class="text-danger border-danger">
                                                                                <span class="fas fa-trash-alt"></span>
                                                                            </span>
                                    									</td>
                                    								</tr>
                                    								<?php } 
                                    								}else{
                                    								    ?>
                                    								<tr class="r-container fila-talla-camisa" data-repeater-item>
                                    									<td>
                                    									    <select name="talla" class="camisax" required>
                                                                                <option value="">Talla</option>
                                                                                <?php foreach ($tallas as $ta) { ?>
                                                    									<option value="<?php if (isset($ta["size_id"])) {
                                                    									echo $ta["size_id"];
                                                    									}
                                                    									
                                                    									?>"><?php echo $ta["size_name"]; ?></option>
                                                    								<?php } ?>
                                                                            </select>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisax" name="medidax" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                    									</td>
                                    									<td>
                                    										<input type="number" class="camisay" name="mediday" placeholder="ESCRBIR LA MEDIDA" autocomplete="off" required>
                                    										<input type="hidden" class="camisaz" name="medidaz" value="0">
                                    									</td>
                                    									<td>
                                    									    <span data-repeater-delete class="text-danger border-danger">
                                                                                <span class="fas fa-trash-alt"></span>
                                                                            </span>
                                    									</td>
                                    								</tr>
                                    								    <?php
                                    								}?>
                                    							</tbody>
                                    						</table>
                                    					</div>
                                                        <div class="form-group mt-2">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <span data-repeater-create class="btn btn-button-7 btn-md">
                                                                        <span class="fas">+</span> Agregar mas tallas
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <?php
                                                }
                                            }
                                            ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        
					
					<button class="mt-20 btn submit-btn sub_envio btn-success" name="submit"  type="submit"><b><?php echo $btn_text; ?> </b></button>
				</form>
				<div class="RespuestaStok">
				    
				</div>

			</div><!-- add-product -->
		</div><!-- main-content -->
	</section>
	<!--main-body -->


	<!-- jQuery library -->
	<!-- <script src="plugin-frameworks/jquery-3.2.1.min.js"></script> -->
<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>



	<!-- Main Script -->
	<script src="common/script.js"></script>
	<script src="./jquery.repeater.min.js"></script>
	<script src="./ui-accordions.js"></script>
	
	<script>
        $('.repeater-default').repeater({
            show: function () { $(this).slideDown('slow'); }
        });
        $('.default-repeater').repeater({
            defaultValues: { talla: '', color: '', cantidad: '2' }
        });        
        $('.repeater-slide').repeater({
            defaultValues: { 'textarea-input': 'foo', 'text-input': 'bar', 'select-input': 'B', 'checkbox-input': ['A', 'B'], 'radio-input': 'B' },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) { $(this).slideUp(deleteElement); }
            }
        });
    </script>
	<!-- <script src="common/colorPick.js"></script> -->

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

		});
		

    
		
	</script>
	<script>
	    $('.myStock').submit(function(e){
        e.preventDefault();

        var form=$(this);
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=$('.RespuestaStok');

        var msjError="Ocurrio un error inesperado";
        var formdata = new FormData(this);
 
        $.ajax({
            type: metodo,
            url: accion,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    if(percentComplete<100){
                        respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                    }else{
                        respuesta.html('<p class="text-center"></p>');
                    }
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                
                respuesta.html(data);
            },
            error: function() {
                alert(msjError);
            }
        });
    });
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