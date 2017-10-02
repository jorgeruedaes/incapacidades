<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$datos =Get_Equipos_Partido_Especial($id);
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'resultados_'.$id);

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li class="active">Resultados</li>
	</ol>
</div>
<!-- content-bottom -->
<div class="content-info">
	<div class="container">
		<div class="content-bottom-grids">
			<div class="col-md-12 popular">	
				
				<table style="width:100% " class="table table-condensed">
					<thead>
						<tr>
							<th style="width:auto"></th>
							<th style="width:auto"></th>
							<th style="width:auto"></th>
						</tr>
					</thead>
					<tbody>
						<tr style="color: #C0392B;font-size: 1.4em;font-family: 'Audiowide', cursive;margin: 0 0 10px 0;">
							<td><?php echo Get_Nombre_Torneo_Pasando_Partido($id); ?></td>
							<td colspan="2"><?php echo Get_Nombre_Partido($id); ?></td>
						</tr>
						<tr style="background:#DDDDDD">
							<td colspan="2">Lugar : <?php echo NombreCancha($datos['lugar']).", el día ".FormatoFecha($datos['fecha']); ?></td>
							<td>
								<a href="whatsapp://send?text=Resultado : <?php echo Get_Nombre_Partido($id);  ?>%20<?php echo $host . $url ?>" data-action="share/whatsapp/share">
									<img style="width: 100%; float:right; max-width: 30px;" src="images/whatsapp.png" >
								</a>
							</td>
						</tr>
					</tbody>
				</table>


			</div>
			<div class="clearfix"></div>
		</div>
		
	</div>
</div>
<!-- //content-bottom -->

<!-- content-2 PARTE  -->
<div class="content-info">
	<div class="container">
		<div class="content-bottom-grids">
			<div class="col-md-12 popular">	
				<h3>Participantes</h3>
				<div style="max-height: 300px; overflow-y:scroll;">
					<table style="width:100% " class="table table-condensed">
						<thead>
							<tr class="background">
								<th ></th>
								<th style="width:50%">Colegio</th>
								<th style="width:50%">Participante</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$contador =1;
							$vector = Get_Lista_Participantes($id);
							foreach ($vector as $value) {
								?>
								<tr>
									<td><?php echo $contador; ?></td>
									<td><?php echo $value['nombre']; ?></td>
									<td><?php echo $value['nombre_equipo']; ?></td>
								</tr>
								<?php
								$contador=$contador+1;
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