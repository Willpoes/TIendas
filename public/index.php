<?php require_once('../private/init.php');
include "../configuration.php"; ?>
<?php

$admin_id = "";
$username = "";
$admin_info = logged_in();
if (!empty($admin_info)) {
	$admin_id = $admin_info[0];
	$username = $admin_info[1];
} else
	redirect_to_login();

$page = 0;
$count = 15;
$prev = false;
$next = true;

if (!empty($_GET['next'])) {
	$page = $_GET['next'];

} else if (!empty($_GET['prev'])) {
	$page = $_GET['prev'];
}

if ($page > 0)
	$prev = true;
else
	$prev = false;

$orders = find_orders_by_count(($page * $count), $count);

if (count($orders) > $count) {
	$message = "mostrar " . ($page * $count) . " a " . (($page * $count) + $count) . " pedidos.";
} else {
	$message = "mostrar " . ($page * $count) . " a " . (($page * $count) + count($orders)) . " pedidos.";
}

$message_param = "order";
if (empty($orders)) {
	$next = false;
	$message = "No se encontraron pedidos.";
} else if (!empty(get_msg_all($message_param))) {
	$next = true;
	$message = get_msg_all($message_param);
	unset_msg_all($message_param);
}

$start_date = date('Y-m-d');
$end_date = date('Y-m-d', strtotime("-30 days"));

$one_mnth_orders = find_orders_between_dates($start_date, $end_date);

$todays_order = find_orders_of_today();
$todays_revenue = get_revenue_by_orders($todays_order);
$mnth_revenue = get_revenue_by_orders($one_mnth_orders);

?>

<?php require("common/head.php"); ?>

<body>

	<?php require("common/heading_menu.php"); ?>

	<section class="main-body">
		<?php require("common/sidebar.php"); ?>

		<div class="main-contents">

			<?php if ($_SESSION['grobaltype'] == 0) { ?>

				<div class="oflow-hidden mlr--10">
					<div class="dash-info">
						<div class="dash-info-inner">
							<h2><b><?php echo count($todays_order); ?></b></h2>
							<h5><?php echo $lang['PedidosHoy'] ?></h5>
						</div>
					</div>

					<div class="dash-info">
						<div class="dash-info-inner">
							<h2><b><?php echo get_currency() . " " . $todays_revenue; ?></b></h2>
							<h5><?php echo $lang['IngresoHoy'] ?></h5>
						</div>
					</div>

					<div class="dash-info">
						<div class="dash-info-inner">
							<h2><b><?php echo get_currency() . " " . $mnth_revenue; ?></b></h2>
							<h5><?php echo $lang['IngresoUMes'] ?></h5>
						</div>
					</div>
				</div>

			<?php } ?>

			<?php if ($_SESSION['grobaltype'] == 4) {

			} ?>
		</div>
	</section>

	<!-- jQuery library -->
	<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

	<!-- Main Script -->
	<script src="common/script.js"></script>
</body>

</html>