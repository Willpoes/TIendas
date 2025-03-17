<?php

$usuario = $_SESSION['fullname'];
?>
<header class="header header_galeria">
    <div class="logo">
        <a href="../index.php" class="logo">
            <img src="../uploads/user-images/c082add26e3398e9511d8f1b54e9fc32.jpg" alt="">
            <b class="hide-md">MIAPP</b>
        </a>
    </div>

    <div class="sesion">
        <div class="notificaciones">
            <img src="../images/notification.png" alt="">

        </div>
        <div class="usuario">
            <img src="../images/profile_default.jpg" alt="">
            <a href="#" class="link_usuario" onclick="togglecerrarSesion(event)">
                <span><?php
                echo $usuario;
                ?></span>
                <i>v</i>
            </a>
            <div class="cerrarSesion" id="cerrarSesion">
                <a class="cuenta">
                    <img src="../images/usuario.png" alt="">
                    <p>Mi cuenta</p>
                </a>
                <a href="cerrar_sesion.php" class="salir">
                    <img src="../images/iniciar-sesion.png" alt="">
                    <p>Salir</p>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    function togglecerrarSesion(event) {
        event.preventDefault();
        const cerrarSesion = document.getElementById('cerrarSesion');
        cerrarSesion.style.display = cerrarSesion.style.display === 'block' ? 'none' : 'block';
    }

    // Oculta el menú al hacer clic fuera
    document.addEventListener('click', function (event) {
        const cerrarSesion = document.getElementById('cerrarSesion');
        const usuario = document.querySelector('.usuario');
        if (!usuario.contains(event.target)) {
            cerrarSesion.style.display = 'none';
        }
    });

</script>