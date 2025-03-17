<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php

$error_msg = (!empty($_SESSION['errors'])) ? get_error_msg() : "";

$admin_id = "";
$username = "";
$admin_info = logged_in();
if(!empty($admin_info)){
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
}else redirect_to_login();


$message = "";
$message_param = "push_notification";
if(!empty(get_session_msg($message_param))){
    $message = get_session_msg($message_param);
    unset_session_msg($message_param);
}


?>

<?php require("common/head.php"); ?>

<body>

<?php require("common/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common/sidebar.php"); ?>


    <div class="main-contents">
        <div class="recent-products">

            <div class="add-product">
                <div class="message-wrapper">
                    <h5 class="message"><?php echo $message; ?></h5>
                </div>
                
                <?php if($error_msg != "") echo $error_msg; ?>

                <form action="../private/send_push_noti.php" method="POST">

                    <input type="text" name="push_title" placeholder="<?php echo $lang['asunto']; ?>" >
                    <input type="text" name="push_desc" placeholder="<?php echo $lang['mensaje']; ?>" >

                    <button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['enviar']; ?></b></button>
                </form>

            </div><!-- add-product -->

        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>