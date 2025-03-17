<?php require_once('../private/init.php'); ?>
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

	$products = find_products_by_count(($page *$count), $count);

	if(count($products) > $count){
		$message = "mostrar " . ($page * $count) . " a " . (($page * $count) + $count) . " Productos.";
	}else{
		$message = "mostrar " . ($page * $count) . " a " . (($page * $count) + count($products)) . " Productos.";
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
					
				</div>

				<div class="tbl-wrapper">
					<table class="order-table">

						<thead>
						<tr>
							<th>Imagen</th>
							<th>productos</th>
							<th>Categoria</th>
							<th>Compra <br><?php echo get_currency();?></th>
							<th>Precio <br><?php echo get_currency();?></th>
							<th>Estado</th>
							<th>Destacado</th>
							<th>Accion</th>
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

						<td class="w-100x">
						<img class="circle-img-80x" src="<?php echo 'uploads/recent-products/' . $product_img[0]["image_name"]; ?>" alt=""></td>

						<td class="w-200x"><?php echo $product['title']; ?><br>
						Tienda:<?php echo $store_name; ?><br>
							Galeria:<?php echo $gallery_name; ?><br>


						</td>
						<td class="w-120x"><b><?php echo $category_name; ?></b></td>
						<td class="w-120x"><b><?php echo get_currency() . " " . $product['purchase_price']; ?></b></td>
						<td class="w-120x color-primary">
						<span class="prev-price"><?php echo get_currency() . " " . $product['previous_price']; ?></span><br>
						<?php echo get_currency() . " " . $product['price']; ?></td>
						<td><?php //echo truncated_message($product['description'], 100); ?> 

						<?php if  ($product['status']==1){echo  "ACTIVO";}
						if  ($product['status']==2){echo  "INACTIVO";}
						?>

						</td>
						<td class="w-150x">
						<?php if  ($product['outstanding']==2){
							$arc=1;
						?>
						<a class="add-product-btn btn" href="#" onclick="grabar_datos(<?=$product['id'];?>,<?=$arc?>)">DESACTIVAR</a>

						<?php 
						}?>
						<?php 
						if  ($product['outstanding']==1){
							$arc=2;
						?>
						<a class="add-product-btn btn" href="#" onclick="grabar_datos(<?=$product['id'];?>,<?=$arc?>)" >ACTIVAR</a>
						<?php 
						}
						?>
						</td>

						<td class="w-150x">
						<!--<a class="update-btn" href="add_recent_products.php?product_id=<?php echo $product['id']; ?>">
						<i class="fas fa-edit"></i></a>-->


	



						<a class="delete-btn" href="delete_product.php?product_id=<?php echo $product['id']; ?>">
						<i class="fas fa-trash-alt"></i></a>
						</td>
						</tr>


						<?php } ?>
						<?php } ?>

						</tbody>
					</table><!-- user -->
				</div>

				<div class="mt-30 center-text nxt-link"><div id="resultados"></div>
					<?php if($prev){ ?>
						<a href="recent_products_user.php?prev=<?php echo ($page -1); ?>"> anterior</a>
					<?php } ?>
					<?php if($next){ ?>
						<a href="recent_products_user.php?next=<?php echo ($page + 1); ?>"> siguiente</a>
					<?php } ?>
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
						
					}
				});
			
		}

</script>
</body>
</html>