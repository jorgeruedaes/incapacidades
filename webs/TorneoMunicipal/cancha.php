<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'canchas'.'_'.$id);
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
  <span class="ec-blue-transparent"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
        <div class="ec-mini-title">
          <h1><?php echo ObtenerNombreCancha($id)?></h1>
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
        <p class="float-right font-20 add-pointer"  style="margin-right: 30px">Descargar programación
            <a class="font-25"  href="webs/Pdf/porcancha.php?id=<?php echo $id?>&flag=porcancha" style="color:#4183D7" download>
              <span class="fa fa-file-pdf-o"></span>
            </a>
          </p>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="ec-fancy-title">
            <h2>PROGRAMACIÓN</h2>
          </div>
          <div class="ec-fixture-list  ">
            <ul>

              <?php
              $vectores = ObtenerPartidosPorJugarEnUnLugar($id,'1');
              echo (empty($vectores)) ? '<div class="center"><cite>No se ha cargado programación.</cite></div>' :'';
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
<br>
<br>
<br>
<br>
<br>
<br> 
<br>  
<br>
<br>
<br>
<br>
<br>
<br>
<br> 
<br>  
<br>
<br>
<br>
<br>
<br>
<br>
<br> 
<br>  
<br>
<br>
<br>
<br>
<br>
<br>
<br> 
<br>  
<br>
<br>
<br>
<br>
<br>
<br>
<br> 
<br>  
<!--// Main Section \\-->

<?php
include('../../footerinicial.php');
?>

<script src="webs/js/index.js"></script>