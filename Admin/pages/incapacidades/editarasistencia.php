<?php  
$ubicacion ="../";
include("../menuinicial.php");
include($ubicacion."../php/partidos.php");
include($ubicacion."../php/equipo.php");
include($ubicacion."../php/jugador.php");
$id_modulos ='76';
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
	?>


	<!-- JQuery DataTable Css -->
	<link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								<?php echo Get_NombreEquipo($_GET['id']);  ?>
							</h2>
						</div>
						<div class="body">
							<table id="tabla1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Jugador</th>
										<?php
										$vector = Array_Get_Fechas($_GET['id'],'2');
										$i=1;
										foreach ($vector as $value) {
											?>
											<th style="width: 36px;">G</th>
											<th>A</th>
											<th>Fe: <?php echo $value['numero_fecha']?></th>

											<?php
										}
										?>
									</tr>
								</thead>
								<tbody>
									<?php
									$vector = Array_Get_Jugadores_Equipo($_GET['id']);
									foreach ($vector as  $value) {
										?>
										<tr>
											<td><?php echo String_Get_NombreCompleto($value['id_jugador']) ?></td>

											<?php
											$vectores = Array_Get_Fechas($_GET['id'],'2');
											foreach ($vectores  as $values) {
												?>
												<td>
													<div class="col-md-12">
														<div class="form-group">
															<div class="form-line">
																<input type="text" id="ronda" class="form-control gol"  
																value="<?php echo Get_Goles_Partido($value['id_jugador'],$values['numero_fecha'])?>" placeholder="0">
															</div>
														</div>
													</div>
												</td>
												<td>
													<select class="form-control show-tick select-tarjeta">

														<option value="5" <?php echo (Get_Amonestacion_Partido($value['id_jugador'],$values['numero_fecha'])=="5")?'selected':'' ?>>-</option>
														<option value="1" <?php echo (Get_Amonestacion_Partido($value['id_jugador'],$values['numero_fecha'])=="1")?'selected':'' ?>>A</option>
														<option value="2" <?php echo (Get_Amonestacion_Partido($value['id_jugador'],$values['numero_fecha'])=="2")?'selected':'' ?>>R</option>
													</select>

												</td>
												<td>
													<div class="col-md-3 col-xs-3">
														<input type="checkbox" id="md_checkbox_<?php echo $value['id_jugador']?>_<?php echo $values['numero_fecha']?>" class="filled-in chk-col-blue confirmacion" <?php echo (Bole_SabersiAsistio($value['id_jugador'],$values['numero_fecha'])==="true")?'checked':'' ?>  />
														<label for="md_checkbox_<?php echo $value['id_jugador']?>_<?php echo $values['numero_fecha']?>"></label>
													</div></td>
													<?php 
												}
												?>
											</tr>
											<?php
										}
										?> 


									</tbody>
								</table>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="card">
								<div class="body">
									<center>
										<button type="button" data-estado="<?php echo $partido['estado'] ?>" 
											data-fecha="<?php echo $partido['Nfecha']; ?>"
											class="btn btn-primary btn-lg m-l-15 waves-effect guardar-editar-goles" data-partido="<?php echo $_GET['id']?>">Guardar</button>
										</center>
									</div>

								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- JS ====================================================================================================================== -->
				<!--  Js-principal -->
				<script src="pages/partidos/js/asistencia.js"></script>

				<!-- Jquery DataTable Plugin Js -->
				<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
				<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
				<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

				<!-- Custom Js -->
				<script src="js/pages/tables/jquery-datatable.js"></script>



				<!-- Modal Dialogs ====================================================================================================================== -->
				<!-- Default Size -->
				<?php
			}else
			{
				require("../sinpermiso.php");
			}
			?>