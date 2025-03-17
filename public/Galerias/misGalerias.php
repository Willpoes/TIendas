<?php
include "config.php";
$con = connection();
session_start();

// obtener el id del usuario que ha iniciado sesión 
$user_id_Type4 = $_SESSION['admin_id'];

// obtener el type del usuario que ha iniciado sesión 
$userType4 = $_SESSION['grobaltype'];

$query = $con->prepare("SELECT * FROM users WHERE type = 5 AND id_gerente_galeria = :user_id");
$query->bindParam(':user_id', $user_id_Type4, PDO::PARAM_INT);
$query->execute();
$usuarios = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tiendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/listado_galerias_styles.css">
    <link rel="stylesheet" href="../fonts/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../common/styles.css">
</head>

<body>
    <?php include_once 'header_galeria.php' ?>
    <main class="contenedor">
        <?php
        require 'sidebar.php'
            ?>
        <!-- Contenido principal con nueva clase -->
        <div class="main-content">
            <div class="titulo">
                <h1>Listado Tiendas</h1>
                <a href="Agregar_misGalerias.php" class="add-button">Agregar Nuevo Usuario</a>
            </div>

            <div class="contenedor-listado">
                <table>
                    <thead>
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Nombre de Tienda</th>
                            <th>Fecha de creación</th>
                            <th>Teléfono</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1; // Inicializar el contador
                        foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $contador; ?></td>
                                <td><?php echo htmlspecialchars($usuario['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['business_name']); ?></td>
                                <td><?php echo date("d-m-Y", strtotime($usuario['date'])); ?></td>
                                <td><?php echo htmlspecialchars($usuario['mobile']); ?></td>
                                <td>
                                    <select class="status-select"
                                        onchange="actualizarStatus(this.value, <?php echo $usuario['user_id']; ?>)">
                                        <option value="0" <?php echo ($usuario['status'] == 0) ? 'selected' : ''; ?>>Pendiente
                                        </option>
                                        <option value="1" <?php echo ($usuario['status'] == 1) ? 'selected' : ''; ?>>Activo
                                        </option>
                                        <option value="2" <?php echo ($usuario['status'] == 2) ? 'selected' : ''; ?>>Rechazado
                                        </option>
                                    </select>
                                </td>
                                <td class="action-buttons">
                                    <a href="Agregar_misGalerias.php?edit=<?php echo $usuario['user_id']; ?>"
                                        class="edit-button">Editar</a>
                                    <a href="delete_user.php?user_id=<?php echo $usuario['user_id']; ?>"
                                        class="delete-button"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                                </td>
                            </tr>
                            <?php
                            $contador++; // Incrementar el contador
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function actualizarStatus(status, userId) {
            if (confirm('¿Está seguro de cambiar el estado del usuario?')) {
                fetch('actualizar_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'user_id=' + userId + '&status=' + status
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Estado actualizado correctamente');
                        } else {
                            alert('Error al actualizar el estado');
                        }
                    });
            }
        }
    </script>
</body>

</html>