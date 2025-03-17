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

        <script src="js/jquery-2.2.4.min.js"></script>

        <!-- Title -->
        <title><?php echo $lang['title'] ?></title>

        <!-- Favicon -->
        <link rel="icon" href="img/logo.png">

        <!-- Core Stylesheet -->
        <link href="style.css" rel="stylesheet">

        <!-- Responsive CSS -->
        <link href="css/responsive.css" rel="stylesheet">


        <style>
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
                clean();
                $("#btnAceptar").click(function () {
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
                                alert(data);
                                clean();
                            }
                        }
                        );
                    }
                    return false;
                });
            });

        </script>

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
                                        <li class="nav-item"><a class="nav-link" href="quienessomos.php"><?php echo $lang['QuienesSomos'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="promociones.php"><?php echo $lang['Promociones'] ?></a></li>
                                        <li class="nav-item active"><a class="nav-link" href="contacto.php"><?php echo $lang['Contacto'] ?></a></li>
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

        <!-- ***** Contact Us Area Start ***** -->
        <section class="footer-contact-area section_padding_60 clearfix" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <!-- Heading Text  -->
                        <div class="section-heading" style="margin-top: 25px;">
                            <h2 class="text-center font-weight-bold" style="color:#00b558;font-family:sans-serif;font-size: 35px;"><?php echo $lang['PonteContacto'] ?></h2>
                            <h2 class="text-center font-weight-bold" style="color:#00b558;font-family:sans-serif;font-size: 35px;"><?php echo $lang['PonteContactoTitle'] ?></h2>
                            <!--<div class="line-shape"></div>-->
                        </div>
                        <div class="footer-text" style="padding-right:20px">
                            <center><p><?php echo $lang['PonteContactoDesc'] ?></p></center>

                            <form action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nombre" placeholder="<?php echo $lang['NomApelliContacto'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="correo" placeholder="<?php echo $lang['EmailContacto'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="celular" placeholder="<?php echo $lang['CelularContacto'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="edad" placeholder="<?php echo $lang['EdadContacto'] ?>">
                                </div>
                                <div class="text-center">
                                    <button id="btnAceptar" style="background-color: #2dabe5;border-color:#2dabe5;" type="submit" class="btn btn-primary mb-1"><?php echo $lang['BotonAceptaContacto'] ?></button>    
                                </div>
                            </form>
                        </div>
                        <div class="phone-text">

                        </div>




                    </div>


                    <!--<div class="col-md-4">
                        <img class="logo-contacto" src="img/logo.png" alt="" style="max-width:307px;margin-right:auto;margin-left:auto;float: right">                    
                    </div>-->
                </div>
            </div>
        </section>
        <!-- ***** Contact Us Area End ***** -->

        <!-- ***** Footer Area Start ***** -->
        <footer class="footer-social-icon text-center section_padding_100 clearfix">
            <!-- footer logo -->
            <div class="footer-text">
                <img src="img/logo.png" alt="" style="width:200px">
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
                <!-- ***** Removing this text is now allowed! This template is licensed under CC BY 3.0 ***** -->
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
        <script src="js/active.js"></script>
    </body>

</html>
