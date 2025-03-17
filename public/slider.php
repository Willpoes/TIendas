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

$slider = find_all_slider();
$message = $lang['mostrar'] .' '. sizeof($slider) . " Slider.";
if (empty($slider)) {
    $message = "No Slider Found.";
} else if (!empty(get_slider_msg())) {
    $message = get_slider_msg();
    unset_slider_msg();
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
                <h6><a class="add-product-btn btn" href="add_slider.php">+ <?php echo $lang['NewSlider']; ?></a></h6>
            </div>

            <div class="tbl-wrapper">
                <table class="order-table">
                    <thead>
                    <tr>

                        <th><?php echo $lang['imagen']; ?></th>
                        <th><?php echo $lang['Slider']; ?></th>
                        <th><?php echo $lang['estado']; ?></th>
                        <th><?php echo $lang['accion']; ?></th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php if (!empty($slider)) {
                        foreach ($slider as $slider) { ?>
                            
    <tr>
    <td class="w-100x">

    <img class="circle-img-80x"
     src="<?php echo dir_slider_from_php() . $slider['image_name']; ?>" alt="">
    </td>


    <td class="w-100x">
    <?php echo $slider['title']; ?></td>

    <td  class="w-100x">
   
    </td>

    <td class="w-150x">
    <a class="update-btn" href="add_slider.php?slider_id=<?php echo $slider['id'];?>"><i class="fas fa-edit"></i></a>
    <a class="delete-btn" href="delete_slider.php?slider_id=<?php echo $slider['id'];?>"><i class="fas fa-trash-alt"></i></a>
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