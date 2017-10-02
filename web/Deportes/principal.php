<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$datos = Get_Deporte($id);
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'deportes'.'_'.$id);
?>
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="web/deportes.php">Deportes</a></li>
				<li class="active"><a href="web/Deportes/principal.php?id=<?php echo $id ?>"><?php echo $datos['nombre'];?></a></li>
			</ol>
		</div>
		<div class="content-info">
			<div class="container">
				<div class="col-md-12 popular">	
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr>
								<th style="width:25%"></th>
								<th style="width:75%"></th>
							</tr>
						</thead>
						<tbody>
							<tr style="color: #C0392B;font-size: 1.85em;font-family: 'Audiowide', cursive;margin: 0 0 12px 0;">
								<td>
									<img style=" width :100%; max-width:50px;" src="images/deportes/<?php echo $datos['logo'];?>" alt="">
								</td>
								<td><?php echo $datos['nombre'];?></td>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- content-bottom -->
			<div class="content-info">
				<div class="container">

					<div class="content-bottom-grids">
						<div class="col-md-4 welcome-pic">	
							<h3>Calendario</h3>
							<div style="max-height: 300px; overflow-y:scroll; ">
							<table style="width:100% " class="table table-condensed">
								<thead>
									<tr>
						        <!--<th style="width:40%">Pos</th>
						        <th style="width:20%">PJ</th>
						        <th style="width:30%">PG</th>
						    -->
						</tr>
					</thead>
					<tbody>
			<?php
				//contador para manejar cantidad en inicial
				$contador=0;
				$vector = Get_Lista_Partido_Deporte($id,'1');
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
							$datospartido = Get_Partido($valores['partido']);
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
			<div class="col-md-4 welcome-pic">
				<h3>Resultados</h3>
				<div style="max-height: 300px; overflow-y:scroll; ">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr>
						        <!--<th style="width:40%">Pos</th>
						        <th style="width:20%">PJ</th>
						        <th style="width:30%">PG</th>
						    -->
						</tr>
					</thead>
					<tbody>
							<?php
							//contador para manejar cantidad en inicial
								$contador=0;
										$vector = Get_Lista_Partido_Deporte($id,'2');
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

													<td><?php echo  Formato_Fecha_Sin_Ano($datospartido['fecha']).'<br>'.FormatoHora($datospartido['hora']); ?></td>

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
		<script src="js/responsiveslides.min.js"></script>
		<div class="col-md-4 welcome-pic">
			<h3>Tablas</h3>
			<div style="max-height: 300px; overflow-y:scroll;">
				<table style="width:100% " class="table table-condensed">
					<thead>
						<tr class="background">
							<th style="width:3%"></th>
							<th style="width:70%">Torneo</th>
							<th style="width:30%">Categoria</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$contador=1;
						$vector = Get_Lista_Torneos($id);
						foreach ($vector as $value)
						{
							?>
							<tr class="cursor-type" onclick="location.href='web/Deportes/tablas.php?id=<?php echo $value['id_torneo']; ?>'">
								<td><?php echo $contador;?></td>
								<td><?php echo $value['nombre_torneo']?></td>
								<td><?php echo $value['categoria']?></td>
							</tr>
							<?php
							$contador = $contador + 1;   
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	
</div>
</div>

	<?php
include('../../footerinicial.php');
	?>
