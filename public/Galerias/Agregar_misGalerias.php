<?php
include "config.php";  
$con = connection();
session_start();

// Inicializar variables
$user_id = '';
$first_name = '';
$last_name = '';
$mother_last_name = '';
$username = '';
$email = '';
$password = ''; // Sin encriptación
$mobile = '';
$department = '';
$province = '';
$district = '';
$business_name = '';
$address = ''; // Asegúrate de que esta variable esté inicializada
$type = 5; // Asignar un tipo fijo de 5
$ruc = '';
$bank_account = '';
$status = isset($usuario['status']) ? $usuario['status'] : 0; // Por defecto 0 (pendiente)
$user_id_Type4 = $_SESSION['admin_id']; //id de type 4
$fecha='';

// Cargar datos del usuario si se está editando
if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    $query = $con->prepare("SELECT * FROM users WHERE user_id = ?");
    $query->execute([$user_id]);
    $usuario = $query->fetch();

    if ($usuario) {
        $first_name = $usuario['first_name'];
        $last_name = $usuario['last_name'];
        $mother_last_name = $usuario['mother_last_name'];
        $username = $usuario['username'];
        $email = $usuario['email'];
        $password = $usuario['password'];
        $mobile = $usuario['mobile'];
        $department = $usuario['department'];
        $province = $usuario['province'];
        $district = $usuario['district'];
        $business_name = $usuario['business_name'];
        $address = $usuario['address']; // Asegúrate de que este campo se esté capturando correctamente
        $ruc = $usuario['ruc'];
        $bank_account = $usuario['bank_account'];
        $fecha=$usuario['date'];
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $user_id = $_POST['user_id']; // Agregar user_id
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mother_last_name = $_POST['mother_last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Sin encriptación
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address']; // Asegúrate de que este campo se esté capturando correctamente
    $ruc = $_POST['ruc'];
    $bank_account = $_POST['bank_account'];
    $fecha=$_POST['date'];

    // Verificar si el nombre de usuario ya existe
    $verificar = $con->prepare("SELECT * FROM users WHERE username = ? AND user_id != ?");
    $verificar->execute([$username, $user_id]);
    $resultado = $verificar->fetch();

    if ($resultado !== false) {
        echo "Error: El nombre de usuario ya está registrado en el sistema.";
    } else {
        // Insertar o actualizar usuario en la tabla users
        if (isset($_GET['edit'])) {
            $user_id = $_GET['edit'];
            $fecha = $_POST['date'];
            // Actualizar usuario
            $guardar = $con->prepare("UPDATE users SET first_name = ?, last_name = ?, mother_last_name = ?, username = ?, id_gerente_galeria=?, email = ?, password = ?, mobile = ?, department = ?, province = ?, district = ?, business_name = ?, address = ?, type = ?, ruc = ?, date = ?, bank_account = ? WHERE user_id = ?");
            $guardar->execute([$first_name, $last_name, $mother_last_name, $username,$user_id_Type4, $email, $password, $mobile, $department, $province, $district, $business_name, $address, $type, $ruc,$fecha, $bank_account, $user_id]);
        } else {
            // Insertar nuevo usuario
            $guardar = $con->prepare("INSERT INTO users (first_name, last_name, mother_last_name, username, id_gerente_galeria,email, password, mobile, department, province, district, business_name, address, type, ruc, bank_account, status,date) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())");
            $guardar->execute([$first_name, $last_name, $mother_last_name, $username,$user_id_Type4, $email, $password, $mobile, $department, $province, $district, $business_name, $address, $type, $ruc, $bank_account, 0]);
        }

        header("Location: misGalerias.php");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Tienda</title>
    <link rel="stylesheet" href="css/usu_gale_styles.css">
    <link rel="stylesheet" href="../fonts/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../common/styles.css">
    <link rel="stylesheet" href="css/listado_galerias_style.css">
</head>
<body>
<?php include_once 'header_galeria.php'?>
<?php require 'sidebar.php'?>
    <div class="contenedor">
        <div class="titulo">
            <h1><?php echo isset($_GET['edit']) ? 'Editar Usuario' : 'Registrar Usuario'; ?></h1>
        </div>
        <div class="contenedor-formulario">
            <form method="POST" enctype="multipart/form-data">
                <label for="mobile">Número de Teléfono (Cuenta usuario)</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required>

                <label for="password">Contraseña</label>
                <input type="<?php echo isset($_GET['edit']) ? 'text' : 'password'; ?>" name="password" id="password" required value="<?php echo htmlspecialchars($password) ?>" require>

                <label for="first_name">Nombre</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                
                <label for="last_name">Apellido Paterno</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
                
                <label for="mother_last_name">Apellido Materno</label>
                <input type="text" name="mother_last_name" id="mother_last_name" value="<?php echo htmlspecialchars($mother_last_name); ?>" required>
                
                <?php if (isset($_GET['edit'])): ?>
                <label for="date">Fecha:</label>
                <input type="date" name="date" id="date" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($fecha))); ?>" required>
                <?php endif; ?>
                
                <label for="username">Nombre de Usuario</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
                
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>

                <label for="department">Departamento</label>
                <input type="text" name="department" id="department" value="<?php echo htmlspecialchars($department); ?>" required>
                
                <label for="province">Provincia</label>
                <input type="text" name="province" id="province" value="<?php echo htmlspecialchars($province); ?>" required>
                
                <label for="district">Distrito</label>
                <input type="text" name="district" id="district" value="<?php echo htmlspecialchars($district); ?>" required>
                
                <label for="business_name">Nombre del Negocio</label>
                <input type="text" name="business_name" id="business_name" value="<?php echo htmlspecialchars($business_name); ?>" required>
                
                <label for="address">Dirección</label>
                <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($address); ?>" required> <!-- Agregar campo para address -->
                
                <label for="ruc">RUC</label>
                <input type="text" name="ruc" id="ruc" value="<?php echo htmlspecialchars($ruc); ?>" required>
                
                <label for="bank_account">Razon social</label>
                <input type="text" name="bank_account" id="bank_account" value="<?php echo htmlspecialchars($bank_account); ?>" required>
                
                <input type="hidden" name="type" value="5"> 
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <!-- Asignar un tipo fijo -->
                <input type="submit" value="<?php echo isset($_GET['edit']) ? 'Actualizar' : 'Registrar'; ?>">
            </form>
        </div>
    </div>
</body>
</html>