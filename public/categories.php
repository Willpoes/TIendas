<?php require_once('../private/init.php'); include "../configuration.php";?>
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

$categories = find_all_categories();
$message = $lang['mostrar'] .' '. sizeof($categories) . " ".$lang['Categorias'] .".";
if (empty($categories)) {
    $message = "No Categories Found.";
} else if (!empty(get_category_msg())) {
    $message = get_category_msg();
    unset_category_msg();
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
                <h6><a class="add-product-btn btn" href="add_category.php">+ <?php echo $lang['Newcategoria']; ?></a></h6>
            </div>

            <div class="tbl-wrapper">
                <table class="order-table">
                    <thead>
                    <tr>

                        <th><?php echo $lang['imagen']; ?></th>
                        <th><?php echo $lang['tipo']; ?></th>
                        <th><?php echo $lang['Categoria']; ?></th>
                        <th><?php echo $lang['estado']; ?></th>
                        <th><?php echo $lang['accion']; ?></th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php if (!empty($categories)) {
                        foreach ($categories as $category) { ?>
                            
    <tr>
    <td class="w-100x">

    <img class="circle-img-80x"
     src="<?php echo dir_category_from_php() . $category['image_name']; ?>" alt="">
    </td>

    <td class="w-100x">
    <?php if  ($category['types']==1){echo  $lang['HOMBRES'];}
    if  ($category['types']==2){echo  $lang['MUJERES'];}
    if  ($category['types']==3){echo  $lang['NIÑOS'];} 
    if  ($category['types']==4){echo  $lang['BEBES'];}  ?>

    </td>

    <td class="w-100x">
    <?php echo $category['title']; ?></td>

    <td  class="w-100x">
    <?php if  ($category['status']==1){echo  $lang['ACTIVO'];}
    if  ($category['status']==2){echo  $lang['INACTIVO'];}
    ?>
      
    </td>

    <td class="w-150x">
    <a class="update-btn" href="add_category.php?category_id=<?php echo $category['id'];?>"><i class="fas fa-edit"></i></a>
    <a class="delete-btn" href="delete_category.php?category_id=<?php echo $category['id'];?>"><i class="fas fa-trash-alt"></i></a>
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