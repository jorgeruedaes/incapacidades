 <?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'categoria'.'_'.$id);
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
  <span class="ec-blue-transparent"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
        <div class="ec-mini-title">
          <h1><?php echo NombreTorneo($id)?></h1>
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
        <div class="col-md-5 float-right">
      </div>
    </div>
    <br>
<?php
if(false)
{
?>
    <div class="row">
      <div class="col-md-12">
        <div class="ec-fancy-title">
          <h2>PROGRAMACIÓN</h2>
        </div>
        <div class="ec-fixture-list scrollbar-height-fixed scrollbar">
          <ul>

            <?php
            $vectores = ObtenerPartidosPorJugarDeUnTorneo($id,'1');
            echo (empty($vectores)) ? '<div class="center"><cite>No hay programación.</cite></div>' :'';
            foreach ($vectores as $value)
            {
              $idpartido  = $value['idpartido'];
              $equipo1    = $value['equipo1'];
              $equipo2    = $value['equipo2'];
              $fecha      = $value['fecha'];
              $hora       = $value['hora'];
              $lugar      = $value['lugar'];
              ?>
              <li id="<?php echo $idpartido?>" class="calendar-detail add-pointer">
                <div class="ec-cell"><span><?php echo FormatoFecha($fecha);?></span></div>
                <div class="ec-cell"><span><?php echo FormatoHora($hora);?></span></div>
                <div class="ec-cell"><span><?php echo NombreCancha($lugar)?></span></div>
                <div class="ec-cell"><img class="width-15" src="<?php echo LogoClub(ClubEquipo($equipo1))?>" alt=""><span style="padding-left: 5px"><?php echo NombreEquipo($equipo1)?></span></div>

                <div class="ec-cell"><span class="ec-fixture-vs"><small>vs</small></span></div>
                <div class="ec-cell"><img class="width-15" src="<?php echo LogoClub(ClubEquipo($equipo2))?>" alt=""><span style="padding-left: 5px"><?php echo NombreEquipo($equipo2)?></span></div>

              </li>

              <?php
            }
            ?>
          </ul>
        </div>
      </div>

    </div>
<?php
}
?>
    <br>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="widget ec-match_widget">
          <div class="ec-fancy-title">
            <h2>RESULTADOS</h2> </div>
            <ul class="scrollbar-height-fixed scrollbar">
             <?php
             $vectores = ObtenerPartidosDeUnTorneo($id,'2');
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
              <li class="add-pointer results-detail" id="<?php echo $idpartido?>">
                <div class="ec-cell">
                  <span><?php echo NombreEquipo($equipo1);?></span>
                </div>
                <div class="ec-cell">
                  <span class="ec-vs"><?php echo $resultado1 . ' - ' . $resultado2;?></span>
                </div>
                <div class="ec-cell">
                  <span><?php echo NombreEquipo($equipo2);?></span>
                </div>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>

      </div>
    </div>



    <?php
    if(TipoTorneo($id)=="competencia")
    {
      ?>
      <div class="row">
        <div class="col-md-6 ">
          <div class="ec-fancy-title">
            <h2>TABLA DE POSICIONES</h2>
            <span><a style=" color: white; text-decoration: underline; " href="webs/TorneoMunicipal/TablaPosiciones.php?id=<?php echo $id ?>" >Ver más</a></span>
          </div>
          <div class="ec-table-point scrollbar-height-fixed scrollbar">
            <?php

            $grupos = Get_Lista_Grupos($id);

            foreach ($grupos as $valuegrupo)
            {

              ?>
              <div class="ec-table-point">
                <?php if(sizeof($grupos) > 1 ) { ?>
                <div class="border-bottom-light">
                  <h3 class="header-torneo"><?php echo 'Grupo ' . $valuegrupo['grupo']?></h3>
                </div>
                <?php } ?>
                <?php
                $numero = 1;
                $vectores = ObtenerTablaPosiciones('50',$valuegrupo['grupo'],$id);
                echo (empty($vectores)) ? '<div class="center"><cite>No hay posiciones.</cite></div>' :'<ul class="ec-table-head">
                <li>
                  <div class="ec-cell">#</div>
                  <div class="ec-cell">Equipo</div>
                  <div class="ec-cell">PT</div>
                  <div class="ec-cell">PJ</div>
                  <div class="ec-cell">PE</div>
                  <div class="ec-cell">PP</div>
                </li>
              </ul>';

              ?>
              <ul class="ec-table-list">

                <?php
                foreach ($vectores  as $values)
                {
                  ?>
                  <li>
                   <div class="ec-cell"><?php echo $numero;?></div>
                   <div class="ec-cell"><?php echo $values['equipo']  ?></div>
                   <div class="ec-cell"><?php echo $values['puntos']  ?></div>
                   <div class="ec-cell"><?php echo $values['pj']  ?></div>
                   <div class="ec-cell"><?php echo $values['pe']  ?></div>
                   <div class="ec-cell"><?php echo $values['pp']  ?></div>
                 </li>
                 <?php 
                 $numero = $numero + 1;
               }

               ?>
             </ul>

           </div>

           <?php

         }

         ?>
       </div>
     </div>



     <div class="col-md-6 ">
      <div class="ec-fancy-title">
        <h2>Goleadores</h2>
      </div>
      <div class="ec-table-point scrollbar-height-fixed scrollbar">
        <?php

        $grupos = Get_Lista_Grupos($id);

        foreach ($grupos as $valuegrupo)
        {

          ?>
          <div class="ec-table-point">
            <?php if(sizeof($grupos) > 1 ) { ?>
            <div class="border-bottom-light">
              <h3 class="header-torneo"><?php echo 'Grupo ' . $valuegrupo['grupo']?></h3>
            </div>
            <?php } ?>
            <?php
            $vectores = ObtenerGoleadoresTorneo($id,$valuegrupo['grupo']);
            echo (empty($vectores)) ? '<div class="center"><cite>No se han cargado los Goles.</cite></div>' :'<ul class="ec-table-head">
            <li>
             <div class="ec-cell">Jugador</div>
             <div class="ec-cell">Equipo</div>
             <div class="ec-cell">Goles</div>
           </li>
         </ul>';

         ?>
         <ul class="ec-table-list">

          <?php
          foreach ($vectores  as $values)
          {
            ?>
            <li>
              <div class="ec-cell"><?php echo ObtenerNombreCompletoJugador($values['jugador'])  ?></div>
              <div class="ec-cell"><?php echo NombreEquipo($values['idequipo'])  ?></div>
              <div class="ec-cell"><?php echo $values['goles']  ?></div>
            </li>
            <?php 
          }

          ?>
        </ul>

      </div>

      <?php

    }

    ?>
  </div>
</div>


</div>
<br>
<br>

<div class="row">
  <div class="col-md-6">
    <div class="ec-fancy-title">
      <h2>Valla menos vencida</h2>
    </div>
    <div class="ec-table-point scrollbar-height-fixed scrollbar">
      <?php
      $numero = 1;
      $vectores = ObtenerVallaMenosVencidaTorneo($id);
      echo (empty($vectores)) ? '<div class="center"><cite>No hay valla menos vencida.</cite></div>' :'<ul class="ec-table-head">
      <li>
        <div class="ec-cell">#</div>
        <div class="ec-cell">Equipo</div>
        <div class="ec-cell">Goles</div>
      </li>
    </ul>';
    ?>
    <ul class="ec-table-list">

      <?php
      foreach ($vectores  as $values)
      {

        ?>     
        <li>
          <div class="ec-cell"><?php echo $numero;?></div>
          <div class="ec-cell"><?php echo $values['equipo']  ?></div>
          <div class="ec-cell"><?php echo $values['goles']  ?></div>

        </li>

        <?php 
        $numero = $numero + 1;
      } ?>
    </ul>

  </div>

</div>
<div class="col-md-6">
  <div class="ec-fancy-title">
    <h2>Amonestaciones</h2> 
  </div>
  <div class="ec-table-point scrollbar-height-fixed scrollbar">
    <?php
    $numero = 1;
    $vectores = ObtenerAmonestacionesTorneo($id);
    echo (empty($vectores)) ? '<div class="center"><cite>No hay amonestaciones.</cite></div>' :'<ul class="ec-table-head">
    <li>
      <div class="ec-cell">#</div>
      <div class="ec-cell">Jugador</div>
      <div class="ec-cell">Equipo</div>
      <div class="ec-cell">Amonestación</div>
    </li>
  </ul>';
  ?>
  <ul class="ec-table-list">

    <?php
    foreach ($vectores  as $values)
    {

      ?>     
      <li>
        <div class="ec-cell"><?php echo $numero;?></div>
        <div class="ec-cell"><?php echo ObtenerNombreCompletoJugador($values['jugador'])  ?></div>
        <div class="ec-cell"><?php echo NombreEquipoJugador($values['jugador'])  ?></div>
        <div class="ec-cell">
         <a href="#" data-toggle="tooltip" title="<?php echo $values['comentario']?>">
           <?php echo ObtenerTipoTarjeta($values['amonestacion'])?>
         </a>
       </li>

       <?php 
       $numero = $numero + 1;
     } ?>
   </ul>

 </div>

</div>
</div>

<?php
}
?>
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

<script src="webs/js/index.js"></script>