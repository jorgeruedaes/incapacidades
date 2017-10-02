
<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'noticias'.$id);
?>

<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Eventos</li>
		 </ol>
</div>
<!-- events -->
<div class="events-sec">
	 <div class="container">
	  <?php
		  $datos = mysql_query("SELECT * FROM tb_noticias WHERE id_noticias=$id  ORDER BY fecha DESC");
                        while ($noticias = mysql_fetch_array($datos)) {
                        	$fecha = $noticias['fecha'];
		 ?>	
		 <h2><?php echo $noticias['titulo'] ?></h2>
		 <div class="event-grids">			
	
		     <div class="col-md-8 event-grid">
				 <div class="date">
				     <h3><?php echo date("d", strtotime($fecha));?></h3>
					 <span><?php echo date("m", strtotime($fecha));?>/<?php echo date("Y", strtotime($fecha));?></span>
				 </div>				 
			     <div class="event-info">
					  
						<p><?php echo $noticias['texto']; ?></p>					
				 </div>
				 <div class="clearfix"></div>				 			 
			 </div>

			
			 <div class="clearfix"></div>	
		 </div>
		  <?php
			}
			     mysql_close($con);
			 ?>
	 </div>
</div>
