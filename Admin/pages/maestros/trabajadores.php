<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/trabajadores.php');
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
								GESTIÓN DE EMPLEADOS
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
						<table  id="tabla-trabajadores" class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th width="10%">Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Trabajadores();
								foreach ($vector as  $value) {
									?>
									<tr>
										<th scope="row"><?php echo $value['id_trabajadores']; ?></th>
										<td><?php echo $value['nombre']; ?></td>
										<td><?php echo $value['apellido']; ?></td>
										<td>
											<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
												<button 

												data-nombre="<?php echo $value['nombre']; ?>" 
												data-cedula="<?php echo $value['id_trabajadores']; ?>" 
												data-apellido="<?php echo $value['apellido']; ?>" 
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
<script src="pages/maestros/js/trabajadores.js"></script>

<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Nuevo Trabajador</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="">Documento</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control n-cedula" placeholder="Documento" />
							</div>
						</div>
						<label for="">Nombre</label>
						<div class="form-group ">
							<input type="text" class="form-control n-nombre" placeholder="Nombre" />
						</div>
						<label for="">Apellido</label>
						<div class="form-group ">
							<input type="text" class="form-control n-apellido" placeholder="Apellido" />
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
<div class="modal fade" id="defaultModal" data-trabajadores="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Edición Trabajadores</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="">Documento</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control cedula" placeholder="Documento" />
							</div>
						</div>
						<label for="">Nombre</label>
						<div class="form-group ">
							<input type="text" class="form-control nombre" placeholder="Nombre" />
						</div>
						<label for="">Apellido</label>
						<div class="form-group ">
							<input type="text" class="form-control apellido" placeholder="Apellido" />
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
<?php
}else
{
	require("../sinpermiso.php");
}
?>


