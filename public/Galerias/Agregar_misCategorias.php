<?php
include "config.php";
include "./php/categorias/listarCategoriasGenerales.php";

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
    <link rel="stylesheet" href="css/listado_galerias_styles.css">
    <link rel="stylesheet" href="../fonts/css/fontawesome-all.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
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
                    <form id="formNuevoProducto" method="POST" action="./php/categorias/agregarCategoria.php"
                        enctype="multipart/form-data">
                        <div>
                            <h1>Crear nueva Categoria</h1>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <br>

                                <div class="mb-3">
                                    <label for="nombreCategoria" class="form-label">Nombre de la Categoria:</label>
                                    <input type="text" id="nombreCategoria" name="nombreCategoria" class="form-control"
                                        required>
                                </div>
                                <br>

                                <div class="mb-3">
                                    <label for="idcategoria" class="form-label">Categoría:</label>
                                    <select id="idcategoria" name="idcategoria" class="form-select" required>
                                        <?php foreach ($resultado as $categoria): ?>
                                            <option value="<?= $categoria['idcategorigeneral'] ?>">
                                                <?= $categoria['nombrecategoriageneral'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>

                                <div class="mb-3">
                                    <label for="idrubro" class="form-label">Rubro:</label>
                                    <select id="idrubro" name="idrubro" class="form-select" required>
                                        <?php foreach ($resultadoListaRubros as $rubro): ?>
                                            <option value="<?= $rubro['idrubro'] ?>">
                                                <?= $rubro['nombrerubro'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                            </div>
                        </div>
                                        <!--hice q postnameaction registrarproducto a registrrarcateg-->
                        <div>
                            <button type="submit" name="registrarcategoria" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </main>

                <script
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>