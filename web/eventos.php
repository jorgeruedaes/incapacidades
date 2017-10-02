<?php
include('../menuinicial.php');
$id_modulos="32";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'eventos');
?>

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
<!-- events -->
<div class="events-sec">
	 <div class="container">
		 <h2>Noicias y Eventos</h2>
		 <div class="event-grids">		
		 <?php
		  $datos = mysqli_query($conexion,"SELECT * FROM tb_noticias  ORDER BY fecha DESC");
                        while ($noticias = mysqli_fetch_array($datos)) {
                        	$fecha = $noticias['fecha'];
		 ?>	
		     <div class="col-md-4 event-grid">
				 <div class="date">
				     <h3><?php echo date("d", strtotime($fecha));?></h3>
					 <span><?php echo date("m", strtotime($fecha));?>/<?php echo date("Y", strtotime($fecha));?></span>
				 </div>				 
			     <div class="event-info">
					  <h4><a href="web/Eventos/eventos.php?id=<?php echo $noticias['id_noticias'] ?>"><?php echo $noticias['titulo'] ?></a></h4>
						<p><?php echo $noticias['texto']; ?></p>					
				 </div>
				 <div class="clearfix"></div>				 			 
			 </div>

			 <?php
			}
			 ?>
			
				 <div class="clearfix"></div>				 			 
			 </div>
			 <div class="clearfix"></div>	
		 </div>
</div>
	<?php
include('../footerinicial.php');
	?>
