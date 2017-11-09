<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/incapacidad.php');
include('../../php/eps.php');
include('../../php/ciudades.php');
include('../../php/empresas.php');
$id_modulos =Int_RutaModulo($_SERVER['REQUEST_URI']);

if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
  ?>

  <link href="pages/pagos/css/gestionar.css" rel="stylesheet" />
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
          </ol>
        </h2>
      </div>
      <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 caja-listadopago">
          <div class="card">
            <div class="header">
              <h2>
                LISTADO DE PAGOS  
              </h2>
              <ul class="header-dropdown m-r--5">
                <li><button type="button" class="btn bg-red
                  waves-effect nuevo-pago">
                  <i class="material-icons">add</i>
                </button></li>
                <li></li>
              </ul>
            </div>
            <div class="body">

             <table  id="tabla-pagos" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Eps</th>
                  <th>Valor</th>
                  <th>Fecha Pago</th>
                  <th>Período</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Usuario Creación</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 caja-nuevopago" hidden="hidden">
        <div class="col-md-12  no-padding-left">
          <button type="button" class="btn btn-success waves-effect go-back">Volver al listado</button>
        </div>
        <section class="intro">
          <row>
            <div class="col-lg-6 col-sm-12 left" id="caja-izq">
              <form>
                <div class="col-md-12">
                  <h3 class="grey-text">Nuevo pago</h3>
                </div>
                <div class="col-md-12">
                  <br>
                </div>
               
            <!--  <div class="col-md-6">
              <label for="">Período</label>
              <div class="form-group">
                <select class="form-control show-tick select-tipo">
                  <option value="">--Selecciona Período --</option>
                  <?php
                  $vector = Array_Get_Eps(true);
                  foreach ($vector as $value)
                  {

                   ?>
                 }
                 <option value="<?php echo $value['id_eps'] ?>"><?php echo $value['nombre'] ?></option>
                 <?php
               }
               ?>
             </select>
           </div>
         </div> -->
         
         <div class="col-md-6 ">
          <label for="">Valor pago</label>
          <div class="form-group">
            <div class="form-line">
              <input type="number" min="0" class="form-control payment-value" placeholder="$" />
            </div>
          </div>
        </div>
        <div class="col-md-6 demo-masked-input">
        <b>Fecha de pago</b>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control date" placeholder="Ej: 2017-07-30">
            </div>
          </div>
        </div>
         <div class="col-md-12">
                  <label for="">Eps</label>
                  <div class="form-group">
                    <select class="form-control show-tick select-tipo">
                      <option value="">--Selecciona eps --</option>
                      <?php
                      $vector = Array_Get_Eps(true);
                      foreach ($vector as $value)
                      {

                       ?>
                     }
                     <option value="<?php echo $value['id_eps'] ?>"><?php echo $value['nombre'] ?></option>
                     <?php
                   }
                   ?>
                 </select>
               </div>
         </div>
        <div class="col-md-12">
          <hr>
          <p><b>DETALLES DEL PAGO</b></p>
          <blockquote>
            <small>Agregue aquí incapacidades consultando en el lado derecho de la pantalla.</cite></small>
          </blockquote>
        </div>
        <div class="col-md-12">
          <table  id="tabla-detalle-pago" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>No. Incapacidad </th>
                <th>Cédula</th>
                <th>Empleado</th>
                <th>Días</th>
                <th>Valor</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <table  id="tabla-detalle-total" class="table table-bordered table-striped table-hover">
            <tr>
              <td align="right" colspan="4">Valor total</td>
              <td class="payment-total-value">0</td>
            </tr>
            <tr>
              <td align="right" colspan="4">Valor pago</td>
              <td class="payment-value-2">0</td>
            </tr>
            <tr>
              <td align="right" colspan="4">Diferencia</td>
              <td class="payment-difference">0</td>
            </tr>
          </table>
        </div>

        <div class="col-md-8 col-md-offset-4">
          <button type="button" class="btn btn-danger waves-effect boton-cancelar">Cancelar</button>
          <button type="button" class="btn btn-info waves-effect boton-pendiente">Dejar pendiente</button>
          <button type="button" class="btn btn-success waves-effect boton-finalizar">Finalizar</button>
        </div>
        <div class="col-md-12">
          <br><br>
        </div>
      </form>
    </div> 
    <div class="col-lg-6 col-sm-12 right caja-der-padding" id="caja-der">
      <form>
       <div class="col-md-12">
         <h3 class="grey-text">Búsqueda de incapacidades</h3>
       </div>
       <div class="col-md-3 col-md-offset-9">
        <button type="button" class="btn btn-success waves-effect"><i class="material-icons">filter_list</i> Filtrar</button>
      </div>
       <div class="col-md-12">
         <br>
       </div>
<div class="col-md-12 no-padding-left">
  <table  id="tabla-incapacidades" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>No. Incapacidad</th>
        <th>Cédula</th>
        <th>Empleado</th>
        <th>Días</th>
        <th>Valor</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>001</td>
        <td>1102372558</td>
        <td>Lizeth Rodríguez</td>
        <td>5</td>
        <td>52.000</td>
        <td>
         <div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
          <button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect edit-item"><i class="material-icons">add</i></button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</div>

</form>

</div>

</row>
</section>
</div>
</div>
</div>
</section>

<!-- JS ====================================================================================================================== -->
<!-- Modal Dialogs ====================================================================================================================== -->
<!-- Default Size -->

<!--  Js-principal -->
<script src="pages/pagos/js/gestionar.js"></script>


<?php
}else
{
  require("../sinpermiso.php");
}
?>


