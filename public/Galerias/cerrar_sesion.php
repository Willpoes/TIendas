<?php
session_start();
session_unset(); 
session_destroy(); 

// Redirigir al inicio de sesión
header("Location: ../index.php");
exit();
?>
