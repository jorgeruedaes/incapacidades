<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'resultado'.'_'.$id);
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-main-content">
    <!--// Main Section \\-->
    <div class="ec-main-section">
        <div class="container">

            <?php
            
            $vectores = DatosPartido($id);
            
            $equipo1=$vectores['equipo1'];
            $equipo2=$vectores['equipo2'];
            $estado=$vectores['estado']; 
            $fecha=$vectores['fecha'];
            $hora=$vectores['hora'];
            $lugar=$vectores['lugar'];
            $Nfecha=$vectores['Nfecha'];
            $resultado1=$vectores['resultado1'];
            $resultado2=$vectores['resultado2'];
            $tiporesultado =  $vectores['tiporesultado'];
            ?>
            <div class="row">
                <div class="col-md-12 ec-custom-list">
                    <div class="ec-fixture-detail">
                        <ul class="ec-fixture-option">
                            <li class="titulo-programacion"><i class="fa fa-calendar"></i> 
                                <?php echo FormatoFecha($fecha) . ' ' . FormatoHora($hora) ?></li>
                                <li class="titulo-programacion"><i class="fa fa-map-marker"></i><?php echo ObtenerNombreCancha($lugar) ?> </li>
                            </ul>
                            <div class="ec-latest-result-wrap">
                                <div class="ec-latest-result">
                                    <ul>
                                        <li>
                                            <span><?php echo NombreEquipo($equipo1) ?></span>
                                            <img class="width-30" src="<?php echo LogoClub(ClubEquipo($equipo1))?>" alt="">
                                        </li>
                                        <li>
                                            <div class="ec-result-time">
                                                <div class="ec-time-wrap padding-top-55">
                                                    <?php echo $resultado1 . ':' . $resultado2  ?>
                                                    <small></small>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <span><?php echo NombreEquipo($equipo2) ?></span>
                                            <img class="width-30" src="<?php echo LogoClub(ClubEquipo($equipo2))?>" alt="">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>


                <br>
                <div class="row">
                    <div class="col-md-6">
                    <h2>
                        <?php
                        if ($tiporesultado != 1)
                        {
                            echo '* '.Get_Texto_TipoResultado($tiporesultado);
                        }
                        ?>
                        </h2>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <div class="ec-fancy-title">
                                <h2><?php echo NombreEquipo($equipo1)?> </h2> </div>
                                <div class="ec-table-point">
                                    <ul class="ec-table-head">
                                        <li>
                                            <div class="ec-cell">#</div>
                                            <div class="ec-cell">Jugador</div>
                                            <div class="ec-cell">Tarjeta</div>
                                            <div class="ec-cell">Goles</div>
                                            <div class="ec-cell">Autogoles</div>
                                        </li>
                                    </ul>
                                    <ul class="ec-table-list">
                                        <?php 
                                        $numero  = 1;
                                        $vectores = ObtenerPlanillaPartido($equipo1,$id);
                                        echo (empty($vectores)) ? '<div class="center"><cite>No hay jugadores.</cite></div>' :'';
                                        foreach ($vectores  as $values)
                                        {
                                            $jugador=$values['jugador'];
                                            $amonestacion=$values['amonestacion'];
                                            $goles=$values['goles'];
                                            $autogoles=$values['autogoles'];
                                            $partido = $values['partido'];

                                            ?>
                                            <li>
                                                <div class="ec-cell">1</div>
                                                <div class="ec-cell"><?php echo ObtenerNombreCompletoJugador($jugador)?></div>
                                                <div class="ec-cell">
                                                    <a href="#" data-toggle="tooltip" >
                                                        <?php echo ObtenerTipoTarjeta($values['amonestacion'])?>
                                                    </a>
                                                </div>
                                                <div class="ec-cell"><?php echo $goles?></div>
                                                <div class="ec-cell"><?php echo $autogoles?></div>
                                            </li>
                                            <?php
                                            $numero = $numero + 1;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <div class="ec-fancy-title">
                                    <h2><?php echo NombreEquipo($equipo2)?> </h2> </div>
                                    <div class="ec-table-point">
                                        <ul class="ec-table-head">
                                            <li>
                                                <div class="ec-cell">#</div>
                                                <div class="ec-cell">Jugador</div>
                                                <div class="ec-cell">Tarjeta</div>
                                                <div class="ec-cell">Goles</div>
                                                <div class="ec-cell">Autogoles</div>
                                            </li>
                                        </ul>
                                        <ul class="ec-table-list">
                                            <?php 
                                            $numero  = 1;
                                            $vectores = ObtenerPlanillaPartido($equipo2,$id);
                                            echo (empty($vectores)) ? '<div class="center"><cite>No hay jugadores.</cite></div>' :'';
                                            foreach ($vectores  as $values)
                                            {
                                                $jugador=$values['jugador'];
                                                $amonestacion=$values['amonestacion'];
                                                $goles=$values['goles'];
                                                $autogoles=$values['autogoles'];
                                                $partido=$values['partido'];

                                                ?>
                                                <li>
                                                    <div class="ec-cell"><?php echo $numero?></div>
                                                    <div class="ec-cell"><?php echo ObtenerNombreCompletoJugador($jugador)?></div>
                                                    <div class="ec-cell">
                                                        <a href="#" data-toggle="tooltip" title="<?php echo 
                                                        ComentarioAmonestacion($jugador,$partido)?>">
                                                        <?php echo ObtenerTipoTarjeta($values['amonestacion'])?>
                                                    </a>
                                                </div>
                                                <div class="ec-cell"><?php echo $goles?></div>
                                                <div class="ec-cell"><?php echo $autogoles?></div>
                                            </li>
                                            <?php
                                            $numero = $numero + 1;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <!--// Main Section \\-->
            </div>

            <?php
            include('../../footerinicial.php');
            ?>

            <script src="webs/js/index.js"></script>