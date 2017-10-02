 <?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'tablaposiciones'.'_'.$id);
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
  <span class="ec-blue-transparent"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
        <div class="ec-mini-title">
          <h1> Tabla de posiciones <?php echo NombreTorneo($id)?></h1>
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
      <div class="row">
        <div class="col-md-12 ">
          <div class="ec-fancy-title">
            <h2>TABLA DE POSICIONES</h2>
          </div>
          <div class="ec-table-point  scrollbar">
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
                  <div class="ec-cell">PG</div>
                  <div class="ec-cell">PE</div>
                  <div class="ec-cell">PP</div>
                  <div class="ec-cell">DG</div>
                  <div class="ec-cell">GF</div>
                  <div class="ec-cell">GC</div>
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
                   <div class="ec-cell"><?php echo $values['pg']  ?></div>
                   <div class="ec-cell"><?php echo $values['pe']  ?></div>
                    <div class="ec-cell"><?php echo $values['pp']  ?></div>
                    <div class="ec-cell"><?php echo $values['dg']  ?></div>
                     <div class="ec-cell"><?php echo $values['gf']  ?></div>
                      <div class="ec-cell"><?php echo $values['gc']  ?></div>
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
<br>
<br>
<br> 
<br>  
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