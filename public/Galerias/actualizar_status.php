<?php
include "config.php";
$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    
    $actualizar = $con->prepare("UPDATE users SET status = ? WHERE user_id = ?");
    $resultado = $actualizar->execute([$status, $user_id]);
    
    echo json_encode(['success' => $resultado]);
} 