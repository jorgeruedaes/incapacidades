<?php
include('../menuinicial.php');
$id_modulos="29";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'calendario');
?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
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
</div>
<!-- content-bottom -->
<div class="content-info">
	<div class="container">
		<div class="content-bottom-grids">
			<div class="col-md-6 popular">	
				<h3>Calendario</h3>
				<div style="max-height: 500px; overflow-y:scroll;">
				<table style="width:100% " class="table table-condensed">
					<thead>
						<tr>
							<th style="width:40%"></th>
							<th style="width:20%"></th>
							<th style="width:30%"></th>
						</tr>
					</thead>
					<tbody>
						<?php
							//contador para manejar cantidad en inicial
						$contador=0;
						$vector = Get_Lista_Torneos_Partido_Programados();
						echo (empty($vector)) ? '<cite>No hay partidos programos.</cite>' :'';
						foreach ($vector as $value)
						{
							
							$torneo =$value['id_torneo'];

							?>
							<tr class="background"  >
								<td colspan="2">Torneo : <?php echo $value['nombre_torneo']; ?></td>
								<td colspan="2">Categoria <?php echo $value['categoria']; ?>
								</td>
							</tr>
							<?php
							$vectores = Get_Lista_Partido_Por_Torneo($torneo,'1');
							foreach ($vectores  as $valores)
							{
								$datospartido =Get_Partido($valores['partido']);
								?>
								<?php
								if ($value['tipo_resultado']=='tiempo') 
								{
									?>
									<tr class="cursor-type" onclick="location.href='web/Calendario/calendario-especial.php?id=<?php echo $valores['partido']; ?>'">
										<td>
											<?php
											echo $datospartido['nombre_partido'];	
										}
										else
										{
											?>
											<tr class="cursor-type" onclick="location.href='web/Calendario/calendario.php?id=<?php echo $valores['partido']; ?>'">
												<td>
													<?php
													$datosequipos = Get_Equipos_Partido_Clasico($valores['partido']);
													echo NombreEquipo($datosequipos['equipo1']).' vs '.NombreEquipo($datosequipos['equipo2']);
												}

												?>
											</td>
											<td><?php echo  Formato_Fecha_Sin_Ano($datospartido['fecha']).'<br>'.FormatoHora($datospartido['hora']); ?></td>
											<td><?php echo NombreCancha($datospartido['lugar']); ?></td>

										</tr>
										<?php
										$contador=$contador+1;
									}


									
								}
								?>
							</tbody>
						</table>
						</div>

					</div>
					<div class="col-md-6 popular">
						<h3>Resultados</h3>
						<div style="max-height: 500px; overflow-y:scroll;">
						<table style="width:100% " class="table table-condensed">
							<thead>
								<tr>
									<th style="width:40%"></th>
									<th style="width:20%"></th>
									<th style="width:30%"></th>
								</tr>
							</thead>
							<tbody>
								<?php
							//contador para manejar cantidad en inicial
								$contador=0;
								$vector = Get_Lista_Torneos_Partido_Terminados();
								echo (empty($vector)) ? '<cite>No hay partidos terminados.</cite>' :'';
								foreach ($vector as $value)
								{
									
									$torneo =$value['id_torneo'];

									?>
									<tr class="background"  >
										<td colspan="2">Torneo: <?php echo $value['nombre_torneo']; ?></td>
										<td colspan="2">Categoria <?php echo $value['categoria']; ?>
										</td>
									</tr>
									<?php
									$vectores = Get_Lista_Partido_Por_Torneo($torneo,'2');
									foreach ($vectores  as $valores)
									{
										$datospartido =Get_Partido($valores['partido']);

										if ($value['tipo_resultado']=='tiempo') 
										{
											?>
											<tr class="cursor-type" onclick="location.href='web/Resultados/resultado-especiales.php?id=<?php echo $valores['partido']; ?>'">

												<td colspan="2"><?php echo $datospartido['nombre_partido'] ?></td>

												<td><?php echo  Formato_Fecha_Sin_Ano($datospartido['fecha']).' '.FormatoHora($datospartido['hora']); ?></td>

											</tr>	
											<?php
										}
										else
										{
											$datosequipos = Get_Equipos_Partido_Clasico($valores['partido']);
											?>
											<tr class="cursor-type" onclick="location.href='web/Resultados/resultados.php?id=<?php echo $valores['partido']; ?>'">

												<td><?php echo NombreEquipo($datosequipos['equipo1']) ?></td>
												<td><?php echo  $datosequipos['resultado1'].'-'.$datosequipos['resultado2']; ?></td>
												<td><?php echo NombreEquipo($datosequipos['equipo2']); ?></td>
											</tr>	
											<?php
										}
										?>
										<?php
										$contador=$contador+1;
									}
								}
								?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="col-md-4 welcome-pic">
					</div>
				</div>
			</div>
		</div>
		<?php
		include('../footerinicial.php');
		?>