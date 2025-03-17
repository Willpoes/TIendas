<div class="sidebar sidebar_contendor">
  <ul>
    <?php
    if ($_SESSION['grobaltype'] == 0) {

      ?>
      <li>
        <a href="../orders.php">
          <i class="fas fa-bell"></i>
          <span class="hide-md"><?php echo 'PedidosG' ?> </span>
          <!--<b class="notification">0</b>-->
        </a>
      </li>

      <li><a href="../recent_products_user.php"><i class="fas fa-box"></i><span
            class="hide-md"><?php echo 'TodosP' ?></span></a></li>

      <li><a href="../colors.php"><i class="fas fa-palette"></i><span class="hide-md"><?php echo 'ColoresP' ?></span></a>
      </li>

      <li><a href="../product_sizes.php"><i class="fas fa-window-maximize"></i><span
            class="hide-md"><?php echo 'Tallas' ?></span></a></li>
      <li><a href="../categories.php"><i class="fas fa-cubes"></i><span
            class="hide-md"><?php echo 'Categorias' ?></span></a></li>
      <li><a href="../sales.php"><i class="fas fa-cart-arrow-down"></i><span
            class="hide-md"><?php echo 'Ventas' ?></span></a></li>
      <li><a href="../users.php"><i class="fas fa-users"></i><span class="hide-md"><?php echo 'Usuarios' ?></span></a>
      </li>
      <li><a href="../seller.php"><i class="fas fa-users"></i><span class="hide-md"><?php echo 'Vendedores' ?></span></a>
      </li>
      <li><a href="../comisiones.php"><i class="fas fa-coins"></i><span
            class="hide-md"><?php echo 'Comisiones' ?></span></a></li>

      <li><a href="../Galerias/listado_galerias.php"><i class="fas fa-store"></i>Galerias</i><span
            class="hide-md"></span></a></li>

      <li><a href="../push-notification.php"><i class="fas fa-dot-circle"></i>

          <span class="hide-md"><?php echo 'Notificacion' ?></span>

        </a></li>
      <li><a href="../destinos.php"><i class="fas fa-map-marker-alt"></i><span class="hide-md"><?php echo 'Destinos' ?>
          </span></a></li>
      <li><a href="settings.php"><i class="fas fa-cogs"></i><span class="hide-md"><?php echo 'Configuracion' ?>
          </span></a></li>
      <li><a href="../ads.php"><i class="fas fa-box"></i><span class="hide-md"><?php echo 'Anuncios' ?> </span></a></li>


      <li><a href="../slider.php"><i class="fas fa-cogs"></i><span class="hide-md"><?php echo 'Slider' ?> </span></a></li>

      <?php
    }

    ?>

    <?php
    if ($_SESSION['grobaltype'] == 4) {

      ?>
      <li><a href="../index.php"><i class="fas fa-tachometer-alt"></i><span
            class="hide-md"><?php echo 'Escritorio' ?></span></a></li>

      <li><a href="../Galerias/misGalerias.php"><i class="fas fa-box"></i><span
            class="hide-md"><?php echo 'Mis Tiendas' ?></span></a></li>

      <li><a href=""><i class="fas fa-bell"></i><span class="hide-md"><?php echo 'Apartado' ?></span>
          <!--<li><a href="add_order_user.php"><i class="fas fa-bell"></i><span class="hide-md">Mis Pedidos</span>
-->
          <!--<b class="notification">0</b>-->

        </a></li>
      <?php
    }

    ?>

    <?php
    if ($_SESSION['grobaltype'] == 5) {

      ?>
      <li>
        <a href="../index.php">
          <i class="fas fa-tachometer-alt">
          </i>
          <span class="hide-md">
            <?php echo 'Escritorio' ?>
          </span>
        </a>
      </li>

      <li>
        <a href="">
          <i class="fas fa-box"></i>
          <span class="hide-md">
            <?php echo 'Mis Tiendas' ?>
          </span>
        </a>
      </li>

      <li><a href="./servicios.php">
          <i class="fas fa-hands-helping"></i>
          <span class="hide-md">
            <?php echo 'Servicios' ?>
          </span></a>
      </li>

      <li><a href="./misCategorias.php">
          <i class="fas fa-hands-helping"></i>
          <span class="hide-md">
            <?php echo 'Categorias' ?>
          </span></a>
      </li>


      <?php
    }

    ?>


  </ul>
</div>