<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/incapacidad.php');
include('../../php/pagos.php');
include('../../php/eps.php');
include('../../php/ciudades.php');
include('../../php/empresas.php');
$id_modulos ='76';
$id = $_GET['id'];
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
  ?>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>
          <ol class="breadcrumb">
            <li>
              <a href="pages/administracion.php">
                <!--<i class="material-icons">home</i>-->
                Administración
              </a>
            </li>
            <?php
            $vector = Array_Get_PadreHijo($id_modulos);
            foreach ($vector as $value)
            {
              ?>
              <li>
                <a href="<?php echo $value['ruta'] ?>" class="active">
                  <!--<i class="material-icons"><?php echo $value['icono'] ?></i>-->
                  <?php echo $value['nombre'] ?>
                </a>
              </li>
              <?php
            }
            ?>
            <li>
              <a href="/pages/pagos/detallespago.php?id=<?php echo $id ?>" class="active">Detalles Pago <?php echo $id ?></a>
            </li>
          </ol>
        </h2>
      </div>

      <?php
      $vector = Array_Get_DatosPago($id);
      foreach ($vector as $value) {

        $valorpago = $value['valor'];
        $epspago = Get_nombre_eps($value['eps']);
        $fechapago = $value['fechapago'];
      }
      ?>


      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header" style="padding-bottom: 0px">
              <div class="row">
                <div class="col-md-12" data-id="75" id="payment-title">
                  <h3 class="grey-text textodetalle">Detalles pago # <?php echo $id ?></h3>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-2">
                  <label for="">Valor pago</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" min="0" value="<?php echo $valorpago ?>" class="form-control payment-full-value valorpago" placeholder="$" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <label for="">Eps</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" min="0" value="<?php echo $epspago ?>" class="form-control payment-full-value epspago" placeholder="$" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <label for="">Fecha pago</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" min="0" value="<?php echo $fechapago ?>" class="form-control payment-full-value fechapago" placeholder="$" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="body">
             <table  id="tabla-detalle" class="table table-bordered table-striped table-hover ">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Cedula</th>
                  <th>Empleado</th>
                  <th>Días</th>
                  <th>Fecha Corte</th>
                  <th>Tipo</th>
                  <th>Valor</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $vector = Array_Get_IncapacidadesxPago($id);
                foreach ($vector as $value) {
                  ?>
                  <tr>
                    <td><?php echo $value['idincapacidad'] ?></td>
                    <td><?php echo $value['cedula'] ?></td>
                    <td><?php echo $value['nombre'] ?></td>
                    <td><?php echo $value['dias'] ?></td>
                    <td><?php echo $value['fechacorte'] ?></td>
                    <td><?php echo get_name_tipo($value['tipoincapacidad']); ?></td>
                    <td class="money-values"><?php echo $value['valor'] ?></td>
                  </tr>

                  <?php
                }
                ?>
                <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td align="right"><b>Valor total</b></td>
                 <td align="left" id="totalinc"></td>
               </tr>

             </tbody>
           </table>
        <!--     <table class="table table-bordered table-striped table-hover ">
            <tbody>
                <tr>
                  <td align="right"><b>Valor total</b></td>
                  <td align="right" id="totalinc"></td>
                </tr>
            </tbody>
          </table>-->
     <!--   <div class="row">
          <div class="col-md-3 col-md-offset-9">
          <button type="button" class="btn btn-info waves-effect boton-volver">Volver a la página anterior</button>
        </div>
      </div>-->
    </div>
  </div>
</div>
</div>

</div>
</section>

<!-- JS ====================================================================================================================== -->
<!-- Modal Dialogs ====================================================================================================================== -->
<!-- Default Size -->

<!--  Js-principal -->
<script src="pages/pagos/js/detallespago.js"></script>


<?php
}else
{
  require("../sinpermiso.php");
}
?>





