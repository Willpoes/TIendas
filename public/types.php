<?php require_once('../private/init.php'); ?>
<?php

$admin_id = "";
$username = "";
$admin_info = logged_in();
if (!empty($admin_info)) {
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
} else {
    redirect_to_login();
}

$types = find_all_types();
$message = "Mostrar " . sizeof($types) . " Categorias.";
if (empty($types)) {
    $message = "No Categories Found.";
} else if (!empty(get_type_msg())) {
    $message = get_type_msg();
    unset_type_msg();
}

?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common/sidebar.php"); ?>

    <div class="main-contents">
        <div class="recent-products">
            <div class="message-wrapper">
                <h5 class="message"><?php echo $message; ?></h5>
                <h6><a class="add-product-btn btn" href="add_type.php">+ añadir categoría</a></h6>
            </div>

            <div class="tbl-wrapper">
                <table class="order-table">
                    <thead>
                    <tr>

                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php if (!empty($types)) {
                        foreach ($types as $type) { ?>
                            <tr>
                                <td class="w-250x">

                                    <img class="circle-img-150x"
                                         src="<?php echo dir_type_from_php() . $type['image_name']; ?>" alt="">
                                </td>

                                <td class="w-200x"><?php echo $type['title']; ?></td>

                                <td class="w-150x">
                                    <a class="update-btn"
                                       href="add_type.php?type_id=<?php echo $type['id']; ?>"><i
                                            class="fas fa-edit"></i></a>
                                    <a class="delete-btn"
                                       href="delete_type.php?type_id=<?php echo $type['id']; ?>"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>


                    </tbody>
                </table>

            </div><!-- recent-products -->
        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>