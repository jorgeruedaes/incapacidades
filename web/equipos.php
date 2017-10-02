<?php
include('../menuinicial.php');
$id_modulos="31";
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
				 <h3>Colegios</h3>
				 <br>
				  <?php
               $vector = Get_Lista_Colegios();
               foreach ($vector as $value)
               {
                    ?>
				<div class="col-md-2 popular enlaces">	
				<a href="web/Equipos/principal.php?id=<?php echo $value['id_colegio'] ?>"><h4><?php echo $value['nombre'] ?></h4></a> 		
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