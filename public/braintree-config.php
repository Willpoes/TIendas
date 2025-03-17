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
	
	$success_msg = "";
	$braintree_id = "";
	$env = "";
	$merchant = "";
	$public_key = ""; 
	$private_key = "";
	if(!empty($_GET["braintree"]) && $_GET["braintree"] == "true"){
		$count = 1;
		foreach (find_braintree() as $b_tree){
			if( $count > 1) break;
			$braintree_id =  $b_tree["id"];
			$env =  $b_tree["environment"];
			$merchant =  $b_tree["merchant_id"];
			$public_key =  $b_tree["public_key"];
			$private_key =  $b_tree["private_key"];
			$count++;
		}
	}
		
	if(!empty($_GET["successmsg"]) && $_GET["successmsg"] == "true" ){
		$success_msg = get_braintree_msg();
		unset_braintree_msg();
	}
	
?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


	<section class="main-body">
		<?php require("common/sidebar.php"); ?>
		
	
		<div class="main-contents">
			<div class="braintree-config">
				<?php if($error_msg != "") echo get_error_msg(); ?>
				<h5 class="mb-10"><?php if($success_msg != "") echo $success_msg; ?></h5>
				
				<form action="../private/update_braintree.php" method="post">
					<input type="hidden" name="id" value="<?php echo $braintree_id; ?>">
					<input type="hidden" name="user_id" value="<?php echo $admin_id; ?>">
					<div class=""><span>Environment : </span><input type="text" name="environment" placeholder="Environment" value="<?php echo $env; ?>"></div>
					<div class=""><span>Merchant ID : </span><input type="text" name="merchant_id" placeholder="Merchant ID" value="<?php echo $merchant; ?>"></div>
					<div class=""><span>Public Key : </span><input type="text" name="public_key" placeholder="Public Key" value="<?php echo $public_key; ?>"></div>
					<div class=""><span>Private Key : </span><input type="text" name="private_key" placeholder="Private Key" value="<?php echo $private_key; ?>"></div>
					<div class=""><button class="submit btn" name="submit" type="submit"><b>ACTUALIZAR</b><button></div>
				</form>
			</div><!-- main-content -->
		</div><!-- main-content -->
	</section><!--main-body -->
	
	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>