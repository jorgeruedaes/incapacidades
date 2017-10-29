<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/clientes.php');
include('../../php/empresas.php');
$id_modulos =Int_RutaModulo($_SERVER['REQUEST_URI']);

if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
	?>


	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					<ol class="breadcrumb">
						<li>
							<a href="pages/administracion.php">
								<!--<i class="material-icons">home</i>-->
								Administración
							</a>
						</li>
						<?php
						$vector = Array_Get_PadreHijo($id_modulos);
						foreach ($vector as $value)
						{
							?>
							<li>
								<a href="<?php echo $value['ruta'] ?>" class="active">
									<!--<i class="material-icons"><?php echo $value['icono'] ?></i>-->
									<?php echo $value['nombre'] ?>
								</a>
							</li>
							<?php
						}
						?>
					</ol>
				</h2>
			</div>
			<!-- Basic Table -->
			<div class="row ">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								GESTION DE CLIENTES 
							</h2>
							<ul class="header-dropdown m-r--5">
								<li></li>
								<li>
									<button type="button" class="btn bg-red 
									waves-effect add-perfil">
									<i class="material-icons">add</i>
								</button>

							</li>
							<li></li>
						</ul>
					</div>
					<div class="body">
						<table  id="tabla-clientes" class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Acronimo</th>
									<th>Empresa</th>
									<th>Estado</th>
									<th width="10">Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Clientes(false);
								foreach ($vector as  $value) {
									?>
									<tr>
										<th scope="row"><?php echo $value['id_clientes']; ?></th>
										<td><?php echo $value['nombre']; ?></td>
										<td><?php echo $value['acronimo']; ?></td>
										<td> <?php echo Get_nombre_empresa($value['empresa']); ?></td>
										<td><?php echo $value['estado']; ?></td>
										<td>
											<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
												<button 

												data-nombre="<?php echo $value['nombre']; ?>" 
												data-acronimo="<?php echo $value['acronimo']; ?>" 
												data-empresa="<?php echo $value['empresa']; ?>" 
												data-clientes="<?php echo $value['id_clientes']; ?>" 
												data-estado="<?php echo $value['estado']; ?>" 
												type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button>
											</div>

										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- JS ====================================================================================================================== -->
<!--  Js-principal -->
<script src="pages/maestros/js/clientes.js"></script>

<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Nuevo Cliente</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="">Cliente</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control n-nombre" placeholder="Nombre del cleinte" />
							</div>
						</div>
						<label for="">Acronimo</label>
						<div class="form-group ">
							<input type="text" class="form-control n-acronimo" placeholder="Acronimo" />
						</div>
						<label for="">Empresa</label>
						<div class="form-group ">
							<select class="form-control show-tick select-n-empresa">
								<option value="">--Selecciona una Empresa --</option>

								<?php
								$vector = Array_Get_Empresas();
								foreach ($vector as  $value) { 
									?>
									<option value="<?php echo $value['id_empresas'] ?>"><?php echo $value['nombre'] ?></option>	
									<?php
								}
								?>
							</select>
						</div>
						<label for="">Estado</label>
						<div class="form-group ">
							<select class="form-control show-tick select-n-estado">
								<option value="">--Selecciona un estado --</option>

								<option value="activo">Activo</option>
								<option value="inactivo">Inactivo</option>

							</select>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info waves-effect guardar-nuevo">Guardar</button>
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Dialogs ====================================================================================================================== -->
<!-- Default Size -->
<div class="modal fade" id="defaultModal" data-empresa="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Edición Clientes</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="">Cliente</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nombre" placeholder="Nombre del cliente" />
							</div>
						</div>
						<label for="">Acronimo</label>
						<div class="form-group ">
							<input type="text" class="form-control acronimo" placeholder="Acronimo" />
						</div>
						<label for="">Empresa</label>
						<div class="form-group ">
							<select class="form-control show-tick select-empresa">
								<option value="">--Selecciona una Empresa --</option>

								<?php
								$vector = Array_Get_Empresas();
								foreach ($vector as  $value) { 
									?>
									<option value="<?php echo $value['id_empresas'] ?>"><?php echo $value['nombre'] ?></option>	
									<?php
								}
								?>
							</select>
						</div>
						<label for="">Estado</label>
						<div class="form-group ">
							<select class="form-control show-tick select-estado">
								<option value="">--Selecciona un estado --</option>

								<option value="activo">Activo</option>
								<option value="inactivo">Inactivo</option>

							</select>
						</div>

					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info waves-effect guardar">Guardar cambios</button>
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- Default Size -->
<div class="modal fade" id="defaultModalReglamentos" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Agregar logo</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form action="pages/campeonatos/peticiones/peticiones.php" class="dropzone"  id="frmFileUpload"  method="post" enctype="multipart/form-data">
						<div class="dz-message">
							<div class="drag-icon-cph">
								<i class="material-icons">touch_app</i>
							</div>
							<h3>Arrastra el archivo o Haz click para cargarlo.</h3>
							<em>(Selecciona solamente  <strong>un (1 )</strong> Archivo.)</em>
						</div>
						<div class="fallback">
							<input name="file[]" type="file" multiple />
						</div>
						<input name="bandera" type="hidden" value="modificar-reglamentos"/>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info waves-effect guardar-reglamentos">Guardar</button>
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="imagenesvisor" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Logo Club</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<div class="row clearfix">
						<!-- Basic Example -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="card">
								<div class="header">
									<h2></h2>
								</div>

								<img id="imagenes" src="" />

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>



<?php
}else
{
	require("../sinpermiso.php");
}
?>


