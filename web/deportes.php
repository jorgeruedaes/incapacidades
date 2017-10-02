<?php
include('../menuinicial.php');
$id_modulos="36";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'equipos');
?>
<style type="text/css">
	.enlaces a{
		color: #333333;

	}
	.enlaces a:hover{
		color :#C0392B;
		
	}
</style>
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
<div class="content-info">
	 <div class="container">
		 <div class="content-bottom-grids">
			 <div class="col-md-12 popular">	
				 <h3>Deportes</h3>
				 <br>
				  <?php
               $vector = Get_Lista_Deportes();
               foreach ($vector as $value)
               {
                    ?>
				<div class="col-md-3 popular enlaces">	
				<a style="font-family:'Audiowide', cursive" href="web/Deportes/principal.php?id=<?php echo $value['id_deportes'] ?>"><img src="images/deportes/<?php echo $value['logo']; ?>" alt="Smiley face" height="42" width="42"> <?php echo $value['nombre'] ?></a> 
			 </div>	
			 <?php
				}
				?>
			 </div>

	 	</div>
	</div>
</div>
	<?php
include('../footerinicial.php');
	?>