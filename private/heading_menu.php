<script>
  // Funciona para notifiacion
function prueba_notificacion() {
    if (Notification) {
        if (Notification.permission !== "granted") {
            Notification.requestPermission()
        }
        var title = "Gamarrita"
        var extra = {
            icon: "https://gamarritas.com/public/uploads/user-images/6833c988dc459228c8b2490a4760b8b3.png",
            body: "Tienes vendedores nuevos."
        }
        var noti = new Notification(title, extra)
        noti.onclick = {
            // Al hacer click
        }
        noti.onclose = {
            // Al cerrar
        }
        setTimeout(function() {
            noti.close()
        }, 10000)
    }
}

// PEDIDOS NUEVOS
function prueba_notificacion_pedidos_nuevos() {
    if (Notification) {
        if (Notification.permission !== "granted") {
            Notification.requestPermission()
        }
        var title = "Gamarrita"
        var extra = {
            icon: "https://gamarritas.com/public/uploads/user-images/6833c988dc459228c8b2490a4760b8b3.png",
            body: "Tienes Pedidos Nuevos."
        }
        var noti = new Notification(title, extra)
        noti.onclick = {
            // Al hacer click
        }
        noti.onclose = {
            // Al cerrar
        }
        setTimeout(function() {
            noti.close()
        }, 10000)
    }

</script>

<header>
    <div class="left-area">
        <a class="logo" href="index.php"><img src="<?php echo $site_logo ; ?>" alt=""><b class="hide-md"><?php echo $site_name; ?></b></a>
    </div><!-- left-area -->


    <ul class="right-area">
  <?php
   if ($_SESSION['grobaltype']==0){

    ?>

        <!-- == Begin Notification ==  -->
          <li>
            <a href="#" class="rn-link">
              <?php

              $vende_nuevo = total_view_noti();

            //  $pedidos_nuevo = total_view_noti_pedidos_new();

              $show_noti = "";
              // Si muestro noti con sonido y alerta
             //+ if ($vende_nuevo > 0)
                //setcookie('notifi', "si", time() + 365 * 24 * 60 * 60 * 2);

            // var_dump($vende_nuevo);
              ?>

              
                <!-- <span class="rn-noti-float">5</span> -->
                <img class="noti-img" src="images/notification.png" alt="">

            <?php
             if ($vende_nuevo > 0): 
              ?>
                <!-- labels New -->
                  <div class="labels">
                    <div class="onhot"><?= $vende_nuevo ?></div>
                  </div>
        <?php
          endif;
        ?>

                <i class="fas fa-angle-down"></i>
          </a>

            <div class="dropdown-menu rn-left">
                <div class="dropdown-menu-inner">
                    <div class="arrow-up"></div>
                    <ul>
                        <li><a href="seller.php?view=si"><i class="fas fa-user-alt"></i>Tiene <span style="background-color: yellow"><?= $vende_nuevo ?></span> vendedor(es) Nuevo(s)</a></li>
                        
                    </ul>
                </div><!-- dropdown-menu-inner -->
            </div> <!-- /.dropdown-menu -->

        </li>

        <?php 

        // Si hay vendedor nuevo muestra el sonido por una vez
        // Tambien muestra la notifiacion
        if ( $vende_nuevo > 0 ){
          
        ?>

      <script>
        // llamo a la notificacion
        prueba_notificacion();
      </script>
        <audio  id="audio" autoplay >
          <source src="https://mishasho.com/moda-admin/public/audio/got-it-done.ogg" type="audio/ogg">
        </audio>
        <?php

        //setcookie('notifi', "no", time() + 365 * 24 * 60 * 60 * 2);
          }
        ?>

        <!-- == End Notification ==  -->

<?php
}

?>


  <?php
  // ===============
  // ============= PEDIDOS NUEVOS (TIPO VENDEDOR)

   if ($_SESSION['grobaltype']==2){

    ?>

        <!-- == Begin Notification ==  -->
          <li>
            <a href="#" class="rn-link">
              <?php

              // $vende_nuevo = total_view_noti();

             $pedidos_nuevo = total_view_noti_pedidos_new();

              $show_noti = "";
              // Si muestro noti con sonido y alerta
             //+ if ($vende_nuevo > 0)
                //setcookie('notifi', "si", time() + 365 * 24 * 60 * 60 * 2);

            // var_dump($vende_nuevo);
              ?>

              
                <!-- <span class="rn-noti-float">5</span> -->
                <img class="noti-img" src="images/notification.png" alt="">

            <?php
             if ($pedidos_nuevo > 0): 
              ?>
                <!-- labels New -->
                  <div class="labels">
                    <div class="onhot"><?= $pedidos_nuevo ?></div>
                  </div>
        <?php
          endif;
        ?>

                <i class="fas fa-angle-down"></i>
          </a>

            <div class="dropdown-menu rn-left">
                <div class="dropdown-menu-inner">
                    <div class="arrow-up"></div>
                    <ul>
                        <li><a href="list_order_user.php?view_pedidos=si"><i class="fas fa-user-alt"></i>Tiene <span style="background-color: yellow"><?= $pedidos_nuevo ?></span> Pedido(s) Nuevo(s)</a></li>
                        
                    </ul>
                </div><!-- dropdown-menu-inner -->
            </div> <!-- /.dropdown-menu -->

        </li>

        <?php 

        // Si hay vendedor nuevo muestra el sonido por una vez
        // Tambien muestra la notifiacion
        if ( $pedidos_nuevo > 0 ){
          
        ?>

      <script>
        // llamo a la notificacion
        prueba_notificacion_pedidos_nuevos();
      </script>
        <audio  id="audio" autoplay >
          <source src="https://mishasho.com/moda-admin/public/audio/got-it-done.ogg" type="audio/ogg">
        </audio>
        <?php

        //setcookie('notifi', "no", time() + 365 * 24 * 60 * 60 * 2);
          }
        ?>

        <!-- == End Notification ==  -->

<?php
}

?>




        <li><a href="#">
          <img class="admin-img" src="images/profile_default.jpg" alt="">
                <?php echo $username; ?><i class="fas fa-angle-down"></i></a>

            <div class="dropdown-menu">
                <div class="dropdown-menu-inner">
                    <div class="arrow-up"></div>
                    <ul>
                        <li><a href="admin_profile.php?admin_id=<?php echo $admin_id; ?>"><i class="fas fa-user-alt"></i>Mi cuenta</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Salir</a></li>
                    </ul>
                </div><!-- dropdown-menu-inner -->
            </div><!-- dropdown-menu -->

        </li>
    </ul><!-- right-area -->

</header>


<style media="screen">
#audio{
display: none
}
</style>

<?php if (isset($_SESSION['SWVV'])){


if ($_SESSION['SWVV']==1){
$_SESSION['SWVV']=0;


?>

<div id="plHolder">
	<audio  id="audio" controls autoplay>
	  <source src="https://mishasho.com/moda-admin/public/audio/got-it-done.ogg" type="audio/ogg">
	</audio>
</div>
<?php 
}}

?>


<?php   

$user_id = $admin_id;
$ordered_products = find_ordered_products_user_by_order_id($user_id);

 $ix = 0; 
 if(!empty($ordered_products)){
            foreach ($ordered_products as $ordered_product) { 

            	$ix=$ix+1;
	}
}

$conttarpedidos=$ix;
?>

<script type="text/javascript">


var soundPlayer = {
  audio: null,
  muted: false,
  playing: false,
  _ppromis: null,
  puse: function () {
      this.audio.pause();
  },
  play: function (file) {
      if (this.muted) {
          return false;
      }
      if (!this.audio && this.playing === false) {
          this.audio = new Audio(file);
          this._ppromis = this.audio.play();
          this.playing = true;

          if (this._ppromis !== undefined) {
              this._ppromis.then(function () {
                  soundPlayer.playing = false;
              });
          }

      } else if (!this.playing) {

          this.playing = true;
          this.audio.src = file;
          this._ppromis = soundPlayer.audio.play();
          this._ppromis.then(function () {
              soundPlayer.playing = false;
          });
      }
  }
};



/*




var audio = document.getElementById("audio");
function llamar(){
//alert("play");
	audio.play();
}

function stopAudio() {
   audio.pause();
   audio.currentTime = 0;
}*/

var user_id="<?=$admin_id;?>";
var totalpedidoactual='<?=$conttarpedidos;?>';

var swd=0;

//alert(totalpedidoactual);

invertalrecargar =   setInterval(function () {
//cant++;
//console.log("cant"+cant);
var datos="";

if (swd==0){



var urlx="common/page.php?pagina=contarpedidos&user_id="+user_id;
//console.log(urlx);
//alert(urlx);
	//alert(urlx);

		$.get(urlx, function (response) {

			//var datos=response.trim();
			//alert("ver"+datos);
			
			if (totalpedidoactual==response){
				console.log("son iguales"+response);
				
			}else{


				console.log("alerta"+response);

				var urly="common/page.php?pagina=mandarvariable&swvv=1";
						$.get(urly, function (responsex) {
				});

				clearInterval(invertalrecargar);
				
				swd=1;
				location.reload();
				//llamar();
				//alert("Nuevo Pedido");

				// var opcion = confirm("Alerta de notificacion");
    //if (opcion == true) {
     // soundPlayer.play('https://mishasho.com/moda-admin/public/audio/got-it-done.ogg');
     // 
	//} else {
	  //  mensaje = "Has clickado Cancelar";
	//}

				
			}

		});

}



	}, 2000);


</script>

