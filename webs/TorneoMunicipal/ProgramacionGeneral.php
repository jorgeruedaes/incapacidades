<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'Programacion');
?>
<!DOCTYPE html>
<head>
	<link href="css/bootstrap.css" rel="stylesheet">
	<style>
		
		@font-face { font-family: Bariol; src: url('webs/fonts/FontBariol.otf'); } 

	</style>
</head>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
	<span class="ec-blue-transparent"></span> 
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ec-mini-title">
					<h1>Programación general</h1>
				</div>
				<div class="ec-breadcrumb">
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li>Programación</li>
						<li>General</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ec-main-content">
	<!--// Main Section \\-->
	<div class="ec-main-section">
		<div class="container">
			<div class="row">
				<div class="col-md-5 float-right">
					<p class="float-right font-20 add-pointer"  style="margin-right: 30px">Descargar programación
						<a class="font-25"  target="_blank"  href="../Archivos/Documentos/programacion.pdf"  style="color:#4183D7">
							<span class="fa fa-file-pdf-o"></span>
						</a>
					</p>
				</div>
			</div>
			<br>
			<?php
		//	$vector = ObtenerCanchasDePartidos('1');
			$vector =	ObtenerFechasdePartidos('1','asc');
			foreach ($vector as $value)
			{				 
				$idcancha = $value['lugar'];
				$fecha = $value['fecha'];

				?>
				<div class="row">
					<div class="col-md-12">
						<div class="ec-fancy-title">
							<h2><?php echo ObtenerNombreCancha($value['lugar'])?></h2>
							<h2 style="float: right"><?php echo FormatoFecha_Dia($fecha).' ' ?> <?php echo FormatoFecha($fecha)?></h2>
						</div>
						<table id="tablaprogramacion">
							<tbody>
								<?php

								$vectores = ObtenerPartidoDeUnaFecha($fecha,'1',$idcancha);

								echo (empty($vectores)) ? '<div class="center"><cite>No se ha cargado programación.</cite></div>' :'';
								foreach ($vectores as $values)
								{
									?>

									<tr class="calendar-detail add-pointer" id="<?php echo $values['id_partido']?>">
										<td class="ten table-calendar" ><?php echo FormatoHora($values['hora']) ?></td>
										<td class="ten table-calendar"> <?php echo CategoriaEquipo($values['equipo1']) ?></td>
										<td class="ten table-calendar"><img class="width-45"  src="<?php echo LogoClub(ClubEquipo($values['equipo1']))?>" /></td>
										<td class="thirty table-calendar" ><?php echo  NombreEquipo($values['equipo1'])?></td>
										<td class="eight table-calendar" ><span class="ec-fixture-vs"><small style="width: 40px;height: 40px;padding-top: 0px">vs</small></span></td>
										<td class="ten table-calendar" ><img class="width-45" src="<?php echo LogoClub(ClubEquipo($values['equipo2']))?>" /></td>
										<td class="thirty table-calendar"><?php echo  NombreEquipo($values['equipo2'])?></td>
									</tr>
									<?php


								}

								?>
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<?php
			}
			?>

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
	<!--// Main Section \\-->
</div>
<?php
include('../../footerinicial.php');
?>

<script src="webs/js/index.js"></script>
<script src="script/bootstrap.min.js"></script>