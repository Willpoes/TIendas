<?php require_once('../private/init.php'); include "../configuration.php";?>
<?php

$ssite_name = ""; $stag = ""; $ssite_logo = ""; $spanel_currency="";$politicas=""; $ssetting_id="";


$error_msg = (!empty($_GET['errormsg'])) ? $_GET['errormsg'] : "";
$settings = [];
$admin_id = "";
$username = "";
$admin_info = logged_in();
$destinos=traer_destinos();
$departamentos=traer_departamentos();

if(!empty($admin_info)){
    $admin_id = $admin_info[0];
    $username = $admin_info[1];
    $settings = find_setting_of_admin($admin_id);

	if(!empty($settings['panel_site_name'])) $ssite_name = $settings['panel_site_name'];
	if(!empty($settings['panel_tag_line'])) $stag = $settings['panel_tag_line'];
	if(!empty($settings['panel_logo_name'])) $ssite_logo  = $settings['panel_logo_name'];
	if(!empty($settings['panel_currency'])) $spanel_currency = $settings['panel_currency'];
	if(!empty($settings['setting_id'])) $ssetting_id = $settings['setting_id'];
	if(!empty($settings['politicas'])) $politicas = $settings['politicas'];


}else{
    redirect_to_login();
}

$message = "";
$message_param = "setting";
if(empty($settings)){
    $message = "No Settings Found.";
}else if(!empty(get_msg_all($message_param))){
    $message = get_msg_all($message_param);
    unset_msg_all($message_param);
}



?>

<?php require("common_update/head.php"); ?>

<body>

<?php require("common_update/heading_menu.php"); ?>


<section class="main-body">
    <?php require("common_update/sidebar.php"); ?>


    <div class="main-contents">
        <div class="recent-products">
        		<div class="message-wrapper">
					<h5 class="message"><?php echo $message; ?></h5>
					<h6><a style="margin-right: 10px;background-color: cadetblue ; " class="add-product-btn btn" onclick="update_departa()" >Actualizar Departamentos</a></h6>
					<h6 ><a style="margin-right: 10px;background-color: cadetblue ; " class="add-product-btn btn" onclick="update_provin()" >Actualizar Provincias</a></h6>
					
					<h6><a style="margin-right: 10px;" class="add-product-btn btn" data-toggle="modal" data-target="#openModal">+ <?php echo $lang['Anadir']." ".$lang['Destinos']; ?></a></h6>
				</div>
		<div class="res_registro">

	
				<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Cod_destino</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Distrito</th>
				<th>Costo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
        foreach ($destinos as $des) {
           $id_destino=$des['id_destino'];
           $departamento=$des['departamento'];
           $provincia=$des['provincia'];
           $distrito=$des['distrito'];
           $precio=$des['precio'];
           $estado=$des['estado'];
           ?>
           <tr>
                <td><?php echo $id_destino;?></td>
                <td><?php echo $departamento;?></td>
                <td><?php echo $provincia;?></td>
                <td><?php echo $distrito;?></td>
                <td>s/. <?php echo $precio;?></td>
                <td><?php echo $estado;?></td>
                <td>
				<a  onclick="edit_modal('<?php echo $id_destino; ?>')">
				<i class="fas fa-edit"></i></a>
				<a  onclick="delete_destino('<?php echo $id_destino; ?>')">
				<i class="fas fa-trash-alt"></i></a>
				</td>
            </tr>
           <?php
        }
        ?>
			
            
            
        </tbody>
    </table><!-- add-product -->
	</div>
        </div><!-- recent-products -->
    </div><!-- main-content -->
</section><!--main-body -->
<div id="openModal" class="modal">
	<div class="modal-dialog">
		<div class="modal-content modal-lg">
		
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $lang['Anadir']." ".$lang['Destinos']; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form class="add_destino form-horizontal" method="POST" action="../private/add_destino.php">	
					<!-- ===== Campos Nuevos =====  -->
					<input type="hidden" name="accion" value="registrar_ruta">
					<div class="input-wrap-new">
						<span class="titulos-input">Departamento</span>
						<select  id="ad_departamento" name="ad_departamento" required onchange="traer_provicias()">
							<option value="">Seleccione</option>
							<?php
							foreach ($departamentos as $dep) {
								$id_departamento=$dep['id'];
								$name_departamento=$dep['name'];
							?>
							<option value="<?php echo $id_departamento; ?>"><?php echo $name_departamento; ?></option>
							<?php
							}
							?>
							
						</select>
					</div>

					<div class="input-wrap-new">
						<span class="titulos-input">Provincia</span>
						<select class="res_provincia"  id="ad_provincia" name="ad_provincia" required onchange="traer_distritos()">
							<option value="">Seleccione</option>
						</select>
					</div>

					<div class="input-wrap-new">
						<span class="titulos-input">Distrito</span>
						<select  class="res_distritos" id="ad_distrito" name="ad_distrito" required>
							<option value="">Seleccione</option>
						</select>
					</div>

					<div class="input-wrap-new">
						<span class="titulos-input">Precio</span>
						<input type="number" name="ad_precio" id="ad_precio"  placeholder="0.00">
					</div>
					<div class="input-wrap-new">
						<span class="titulos-input">Estado</span>
						<select  id="ad_estado" name="ad_estado" required>
							<option value="Activo">Activo</option>
							<option value="Desactivado">Desactivado</option>
						</select>
						
					</div>

						
					
					<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang['Cerrar'] ?></button>
					<button type="submit" class="btn btn-primary"><?php echo $lang['Ingresar'] ?></button>
			</div>
					

				</form>
			</div>
			
		</div>
	</div>
</div>
<div id="editModal" class="modal">
	<div class="modal-dialog">
		<div class="modal-content modal-lg">
		
			<div class="modal-header">
				<h4 class="modal-title">Editar Destino</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body edit_respuesta">
				
			</div>
			
		</div>
	</div>
</div>
<div id="eactivProv" class="modal">
	<div class="modal-dialog">
		<div class="modal-content modal-lg">
		
			<div class="modal-header">
				<h4 class="modal-title">Actualizar Por Provincia</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body prov_respuesta">
				
			</div>
			
		</div>
	</div>
</div>
<div id="eactivDepa" class="modal">
	<div class="modal-dialog">
		<div class="modal-content modal-lg">
		
			<div class="modal-header">
				<h4 class="modal-title">Actualizar Por Departamento</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body depa_respuesta">
				
			</div>
			
		</div>
	</div>
</div>
<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
<script src="./plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="./plugin-frameworks/js/popper.min.js"></script>
  <script src="./plugin-frameworks/js/bootstrap.bundle.min.js"></script>
<script src="./plugin-frameworks/js/jquery.dataTables.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugin-frameworks/js/dataTables.responsive.min.js"></script>
<script src="./plugin-frameworks/js/responsive.bootstrap4.min.js"></script>

<!-- Main Script -->
<script src="common_update/script.js"></script>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );


</script>


</body>
</html>