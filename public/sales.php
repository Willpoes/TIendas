<?php require_once('../private/init.php');include "../configuration.php"; ?>
<?php

$admin_id = "";
$username = "";
$admin_info = logged_in();
if (!empty($admin_info)) {
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
} else {
    redirect_to_login();
}

if (isset($_GET['month']) ) {
    if ( $_GET['month'] != -1) {
        $year = date("Y");
        $month = $_GET['month'];
        $dateIni = $year.'-'.$month.'-01';
        $dateEnd = date("Y-m-t", strtotime($dateIni));

        $stores = find_order_list_user_all($dateIni,$dateEnd);
    }elseif (isset($_GET['dateIni']) && isset($_GET['dateEnd'])) {
        $stores = find_order_list_user_all($_GET['dateIni'],$_GET['dateEnd']);
    }else {
        $stores = find_order_list_user_all();
    }
}else {
    $stores = find_order_list_user_all();
}


$message = $lang['mostrar'] .' '. mysqli_num_rows($stores) ." ". $lang['Tienda'] ."." ;
if (empty($stores)) {
    $message = "No stores Found.";
} else if (!empty(get_category_msg())) {
    $message = get_category_msg();
    unset_category_msg();
}

?>

<?php require("common_update/head.php"); ?>
<style>
    .filters{
        display: flex; 
        justify-content: space-between; 
        margin-bottom: 15px; 
    }
    .mycheckbox{
        display: flex; 
        width: 25px;
        margin-top: 20px;
    }
</style>
<body>

    <?php require("common_update/heading_menu.php"); ?>


    <section class="main-body">
        <?php require("common_update/sidebar.php"); ?>

        <div class="main-contents">
            <div class="recent-products">
            <form action="" method="GET">
            <div class="d-flex justify-content-between filters" style="">
                <div style="display: flex;">
            
                    <input type="radio" class=" mycheckbox" name="checkmeses" id="checkmeses" value="checkmeses"  checked>
                        
                    <div>
                    <label for="month"><?php echo $lang['Meses'] ?>:</label>
                    <select name="month" id="month">
                        <option value="-1"><?php echo $lang['Seleccionar'] ?></option>
                        <option value="1" <?php 
                        if (isset($_GET['month']) && $_GET['month'] == 1 ) {
                            echo "selected";
                        }
                        ?> ><?php echo $lang['Enero'] ?></option>
                        <option value="2"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 2 ) {
                            echo "selected";
                        }
                        ?> ><?php echo $lang['Febrero'] ?></option>
                        <option value="3"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 3 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Marzo'] ?></option>
                        <option value="4"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 4 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Abril'] ?></option>
                        <option value="5"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 5 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Mayo'] ?></option>
                        <option value="6"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 6 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Junio'] ?></option>
                        <option value="7"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 7 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Julio'] ?></option>
                        <option value="8"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 8 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Agosto'] ?></option>
                        <option value="9"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 9 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Septiembre'] ?></option>
                        <option value="10"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 10 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Octubre'] ?></option>
                        <option value="11"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 11 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Noviembre'] ?></option>
                        <option value="12"<?php 
                        if (isset($_GET['month']) && $_GET['month'] == 12 ) {
                            echo "selected";
                        }
                        ?>><?php echo $lang['Diciembre'] ?></option>
                    </select>
                 </div>
                    
                </div>
                
                <div class="d-flex justify-content-between filters" style="display: flex;">
                    <input type="radio" class=" mycheckbox" name="checkmeses" id="checkdates">
                    <div>
                        <label for="dateIni"><?php echo $lang['FechaInicio'] ?></label>
                        <input type="date" name="dateIni" id="dateIni" value="<?php 
                            if (isset($_GET['dateIni']) ) {
                                echo $_GET['dateIni'];
                            }
                            ?>" disabled>
                    </div>
                    <div class="ml-5" style="margin-left: 100px;">
                        <label for="dateEnd"><?php echo $lang['FechaFinal'] ?></label>
                        <input type="date" name="dateEnd" id="dateEnd" value="<?php 
                            if (isset($_GET['dateEnd']) ) {
                                echo $_GET['dateEnd'];
                            }
                            ?>" disabled>
                    </div>
                </div>
                
                
             
    
            </div>

            <button type="submit" class="btn btn-primary"><?php echo $lang['Filtrar'] ?></button>
        </form>
                <div class="message-wrapper">
                    <h5 class="message"><?php echo $message; ?></h5>
                   
                </div>

                <div class="tbl-wrapper">
                    <table id="example"  class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>

                                <th><?php echo $lang['Tienda'] ?></th>
                                <th><?php echo $lang['Galeria'] ?></th>
                                <th><?php echo $lang['FechaInicio'] ?></th>
                                <th><?php echo $lang['Comision'] ?></th>
                                <th><?php echo $lang['#Comision'] ?></th>
                                <th><?php echo $lang['TotalComision'] ?></th>
                                <th><?php echo $lang['fecha'] ?></th>
                                <th><?php echo $lang['EstadoCorte'] ?></th>
                                <th><?php echo $lang['Ventas'] ?></th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php if (!empty($stores)) {
                                foreach ($stores as $store) { 
                                    $order_id = $store['order_id'];
								    $orderx = find_order_by_id_admi($store['order_id']);
                                    if (isset($orderx['order_status'])) {
                                        $order_status = get_order_statusc($orderx['order_status']);
                                    }else{
                                        $order_status = ['red','Vacio'];
                                    }
                                    if (isset($orderx['order_time'])) {
                                        $order_time = $orderx['order_time'];
                                    }else{
                                        $order_time = 'sin registrar';
                                    }
                                    
                                    if (isset($orderx['order_amount'])) {
                                        $current_total = $orderx['order_amount'];
                                    } else {
    
                                        $current_total = 0;
                                    }
    
                                    if (isset($orderx['district'])) {
                                        $district = $orderx['district'];
                                    }else{
                                        $district = 'sin registrar';
                                    }
                                ?>
                                    <tr>
                                        <td >
                                            <?php 
                                            if (isset($orderx['store'])) {
                                                echo $orderx['store'];
                                            }
                                             ?>
                                            
                                        </td>

                                        <td >
                                            <?php 
                                             if (isset($orderx['gallery'])) {
                                                echo $orderx['gallery'] ;
                                             }
                                            ?>

                                        </td>
                                            
                                        <td >
                                            <?php
                                                echo $order_time;
                                            ?>
                                        </td>

                                        <td >
                                            S/. 2
                                        </td>
                                        <td >
                                            <?php
                                             if (isset($orderx['count'])) {
                                                echo $orderx['count'];
                                             }else{
                                                echo 0;
                                             }
                                            ?>
                                        </td>
                                        <td >
                                        <?php
                                             if (isset($orderx['count'])) {
                                                echo $orderx['count'] * 2;
                                             }else{
                                                echo 0;
                                             }
                                            ?>
                                        </td>
                                        <td >
                                            
                                        </td>
                                        <td >
                                            <?php
                                                echo $order_status[1];
                                            ?>
                                        </td>
                                        <td >
                                            <?php
                                            echo $current_total;
                                            ?>
                                        </td>
                                    </tr>


                                <?php } ?>
                            <?php } ?>


                        </tbody>
                    </table>

                </div><!-- recent-products -->
            </div><!-- recent-products -->
        </div><!-- main-content -->
    </section>
    <!--main-body -->


    <!-- jQuery library -->
    <script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>
<script src="./plugin-frameworks/js/jquery.dataTables.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.responsive.min.js"></script>
<script src="./plugin-frameworks/js/responsive.bootstrap4.min.js"></script>


    <!-- Main Script -->
    <script src="common/script.js"></script>
    <script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
        $('#checkmeses').change(function () {
            if($(this)[0].checked)
            {
                console.log('meses');
                $('#month').prop('disabled', false);
                $('#dateEnd').prop('disabled', true);
                $('#dateIni').prop('disabled', true);
                $('#dateEnd').val('');
                $('#dateIni').val('');
            }
          //chk.attr('value', IsChecked)
        });
        $('#checkdates').change(function () {
            if($(this)[0].checked)
            {
                console.log('dates');
                $('#month').prop('disabled', true);
                $('#month').val('-1')
                $('#dateEnd').prop('disabled', false);
                $('#dateIni').prop('disabled', false);
            }
         //chk.attr('value', IsChecked)
       });
    </script>

</body>

</html>