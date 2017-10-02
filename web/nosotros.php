<?php
include('../menuinicial.php');
$id_modulos="34";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'nosotros');
?>

<div class="about">
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

	<div class="about-grids">
		<div class="about-grid">
			<h3><?php echo String_Get_Valores('titulo');?></h3>
			<p class="abt-info">
				Copa Amistad Profesional es un torneo de fútbol creado con el fin de generar 
				espacios de sano esparcimiento para los profesionales de la región, ya son más 
				de 30 años en los cuales semana tras semana cientos de jugadores han llenado de
				pasión y emoción las canchas de la ciudad de Bucaramanga. 
			</p>

		</div>
		<div class="about-pic">
			<img src="web/images/abt.jpg" alt=""/>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="abt_text">

		<div class="clearfix"></div>
	</div>		
</div>
</div>
	<?php
include('../footerinicial.php');
	?>
