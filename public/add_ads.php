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

$adds = [];
$adds_id = "";
$adds_title = "";
$adds_description = "";


$url_foto = "";

$fecha_registro = "";
$adds_dateExpired = "";
$adds_Type = "";

//CLIENTE
$Cliente = "";
$celular = "";
$correo = "";
$Contacto = "";

if(!empty($_GET) && isset($_GET['adds_id'])){
    $adds_id = $_GET['adds_id'];
    $adds = find_adds_by_id($adds_id);
    $adds_title = $adds['titulo'];
    $adds_description = $adds['descripcion'];
    $adds_type = $adds['tipo_anuncio'];
    $fecha_registro = explode(' ',$adds['fecha_registro'])[0] ;
    $adds_dateExpired = $adds['fecha_expira'];
    $url_foto = $adds['url_foto'];
    $Cliente = $adds['RazonSocial'];
    $celular = $adds['Celular'];
    $correo = $adds['Correo'];
    $Contacto = $adds['Contacto'];

    // var_dump( $category_tipo_tabla );
}
$image_link = dir_adds() . $url_foto;

if(empty($adds)){
    $redirected_link = "insert_adds.php";
    $btn_text = $lang['Registrar'];
}else{
    $redirected_link = "update_adds.php?adds_id=". $adds_id;					
    $btn_text = $lang['Actualizar'];
}

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
                <h3><?php echo $lang['AdministradorAnuncios'] ?></h3>

                <form action="../private/<?php echo $redirected_link; ?>" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="adds_id" value="<?php echo $adds_id; ?>">
                    <input type="hidden" name="photo" value ="<?php echo $url_foto; ?>">
                    <div class="img-uploader">
						<h5 class="upload-title"><?php echo $lang['UploadPhoto'] ?></h5>
						<img id="img-uploaded" src="<?php echo $image_link; ?>" alt="" />
						<div class="file-wrapper">
							<a href="#" class="upload-btn"></a>
							<input type="file" name="adds_image" class="uploader">
						</div>
					</div><!-- img-uploader -->

                    <input type="text" name="title" placeholder="<?php echo $lang['TituloAnuncio'] ?>" value="<?php echo $adds_title; ?>">
                    <input type="text" name="description" placeholder="<?php echo $lang['MensajeAnuncio'] ?>" value="<?php echo $adds_description; ?>">
                    
                    <br><br>
                    <label><?php echo $lang['TipoAnuncio'] ?></label>
                    <select name="type" value="<?php echo $adds_type; ?>">
                        <option value="Pantalla princial y listado">Pantalla princial y listado</option>
                        <option value="Pantalla detalle y carrito">Pantalla detalle y carrito</option>
                    </select>

                    <br><br>
                    <label><?php echo $lang['Cliente'] ?></label>
                    <input type="text" name="RazonSocial" placeholder="<?php echo $lang['RazonSocial'] ?>" value="<?php echo $Cliente; ?>">
                    <input type="number" name="celular" placeholder="<?php echo $lang['celular'] ?>" value="<?php echo $celular; ?>">
                    <input type="email" name="Correo" placeholder="<?php echo $lang['Correo'] ?>" value="<?php echo $correo; ?>">
                    <input type="text" name="Contacto" placeholder="<?php echo $lang['Contacto'] ?>" value="<?php echo $Contacto; ?>">
                    
                    <br><br>
                    <label><?php echo $lang['FechaCreacion'] ?></label>
                    <input type="date" name="fecha_create" value="<?php echo $fecha_registro; ?>">
                    <br><br>
                    <label><?php echo $lang['FechaExpiracion'] ?></label>
                    <input type="date" name="fecha_expira" value="<?php echo $adds_dateExpired; ?>">

                    <button class="mt-20 btn" name="submit" type="submit"><b><?php echo $btn_text ?></b></button>
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