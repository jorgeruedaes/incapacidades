<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$datos = ObtenerEquipo($id);
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'asistencia'.'_'.$id);
?>

<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active"><a href="web/equipos.php">Equipos</a></li>
		    <li class="active"><a href="web/Equipos/principal.php?id=<?php echo $id ?>"><?php echo $datos['nombre_equipo'];?></a></li>
		  <li class="active">Asistencia</li>
		 </ol>
</div>
<!-- content-bottom -->
<div class="content-info">
	 <div class="container">

		 <div class="content-bottom-grids">
			 <div class="col-md-12 popular">	
				 <h3>Asistencia </h3>
				 <div style=" overflow-x:scroll">
				  <table style="width:100% " class="table table-striped">
   						 <thead>
     						 <tr class="background">
						       <th style="width:10%">Jugador</th>
						       	<?php
						       	$vector = Array_ObtenerNumeroFechas($id,2);

						       	foreach ($vector as $value)
						       	{
						       		$valor = $value['numero_fecha'];
						       	?>
						        <th style="width:3%">P <?php echo $valor ?></th>
						       <?php
							    }
						       ?>
						        <th style="width:3%">Partidos</th>
						        <th style="width:3%">Porcentaje</th>
     						 </tr>
   						 </thead>
  						  <tbody>
  						  <?php
  						$vector = ObtenerJugadoresEquipo($id);
  						foreach ($vector as  $value) {
  						  ?>
     						 <tr>
						        <td><?php echo ObtenerNombreCompletoJugador($value['id_jugador']) ?></td>
						        <?php
						        $vectores = Array_ObtenerNumeroFechas($id,2);
						        	foreach ($vectores  as $values) {
						         ?>
						        <td><img src="<?php echo Bole_SabersiAsistio_Partidos($value['id_jugador'],$values['numero_fecha']) ?>"></td>
						       <?php 
						       }
						       ?>
						        <td><?php echo Int_PartidosAsistidos_Jugador($value['id_jugador'])?></td>
						       <td><?php echo Int_PorcentajeAsistencia_Jugador(Int_PartidosAsistidos_Jugador($value['id_jugador']),18)?></td>
						      </tr>
						    <?php
							}
						    ?> 
						      
						    </tbody>
						  </table>
				 
				 </div>
			 </div>
			 

				
			<div class="clearfix"></div>
		 </div>
		
	 </div>
</div>
	<?php
include('../../footerinicial.php');
	?>

