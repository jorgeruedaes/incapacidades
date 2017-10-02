<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'nuestropresidente');
?>

<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
            <span class="ec-blue-transparent"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-mini-title">
                            <h1>Nuestro presidente</h1>
                        </div>
                        <div class="ec-breadcrumb">
                            <ul>
                                <li><a href="index.php">Inicio</a></li>
                                <li>Nuestro Presidente</li>
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
                            <!-- <div class="ec-fancy-title">
                                <h2>PERFIL</h2> </div> -->
                            <div class="ec-plyer-information">
                                <figure>
                                    <a href="#"><img src="webs/images/presidente.jpg" alt=""></a>
                                </figure>
                                <div class="ec-plyer-designation card-padding">
                                   <?php echo String_Get_Datos('infopresidente')?>
                                </div>
                            </div>
                            <div class="ec-detail-editor ec-plyer-information-wrap" style="margin-top: 15px">
                                  <?php echo String_Get_Datos('infocanchamarte')?>
                                <figure class="center" >
                                    <a href="javascript:void();"><img src="webs/images/canchamarte.jpg" alt=""></a>
                                </figure>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// Main Section \\-->
        </div>
<?php
include('../../footerinicial.php');
?>