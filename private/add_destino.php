<?php
require_once('init.php');
if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'traer_provincia':
            $id_departamento=$_GET['id_depa'];
            $provincia=traer_provincias($id_departamento);
            ?>
            <option value="">Seleccione</option>
            <?php
            foreach ($provincia as $prov) {
                $id_provi=$prov['id'];
                $name_provi=$prov['name'];
                ?>
                <option value="<?php echo $id_provi; ?>"><?php echo $name_provi; ?></option>
                <?php
                # code...
            }
            break;
        case 'traer_distrito':
            $id_departamento=$_GET['id_depa'];
            $id_provincia=$_GET['id_prov'];
            $distrito=traer_distrito($id_provincia,$id_departamento);
            ?>
            <option value="">Seleccione</option>
            <?php
            foreach ($distrito as $dis) {
                $id_dis=$dis['id'];
                $name_dis=$dis['name'];
                ?>
                <option value="<?php echo $id_dis; ?>"><?php echo $name_dis; ?></option>
                <?php
                # code...
            }
            break;
        case 'eliminar_destino':
            $id_destino=$_GET['id_destino'];
            $eliminar_destino=eliminar_destino($id_destino);
            if ($eliminar_destino>0) {
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
            } else {
                # code...
            }
            
            
            # code...
            break;
        case 'traer_destino':
            $id_destino=$_GET['id_destino'];
            $destino=traer_destino_id($id_destino);
            foreach ($destino as $dis) {
                $departamento=$dis['departamento'];
                $provincia=$dis['provincia'];
                $distrito=$dis['distrito'];
                $precio=$dis['precio'];
                $estado=$dis['estado'];
                ?>
                <form class="edit_destino form-horizontal" method="POST" action="../private/add_destino.php">	
					<!-- ===== Campos Nuevos =====  -->
					<input type="hidden" name="accion" value="editar_destino">
                    <input type="hidden" name="id_destino" value="<?php echo $id_destino;?>">
					<div class="input-wrap-new">
						<span class="titulos-input">Departamento</span>
						<select disabled  id="ad_departamento" name="ad_departamento" >
							<option value="<?php echo $departamento;?>"><?php echo $departamento;?></option>
							
							
						</select>
					</div>

					<div class="input-wrap-new">
						<span class="titulos-input">Provincia</span>
						<select disabled  id="ad_provincia" name="ad_provincia" >
							<option value="<?php echo $provincia;?>"><?php echo $provincia;?></option>
						</select>
					</div>

					<div class="input-wrap-new">
						<span class="titulos-input">Distrito</span>
						<select  disabled id="ad_distrito" name="ad_distrito" >
							<option value="<?php echo $distrito;?>"><?php echo $distrito;?></option>
						</select>
					</div>

					<div class="input-wrap-new">
						<span class="titulos-input">Precio</span>
						<input type="number" name="ad_precio" id="ad_precio"  value="<?php echo $precio;?>" required>
					</div>
					<div class="input-wrap-new">
						<span class="titulos-input">Estado</span>
						<select  id="ad_estado" name="ad_estado" required>
							<?php
                            if ($estado=="Activo") {
                               ?>
                               <option value="Activo" selected>Activo</option>
                               <option value="Desactivado">Desactivado</option>
                               <?php
                            } else {
                                ?>
                                <option value="Activo" >Activo</option>
                               <option value="Desactivado" selected>Desactivado</option>
                                <?php
                            }
                            
                            ?>
						</select>
						
					</div>

						
					
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>
					

				</form>
                <script src="common_update/script.js"></script>
                <?php
            }
            break;
        case 'traer_provincia_destino':
            
            $id_departamento=$_GET['id_depa'];
            $provincia=traer_provincias_destino($id_departamento);
            ?>
            <option value="">Seleccione</option>
            <?php
            foreach ($provincia as $prov) {
                $id_provi=$prov['id_provincia'];
                $name_provi=$prov['name'];
                ?>
                <option value="<?php echo $id_provi; ?>"><?php echo $name_provi; ?></option>
                <?php
                # code...
            }
            break;
        default:
            # code...
            break;
    }
}elseif (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'editar_destino':
            $id_destino=$_POST['id_destino'];
            $precio=$_POST['ad_precio'];
            $estado=$_POST['ad_estado'];
            $editar_destino=editar_destino_id($id_destino,$precio,$estado);
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
            break;
        
        default:
        $cod_departamento=$_POST['ad_departamento'];
        $cod_provincia=$_POST['ad_provincia'];
        $cod_distrito=$_POST['ad_distrito'];
        $precio=$_POST['ad_precio'];
        $estado=$_POST['ad_estado'];
        $datos_destino=['CodD'=>$cod_departamento,
                        'CodP'=>$cod_provincia,
                        'CodDi'=>$cod_distrito,
                        'Precio'=>$precio,
                        'Estado'=>$estado];
        $evaluar_existe=evaluar_existe_destino($datos_destino);
        if ($evaluar_existe) {
            $destinos=traer_destinos();
                ?>
                <p style="color: red;">*Los datos ingresados ya existen.</p>
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
        }else {
            if (insertar_destino($datos_destino)>-1) {
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
            } else {
                echo "orror";
            }
        }
        
        
            break;
    }
    
    
    
} else {
    # code...
}

?>