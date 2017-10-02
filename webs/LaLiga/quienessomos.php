<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'quienessomos');
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
            <span class="ec-blue-transparent"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-mini-title">
                            <h1>Quiénes somos</h1>
                        </div>
                        <div class="ec-breadcrumb">
                            <ul>
                                <li><a href="index.php">Inicio</a></li>
                                <li>Quiénes somos</li>
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
                            <div class="ec-blog ec-blog-medium">
                                <ul class="row">
                                    <li class="col-md-12">
                                        <div class="ec-blog-wrap">
                                            <div class="card-padding">
                                                <h2><a class="title-color" href="javascript:void();">NOSOTROS</a></h2>
                                                <hr>
                                               <?php echo String_Get_Datos('quienessomos')?>
                                            </div>
                                        </div>
                                    </li>
                                     <li class="col-md-12">
                                        <div class="ec-blog-wrap">
                                            <div class="card-padding">
                                                <h2><a class="title-color" href="javascript:void();">VISIÓN</a></h2>
                                               <hr>
                                               <?php echo String_Get_Datos('vision')?>
                                            </div>
                                        </div>
                                    </li>
                                     <li class="col-md-12">
                                        <div class="ec-blog-wrap">
                                            <div class="card-padding">
                                                <h2><a class="title-color" href="javascript:void();">VALORES</a></h2>
                                                <hr>
                                               <?php echo String_Get_Datos('valores')?>
                                            </div>
                                        </div>
                                    </li>
                                     <li class="col-md-12">
                                        <div class="ec-blog-wrap">
                                            <div class="card-padding">
                                                <h2><a class="title-color" href="javascript:void();">GESTIÓN DE CALIDAD</a>
                                                </h2>
                                                <hr>
                                               <?php echo String_Get_Datos('gestioncalidad')?>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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