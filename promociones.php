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

        <!-- Title -->
        <title><?php echo $lang['title'] ?></title>

        <!-- Favicon -->
        <link rel="icon" href="img/logo.png">

        <!-- Core Stylesheet -->
        <link href="style.css" rel="stylesheet">

        <!-- Responsive CSS -->
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
             #ca-navbar ul li a:focus{
                text-decoration: underline;
                text-underline-offset: 0.5em;
                text-decoration-thickness: 4px;
            }
            
        </style>    

    </head>

    <body style="">
        <!-- Preloader Start -->
        <div id="preloader">
            <div class="colorlib-load"></div>
        </div>

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
                                        <li class="nav-item"><a class="nav-link" href="index.php"> <?php echo $lang['Inicio'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="quienessomos.php"><?php echo $lang['QuienesSomos'] ?></a></li>
                                        <li class="nav-item active"><a class="nav-link" href="promociones.php"><?php echo $lang['Promociones'] ?></a></li>
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

        
        <!-- ***** Wellcome Area End ***** -->

        <!-- ***** Special Area Start ***** -->
        <section class="special-area bg-white section_padding_100" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Section Heading Area -->
                        <div class="section-heading text-center">
                            <h3><?php echo $lang['TitlePromociones'] ?></h3>
                            <!--<div class="line-shape"></div>-->
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12" style="background-color: white">
                        <h3><?php echo $lang['TitleMujer'] ?></h3>
                        <img src="img/FVIMAGEN1.webp" style="margin-bottom: 95px;">
                    </div>
                </div>
                
                <div class="row">
                    <h3><?php echo $lang['TitleHombre'] ?></h3>
                    <div class="col-12" style="background-color: white">
                        <img src="img/foto-bg2.webp" style="margin-bottom: 95px;">
                    </div>
                </div>
                
                <div class="row">
                       <h3><?php echo $lang['TitleNinos'] ?></h3>
                    <div class="col-12 text-center" style="background-color: white">
                        <img src="img/fvimagen2.webp" style="margin-bottom: 95px;">
                    </div>
                </div>

            </div>
            <!-- Special Description Area -->
            
        </section>
        

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