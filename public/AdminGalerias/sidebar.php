<div class="sidebar">
    <ul>

    <?php 
    if ($_SESSION['grobaltype']==4){

    ?>   
    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i><span class="hide-md"><?php echo $lang['Escritorio'] ?></span></a></li>

    <li><a href="AdminGalerias/misGalerias.php"><i class="fas fa-box"></i><span class="hide-md"><?php echo 'Mis Galerias' ?></span></a></li>

    <li><a href="misGalerias.php"><i class="fas fa-box"></i><span class="hide-md"><?php echo 'Mis Galerias 2' ?></span></a></li>
    
    <li><a href=""><i class="fas fa-bell"></i><span class="hide-md"><?php echo 'Apartado' ?></span>
  <!--<li><a href="add_order_user.php"><i class="fas fa-bell"></i><span class="hide-md">Mis Pedidos</span>
-->
    <!--<b class="notification">0</b>-->

    </a></li>
    <?php 
    } 

    ?>
</ul>
</div>