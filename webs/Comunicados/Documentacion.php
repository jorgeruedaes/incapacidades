<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'documentacion');
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-main-content">
	<!--// Main Section \\-->
	<div class="ec-main-section">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12">

					<div class="widget widget_categories">
						<div class="ec-fancy-title">
							<h2>DOCUMENTACIÓN</h2> </div>
							<ul>
								<?php
								$vectores = ObtenerComunicados('documentos');
								echo (empty($vectores)) ? '<div class="center"><cite>No hay documentación.</cite></div>' :'';
								foreach ($vectores as $value)
								{
									$id  = $value['id'];
									$tipo    = $value['tipo'];
									$comunicado    = $value['comunicado'];
									$fecha      = $value['fecha'];
									$titulo       = $value['titulo'];

									?>
									<li>
									<a class="font-20" target="_blank"  href="<?php echo $comunicado?>" ><?php echo $titulo?>
											&nbsp&nbsp<span style="color:#4183D7" class="fa fa-file-pdf-o font-20"></span>
										</a>


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
			</div>
		</div>
		<!--// Main Section \\-->
	</div>
	<?php
	include('../../footerinicial.php');
	?>

