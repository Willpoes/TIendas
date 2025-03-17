<?php
include "config.php";  
$con = connection();
session_start();

if (isset($_GET['gerente_id'])) {
    $gerente_id = $_GET['gerente_id'];

    // Obtener usuarios con type igual a 5 y que están asociados al gerente
    $query = $con->prepare("SELECT user_id, business_name, status FROM users WHERE type = 5 AND id_gerente_galeria = ?");
    $query->execute([$gerente_id]);
    $tiendas = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tiendas);
}
?>