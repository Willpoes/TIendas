<?php require_once('../../private/init.php'); include "../../configuration.php";?>
<?php
	
	$admin_id = "";
	$username = "";
	$admin_info = logged_in();
	if(!empty($admin_info)){
		$admin_id = $admin_info[0];
		$username = $admin_info[1];
	}else redirect_to_login();



?>

<?php require('../common/head.php'); ?>


<body>



<?php require("../common/heading_menu.php"); ?>


<section class="main-body">
	<?php require("./sidebar.php"); ?>


	<div class="main-contents">

	<h2>LISTA DE GALERIAS</h2>


	</div><!-- main-content -->




</section><!--main-body -->

	
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>