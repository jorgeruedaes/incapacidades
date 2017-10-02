<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'Programacion');
?>
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
					<h1>Programación por canchas</h1>
				</div>
				<div class="ec-breadcrumb">
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li>Programación</li>
						<li>Por canchas</li>
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
						<a class="font-25"  href="webs/Pdf/todosporcancha.php?flag=todosporcancha"  style="color:#4183D7" download>
							<span class="fa fa-file-pdf-o"></span>
						</a>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ec-simple-title">
						<h2>Canchas</h2>
						<p>Seleccione la cancha de la cual desea conocer la programación.</p>
					</div>
				</div>
				<div class="ec-services">
					<ul class="row">
						<?php

						$vector = ObtenerCanchasOrdenado('activo');
						echo (empty($vector)) ? '<cite>No hay canchas.</cite>' :'';
						foreach ($vector as $value)
						{

							$id = $value['id'];
							$nombre =$value['nombre'];
							?>
							<li class="col-md-3 add-pointer calendar-court"  id="<?php echo $id?>">
								<div class="ec-service-wrap calendar-image">
									<i class="fa fa-calendar" style="font-size: 3em;padding-bottom: 0.5em"></i>
									<h2 class="court-name-big"><?php echo $nombre; ?></h2>
									<p><?php echo $nombre; ?> </p>
								</div>
							</li>
							<?php
						}
						?>


					</ul>
				</div>

			</div>
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