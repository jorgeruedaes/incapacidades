<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'contacto');
?>

<head>
	 <link href="Admin/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
</head>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
	<span class="ec-blue-transparent"></span>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ec-mini-title">
					<h1>Contáctenos</h1>
				</div>
				<div class="ec-breadcrumb">
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li>Contáctenos</li>
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
					<div class="ec-map">
						<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDhlYO8a5jTRHQgPhtTovjMBriyKZNyJa4
						&q=Instituto Departamental de Recreación y Deportes de Santander "Indersantander",Bucaramanga"" height="380"></iframe>
					</div>
				</div>
				<div class="col-md-4">
					<div class="widget widget-userinfo">
						<div class="ec-fancy-title">
							<h2>Ubicación</h2>
						</div>
						<ul>
							<?php echo String_Get_Datos('direccion_3')?>
							<?php echo String_Get_Datos('telefono_contacto')?>
							<?php echo String_Get_Datos('celular_contacto')?>
						</ul>
					</div>
					<div class="widget widget-userinfo">
						<div class="ec-fancy-title">
							<h2>EMAIL</h2>
						</div>
						<ul>
							<li> <i class="fa fa-envelope"></i>
								<p><a href="#"><?php echo String_Get_Datos('email')?></a></p>
							</li>
							<li> <i class="fa fa-envelope-o"></i>
								<p><a href="#"><?php echo String_Get_Datos('email2')?></a></p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-8">
					<!--// Comment Form //-->
					<div class="ec-form">
						<div class="ec-fancy-title">
							<h2>Formulario de contacto</h2> </div>
							<form method="post">
								<p>
									<input type="text" id="nombre" value="Nombre" onblur="if(this.value == '') { this.value ='Nombre'; }" onfocus="if(this.value =='Nombre') { this.value = ''; }" name="usrname" required=""> </p>
									<p>
										<input type="text" id="email" value="Email" onblur="if(this.value == '') { this.value ='Email'; }" onfocus="if(this.value =='Email') { this.value = ''; }" name="usrname" required=""> </p>
										<p>
											<input type="text" id="asunto" value="Asunto" onblur="if(this.value == '') { this.value ='Asunto'; }" onfocus="if(this.value =='Asunto') { this.value = ''; }" name="usrname" required=""> </p>
											<p class="ec-comment">
												<textarea id="mensaje" placeholder="Mensaje"></textarea>
											</p>

											<p class="ec-submit">
												<button id="sendEmailBtn" type="button" class="btn btn-danger">ENVIAR</button> </p>
											</form>
										</div>
										
									</div>

								</div>
							</div>
						</div>
					</div>
					<?php


include('../../footerinicial.php');
?>

  <script src="webs/js/index.js"></script>
<script src="Admin/plugins/sweetalert/sweetalert.min.js"></script>


