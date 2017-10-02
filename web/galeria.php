<?php
include('../menuinicial.php');
$id_modulos="33";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'eventos');
?>

<div class="gallery-head">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="index.php">Inicio</a></li>
				<?php
			$vector = Array_Get_PadreHijo($id_modulos);
						foreach ($vector as $value)
						{?>
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
	<div class="gallery-text">
		<div class="container">
			<h2>Galeria</h2>
			<p>Espacio reservado las fotografias del torneo.</p>
		</div>
	</div>
	<div class="container">	
		<div class="main">
			<div class="gallery">	
				<section>
					<?php
					$vector = CargarImagenes();
					foreach ($vector as $i => $value) {
						?>
						<?php	 if($i==0 or $i==4  or $i==8) 
						{
							?>
							<ul class="lb-album">
								<?php
							}
							?>	
							<li>
								<a href="#image-<?php echo $value['id_imagen'];?>">
									<img src="images/Galeria/<?php echo $value['imagen'];?>" class="img-responsive" alt="">
									<span> </span>
								</a>
								<div class="lb-overlay" id="image-<?php echo $value['id_imagen'];?>">
									<img src="../images/Galeria/<?php echo $value['imagen'];?>" class="img-responsive" alt="image03">
									<a href="#page" class="lb-close"> </a>
								</div>
							</li>	
							<?php	 if($i==3 or $i==7  or $i==12) 
							{
								?>
							</ul>
							<?php
						}
					}
					?> 

				</section>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
	<?php
include('../footerinicial.php');
	?>
