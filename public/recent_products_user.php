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

	$page = 0;
	$count = 15;
	$prev = false;
	$next = true;

	if(!empty($_GET['next'])){
		$page = $_GET['next'];

	}else if(!empty($_GET['prev'])){
		$page = $_GET['prev'];
	}

	if($page > 0) $prev = true;
	else $prev = false;



	if(!empty($_GET['filtro'])){
		$filtro = $_GET['filtro'];
	}else{

		$filtro ="";
	}


	if(!empty($_GET['types'])){
		$types = $_GET['types'];
	}else{

		$types ="";
	}





	$products = find_products_by_count_system($types,$filtro,($page *$count), $count);

	if(count($products) > $count){
		$message = $lang['mostrar'] .' '. ($page * $count) . " ". $lang['a'] ." " . (($page * $count) + $count) . " ". $lang['Productos'] .".";
	}else{
		$message = $lang['mostrar'] .' '. ($page * $count) . " ". $lang['a'] ." " . (($page * $count) + count($products)) . " ". $lang['Productos'] .".";
	}


	if(empty($products)){
		$next = false;
		$message = "No Product Found.";
	}else if(!empty(get_product_msg())){
		$next = true;
		$message = get_product_msg();
		unset_product_msg();
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

					<input type="text" name="search" id="search" placeholder="<?php echo $lang['IngresarDatos'] ?>" value="">
					<button class="mt-20 btn submit-btn" name="store" type="button" onclick="buscar_datos(1);"><b><?php echo $lang['Tienda'] ?></b></button>
					<button class="mt-20 btn submit-btn" name="gallery" type="button" onclick="buscar_datos(2);"><b><?php echo $lang['Galeria'] ?></b></button>
					<button class="mt-20 btn submit-btn" name="destacados" type="button" onclick="buscar_datos(3);"><b><?php echo $lang['Destacados'] ?></b></button>
					
				</div>

				<div class="tbl-wrapper">
					<table class="order-table">

						<thead>
						<tr>
							<th><?php echo $lang['imagen'] ?></th>
							<th><?php echo $lang['Productos'] ?></th>
							<!--<th>Categoria</th>-->
							<th>Precio Tienda</th>
							<th><?php echo $lang['Precio'] ?> <br><?php echo get_currency();?></th>
							<th><?php echo $lang['estado'] ?></th>
							<th><?php echo $lang['Destacado'] ?></th>
							<!--<th>Accion</th>-->
						</tr>
						</thead>

						<tbody>

						<?php if(!empty($products)){
						foreach ($products as $product) { ?>

						<tr>
					<?php 	
					$product_img 	= get_images_by_product_id($product['id']);
					$category_name 	= find_category_by_id($product['category'])['title'];

					$store_name =find_admin_by_id($product['user_id'])['store'];
					$gallery_name =find_admin_by_id($product['user_id'])['gallery'];
 					//$product['user_id'];// 
					?>

						<td>
						<img class="circle-img-80x" src="<?php echo 'uploads/recent-products/' . $product_img[0]["image_name"]; ?>" alt=""></td>

						<td><?php echo $product['title']; ?><br>
						<?php echo $lang['Tienda'] .': '. $store_name; ?><br>
						<?php echo $lang['Galeria'] .': '.$gallery_name; ?><br>


						</td>
						<!--<td><b><?php echo $category_name; ?></b></td>-->
						<td><b><?php echo get_currency() . " " . $product['purchase_price']; ?></b></td>
						<td class="color-primary">
						<span class="prev-price"><?php echo get_currency() . " " . $product['previous_price']; ?></span><br>
						<?php echo get_currency() . " " . $product['price']; ?></td>
						<td><?php //echo truncated_message($product['description'], 100); ?> 

						<?php if  ($product['status']==1){echo  $lang['ACTIVO'];}
						if  ($product['status']==2){echo  $lang['INACTIVO'];}
						?>

						</td>
						<td>
						<?php if  ($product['outstanding']==2){
							$arc=1;
						?>
						<a class="add-product-btn btn" onclick="grabar_datos(<?=$product['id'];?>,<?=$arc?>)"><?php echo $lang['DESACTIVAR'] ?></a>

						<?php 
						}?>
						<?php 
						if  ($product['outstanding']==1){
							$arc=2;
						?>
						<a class="add-product-btn btn" onclick="grabar_datos(<?=$product['id'];?>,<?=$arc?>)" ><?php echo $lang['ACTIVAR'] ?></a>
						<?php 
						}
						?>
						</td>

						<td>
						<!--<a class="update-btn" href="add_recent_products.php?product_id=<?php echo $product['id']; ?>">
						<i class="fas fa-edit"></i></a>-->


	

<!--

						<a class="delete-btn" href="delete_product.php?product_id=<?php echo $product['id']; ?>">
						<i class="fas fa-trash-alt"></i></a>-->
						</td>
						</tr>


						<?php } ?>
						<?php } ?>

						</tbody>
					</table><!-- user -->
				</div>

				<div class="center-text nxt-link"><div id="resultados"></div>

				<?php 

$anterior= $page -1;
$siguiente= $page +1;

				?>
				<!--	<?php if($prev){ ?>
						<a href="recent_products_user.php?prev=<?php echo ($page -1); ?>"> anterior</a>
					<?php } ?>
					<?php if($next){ ?>
						<a href="recent_products_user.php?next=<?php echo ($page + 1); ?>"> siguiente</a>
					<?php } ?>-->
				</div>

			</div><!-- recent-products -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>

<script type="text/javascript">
		
	function grabar_datos(id,iddes){

		
		var parametros ="id="+id+"&iddes="+iddes;

		///var importe = $("#importe_"+id).val();+"&importe="+importe

				$.ajax({
				    type: "POST",
				    url: "json/update_desta_by_id.php",
				    data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Mensaje: Cargando...");
					  },
				    success: function(datos){
						$("#resultados").html(datos);
						location.reload();
						
					}
				});
			
		}



	function buscar_datos(types){

		var filtro=$("#search").val();

		var anterior="<?=$anterior;?>";
		var siguiente="<?=$siguiente;?>";

	//	location.href="recent_products_user.php?filtro="+filtro+"&types="+types+"&prev="+anterior+"&next="+siguiente;
		location.href="recent_products_user.php?filtro="+filtro+"&types="+types;





		/*var parametros ="id="+id+"&iddes="+iddes;
		///var importe = $("#importe_"+id).val();+"&importe="+importe
				$.ajax({
				    type: "POST",
				    url: "json/update_desta_by_id.php",
				    data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Mensaje: Cargando...");
					  },
				    success: function(datos){
						$("#resultados").html(datos);
						
					}
				});*/
			
		}

</script>
</body>
</html>