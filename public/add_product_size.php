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
	
	$all_categories = find_all_categories();
	$product_size = [];
	$size_id = "";
	$size_name = "";

	$product_category = "";

	if(!empty($_GET) && isset($_GET['size_id'])){
		$size_id = $_GET['size_id'];
// 		$product_size = find_size_by_id($size_id);
// 		$size_name = $product_size['size_name'];
        $product_category = find_category_by_id($size_id ); // El parametro es un ID de categoria.
        
// 		$product_category = $product_size['id'];
		
		// Para las tallas
	}
	
	if(empty($product_size)){
		$redirected_link = "insert_size.php";
		$btn_text = 'añadir';
	}else{
		$redirected_link = "update_size.php?size_id=". $product_size['size_id'];
		$btn_text = 'actualizar';
	}
	
?>

<?php require("common/head.php"); ?>

<body>
    <link href="./tag-basic-style.css" rel="stylesheet">
    <style>
        .tagging {
            margin-top: 10px;
        }
        
        .add-product input {
            margin-top: 0 !important;
        }
        
        .add-product input:focus {
            border: none !important;
        }
    </style>

<?php require("common/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
		
	
		<div class="main-contents">
		
			<div class="add-product">
				
				<?php if($error_msg != "") echo get_error_msg(); ?>

				<form action="<?php echo '../private/' . $redirected_link; ?>" method="POST" enctype="multipart/form-data">
				
					<input type="hidden" name="size_id" value="<?php echo $size_id; ?>">

					<!-- ======= Cambio para categorias ======  -->
					<select name="category"  id="category">
						<option class="first" selected disabled hidden >Porfavor seleccione una categoría</option>
						<?php 

				// 		var_dump($product_category);
						foreach($all_categories as $category){ ?>

							<option value="<?php echo $category["id"]?>" <?php if($category["id"] == $product_category['id']){
								echo " selected ";
							}
								?>>  <?php $types= find_type_by_id($category["types"]);

										echo $types["title"];

								 ?> >  <?php echo $category["title"]; ?>   
							</option>
						<?php } ?>
					</select>
					
					<!--<input type="text" name="size_name" placeholder="Talla" value="<?php echo $size_name; ?>">-->
					<!--Cambios -->
					<div data-tags-input-name="tag" id="tagBox"></div>
					
					<?php 
    					 // Obtener todas las tallas
                        $tallas = find_size_by_category_id($size_id);
    				// 	var_dump($tallas);
    								    
    					$tallin = '';
    					foreach($tallas as $talla) {	
    					    $tallin .= $talla['size_name'] . ", ";
    					}
    			        $tallin =substr($tallin, 0, strlen($tallin) -2);
    			     //   var_dump($tallin);
					 ?>
					

					<button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['Anadir'] ?></b></button>
				</form>

			</div><!-- add-product -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<!--<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="./tagging.min.js"></script>

<script>
    // init tag jQuery Plugin
    var t, $tag_box;
    
    // ================================= 
    // Capturo los tags con PHP

   var tags_elem = "<?= $tallin ?>";

   var tags_arr = tags_elem.split(",");
    
    // We call taggingJS init on all "#tag" divs
    t = $( "#tagBox" ).tagging();
    
    // This is the $tag_box object of the first captured div
     $tag_box = t[0];
    
    // agrego los tags del registro que tiene
    $tag_box.tagging( "add", tags_arr);
  
</script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>