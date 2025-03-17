<?php
include "config.php";
include "./php/categorias/listarCategorias.php";

$con = connection();
session_start();

// Obtener el id y el type del usuario que ha iniciado sesión
$user_id_Type4 = $_SESSION['admin_id'];
$userType4 = $_SESSION['grobaltype'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Categorías</title>
    <link rel="stylesheet" href="../common/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/listado_categorias.css">
    <link rel="stylesheet" href="css/listado_galerias_style.css">
    <link rel="stylesheet" href="css/listado_galerias_styles.css">
    <link rel="stylesheet" href="../fonts/css/fontawesome-all.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <?php include_once 'header_galeria.php'; ?>
    <main>
        <?php require 'sidebar.php'; ?>

        <div class="container-fluid">

            <!-- Header -->
            <div class="row">
                <!-- LISTADO DE CATEGORÍAS -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                    <div>
                        <h2>Gestión de Categorías</h2>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <div class="input-group w-25">
                            <input type="text" class="form-control" placeholder="Buscar categorías...">
                            <button class="btn btn-primary" type="button" id="search-btn">
                                <i class='bx bx-search icon'></i>
                            </button>
                        </div>
                        <a href="Agregar_misCategorias.php" class="btn btn-primary">+ Agregar Categoría</a>
                    </div>

                    <div>
                        <table id="miTabla" class="table text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Rubro</th>
                                    <th>Categoria</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultado as $row): ?>
                                    <tr>
                                        <td><?= $row['idcategoria']; ?></td>
                                        <td><?= $row['nombrecategoria']; ?></td>
                                        <td><?= $row['nombrerubro']; ?></td>
                                        <td><?= $row['nombrecategoriageneral']; ?></td>
                                        <td>
                                            <!--1-->
                                            <button class="btn btn-primary detalle-btn" type="button" data-bs-toggle="modal"
                                                data-bs-target="#detalleCategoriaModal"
                                                data-nombre="<?= $row['nombrecategoria']; ?>"
                                                data-rubro="<?= $row['nombrerubro']; ?>"
                                                data-categoria="<?= $row['nombrecategoriageneral']; ?>">
                                                <i class='bx bxs-webcam'></i>
                                            </button>

                                            <!--2-->
                                            <form action="editarCategoria.php" method="GET" style="display:inline;">
                                                <input type="hidden" name="pedirCategoria"
                                                    value="<?= $row['idcategoria']; ?>">
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class='bx bx-edit'></i>
                                                </button>
                                            </form>
                                            <!--3-->
                                            <form action="./php/categorias/eliminarCategoria.php" method="POST"
                                                style="display:inline;" onsubmit="return confirmarEliminacion()">
                                                <input type="hidden" name="idcategoria" value="<?= $row['idcategoria']; ?>">
                                                <button type="submit" name="eliminarCategoria" class="btn btn-danger">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="detalleCategoriaModal" tabindex="-1"
                            aria-labelledby="detalleCategoriaModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detalleCategoriaModalLabel">Detalles de la Categoría
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                                        <p><strong>Rubro:</strong> <span id="modalRubro"></span></p>
                                        <p><strong>Tipo de Categoría:</strong> <span id="modalCategoria"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmarEliminacion() {
            return confirm("¿Segyr de que deseas eliminar categoríA?");
        }

        $(document).ready(function () {
            $('#miTabla').DataTable({
                paging: true,
                ordering: true,
                info: true,
                lengthChange: false,
                searching: false,
                pageLength: 7,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const detalleButtons = document.querySelectorAll('.detalle-btn');
            const modalNombre = document.getElementById('modalNombre');
            const modalRubro = document.getElementById('modalRubro');
            const modalCategoria = document.getElementById('modalCategoria');

            detalleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const nombre = this.getAttribute('data-nombre');
                    const rubro = this.getAttribute('data-rubro');
                    const categoria = this.getAttribute('data-categoria');

                    modalNombre.textContent = nombre;
                    modalRubro.textContent = rubro;
                    modalCategoria.textContent = categoria;
                });
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#search-btn').click(function () {
                const searchText = $('.form-control').val().toLowerCase();

                $('#miTabla tbody tr').each(function () {
                    const rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('.form-control').on('keyup', function () {
                const searchText = $(this).val().toLowerCase();

                $('#miTabla tbody tr').each(function () {
                    const rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>


</body>

</html>