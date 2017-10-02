<?php
include('../../menuinicial.php');
$id = $_GET['id'];
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
                                                    VS
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
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <div class="widget widget_categories">
                            <div class="ec-fancy-title">
                                <h2>Jugadores <?php echo NombreEquipo($equipo1)?> </h2> </div>
                                <ul>
                                    <?php 
                                    $vectores = ObtenerJugadoresEquipo($equipo1);
                                    echo (empty($vectores)) ? '<div class="center"><cite>No hay jugadores.</cite></div>' :'';
                                    foreach ($vectores  as $values)
                                    {
                                        $nombre1=$values['nombre1'];
                                        $nombre2=$values['nombre2'];
                                        $apellido1=$values['apellido1'];
                                        $apellido2=$values['apellido2'];

                                        ?>
                                        <li><a href="javascript:void();"><?php echo $nombre1 . ' ' .$nombre2 . ' ' . $apellido1 . ' ' .  $apellido2 ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="widget widget_categories">
                                <div class="ec-fancy-title">
                                    <h2>Jugadores <?php echo NombreEquipo($equipo2)?></h2> </div>
                                    <ul>
                                       <?php 
                                       $vectores = ObtenerJugadoresEquipo($equipo2);
                                       echo (empty($vectores)) ? '<div class="center"><cite>No hay jugadores.</cite></div>' :'';
                                       foreach ($vectores  as $values)
                                       {
                                        $nombre1=$values['nombre1'];
                                        $nombre2=$values['nombre2'];
                                        $apellido1=$values['apellido1'];
                                        $apellido2=$values['apellido2'];

                                        ?>
                                        <li><a href="javascript:void();"><?php echo $nombre1 . ' ' .$nombre2 . ' ' . $apellido1 . ' ' .  $apellido2 ?></a></li>
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