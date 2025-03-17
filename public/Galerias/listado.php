<?php
    include "config.php";  
    $con = connection();
    session_start();
    
    // Obtener usuarios con type igual a 4
    $query = $con->prepare("SELECT * FROM users WHERE type = 4");
    $query->execute();
    $usuarios = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Galerías</title>
    <link rel="stylesheet" href="css/listado_galerias_styles.css">
    <link rel="stylesheet" href="../fonts/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../common/styles.css">
   
</head>

<body>

    <?php include_once 'header_galeria.php'?>
    <main class="contenedor">
        <?php require 'sidebar.php' ?>
        <!-- Contenido principal con nueva clase -->
        <div class="main-content">
            <div class="titulo">
                <h1>Listado de Dueños de Galerías</h1>
            </div>
    
            <div class="contenedor-listado">
                <label for="username-select">Selecciona un Usuario:</label>
                <select id="username-select" class="username-select" onchange="cargarTiendas(this.value)">
                    <option value="">-- Selecciona un Usuario --</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo htmlspecialchars($usuario['user_id']); ?>">
                            <?php echo htmlspecialchars($usuario['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="tiendas-list" class="contenedor-listado" style="margin-top: 20px;">
                <h2>Tiendas Asociadas:</h2>
                <table id="tiendas-table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de Tienda</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se llenarán las tiendas asociadas -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
    function cargarTiendas(gerenteId) {
        const tableBody = document.querySelector('#tiendas-table tbody');
        tableBody.innerHTML = ''; // Limpiar la tabla antes de cargar nuevos datos

        if (gerenteId) {
            fetch('obtener_tiendas.php?gerente_id=' + gerenteId)
                .then(response => response.json())
                .then(data => {
                    data.forEach((tienda, index) => {
                        console.log('Estado de la tienda:', tienda.status); // Imprimir el estado
                        console.log('Tipo de estado:', typeof tienda.status); // Imprimir el tipo de estado
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class='td-row'>${index + 1}</td> <!-- Número de orden -->
                            <td class='td-row'>${tienda.business_name}</td>
                            <td class='td-row'>${getStatusText(tienda.status)}</td> <!-- Mostrar el estado como texto -->
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error al cargar las tiendas:', error));
        }
    }

    function getStatusText(status) {
        status = Number(status); // Asegúrate de que sea un número
        switch (status) {
            case 0:
                return 'Pendiente';
            case 1:
                return 'Activo';
            case 2:
                return 'Desactivado';
            default:
                return 'Desconocido';
        }
    }
    </script>
</body>
</html>