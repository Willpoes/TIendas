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

$adds = find_ads();
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

           <div class="message-wrapper">
                <h5 class="message"><?php echo $lang['ListAnuncios']; ?></h5>
                <h6><a class="add-product-btn btn" href="add_ads.php">+ <?php echo $lang['NewADS']; ?></a></h6>
            </div>
            
            <div class="tbl-wrapper">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo $lang['Titulo']; ?></th>
                            <th><?php echo $lang['Descripcion']; ?></th>
                            <th><?php echo $lang['FechaCreacion']; ?></th>
                            <th><?php echo $lang['FechaExpiracion']; ?></th>
                            <th><?php echo $lang['tipo']; ?></th>
                            <th><?php echo $lang['Cliente']; ?></th>
                            <th><?php echo $lang['accion']; ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($adds as $key) {
                        ?>
                        <tr
                                style="<?php
                                $date1 = new DateTime($key['fecha_expira']);
                                $date2 = new DateTime("now");
                                $diff = $date2->diff($date1);
                                if($diff->days<= 5)
                                {
                                    echo 'background-color: red;';
                                }
                                
                                ?>"
                        >
                            <td><?php echo $key['id_anuncio'];?></td>
                            <td><?php echo $key['titulo'];?></td>
                            <td><?php echo $key['descripcion'];?></td>
                            <td><?php echo $key['fecha_registro'];?></td>
                            <td><?php echo $key['fecha_expira'];?></td>
                            <td><?php echo $key['tipo_anuncio'];?></td>
                            <th><?php echo $key['RazonSocial']; ?></th>
                            <td>
                                <a href="add_ads.php?adds_id=<?php echo $key['id_anuncio'];?>"><?php echo $lang['Editar']; ?></a>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                        
                       
                    </tbody>
                    
                </table>
                
            </div>

        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>

<!-- Main Script -->
<script src="common/script.js"></script>


</body>
</html>