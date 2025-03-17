<?php
include "config.php";
$con = connection();
session_start();
$userType4 = $_SESSION['grobaltype'];

// Verificar si se recibió el ID del usuario a eliminar
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {
        //  consulta para eliminar el usuario
        $query = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);


        if ($query->execute()) {

            $_SESSION['success_message'] = "Usuario eliminado correctamente.";
        } else {

            $_SESSION['error_message'] = "No se pudo eliminar el usuario.";
        }
    } catch (PDOException $e) {

        $_SESSION['error_message'] = "Error al eliminar el usuario: " . $e->getMessage();
    }
} else {
    $_SESSION['error_message'] = "ID de usuario no proporcionado.";
}
if ($userType4 === '4') {
    header("Location: misGalerias.php");
    exit();
} else {
    header("Location: listado_galerias.php");
    exit();
}
?>