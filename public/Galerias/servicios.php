<?php
include 'config.php';

// Obtener la conexión PDO
$conn = connection();

// Verificar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Conexión fallida");
}

// Obtener los servicios iniciales
$sql = "SELECT s.*, t.username AS nombre_tienda, c.nombre AS nombre_categoria
        FROM servicios_generales s
        JOIN users t ON s.id_tienda = t.user_id
        JOIN categorias_general c ON s.id_categoria = c.id_categorias";
$stmt = $conn->prepare($sql);
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios</title>
    <link rel="stylesheet" href="css/servicios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Gestión de Servicios</h2>
        </div>
        <div class="search-container">
            <input type="text" id="search" placeholder="Buscar servicios...">
            <button class="add-button" onclick="window.location.href='form_agregar_servicio.php'">
                <i class="fas fa-plus"></i> Agregar Servicio
            </button>
        </div>
        <table id="results">
            <tr>
                <th>ID</th>
                <th>Nombre del Servicio</th>
                <th>Descripción</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Precio Aprox.</th>
                <th>Precio de Oferta</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($servicios) {
                foreach ($servicios as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_servicios'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['correo'] . "</td>";
                    echo "<td>" . $row['precio_aprox'] . "</td>";
                    echo "<td>" . $row['precio_oferta'] . "</td>";
                    echo "<td><img src='" . $row['imagen'] . "' width='50'></td>";
                    echo "<td class='acciones'>";
                    echo "<button class='ver' onclick=\"openModal(" . $row['id_servicios'] . ")\"><i class='fas fa-eye'></i></button>";
                    echo "<button class='editar' onclick=\"window.location.href='editar_servicio.php?id=" . $row['id_servicios'] . "'\"><i class='fas fa-edit'></i></button>";
                    echo "<button class='eliminar' onclick=\"confirmDelete(" . $row['id_servicios'] . ")\"><i class='fas fa-trash'></i></button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay servicios disponibles</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Estructura modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Detalles del Servicio</h2>
            <div id="modal-body">
                <!-- Detalles del servicio se cargarán aquí -->
            </div>
        </div>
    </div>

    <!-- Contenedor de notificaciones -->
    <div class="notification-container" id="notification-container"></div>

    <script>
        // Obtener el modal
        var modal = document.getElementById("myModal");

        // Obtener el <span> que cierra el modal
        var span = document.getElementsByClassName("close")[0];

        // Cerrar el modal cuando se haga clic en <span> (x)
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Cerrar el modal cuando se haga clic fuera de él
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Función para abrir el modal y cargar los detalles del servicio
        function openModal(id) {
            modal.style.display = "block";
            fetch('detalles_servicio.php?id=' + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('modal-body').innerHTML = `
                        <p><strong>ID:</strong> ${data.id_servicios}</p>
                        <p><strong>Nombre del Servicio:</strong> ${data.nombre}</p>
                        <p><strong>Descripción:</strong> ${data.descripcion}</p>
                        <p><strong>Teléfono:</strong> ${data.telefono}</p>
                        <p><strong>Correo:</strong> ${data.correo}</p>
                        <p><strong>Precio Aprox:</strong> ${data.precio_aprox}</p>
                        <p><strong>Precio de Oferta:</strong> ${data.precio_oferta}</p>
                        <p><strong>Imagen:</strong> <img src='${data.imagen}' width='100'></p>
                        <p><strong>Tienda:</strong> ${data.nombre_tienda}</p>
                        <p><strong>Categoría:</strong> ${data.nombre_categoria}</p>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('modal-body').innerHTML = `
                        <p>Error al cargar los detalles del servicio.</p>
                    `;
                });
        }

        // Función para mostrar una notificación
        function showNotification(message, type = 'success') {
            const notificationContainer = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.classList.add('notification', type);
            notification.innerText = message;
            notificationContainer.appendChild(notification);

            // Mostrar la notificación
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);

            // Ocultar la notificación después de 3 segundos
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notificationContainer.removeChild(notification);
                }, 500);
            }, 3000);
        }

        // Función para confirmar la eliminación de un servicio
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este servicio?')) {
                fetch('eliminar_servicio.php?id=' + id)
                    .then(response => {
                        if (response.ok) {
                            showNotification('Servicio eliminado con éxito', 'success');
                            // Recargar la tabla de servicios
                            location.reload();
                        } else {
                            showNotification('Error al eliminar el servicio', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error al eliminar el servicio', 'error');
                    });
            }
        }

        document.getElementById('search').addEventListener('input', function () {
            const searchTerm = this.value;
            fetch('buscar_servicios.php?search=' + searchTerm)
                .then(response => response.json())
                .then(data => {
                    const resultsTable = document.getElementById('results');
                    resultsTable.innerHTML = `
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Servicio</th>
                            <th>Descripción</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Precio Aprox.</th>
                            <th>Precio de Oferta</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                        ${data.map(row => `
                            <tr>
                                <td>${row.id_servicios}</td>
                                <td>${row.nombre}</td>
                                <td>${row.descripcion}</td>
                                <td>${row.telefono}</td>
                                <td>${row.correo}</td>
                                <td>${row.precio_aprox}</td>
                                <td>${row.precio_oferta}</td>
                                <td><img src='${row.imagen}' width='50'></td>
                                <td class='acciones'>
                                    <button class='ver' onclick="openModal(${row.id_servicios})"><i class='fas fa-eye'></i></button>
                                    <button class='editar' onclick="window.location.href='editar_servicio.php?id=${row.id_servicios}'"><i class='fas fa-edit'></i></button>
                                    <button class='eliminar' onclick="confirmDelete(${row.id_servicios})"><i class='fas fa-trash'></i></button>
                                </td>
                            </tr>
                        `).join('')}
                    `;
                });
        });
    </script>
</body>

</html>