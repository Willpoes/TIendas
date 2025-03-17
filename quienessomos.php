<?php
session_start();
include "configuration.php"
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title><?php echo $lang['title'] ?></title>

        <!-- Favicon -->
        <link rel="icon" href="img/logo.png">

        <!-- Core Stylesheet -->
        <link href="./style.css" rel="stylesheet" >

        <!-- Responsive CSS -->
        <link href="./css/responsive.css" rel="stylesheet">
        
        <style>
            #ca-navbar ul li a:focus{
                text-decoration: underline;
                text-underline-offset: 0.5em;
                text-decoration-thickness: 4px;
            }
        </style>

    </head>

    <body>
        <!-- Preloader Start -->
        <div id="preloader">
            <div class="colorlib-load"></div>
        </div>

        <!-- ***** Header Area Start ***** -->
        <header class="header_area animated area-bienvenida">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Menu Area Start -->
                    <div class="col-12 col-lg-12">
                        <div class="menu_area">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <!-- Logo -->
                                <a class="navbar-brand" href="#"><?php echo $lang['title2'] ?></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                                <!-- Menu Area -->
                                <div class="collapse navbar-collapse" id="ca-navbar">
                                    <ul class="navbar-nav ml-auto" id="nav">
                                        <li class="nav-item"><a class="nav-link" href="index.php"><?php echo $lang['Inicio'] ?></a></li>
                                        <li class="nav-item active"><a class="nav-link" href="quienessomos.php"><?php echo $lang['QuienesSomos'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="promociones.php"><?php echo $lang['Promociones'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="contacto.php"><?php echo $lang['Contacto'] ?></a></li>
                                    </ul>
                                    <div class="sing-up-button d-lg-block" style="margin:7px">
                                        <a href="public/admin-login.php"><?php echo $lang['Ingresar'] ?></a>
                                    </div>
                                    <div class="sing-up-button d-lg-block" style="margin:7px">
                                        <a href="vender"><?php echo $lang['Registrate'] ?></a>
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

        <div class="video-section" style="background-color: white;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6" style="font-size:0;margin-bottom: -35px;">
                        <!--<div class="center-block">-->
                        <img  src="img/FVG6.webp" style="margin-bottom: 95px;width: 265px;height: 400px;">
                        <img src="img/chicasport.jpg" style="margin-bottom: 95px;width: 265px;height: 400px;">
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>


        <!-- ***** Awesome Features Start ***** -->
        <section class="awesome-feature-area bg-white section_padding_0_50 clearfix" id="features">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Heading Text -->
                        <div class="section-heading text-center">
                            <h2><?php echo $lang['GamarritasEs'] ?>
                                <img src="img/icon_logo.png" alt="" style="width: 145px;float: right;margin-top: 5px;">  
                            </h2>
                            <div class="line-shape" style="margin-left: 40%;"></div>
                            <!--<div class="row" style="float: right;margin-top:50px;">
                                <img src="img/logo.png" alt="" style="width: 145px;">    
                            </div>-->
                        </div>
                    </div>
                </div>
                <!-- aqui-->

                <div class="row">
                    <!-- Single Feature Start -->
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-feature">

                            <i class="" aria-hidden="true">
                                <img src="img/FVICONO4.png" width="50" height="50"/>    
                            </i>
                            <h5 class="font-weight-bold"><?php echo $lang['GamarritasEst1'] ?></h5>
                            <p><?php echo $lang['GamarritasEst1Desc'] ?></p>
                        </div>
                    </div>
                    <!-- Single Feature Start -->
                    <!-- Single Feature Start -->
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-feature">
                            <i class="" aria-hidden="true">
                                <img src="img/FVICONO6.png" width="50" height="50"/>    
                            </i>
                            <h5 class="font-weight-bold"><?php echo $lang['GamarritasEst2'] ?></h5>
                            <p><?php echo $lang['GamarritasEst2Desc'] ?></p>
                        </div>
                    </div>
                    <!-- Single Feature Start -->
                    <!--<<div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-feature">
                            <i class="ti-palette" aria-hidden="true"></i>
                            <h5><?php // echo $lang['GamarritasEst3']      ?></h5>
                            <p><?php //echo $lang['GamarritasEst3Desc']      ?></p>
                            <!--<p>Somos la mejor opción para comprar prendas y accesorios a los mejores precios y la mejor calidad.</p>
                        </div>-->
                    <!--</div>-->

                    <!-- Single Feature Start -->
                    <!--<div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-feature">
                            <i class="ti-crown" aria-hidden="true"></i>
                            <h5><?php //echo $lang['GamarritasEst4']       ?></h5>
                            <p><?php //echo $lang['GamarritasEst4Desc']       ?></p>
                        </div>
                    </div>-->
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-feature">
                            <i class="" aria-hidden="true">
                                <img src="img/FVICONO5.png" width="50" height="50"/>    
                            </i>
                            <h5 class="font-weight-bold"><?php echo $lang['GamarritasEst3'] ?></h5>
                            <p><?php echo $lang['GamarritasEst3Desc'] ?></p>
                            <!--<p>Somos la mejor opción para comprar prendas y accesorios a los mejores precios y la mejor calidad.</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Awesome Features End ***** -->

        <div class="video-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6" style="background-color: white">
                        <img src="img/FVIMAGEN5.webp" style="margin-bottom: 95px; width: 570px;height: 400px;">
                    </div>
                    <!--<div class="col-12" style="background-color: white">
                        <img src="img/foto-bg3.png" style="margin-bottom: 95px;">
                    </div>-->
                </div>
            </div>
        </div>

        <!-- ***** Video Area Start ***** -->
        <!--
        <div class="video-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
    
                        <div class="video-area" style="background-image: url(img/bg-img/video.jpg);">
                            <div class="video-play-btn">
                                <a href="https://www.youtube.com/watch?v=f5BBJ4ySgpo" class="video_btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
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
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <!-- Heading Text  -->
                        <div class="section-heading">
                            <h2><?php echo $lang['Galeria'] ?></h2>
                            <div class="line-shape"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- App Screenshots Slides  -->
                        <div class="app_screenshots_slides owl-carousel">
                            <div class="single-shot">
                                <img src="img/fvg1.webp" alt="">
                            </div>
                            <div class="single-shot">
                                <img src="img/FVG2.webp" alt="">
                            </div>
                            <div class="single-shot">
                                <img src="img/FVG3.webp" alt="">
                            </div>
                            <div class="single-shot">
                                <img src="img/FVG4.webp" alt="">
                            </div>
                            <div class="single-shot">
                                <img src="img/FVG5.webp" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** App Screenshots Area End *****====== -->
        <!-- ***** Contact Us Area End ***** -->
        <footer class="footer-social-icon text-center section_padding_70 clearfix">
            <!-- footer logo -->
            <div class="footer-text">
                <img src="./img/logo.png" alt="" style="width:200px">
            </div>
            <!-- social icon-->
            <div class="footer-social-icon">
                <a href="https://www.facebook.com/Fulventas-101699735781354"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="active fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/_fulventas/"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            </div>
            <div class="footer-menu">
                <nav>
                    <ul>
                        <li><a href="index.php"><?php echo $lang['Inicio'] ?></a></li>
                        <li><a href="quienessomos.php"><?php echo $lang['QuienesSomos'] ?></a></li>
                        <li><a href="contacto.php"><?php echo $lang['Contacto'] ?></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Foooter Text-->
            <div class="copyright-text">

                <p>Copyright ©2020 </p>
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
        <script src="./js/active.js"></script>
    </body>

</html>

