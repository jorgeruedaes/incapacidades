<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$datos =Get_Equipos_Partido_Clasico($id);
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'resultados_'.$id);

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
?>

<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Resultados</li>
		 </ol>
</div>
<!-- content-bottom -->
<div class="content-info">
	 <div class="container">

		 <div class="content-bottom-grids">
			 <div class="col-md-12 popular">	
				
				  <table style="width:100% " class="table table-condensed">
   						 <thead>
     						 <tr>
						    <th style="width:auto"></th>
						        <th style="width:auto"></th>
						        <th style="width:auto"></th>
     						 </tr>
   						 </thead>
  						  <tbody>
     						 <tr style="color: #C0392B;font-size: 1.4em;font-family: 'Audiowide', cursive;margin: 0 0 10px 0;">
						        <td><?php echo NombreEquipo($datos['equipo1']); ?></td>
						        <td>vs</td>
						        <td><?php echo NombreEquipo($datos['equipo2']); ?></td>
						      </tr>
						        <tr style="background:#DDDDDD">
						      	<td colspan="2">Cancha : <?php echo NombreCancha($datos['lugar']).", el día ".FormatoFecha($datos['fecha']); ?></td>
						         <td>
						      	<a href="whatsapp://send?text=Calendario : <?php echo NombreEquipo($datos['equipo1']).' vs '.NombreEquipo($datos['equipo2'])  ?>%20<?php echo $host . $url ?>" data-action="share/whatsapp/share">
    <img style="width: 100%; float:right; max-width: 30px;" src="images/whatsapp.png" >
   								 </a>
						      </td>
						      </tr>
						    </tbody>
						  </table>
				 
				 
			 </div>
			<div class="clearfix"></div>
		 </div>
		
	 </div>
</div>
<!-- //content-bottom -->

<!-- content-2 PARTE  -->
<div class="content-info">
	 <div class="container">

		 <div class="content-bottom-grids">
			 <div class="col-md-6 popular">	
				 <h3><?php echo NombreEquipo($datos['equipo1']); ?></h3>
				 <div style="max-height: 300px; overflow-y:scroll;">
				  <table style="width:100% " class="table table-condensed">
   						 <thead>
     						 <tr class="background">
						        <th >Jugador</th>
						        <th style="width:15%">Tarjeta</th>
						        <th style="width:15%">Goles</th>
						         <th style="width:15%">Autogol</th>
     						 </tr>
   						 </thead>
  						  <tbody>
  						  <?php
  						  $vector = ObtenerPlanillaPartido($datos['equipo1'],$id);
  						  foreach ($vector as $value) {
  						  ?>
     						 <tr>
						        <td><?php echo ObtenerNombreCompletoJugador($value['jugador']); ?></td>
						        <td><?php echo ObtenerTipoTarjeta($value['amonestacion']);?></td>
						        <td><?php echo $value['goles'] ?></td>
						        <td><?php echo $value['autogoles'] ?></td>
						      </tr>
						    <?php
						}
						    ?>    
						     
						    </tbody>
						  </table>
						</div>  
				 
				 
			 </div>
			 <div class="col-md-6 welcome-pic">
				 <h3> <?php echo NombreEquipo($datos['equipo2']); ?></h3>
				 <div style="max-height: 300px; overflow-y:scroll;">
				   <table style="width:100% " class="table table-condensed">
   						 <thead>
     						 <tr class="background">
						        <th >Jugador</th>
						        <th style="width:15%">Tarjeta</th>
						        <th style="width:15%">Goles</th>
						        <th style="width:15%">Autogol</th>
     						 </tr>
   						 </thead>
  						  <tbody>
     					 <?php
  						  $vector = ObtenerPlanillaPartido($datos['equipo2'],$id);
  						  foreach ($vector as $value) {
  						  ?>
     						 <tr>
						        <td><?php echo ObtenerNombreCompletoJugador($value['jugador']); ?></td>
						        <td><?php echo ObtenerTipoTarjeta($value['amonestacion']);?></td>
						        <td><?php echo $value['goles'] ?></td>
						        <td><?php echo $value['autogoles'] ?></td>
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