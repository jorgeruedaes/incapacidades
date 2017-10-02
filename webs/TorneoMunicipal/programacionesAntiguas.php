<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'programcionesantiguas');
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
					<h1>Programaciones Antiguas</h1>
				</div>
				<div class="ec-breadcrumb">
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li>Programaciones Antiguas</li>
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
			<br>
			<div class="row">
					<div class="ec-services">
					<ul class="row">
						<?php

					$vectores = ObtenerComunicados('programacion');
					echo (empty($vectores)) ? '<div class="center"><cite>No hay programaciónes.</cite></div>' :'';
						foreach ($vectores as $value)
						{

							$id  = $value['id'];
									$fecha      = $value['fecha'];
									$titulo       = $value['titulo'];
									$comunicado       = $value['comunicado'];
							?>
							<li class="col-md-3 add-pointer file-category"  id="<?php echo $comunicado?>">
								<div class="ec-service-wrap calendar-image">
									<i class="fa fa-file-pdf-o" style="font-size: 3em;padding-bottom: 0.5em"></i>
									<h2 class="court-name-big"><?php echo $titulo; ?></h2>
									<p><?php echo $fecha; ?> </p>
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