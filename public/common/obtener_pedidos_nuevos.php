<?php 

require_once('../../private/init.php'); 


$nuevos_pedidos = total_visto_courier_pedidos();

if ($nuevos_pedidos > 0) {
	echo "si";
} else {
	echo "no";
}


?>