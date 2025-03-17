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


	$admob = [];
	$session_var = "admob";
	if(!empty($_GET)){

		$admob = find_admob_by_admin_id($admin_id);

	}
	if(!empty($_POST)){


		$admob['admob_id'] = $_POST['admob_id'];
		$admob['app_id'] = $_POST['app_id'];
		$admob['add_unit_id'] = $_POST['add_unit_id'];

		if(update_admob_by_id($admob)){
			set_session_msg($session_var, "Admob Updated Successfully");
		}else{

		}
	}

	if(session_exists($session_var)){
		$success_msg = get_session_msg($session_var);
		unset_session_msg($session_var);
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
				
				<form action="admob-config.php" method="post">
					<input type="hidden" name="admob_id" value="<?php echo $admob['admob_id']; ?>">
					<input type="hidden" name="user_id" value="<?php echo $admin_id; ?>">
					<div class=""><span>APP ID : </span><input type="text" name="app_id" placeholder="App ID" value="<?php echo $admob['app_id']; ?>"></div>
					<div class=""><span>ADD UNIT ID : </span><input type="text" name="add_unit_id" placeholder="Add Unit ID" value="<?php echo $admob['add_unit_id']; ?>"></div>
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