<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'albums');
?>
<head>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<link href="css/owl.carousel.css" rel="stylesheet">
	<link href="css/color.css" rel="stylesheet">
	<link href="css/dl-menu.css" rel="stylesheet">
	<link href="css/flexslider.css" rel="stylesheet">
	<link href="css/prettyphoto.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
	<span class="ec-blue-transparent"></span>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ec-mini-title">
					<h1>Albums</h1>
				</div>
				<div class="ec-breadcrumb">
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li>Galería</li>
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
				<div class="col-md-12">
					<div class="ec-gallery ec-simple-gallery">
						<ul class="row gallery">
							<?php
							$vectores = Array_Get_Albums();
							echo (empty($vectores)) ? '<div class="center"><cite>No hay Albums.</cite></div>' :'';
							foreach ($vectores as $value)
							{
								$id = $value['id_album'];
								$nombre = $value['nombre'];
								?>
								<li class="col-md-3">

									<figure>
									<a href="javascript:void();"><img src="<?php echo ObtenerPrimeraImagen($id);?>" alt=""></a>
										<figcaption>
											<a title=""  href="webs/Galeria/Galeria.php?id=<?php echo $id ?> " class="ec-color"><i class="fa fa-compress"></i></a>
										</figcaption>
									</figure>
									 <div class="ec-gallery-info">
                                            <h2><?php echo $nombre ?></h2>
                                            <p>.</p>
                                        </div>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--// Main Section \\-->
</div>

<?php
include('../../footerinicial.php');
?>
<script src="script/jquery.js"></script>
<script src="script/modernizr.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="script/jquery.dlmenu.js"></script>
<script src="script/flexslider-min.js"></script>
<script src="script/jquery.prettyphoto.js"></script>
<script src="script/waypoints-min.js"></script>
<script src="script/owl.carousel.min.js"></script>
<script src="script/jquery.countdown.min.js"></script>
<script src="script/fitvideo.js"></script>
<script src="script/newsticker.js"></script>
<script src="script/skills.js"></script>
<script src="script/functions.js"></script>