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

	$products = find_products_by_count_user($admin_id);

	if(count($products) > $count){
		$message = $lang['mostrar']." " . ($page * $count) . " ".$lang['a']." " . (($page * $count) + $count) . " ".$lang['Productos'];
	}else{
		$message = $lang['mostrar']." " . ($page * $count) . " ".$lang['a']." " . (($page * $count) + count($products)) . " ".$lang['Productos'];
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

<?php require("common_update/head.php"); ?>


<body>

<?php require("common_update/heading_menu.php"); ?>


<section class="main-body">
	<?php require("common_update/sidebar.php"); ?>
		
	
		<div class="main-contents">
			<div class="recent-products">
				<div class="message-wrapper">
					<h5 class="message"><?php echo $message; ?></h5>
					<h6><a class="add-product-btn btn" href="add_recent_products.php">+ <?php echo $lang['Anadir'] ?></a></h6>
				</div>

				<div class="tbl-wrapper">
					
					
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th><?php echo $lang['imagen'] ?></th>
							<th><?php echo $lang['Productos'] ?></th>
							<th><?php echo $lang['Categoria'] ?></th>
							<th><?php echo $lang['Precio'] ?> <br><?php echo get_currency();?></th>
							<th><?php echo $lang['estado'] ?></th>
							<th><?php echo $lang['accion'] ?></th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($products)){
								foreach ($products as $product) { ?>

	<tr>
		<?php 	$product_img 	= get_images_by_product_id($product['id']);
				$category_name 	= find_category_by_id($product['category'])["title"];
		?>

		<td>
			<img class="circle-img-80x" src="<?php echo 'uploads/recent-products/' . $product_img[0]["image_name"]; ?>" alt=""></td>

		<td><?php echo $product['title']; ?></td>
		<td><b><?php echo $category_name; ?></b></td>
		<td><b><?php echo get_currency() . " " . number_format($product['purchase_price'],2); ?></b></td>
		<td><?php //echo truncated_message($product['description'], 100); ?> 

 <?php if  ($product['status']==1){echo   $lang['ACTIVO'];}
    if  ($product['status']==2){echo   $lang['INACTIVO'];}
    ?>

		</td>
		<td>
			<a class="update-btn" href="add_recent_products.php?product_id=<?php echo $product['id']; ?>">
				<i class="fas fa-edit"></i></a>
			<a class="delete-btn" style="margin-left: 12px;color:red;" onclick="eliminar_pro_id('<?php echo $product['id']; ?>')">
				<i class="fas fa-trash-alt"></i></a>
		</td>
	</tr>

									
								<?php } ?>
							<?php } ?>
					</tbody>
				</table><!-- user -->
				</div>
				
				<!-- <div class="mt-30 center-text nxt-link">
					<?php if($prev){ ?>
						<a href="recent_products.php?prev=<?php echo ($page -1); ?>"> <?php echo $lang['Anterior'] ?></a>
					<?php } ?>
					<?php if($next){ ?>
						<a href="recent_products.php?next=<?php echo ($page + 1); ?>"> <?php echo $lang['Siguiente'] ?></a>
					<?php } ?>
				</div> -->

			</div><!-- recent-products -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->


</body>

<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>
<script src="./plugin-frameworks/js/jquery.dataTables.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.responsive.min.js"></script>
<script src="./plugin-frameworks/js/responsive.bootstrap4.min.js"></script>

<!-- Main Script -->
<script src="common_update/script.js"></script>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );

function eliminar_pro_id(id_prod){
	    var ans = confirm("Si deseas eliminar el producto presionar el boton ACEPTAR, caso contrario CANCELAR.");
		if(ans){
		     window.location.href = "./delete_product.php?product_id="+id_prod;
		    
		}else{
		   return false;
		} 
	}
</script>
</html>