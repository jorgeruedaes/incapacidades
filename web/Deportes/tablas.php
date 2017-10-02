<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$datos = Get_Torneo($id);
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
						<td><?php echo $datos['nombre_torneo'].' '.$datos['categoria']?></td>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="content-info">
		<div class="container">

			<div class="content-bottom-grids">
				<?php
				$vector = Get_Lista_Grupos($id);
				echo (empty($vector)) ? '<cite>No hay grupos.</cite>' :'';
				foreach ($vector as $value)
				{
					?>

					<div class="col-md-6 welcome-pic">	
						<h3>Tabla de posiciones <?php 	echo (sizeof($vector)==1) ? '' :'grupo '.$value['grupo']; ; ?> </h3>
						<table style="width:100% " class="table table-condensed">
							<thead>
								<tr  class="background">
									<th></th>
									<th>Equipo</th>
									<th>PT</th>
									<th>PJ</th>
									<th>PG</th>
									<th>PE</th>
									<th>PP</th>
									<th>GF</th>
									<th>GC</th>
									<th>GD</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$contador =1;
								$vector = ObtenerTablaPosiciones('25',$value['grupo'],$id);
								echo (empty($vector)) ? '<tr><td><cite>No hay  resultados.</cite></td></tr>' :'';
								foreach ($vector as  $value) 
									{?>
										<tr>
											<th><?php echo $contador; ?></th>
											<th><?php echo NombreEquipo($value['id']);  ?></th>
											<th><?php echo $value['puntos']; ?></th>
											<th><?php echo $value['pj']; ?></th>
											<th><?php echo $value['pg']; ?></th>
											<th><?php echo $value['pe']; ?></th>
											<th><?php echo $value['pp']; ?></th>
											<th><?php echo $value['gf']; ?></th>
											<th><?php echo $value['gc']; ?></th>
											<th><?php echo $value['dg']; ?></th>
										</tr>
										<?php
										$contador = $contador+1;
									}
									?>
								</tbody>
							</table>
						</div>
						<?php
					}
					?>

				</div>
			</div>


			<?php
			include('../../footerinicial.php');
			?>
