<div class="sidebar">
  <ul>

    <?php
    if ($_SESSION['grobaltype'] == 4) {

      ?>
      <li><a href="index.php"><i class="fas fa-tachometer-alt"></i><span
            class="hide-md"><?php echo $lang['Escritorio'] ?></span></a></li>

      <li><a href="Galerias/misGalerias.php"><i class="fas fa-box"></i><span
            class="hide-md"><?php echo 'Mis Galerias' ?></span></a></li>

      <li><a href=""><i class="fas fa-bell"></i><span class="hide-md"><?php echo 'Apartado' ?></span>
        </a></li>
      <?php
    }
    ?>

    <?php
    if ($_SESSION['grobaltype'] == 5) {

      ?>
      <li><a href="index.php">
          <i class="fas fa-tachometer-alt"></i>
          <span class="hide-md">
            <?php echo $lang['Escritorio'] ?>
          </span>
        </a>
      </li>

      <li>
        <a href="Galerias/misGalerias.php">
          <i class="fas fa-box"></i>
          <span class="hide-md">
            <?php echo 'Mis Galerias' ?>
          </span>
        </a>
      </li>

      <li><a href="Galerias/servicios.php">
          <i class="fas fa-hands-helping"></i>
          <span class="hide-md">
            <?php echo 'Servicios' ?>
          </span></a>
      </li>

      <li><a href="Galerias/misCategorias.php">
          <i class="fas fa-users"></i>
          <span class="hide-md">
            <?php echo 'Categorias' ?>
          </span>
        </a>
      </li>

      <?php
    }
    ?>

    <?php
    if ($_SESSION['grobaltype'] == 2) {
      ?>
      <li><a href="index.php"><i class="fas fa-tachometer-alt"></i><span
            class="hide-md"><?php echo $lang['Escritorio'] ?></span></a></li>
      <li><a href="recent_products.php"><i class="fas fa-box"></i><span
            class="hide-md"><?php echo $lang['Productos'] ?></span></a></li>
      <li><a href="list_order_user.php"><i class="fas fa-bell"></i><span
            class="hide-md"><?php echo $lang['MisPedidos'] ?></span>
          <!--<li><a href="add_order_user.php"><i class="fas fa-bell"></i><span class="hide-md">Mis Pedidos</span>
-->
          <!--<b class="notification">0</b>-->

        </a></li>
      <?php
    }

    ?>


    <?php
    if ($_SESSION['grobaltype'] == 3) {

      ?>

      <!--<li><a href="orders_repartidor.php"><i class="fas fa-bell"></i><span class="hide-md">Mis Pedidos</span>-->


      <li><a href="seller_order_list.php"><i class="fas fa-bell"></i><span
            class="hide-md"><?php echo $lang['MisPedidos'] ?></span>


        </a></li>
      <?php
    }

    ?>






    <?php
    if ($_SESSION['grobaltype'] == 0) {

      ?>


      <li><a href="orders.php"><i class="fas fa-bell"></i><span class="hide-md"><?php echo $lang['PedidosG'] ?> </span>


          <!--<b class="notification">0</b>-->

        </a></li>

      <li><a href="recent_products_user.php"><i class="fas fa-box"></i><span
            class="hide-md"><?php echo $lang['TodosP'] ?></span></a></li>


      <li><a href="colors.php"><i class="fas fa-palette"></i><span
            class="hide-md"><?php echo $lang['ColoresP'] ?></span></a></li>
      <li><a href="product_sizes.php"><i class="fas fa-window-maximize"></i><span
            class="hide-md"><?php echo $lang['Tallas'] ?></span></a></li>
      <li><a href="categories.php"><i class="fas fa-cubes"></i><span
            class="hide-md"><?php echo $lang['Categorias'] ?></span></a></li>
      <li><a href="sales.php"><i class="fas fa-cart-arrow-down"></i><span
            class="hide-md"><?php echo $lang['Ventas'] ?></span></a></li>
      <li><a href="users.php"><i class="fas fa-users"></i><span class="hide-md"><?php echo $lang['Usuarios'] ?></span></a>
      </li>
      <li><a href="seller.php"><i class="fas fa-users"></i><span
            class="hide-md"><?php echo $lang['Vendedores'] ?></span></a></li>
      <li><a href="comisiones.php"><i class="fas fa-coins"></i><span
            class="hide-md"><?php echo $lang['Comisiones'] ?></span></a></li>

      <li><a href="Galerias/listado_galerias.php"><i class="fas fa-store"></i>Galerias</i><span
            class="hide-md"></span></a></li>

      <li><a href="push-notification.php"><i class="fas fa-dot-circle"></i>

          <span class="hide-md"><?php echo $lang['Notificacion'] ?></span>

        </a></li>
      <li><a href="destinos.php"><i class="fas fa-map-marker-alt"></i><span
            class="hide-md"><?php echo $lang['Destinos'] ?> </span></a></li>
      <li><a href="settings.php"><i class="fas fa-cogs"></i><span class="hide-md"><?php echo $lang['Configuracion'] ?>
          </span></a></li>
      <li><a href="ads.php"><i class="fas fa-box"></i><span class="hide-md"><?php echo $lang['Anuncios'] ?> </span></a>
      </li>
      <li><a href="slider.php"><i class="fas fa-cogs"></i><span class="hide-md"><?php echo $lang['Slider'] ?> </span></a>
      </li>

      <?php
    }
    ?>
    <!--    
    <li><a href="orders.php"><i class="fas fa-shopping-bag"></i><span class="hide-md">Orders</span></a></li>
    <li><a href="braintree-config.php?braintree=true"><i class="fas fa-credit-card"></i><span class="hide-md">Braintree Credential</span></a></li>
    <li><a href="admob-config.php?braintree=true"><i class="fab fa-adversal"></i><span class="hide-md">Admob Credential</span></a></li>
    -->

  </ul>
</div><!-- sidebar -->