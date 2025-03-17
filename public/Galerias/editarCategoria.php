<?php
include "config.php";
include "./php/categorias/agregarCategoria.php";
include_once "./php/categorias/listarCategoriasGenerales.php";

$categorias = new CategoriasGenerales();
$resultado = $categorias->obtenerCategorias();

$rubros = new CategoriasGenerales();
$resultadoListaRubros = $rubros->obtenerRubros();

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
                    <h2>Modificar Categoría</h2>
                    <br>

                    <form method="POST" action="./php/categorias/editarCategoria.php" enctype="multipart/form-data"
                        onsubmit="return confirmarEdicion()">
                        <input type="text" class="form-control" id="idCategoria" name="idCategoria"
                            value="<?= $categoria['idCategoria']; ?>" readonly>

                        <div class="mb-3">
                            <label for="nombreCategoria" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria"
                                value="<?= $categoria['nombreCategoria']; ?>" required>
                        </div>
                        <br>

                        <div class="mb-3">
                            <label for="idrubro" class="form-label">Rubro</label>
                            <select id="idrubro" name="idrubro" class="form-select" required>
                                <option value="" disabled selected> Actualmente esta en:
                                    <?= $categoria['nombreRubro'] ?>
                                </option>
                                <?php foreach ($resultadoListaRubros as $rubro): ?>
                                    <option value="<?= $rubro['idrubro'] ?>">
                                        <?= $rubro['nombrerubro'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>

                        <div class="mb-3">
                            <label for="idtipocategoria" class="form-label">Categoría:</label>
                            <select id="idtipocategoria" name="idtipocategoria" class="form-select" required>
                                <option value="" disabled selected> Actualmente esta en:
                                    <?= $categoria['nombreTipoCategoria'] ?>
                                </option>
                                <?php foreach ($resultado as $categoria): ?>
                                    <option value="<?= $categoria['idcategorigeneral'] ?>">
                                        <?= $categoria['nombrecategoriageneral'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>

                        <button type="submit" name="modificarcategoria" class="btn btn-primary">Modificar</button>
                    </form>

                    <script>
                        function confirmarEdicion() {
                            return confirm("¿seguro de que desea modificarLO?");
                        }
                    </script>
                </main>

                <script
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>