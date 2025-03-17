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

	$users = find_users_by_count(($page *$count), $count);
	
										

	if(count($users) > $count){
		$message = $lang['mostrar'] .' '. ($page * $count) . ' ' . $lang['a'] .' '. (($page * $count) + $count) .' ' . $lang['usuarios'] .".";
	}else{
		$message =$lang['mostrar'] .' '. ($page * $count) . ' ' . $lang['a'] .' '. (($page * $count) + count($users)) .' ' . $lang['usuarios'] .".";
	}


	if(empty($users)){
		$next = false;
		$message = "No se encontraron usuarios.";
	}else if(!empty(get_users_msg())){
		$next = true;
		$message = get_users_msg();
		unset_users_msg();
	}
	
?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
		
	
		<div class="main-contents">
			<div class="user-containe">
				<div class="message-wrapper">
					<h5 class="message"><?php echo $message; ?></h5>
				</div>

				<div class="tbl-wrapper">
					<table class="order-table">

						<thead>
							<tr>
								<!--<th>Imagen</th>-->
								<th><?php echo $lang['Nombre'] ?></th>
								<th><?php echo $lang['Correo'] ?></th>
								<th><?php echo $lang['Direccion'] ?></th>
								<th><?php echo $lang['TipoUsuario'] ?></th>
								<th><?php echo $lang['accion'] ?></th>
							</tr>
						</thead>

						<tbody>

							<?php if(!empty($users)){
								foreach ($users as $user) { ?>


<tr>
<?php
$img_path = "";
if($user["image_name"] == null) $img_path = "images/profile_default.jpg";
else $img_path = "uploads/user-images/".$user["image_name"];
?>

<!--<td class="w-100x"><img class="circle-img-70x" src="<?php echo $img_path; ?>" alt=""></td>-->

<td><?php echo $user["first_name"] . " " . $user["last_name"]; ?></td>
<td><?php echo $user["email"]; ?></td>
<?php
$find_address = find_address_by_address_id($user['address']);
$new_address = concate_address($find_address);
?>



<td><?php echo  $new_address ?><?php echo $user["useraddress"]; ?></td>

<td>
<?php if($user["type"]==0){
echo "Administrador";
}
if($user["type"]==1){
echo "Comprador";
}

if($user["type"]==2){
echo "Vendedor";
}


?>

</td>
<td>
<a class="delete-btn" href="delete_user.php?user_id=<?php echo $user['user_id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
</tr>


								<?php } ?>
							<?php } ?>
						</tbody>
					</table><!-- user -->
				</div>

				<div class="mt-30 center-text nxt-link">
					<?php if($prev){ ?>
						<a href="users.php?prev=<?php echo ($page -1); ?>"> <?php echo $lang['Anterior'] ?></a>
					<?php } ?>
					<?php if($next){ ?>
						<a href="users.php?next=<?php echo ($page + 1); ?>"> <?php echo $lang['Siguiente'] ?></a>
					<?php } ?>
				</div>

			</div><!-- users -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>