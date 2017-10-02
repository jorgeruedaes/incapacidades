<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'club'.'_'.$id);
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
    <span class="ec-blue-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ec-mini-title">
                    <h1><?php echo NombreClub($id)?></h1>
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
                    <div class="ec-fancy-title">
                        <h2>DATOS DEL CLUB</h2>
                    </div>
                    <div class="ec-plyer-information" >
                    <figure class="center">
                            <a href="#"><img class="width-60 no-float" src="<?php echo LogoClub($id) ?>" alt=""></a>
                        </figure>
                        <div class="ec-plyer-designation info-club">
                            <ul>
                                <li><small>Nombre</small> <span><?php echo NombreClub($id) ?></span></li>
                                <li><small>Dirección</small> <span><?php echo DireccionClub($id) ?></span></li>
                                <li><small>Télefonos</small> <span><?php echo TelefonoClub($id) ?></span></li>
                                <li><small>Correo</small> <span class="break-word"><?php echo CorreoClub($id) ?></span></li>
                                <li><small>Presidente</small> <span><?php echo NombrePresidenteClub($id) ?></span></li>
                                <li><small>Cancha entrenamientos</small> <span><?php echo CanchaClub($id) ?></span></li>
                                <li><small>Horario</small> <span><?php echo HorarioClub($id) ?></span></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!--// TablePoint \\-->
                <!--// Match Fixture \\-->


            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-md-8">
                <div class="ec-fancy-title">
                    <h2>PROGRAMACIÓN</h2>
                </div>
                   <div class="ec-fixture-list ec-matches-list ec-nextmatch">
                        <?php

                        $vector = ObtenerTorneosDeClub($id,'activo');
                        echo (empty($vector)) ? '<div class="center"><cite>No hay programación.</cite></div>' :'';
                        foreach ($vector as $value)
                        {
                            $torneo = $value['id'];
                            ?>
                            <div class="item scrollbar-height scrollbar ">
                                <div class="border-bottom-light">
                                    <h3 class="header-torneo"><?php echo NombreTorneo($torneo)?></h3>
                                </div>
                                <?php
                                $vectores = ObtenerPartidosPorJugarDeUnClub($id,$torneo,'1');
                                echo (empty($vectores)) ? '<div class="center"><cite>No hay programación.</cite></div>' :'';
                                foreach ($vectores  as $values)
                                {
                                    $idpartido=$values['idpartido'];
                                    $equipo1=$values['equipo1'];
                                    $equipo2=$values['equipo2'];
                                    $fecha=$values['fecha'];
                                    $hora=$values['hora'];
                                    $lugar=$values['lugar'];
                                    ?>
                                    
                                    
                                    <ul class="add-pointer calendar-detail " id="<?php echo $idpartido?>">
                                    <li>
                                        <div class="ec-cell">
                                            <span><?php echo FormatoFecha($fecha);?></span>
                                        </div>
                                         <div class="ec-cell">
                                            <span><?php echo FormatoHora($hora);?></span>
                                        </div>
                                         <div class="ec-cell">
                                            <span><?php echo NombreCancha($lugar)?></span>
                                        </div>
                                        <div class="ec-cell">
                                            <span><?php echo NombreEquipo($equipo1);?></span>
                                        </div>
                                        <div class="ec-cell">
                                            <span class="ec-vs">vs</span>
                                        </div>
                                        <div class="ec-cell">
                                            <span><?php echo NombreEquipo($equipo2);?></span>
                                        </div>
                                    </li>
                                    </ul>

                                    <?php

                                }

                                ?>
                            </div> 

                            <?php
                        }
                        ?>
                    </div>
            </div>
            <div class="col-md-4">
            <div class="widget ec-match_widget">
                    <div class="ec-fancy-title">
                        <h2>RESULTADOS</h2> 
                    </div>
                    <div class="ec-matches-list ec-nextmatch" style="margin-bottom: 0px">
                     <?php

                        $vector = ObtenerTorneosDeClub($id,'activo');
                        echo (empty($vector)) ? '<div class="center"><cite>No hay resultados.</cite></div>' :'';
                        foreach ($vector as $value)
                        {
                            $torneo = $value['id'];
                            ?>
                   <div class="item scrollbar-height scrollbar ">
                                <div class="border-bottom-light">
                                    <h3 class="header-torneo"><?php echo NombreTorneo($torneo)?></h3>
                                </div>
                                  <?php
                                $vectores = ObtenerPartidosDeUnClub($id,$torneo,'2');
                                echo (empty($vectores)) ? '<div class="center"><cite>No hay resultados.</cite></div>' :'';
                                foreach ($vectores  as $values)
                                {
                                    $idpartido=$values['idpartido'];
                                    $equipo1=$values['equipo1'];
                                    $equipo2=$values['equipo2'];
                                    $fecha=$values['fecha'];
                                    $hora=$values['hora'];
                                    $lugar=$values['lugar'];
                                    $resultado1=$values['resultado1'];
                                    $resultado2=$values['resultado2'];
                                    ?>
                                    
                             <ul class="add-pointer results-detail border-bottom-light" id="<?php echo $idpartido?>">
                                    <li>
                                <div class="ec-cell">
                                    <span><?php echo NombreEquipo($equipo1);?></span>
                                </div>
                                <div class="ec-cell">
                                    <span class="ec-vs" style="width: 45px"><?php echo $resultado1 . ' - ' . $resultado2;?></span>
                                </div>
                                <div class="ec-cell">
                                    <span><?php echo NombreEquipo($equipo2);?></span>
                                </div>
                            </li>
                            </ul>
                            <?php

                                }

                                ?>
                    </div>
                     <?php
                        }
                        ?>
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

<script src="webs/js/index.js"></script>