<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php

$ssite_name = ""; $stag = ""; $ssite_logo = ""; $spanel_currency="";$politicas=""; $ssetting_id="";


$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";
$settings = [];
$admin_id = "";
$username = "";
$admin_info = logged_in();


if(!empty($admin_info)){
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
    $settings = find_setting_of_admin($admin_id);

	if(!empty($settings['panel_site_name'])) $ssite_name = $settings['panel_site_name'];
	if(!empty($settings['panel_tag_line'])) $stag = $settings['panel_tag_line'];
	if(!empty($settings['panel_logo_name'])) $ssite_logo  = $settings['panel_logo_name'];
	if(!empty($settings['panel_currency'])) $spanel_currency = $settings['panel_currency'];
	if(!empty($settings['setting_id'])) $ssetting_id = $settings['setting_id'];
	if(!empty($settings['politicas'])) $politicas = $settings['politicas'];


}else{
    redirect_to_login();
}

$message = "";
$message_param = "setting";
if(empty($settings)){
    $message = "No Settings Found.";
}else if(!empty(get_msg_all($message_param))){
    $message = get_msg_all($message_param);
    unset_msg_all($message_param);
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
            </div>

            <div class="braintree-config">
                <?php if($error_msg != "") echo get_error_msg(); ?>

                <form action="../private/update_setting.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="setting_id" value="<?php echo $ssetting_id; ?>">
                    <input type="hidden" name="site_logo_prev" value="<?php echo $ssite_logo; ?>">

                    <div class="img-uploader mb-15">
                        <h5 class="upload-title">Suelta / Sube tu imagen aquí</h5>
                        <img id="img-uploaded" src="<?php echo $site_logo; ?>" alt="" />
                        <div class="file-wrapper">
                            <a href="#" class="upload-btn"></a>
                            <input type="file" name="site_logo" class="uploader">
                        </div>
                    </div><!-- img-uploader -->

                    <div><span><?php echo $lang['Tienda']; ?> : </span><input type="text" name="site_title" placeholder="<?php echo $lang['Tienda']; ?>" value="<?php echo $ssite_name; ?>"></div>
                    <!--<div><span>Stand : </span></div>-->

                    <input type="hidden" name="site_tag" placeholder="" value="<?php echo $stag; ?>">


                     <div><span><?php echo $lang['Politicas']; ?> : </span>



					<textarea id="politicas" name="politicas" rows="20" cols="50"><?php echo $politicas; ?></textarea>


                   


                     </div>
                     <!--<div><div>Site Currency : </span></div>-->
                     <input type="hidden" name="site_currency" placeholder="Admin Panel Currency" value="<?php echo $spanel_currency; ?>">


                     

                    <button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['Actualizar']; ?></b></button>
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