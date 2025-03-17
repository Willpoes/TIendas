<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php

$ssite_name = ""; $stag = ""; $ssite_logo = ""; $spanel_currency="";$politicas=""; $ssetting_id="";


$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";
$settings = [];
$admin_id = "";
$username = "";
$admin_info = logged_in();
$comisiones=traer_comisiones();

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

<?php require("common_update/head.php"); ?>

<body>

<?php require("common_update/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common_update/sidebar.php"); ?>


    <div class="main-contents">
        <div class="recent-products">
            <div class="message-wrapper">
                <h5 class="message"><?php echo $message; ?></h5>
            </div>

            <div class="braintree-config">
                <?php if($error_msg != "") echo get_error_msg(); ?>

                <form class="form-horizontal form-comision" style="border: 1px solid #ccc; border-radius: 15px; padding: 10px;" action="../private/update_comision.php" method="POST" enctype="multipart/form-data">
                        
                        <?php
                        foreach ($comisiones as $com) {
                           $id_comis=$com['id_comision'];
                            $tipo=$com['tipo'];
                            $cantidad=$com['cantidad'];
                            $estado=$com['estado'];
                            ?>
                        <div class="form-row">
                            <div class="form-group form-check col-1">
                                <?php
                                if ($estado==1) {
                                    ?>
                                    <input type="radio" class="form-check-input rad_comis" id="com_estado" name="com_estado" style="margin-top: -6px;" value="<?php echo $id_comis;?>" checked>
                                    <?php
                                } else {
                                    ?>
                                    <input type="radio" class="form-check-input rad_comis" id="com_estado" name="com_estado" style="margin-top: -6px;" value="<?php echo $id_comis;?>">
                                    <?php
                                }
                                
                                ?>
                                
                                
                            </div>
                            <div class="form-group col-3">
                                <p ><?php echo $tipo;?></p>
                            </div>
                            <div class="form-group col-8">
                                <div class="input-group mb-3 input-group-sm">
                                    <div class="input-group-prepend">
                                        <?php
                                        if ($tipo=="Porcentaje") {
                                            ?>
                                            <span class="input-group-text">%</span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="input-group-text">s/.</span>
                                            <?php
                                        }
                                        
                                        ?>
                                    
                                    </div>
                                    <input type="number" class="form-control" name="mont_comision_<?php echo $id_comis;?>" style="margin-top: 0;" value="<?php echo $cantidad;?>">
                                </div>
                            </div>
                        </div>
                        

                            <?php
                        }
                        ?>
                    
                    <!-- <div class="form-row">
                        <div class="form-check col-1">
                            <input type="radio" class="form-check-input rad_comis" id="com_estado" name="com_estado" style="margin-top: -6px;" value="2">
                            
                        </div>
                        <div class="form-group col-3">
                            <p >Fija</p>
                        </div>
                        <div class="form-group col-8">
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                <span class="input-group-text">s/.</span>
                                </div>
                                <input type="number" class="form-control" style="margin-top: 0;">
                            </div>
                        </div>
                    </div> -->
                    <div class="res_comision" ></div>
                    
                    <button class="mt-20 btn" name="submit" type="submit"><b><?php echo $lang['Actualizar']; ?></b></button>
                </form>

            </div><!-- add-product -->

        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
<script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>

<!-- Main Script -->
<script src="common_update/script.js"></script>


</body>
</html>