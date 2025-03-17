<?php
require_once('init.php');
if(isset($_GET['accion'])){
    switch ($_GET['accion']) {
		case 'traer_provincia':
		    $departamentos=traer_departamentos_destino();
			?>
			<form class="update_provincia form-horizontal" method="POST" action="../private/update_prov_dis.php">	
					<!-- ===== Campos Nuevos =====  -->
					<input type="hidden" name="accion" value="actualizar_provincia">
					<div class="input-wrap-new">
						<span class="titulos-input">Departamento</span>
						<select  id="ad_departamento_mod" name="ad_departamento" required onchange="traer_provicias_destino()">
							<option value="">Seleccione</option>
							<?php
							foreach ($departamentos as $dep) {
								$id_departamento=$dep['id_departamento'];
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
						<select class="res_provincia_mod"  id="ad_provincia" name="ad_provincia" required >
							<option value="">Seleccione</option>
						</select>
					</div>
					<div class="input-wrap-new">
						<span class="titulos-input">Estado</span>
						<select  id="ad_estado" name="ad_estado" required>
							<option value="Activo">Activo</option>
							<option value="Desactivado">Desactivado</option>
						</select>
						
					</div>

						
					
					<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
					

				</form>
					<script src="common_update/script.js"></script>
			<?php
			break;
		case 'traer_departamento':
		    $departamentos=traer_departamentos_destino();
		    ?>
		    <form class="update_departamento form-horizontal" method="POST" action="../private/update_prov_dis.php">	
					<!-- ===== Campos Nuevos =====  -->
					<input type="hidden" name="accion" value="actualizar_departamento">
					<div class="input-wrap-new">
						<span class="titulos-input">Departamento</span>
						<select  id="ad_departamento" name="ad_departamento" required>
							<option value="">Seleccione</option>
							<?php
							foreach ($departamentos as $dep) {
								$id_departamento=$dep['id_departamento'];
								$name_departamento=$dep['name'];
							?>
							<option value="<?php echo $id_departamento; ?>"><?php echo $name_departamento; ?></option>
							<?php
							}
							?>
							
						</select>
					</div>

					
					<div class="input-wrap-new">
						<span class="titulos-input">Estado</span>
						<select  id="ad_estado" name="ad_estado" required>
							<option value="Activo">Activo</option>
							<option value="Desactivado">Desactivado</option>
						</select>
						
					</div>

						
					
					<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Actualizar</button>
			        </div>
					

				</form>
				
				<script src="common_update/script.js"></script>
		    <?php
		    
			break;
		
		default:
			# code...
			break;
	}
}else{
    switch ($_POST['accion']) {
		case 'actualizar_departamento':
		    $id_departamento=$_POST['ad_departamento'];
		    $nuevo_estado=$_POST['ad_estado'];
		    $traer_dep_destino=traer_departamentos_registrados($id_departamento);
		    foreach ($traer_dep_destino as $dep) {
        		$id_destino=$dep['id_destino'];
        		$actualizar_depa=actualizar_por_departamentos($id_destino,$nuevo_estado);
        	}
			if($actualizar_depa==true){
			            $destinos=traer_destinos();
                ?>
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
                </table>
                <script>
                	$(document).ready(function() {
                    $('#example').DataTable();
                } );
                
                
                </script>
                <?php
			}else{
			    
			}
			break;
		case 'actualizar_provincia':
			$id_departamento=$_POST['ad_departamento'];
			$id_provincia=$_POST['ad_provincia'];
		    $nuevo_estado=$_POST['ad_estado'];
		    $traer_prov_destino=traer_provincias_all($id_departamento,$id_provincia);
		    foreach ($traer_prov_destino as $prov) {
        		$id_destino=$prov['id_destino'];
        		$actualizar_depa=actualizar_por_provincias($id_destino,$nuevo_estado);
        	}
			if($actualizar_depa==true){
			            $destinos=traer_destinos();
                ?>
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
                </table>
                <script>
                	$(document).ready(function() {
                    $('#example').DataTable();
                } );
                
                
                </script>
                <?php
			}else{
			    
			}
			break;
		default:
			# code...
			break;
	}
}
?>