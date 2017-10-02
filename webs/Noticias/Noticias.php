<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'noticias');
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
	<span class="ec-blue-transparent"></span>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ec-mini-title">
					<h1>Noticias</h1>
				</div>
				<div class="ec-breadcrumb">
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li>Noticias</li>
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
					<div class="ec-blog ec-blog-medium">
						<ul class="row">

							<?php

							$vector = ObtenerNoticias('desc');
							echo (empty($vector)) ? '<cite>No hay noticias.</cite>' :'';
							foreach ($vector as $value)
							{

								?>
								<li class="col-md-12 add-pointer news-detail" id="<?php echo $value['id']?>">
									<div class="ec-blog-wrap">
										<figure>
											<a href="javascript:void();"><img src="<?php echo $value['imagen']; ?>" alt=""></a>
										</figure>
										<div class="ec-blog-text">
											<ul class="ec-blog-option">
												<li>
												<i class="fa fa-clock-o"></i> Fecha publicación: 
												<a href="javascript:void();" class="ec-colorhover"><?php echo $value['fecha'];?></a>
												<a href="javascript:void();" class="ec-color float-right font-15"><?php echo NombreTorneo($value['torneo']);?></a>
												</li>
											</ul>
											<h2><a href="javascript:void();"><?php echo $value['titulo'];?></a></h2>
											<p class="justify"><?php echo $value['encabezado'];?></p>

										</div>
									</div>
								</li>

								<?php
							}
								?>
							</ul>
						</div>
					</div>
				</div>
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