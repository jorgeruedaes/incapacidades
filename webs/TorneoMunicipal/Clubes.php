<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'clubes');
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
    <span class="ec-blue-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ec-mini-title">
                    <h1>Clubes</h1>
                </div>
                <div class="ec-breadcrumb">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li>Clubes</li>
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
                    <div class="widget widget_search">
                        <div class="ec-fancy-title">
                            <h2>Buscar</h2> </div>
                            <form><input class="filtro" type="text" placeholder="Buscar.."></form>
                        </div>
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
                   <?php

                   $vector = Get_Lista_Clubes('activo');
                   echo (empty($vector)) ? '<cite>No hay clubes.</cite>' :'';
                   foreach ($vector as $value)
                   {

                    $id = $value['id'];
                    $nombre =$value['nombre'];
                    $direccion = $value['direccion'];
                    $telefono =$value['telefono'];
                    $correo = $value['correo'];
                    $presidente =$value['presidente'];
                    $cancha = $value['cancha'];
                    $horario =$value['horario'];
                    $logo = $value['logo'];
                    ?>
                    <!--// Match Fixture \\-->
                    <div class="col-md-4 filtros">
                        <div class="ec-fixture-list">
                            <ul>
                                <li class="add-pointer" 
                                onclick="window.location.href = 'webs/TorneoMunicipal/Club.php?id=<?php echo $id?>  ';"   >

                                <div class="ec-cell">
                                   <img style="height:70px;float: left" src="<?php echo $logo ?>" alt=""/>
                                   <a href="webs/TorneoMunicipal/Club.php?id=<?php echo $id?>" class="club-box-size">
                                       <p class="texto" style="margin-left: 80px"><?php echo $nombre?></p>
                                   </a>
                               </div>
                           </li>
                       </ul>
                   </div>
               </div>
               <?php
           }
           ?>
           <!--// TablePoint \\-->

           <!--// TablePoint \\-->
           <!--// Partner \\-->

           <!--// Partner \\-->
       </div>

   </div>
</div>
<!--// Main Section \\-->
</div>


<?php
include('../../footerinicial.php');

?>
<script src="webs/js/index.js"></script>