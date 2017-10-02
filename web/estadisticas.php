<?php
include('../menuinicial.php');
include('../Admin/php/posiciones.php');
$id_modulos="30";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'estadisticas');
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
			<div class="col-md-8 popular" >	
				<h3>Posiciones</h3>
				<div style="max-height: 750px; overflow-y:scroll;">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr class="background">
								<th></th>
								<th>Equipo</th>
								<th>PT</th>
								<th>PJ</th>
								<th>PG</th>
								<th >PE</th>
								<th >PP</th>
								<th >GF</th>
								<th >GC</th>
								<th >GD</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$contador =1;
							$vector = ObtenerTablaPosiciones('23');
							foreach ($vector as $datos)
							{

								?>
								<tr>
									<td  class="posicion" id="<?php echo $contador; ?>">  <?php echo $contador; ?> </td>
									<td>  <?php echo $datos['equipo']; ?> </td>
									<td>  <?php echo $datos['puntos']; ?> </td>
									<td>  <?php echo $datos['pj']; ?> </td>
									<td>  <?php echo $datos['pg']; ?> </td>
									<td>  <?php echo $datos['pe']; ?> </td>
									<td>  <?php echo $datos['pp']; ?> </td>
									<td>  <?php echo $datos['gf']; ?> </td>
									<td>  <?php echo $datos['gc']; ?> </td>
									<td>  <?php echo $datos['dg']; ?> </td>
								</tr>
								<?php
								$contador = $contador + 1;
							}

							?>

						</tbody>
					</table>
				</div>

			</div>
			<div class="col-md-4 popular">

				<h3>Goleadores de la fecha</h3>
				<div style="max-height: 450px; overflow-y:scroll;">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr  class="background">
								<th></th>
								<th >Equipo</th>
								<th >Jugador</th>
								<th >Goles</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$contador=1;
							$vector = Goleadores_De_Fecha();
							foreach ($vector as $value)
							{
								?>
								<tr>
									<td><?php echo $contador;?></td>
									<td><?php echo NombreEquipo($value['equipo']) ?></td>
									<td><?php echo ObtenerNombreCompletoJugador($value['jugador']); ?></td>
									<td><?php echo $value['goles']; ?></td>
								</tr>
								<?php
								$contador = $contador + 1;
							}
							?>
						</tbody>
					</table>
				</div>


				<br>

				<h3>Goleadores</h3>
				<div style="max-height: 375px; overflow-y:scroll;">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr class="background">
								<th></th>
								<th >Equipo</th>
								<th >Jugador</th>
								<th >PJ</th>
								<th>Goles</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$contador=1;
							$vector = Array_Goleadores_Jugadores('50');
							foreach ($vector as $value)
							{
								?>
								<tr>
									<td><?php echo $contador;?></td>
									<td><?php echo NombreEquipo($value['id_equipo']) ?></td>
									<td><?php echo ObtenerNombreCompletoJugador($value['jugador']); ?></td>
									<td><?php echo Int_PartidosAsistidos_Jugador($value['jugador']) ?></td>
									<td><?php echo $value['goles']; ?></td>
								</tr>
								<?php
								$contador = $contador + 1;
							}
							?>
						</tbody>
					</table>
				</div>

			</div>

		</div>

		<div class="clearfix"></div>
	</div>
	<div class="container">
		<div class="content-bottom-grids">
			<div class="col-md-6 popular">	
				<h3>Equipos más goleadores</h3>
				<div style="max-height: 300px; overflow-y:scroll;">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr class="background">
								<th></th>
								<th >Equipo</th>
								<th >Goles</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$contador=1;
							$vector = ObtenerTablaEquipoGoleador();
							foreach ($vector as $value)
							{
								?>
								<tr>
									<td><?php echo $contador; ?> </td>
									<td><?php echo $value['equipo']; ?></td>
									<td><?php echo $value['gf']; ?> </td>
								</tr>
								<?php
								$contador = $contador + 1;
							}
							?>
						</tbody>
					</table>
				</div>


			</div>
			<div class="col-md-6 popular">
				<h3>Valla menos vencida</h3>
				<div style="max-height: 300px; overflow-y:scroll;">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr class="background">
								<th></th>
								<th >Equipo</th>
								<th >Goles</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$vector = ObtenerTablaVayaMenovencida();
							$contador = 1;
							foreach ($vector as  $value)
							{     
								?>
								<tr>
									<td><?php echo $contador; ?> </td>
									<td><?php echo $value['equipo']; ?></td>
									<td><?php echo $value['gc']; ?> </td>
								</tr>
								<?php
								$contador = $contador + 1;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
	</div>

</div>
</div>
<br>
<br>
<?php
include('../footerinicial.php');
?>
