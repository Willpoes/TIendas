<?php
session_start();
include "configuration.php"
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Aplicacion de gamarra para vender todo tipo de ropa y textil.">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <script src="js/sweetalert2/dist/sweetalert2.min.css"></script>
        <script src="js/jquery-2.2.4.min.js"></script>
        <script src="js/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="js/sweetalert2/dist/sweetalert2.min.css">

        <!-- Title -->
        <title><?php echo $lang['title'] ?></title>

        <!-- Favicon -->
        <link rel="icon" href="img/logo.png">

        <!-- Core Stylesheet -->
        <link href="style.css" rel="stylesheet">

        <!-- Responsive CSS -->
        <link href="css/responsive.css" rel="stylesheet">

        <!-- alertas -->
        <link href="css/responsive.css" rel="stylesheet">



        <style>
            .icono {
                width: 50px;
                height: 50px;
                background: rgb(77, 194, 71);
                order: 2;
                padding: 5px;
                box-sizing: border-box;
                border-radius: 50%;
                margin: 1em auto;
                cursor: pointer;
                overflow: hidden;
                box-shadow: rgba(0, 0, 0, 0.4) 2px 2px 6px;
                transition: all 0.5s ease 0s;
                position: relative;
                z-index: 200;
                display: block;
                border: 0px;
            }

            @media (min-width: 320px) and (max-width: 767px) {

                .fondo {
                    background-image: url(img/bg-img/welcome-bg2.png);
                    background-color: #11a571ba;
                }
            }

            .form-control{
                border-color:#00b558;
            }
            .form-control::placeholder {
                color:#726a84;
            }
            #ca-navbar ul li a:focus{
                /*background-size: 100% 2px;
                //background-color: #00b558;*/
                text-decoration: underline;
                text-underline-offset: 0.5em;
                text-decoration-thickness: 4px;

            }

            .swal2-popup{
                /*width:1140px !important;
                height: 800px !important;*/
            }
        </style>    

        <script>

            function valform() {
                if ($("#nombre").val().length === 0) {
                    alert("Ingresar datos");
                    return false;
                }
                if ($("#correo").val().length === 0) {
                    alert("Ingresar datos");
                    return false;
                }
                if ($("#celular").val().length === 0) {
                    alert("Ingresar datos");
                    return false;
                }
                if ($("#edad").val().length === 0) {
                    alert("Ingresar datos");
                    return false;
                }
                return true;
            }

            function clean() {

                $(".form-control").each(function () {
                    $(".form-control").val("");
                });
            }


            $(document).ready(function () {
                Swal.fire({
                    title: '',
                    width: '1140px',
                    height: '800px',
                    allowOutsideClick: false,
                    html: '<section class="special-area bg-white section_padding_100" id="about">' +
                            '<div class="container">' +
                            '<div class="row">' +
                            '<div class="col-12 col-md-4">' +
                            '<div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">' +
                            '<div class="single-icon">' +
                            '<i class="" aria-hidden="true">' +
                            '<img src="img/chicooo.png" width="300" height="300">' +
                            '</i>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-12 col-md-4">' +
                            '<div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">' +
                            '<h2 class="text-center font-weight-bold" style="color:#00b558;font-family:sans-serif;font-size: 14px;"><?php echo $lang['PonteContacto'] ?></h2>' +
                            '<h2 class="text-center font-weight-bold" style="color:#00b558;font-family:sans-serif;font-size: 14px;"><?php echo $lang['PonteContactoTitle'] ?></h2>' +
                            '<center><p style="font-size:14px;"><?php echo $lang['PonteContactoDesc'] ?></p></center>' +
                            '<form action="#">' +
                            '<div class="form-group">' +
                            '<input type="text" class="form-control" id="nombre" placeholder="<?php echo $lang['NomApelliContacto'] ?>">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<input type="text" class="form-control" id="correo" placeholder="<?php echo $lang['EmailContacto'] ?>">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<input type="text" class="form-control" id="celular" placeholder="<?php echo $lang['CelularContacto'] ?>">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<input type="text" class="form-control" id="edad" placeholder="<?php echo $lang['EdadContacto'] ?>">' +
                            '</div>' +
                            '<div class="text-center">' +
                            '<button id="btnAceptar" style="background-color: #2dabe5;border-color:#2dabe5;" type="submit" class="btn btn-primary mb-1"><?php echo $lang['BotonAceptaContacto'] ?></button>' +
                            '</div>' +
                            '</form>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-12 col-md-4">' +
                            '<div class="single-special text-center wow fadeInUp" data-wow-delay="0.6s">' +
                            '<div class="single-icon">' +
                            '<i class="" aria-hidden="true">' +
                            '<img src="img/chicaaaa.png" width="300" height="300">' +
                            '</i>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</section>',
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    focusConfirm: false

                });

                $("#btnAceptar").click(function () {
                    /*Swal.fire({
                     position: 'center',
                     icon: 'success',
                     title: 'Gracias por Registrarte',
                     showConfirmButton: false,
                     timer: 1500
                     });*/

                    var url = "sendEmail.php";
                    if (valform() === true) {
                        parametros = {
                            "nombre": $("#nombre").val(),
                            "correo": $("#correo").val(),
                            "celular": $("#celular").val(),
                            "edad": $("#edad").val()
                        };
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: parametros,
                            success: function (data)
                            {
                                //alert(data);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: data,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                clean();
                                document.getElementById('autoplay').play();
                            }
                        }
                        );
                    }

                    return false;

                });

                $(".swal2-close").click(function () {
                    document.getElementById('autoplay').play();
                });
            });
        </script>

    </head>

    <body style="">
       

        <!-- ***** Header Area Start ***** -->
        <header class="header_area animated sticky area-bienvenida">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Menu Area Start -->
                    <div class="col-12 col-lg-12">
                        <div class="menu_area">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <!-- Logo -->
                                <a class="navbar-brand" href="#"><?php echo $lang['title'] ?></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                                <!-- Menu Area -->
                                <div class="collapse navbar-collapse" id="ca-navbar">
                                    <ul class="navbar-nav ml-auto" id="nav">
                                        <li class="nav-item active"><a class="nav-link" href="/"> <?php echo $lang['Inicio'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="quienessomos.php"><?php echo $lang['QuienesSomos'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="promociones.php"><?php echo $lang['Promociones'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="contacto.php"><?php echo $lang['Contacto'] ?></a></li>
                                    </ul>
                                    <div class="sing-up-button d-lg-block" style="margin:7px">
                                        <a href="public/admin-login.php"> <?php echo $lang['Ingresar'] ?></a>
                                    </div>
                                    <div class="sing-up-button d-lg-block" style="margin:7px">
                                        <a href="vender"> <?php echo $lang['RegistrarVendedor'] ?></a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn  dropdown-toggle" style="background: #0000; color: #fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="languages/icons/<?php echo $_SESSION['langflag'] ?>.png" width="20" height="20"> <?php echo $_SESSION['lang'] ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" style="min-width: 50px;">
                                        <?php
                                        if ($_SESSION['lang'] != 'es') {
                                            ?>
                                            <form action="" method="get">
                                                <input type="hidden" name="lang" value="es">
                                                <button class="dropdown-item" style="padding: 2px 5px" type="submit"> <img src="languages/icons/espana.png" width="20" height="20">ES</button>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($_SESSION['lang'] != 'pt') {
                                            ?>
                                            <form action="" method="get">
                                                <input type="hidden" name="lang" value="pt">
                                                <button class="dropdown-item" style="padding: 2px 5px" type="submit"> <img src="languages/icons/brazil.png" width="20" height="20">PT</button>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($_SESSION['lang'] != 'en') {
                                            ?>
                                            <form action="" method="get">
                                                <input type="hidden" name="lang" value="en">
                                                <button class="dropdown-item" style="padding: 2px 5px" type="submit"> <img src="languages/icons/estados-unidos.png" width="20" height="20">EN</button>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($_SESSION['lang'] != 'it') {
                                            ?>
                                            <form action="" method="get">
                                                <input type="hidden" name="lang" value="it">
                                                <button class="dropdown-item" style="padding: 2px 5px" type="submit"> <img src="languages/icons/italia.png" width="20" height="20">IT</button>
                                            </form>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Signup btn -->

                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->
        <!-- https://api.whatsapp.com/send?phone=51950862104&text=Quiero%20m%C3%A1s%20informaci%C3%B3n! -->
        <!-- ====== Seccion Botones Begin ======  -->
        <div class="container d-block d-md-none bg-white">
            <div class="py-3 text-center">
                <a href="https://gamarritas.com/public/admin-login.php" class="btn btn-outline-success"><?php echo $lang['Ingresar'] ?></a>
                <a href="https://gamarritas.com/vender" class="btn btn-outline-success ml-2"><?php echo $lang['RegistrarVendedor'] ?></a>
            </div>

            <div class="pb-3 mt-2 rounded text-center">
                <h4 class="font-italic font-weight-bold  text-dark"><?php echo $lang['DescargaApp'] ?></h4>
                <a href="https://play.google.com/store/apps/details?id=com.mishasho.tienda.moda"><img src="img/google-play.png" class="w-50">
                </a>
            </div>

        </div>
        <!-- ====== Seccion Botones End ======  -->

        <!-- ==== Nuevo Video =====  -->
        <section class="container bg-white">

            <div class="embed-responsive embed-responsive-16by9">
                <video id="autoplay" class="embed-responsive-item" controls preload="auto">
                    <source src="audio/video-gamarrita2.mp4" type="video/mp4">                      
                    <?php echo $lang['Error1'] ?>
                </video>
            </div>

        </section>

        <!-- ***** Wellcome Area Start ***** -->
        <section class="bg-white clearfix" id="home">
            <div class="container h-100 fondo">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-md">
                        <div class="wellcome-heading " >
                            <!-- <h2 class="text-dark">Gamarritas</h2> -->
                            <img src="img/logo.png" alt="" style="width: 145px;" class="d-none m-auto d-md-inline">

                            <!-- Icono WhatsApp -->
                            <!-- <img src="img/whatsapp-logo.png" alt="" style="width: 5px;" class="d-block m-auto d-md-inline"> -->
                            <a href="https://api.whatsapp.com/send?phone=51998966871&text=Quiero%20m%C3%A1s%20informaci%C3%B3n!" class="icono d-block d-md-none" >
                                <svg width="100%" fill="#fff" height="100%" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"></path></svg>
                            </a>
                            <span class="d-block d-md-none text-center mb-2"><?php echo $lang['PhoneWhatsapp'] ?></span> 


                            <div class="d-inline-block ml-5">
                                <div class="app-download-btn wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Google Store Btn -->
                                    <a href="https://gamarritas.com/vender">
                                        <p class="mb-0"><?php echo $lang['RegistrarAmigoFulventas'] ?></p>
                                    </a>
                                </div>

                            </div>

                            <div class="p-3 mt-2 rounded text-center float-right d-none d-md-inline-block" style="width: 300px; background: rgba(255, 255, 255, .7)">
                                <h4 class="font-italic font-weight-bold  text-dark"><?php echo $lang['DescargaApp'] ?></h4>
                                <a href="https://play.google.com/store/apps/details?id=com.mishasho.tienda.moda"><img src="img/google-play.png" class="w-75">
                                </a>
                            </div>

                            <p class="text-dark text-center"> <?php echo $lang['AunClick'] ?></p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Welcome thumb -->
            <div class="welcome-thumb wow fadeInDown" data-wow-delay="0.5s">
               <!-- <img src="img/bg-img/welcome-img.png" alt=""> -->
            </div>
        </section>
        <!-- ***** Wellcome Area End ***** -->

        <!-- ***** Special Area Start ***** -->
        <section class="special-area bg-white section_padding_100" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Section Heading Area -->
                        <div class="section-heading text-center">
                            <h2><?php echo $lang['PorGamarritas'] ?></h2>
                            <div class="line-shape"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Single Special Area -->
                    <div class="col-12 col-md-4">
                        <div class="single-special text-center wow fadeInUp" data-wow-delay="0.2s">
                            <div class="single-icon">
                                <!--<i class="ti-mobile" aria-hidden="true">-->
                                <i class="" aria-hidden="true">
                                    <img src="img/FVICONO1.png" width="36" height="36.5" alt=""/>
                                </i>
                            </div>
                             <!--<img src="img/FVICONO1.png" width="36" height="36.5" alt=""/>-->
                            <h4><?php echo $lang['FacilUsar'] ?></h4>
                            <p><?php echo $lang['FacilUsarDesc'] ?></p>
                        </div>
                    </div>
                    <!-- Single Special Area -->
                    <div class="col-12 col-md-4">
                        <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="single-icon">
                                <i class="" aria-hidden="true">
                                    <img src="img/FVICONO2.png" width="36" height="36.5" alt=""/>

                                </i>
                            </div>
                            <h4><?php echo $lang['DiseñosModa'] ?></h4>
                            <p><?php echo $lang['DiseñosModaDesc'] ?></p>
                        </div>
                    </div>
                    <!-- Single Special Area -->
                    <div class="col-12 col-md-4">
                        <div class="single-special text-center wow fadeInUp" data-wow-delay="0.6s">
                            <div class="single-icon">
                                <i class="" aria-hidden="true">
                                    <img src="img/FVICONO3.png" width="36" height="36.5" alt=""/>
                                </i>
                            </div>
                            <h4><?php echo $lang['Seguridad'] ?></h4>
                            <p><?php echo $lang['SeguridadDesc'] ?></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <!-- Single Special Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-special text-center wow fadeInUp" data-wow-delay="0.2s">
                            <img src="img/foto-medio1.jpg">
                        </div>
                    </div>
                    <!-- Single Special Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
                            <img src="img/foto-medio2.jpg">
                        </div>
                    </div>
                    <div class="col-12 col-md-12">

                        <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
                            <p style="font-size:30px;color: #182f4e; " class="font-weight-bold"><?php echo $lang['TitleTendencia'] ?></p>
                            <img style="margin-top: 10px;" src="tendencias.png">
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-6" style="font-size:0;margin-bottom: -35px;">
                                <a title="Ver Promociones" href="promociones.php">
                                    <img  src="img/FVG1.png" style="margin-bottom: 95px;width: 245px;height: 330px;">
                                </a>
                                <a title="Ver Promociones" href="promociones.php">
                                    <img src="img/ver_ofertas.jpg" style="margin-bottom: 95px;width: 255px;height: 330px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Special Area -->
                </div>



            </div>
            <!-- Special Description Area -->
            <div class="special_description_area" style="margin-top:82px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="special_description_img">
                                <center><img src="img/logo.png" alt="" style="width:307px"></center>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-5 ml-xl-auto">
                            <div class="special_description_content">
                                <h2><?php echo $lang['AmigoGamarra'] ?></h2>
                                <p><?php echo $lang['AmigoGamarraDesc1'] ?></p>
                                <p><?php echo $lang['AmigoGamarraDesc2'] ?></p>

                                <div class="app-download-area">
                                    <div class="app-download-btn wow fadeInUp" data-wow-delay="0.2s">
                                        <!-- Google Store Btn -->
                                        <a href="https://gamarritas.com/vender">
                                            <!--
                                            <i class="fa fa-android"></i>
                                            <p class="mb-0"><span>Disponible en</span> Google Store</p> -->
                                            <p class="mb-0"><?php echo $lang['RegistrarVendedor'] ?></p>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Special Area End ***** -->

        <div class="video-section">
            <div class="container">
                <div class="row">
                    <div class="col-12" style="background-color: white">
                        <img src="img/FVIMAGEN2.png" style="margin-bottom: 95px;">
                    </div>
                </div>
            </div>
        </div>


        <!--
    
        <section class="cool_facts_area clearfix">
            <div class="container">
                <div class="row">         
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="single-cool-fact d-flex justify-content-center wow fadeInUp" data-wow-delay="0.2s">
                            <div class="counter-area">
                                <h3><span class="counter">90</span></h3>
                            </div>
                            <div class="cool-facts-content">
                                <i class="ion-arrow-down-a"></i>
                                <p>APP <br> DOWNLOADS</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="single-cool-fact d-flex justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="counter-area">
                                <h3><span class="counter">120</span></h3>
                            </div>
                            <div class="cool-facts-content">
                                <i class="ion-happy-outline"></i>
                                <p>Happy <br> Clients</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="single-cool-fact d-flex justify-content-center wow fadeInUp" data-wow-delay="0.6s">
                            <div class="counter-area">
                                <h3><span class="counter">40</span></h3>
                            </div>
                            <div class="cool-facts-content">
                                <i class="ion-person"></i>
                                <p>ACTIVE <br>ACCOUNTS</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="single-cool-fact d-flex justify-content-center wow fadeInUp" data-wow-delay="0.8s">
                            <div class="counter-area">
                                <h3><span class="counter">10</span></h3>
                            </div>
                            <div class="cool-facts-content">
                                <i class="ion-ios-star-outline"></i>
                                <p>TOTAL <br>APP RATES</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        -->

        <!-- ***** App Screenshots Area Start ***** -->
        <section class="app-screenshots-area bg-white section_padding_0_100 clearfix" id="screenshot">
            <!-- <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        
                        <div class="section-heading">
                            <h2><?php echo $lang['VideoApp'] ?></h2>
                            <div class="line-shape"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- App Screenshots Slides  -->
                        <div class="video-section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- <video width="100%" height="100%" controls autoplay muted>
                                                  <source src="img/gamarrita-video.mp4" type="video/mp4">
                                                </video> -->
                                        <img src="img/FVIMAGEN3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** App Screenshots Area End *****====== -->


        <!-- ***** CTA Area End ***** -->

        <!-- ***** Footer Area Start ***** -->
        <footer class="footer-social-icon text-center section_padding_70 clearfix">
            <!-- footer logo -->
            <div class="footer-text">
                <img src="img/logo.png" alt="" style="width:200px">
            </div>
            <!-- social icon-->
            <div class="footer-social-icon">
                <a href="https://www.facebook.com/Fulventas-101699735781354"><i class="fa fa-facebook active" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/_fulventas/"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
            <div class="footer-menu">
                <nav>
                    <ul>
                        <li><a href="index.php"><?php echo $lang['Inicio'] ?></a></li>
                        <li><a href="quienessomos.php"><?php echo $lang['QuienesSomos'] ?></a></li>                    
                        <li><a href="contacto.php"><?php echo $lang['Contacto'] ?></a></li>
                        <li><a href="https://gamarritas.com/public/admin-login.php"><?php echo $lang['Ingresar'] ?></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Foooter Text-->
            <div class="copyright-text">
                <!-- ***** Removing this text is now allowed! This template is licensed under CC BY 3.0 ***** -->
                <p>Copyright ©2020</p>
            </div>
        </footer>
        <!-- ***** Footer Area Start ***** -->

        <!-- Jquery-2.2.4 JS -->
        <script src="js/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/popper.min.js"></script>
        <!-- Bootstrap-4 Beta JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- All Plugins JS -->
        <script src="js/plugins.js"></script>
        <!-- Slick Slider Js-->
        <script src="js/slick.min.js"></script>
        <!-- Footer Reveal JS -->
        <script src="js/footer-reveal.min.js"></script>
        <!-- Active JS -->
        <script src="js/active.js"></script>
    </body>

</html>