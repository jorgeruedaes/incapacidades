<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'nuestroequipo');
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
            <span class="ec-blue-transparent"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-mini-title">
                            <h1>Nuestro equipo de trabajo</h1>
                        </div>
                        <div class="ec-breadcrumb">
                            <ul>
                                <li><a href="index.php">Inicio</a></li>
                                <li>Nuestro Equipo de Trabajo</li>
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
                          <div class="ec-authore-post light-border">
                                    <div class="ec-fancy-title">
                                        <h2> <?php echo String_Get_Datos('cargoasistente')?></h2> </div>
                                    <div class="authore-wrap">
                                        <figure style="width:200px">
                                            <a href="#"><img alt="" src="webs/images/asistente.png"></a>
                                        </figure>
                                        <div class="ec-authore-info">
                                            <h2><a href="#"><?php echo String_Get_Datos('nombreasistente')?></a></h2>
                                           <?php echo String_Get_Datos('infoasistente')?>
                                        </div>
                                    </div>
                          </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="ec-authore-post light-border">
                                    <div class="authore-wrap">
                                        <div class="ec-authore-info">
                                            <h2><a href="#"><?php echo String_Get_Datos('nombreatencionalusuario')  ?></a></h2>
                                            <p><?php echo String_Get_Datos('cargoatencionalusuario')?></p>
                                           <?php echo String_Get_Datos('infoatencionalusuario')?>
                                        </div>
                                    </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="ec-authore-post light-border">
                                    <div class="authore-wrap">
                                        <div class="ec-authore-info">
                                            <h2><a href="#"><?php echo String_Get_Datos('nombresecretariogeneral')  ?></a></h2>
                                            <p><?php echo String_Get_Datos('cargosecretariogeneral')?></p>
                                           <?php echo String_Get_Datos('infosecretariogeneral')?>
                                        </div>
                                    </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="ec-authore-post light-border">
                                    <div class="authore-wrap">
                                        <div class="ec-authore-info">
                                            <h2><a href="#"><?php echo String_Get_Datos('nombreanalisisygestion')  ?></a></h2>
                                            <p><?php echo String_Get_Datos('cargoanalisisygestion')?></p>
                                           <?php echo String_Get_Datos('infoanalisisygestion')?>
                                        </div>
                                    </div>
                          </div>
                        </div>
                    </div>
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