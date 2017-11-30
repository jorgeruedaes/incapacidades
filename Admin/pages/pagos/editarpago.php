<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/incapacidad.php');
include('../../php/eps.php');
include('../../php/ciudades.php');
include('../../php/empresas.php');
$idpago = $_GET['id'];
$estadopago = $_GET['estado'];
//$id_modulos =Int_RutaModulo($_SERVER['REQUEST_URI']);
$id_modulos ='76';
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
  ?>

  <link href="pages/pagos/css/nuevopago.css" rel="stylesheet" />
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
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 caja-nuevopago">
        <div class="col-md-12  no-padding-left">
          <!--<button type="button" class="btn btn-success waves-effect go-back">Volver al listado</button>-->
        </div>
        <section class="intro">
          <row>
           <div class="col-md-12" style="padding-left: 0px;padding-bottom: 8px;">
           <button type="button" class="btn btn-success waves-effect boton-menu"><i class="material-icons">menu</i></button>
          </div>
            <div class="col-lg-5 col-sm-12 left" id="caja-izq">
              <form>
                <div class="col-md-12" data-id="<?php echo $idpago ?>" data-estado="<?php echo $estadopago ?>" id="payment-title">
                  <h3 class="grey-text">Editar pago # <?php echo $idpago ?></h3>
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
              <input type="number" min="0" class="form-control payment-full-value" placeholder="$" />
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
              <input type="text" class="form-control date payment-date" placeholder="Ej: 2017-07-30">
            </div>
          </div>
        </div>
         <div class="col-md-12">
                  <label for="">Eps</label>
                  <div class="form-group">
                    <select class="form-control show-tick  payment-eps" id="payment-eps">
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
                <th>No.</th>
                <th>Cédula</th>
                <th>Empleado</th>
                <th>Días</th>
                <th>Fecha corte</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th></th>
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
          <!--<button type="button" class="btn btn-danger waves-effect boton-cancelar">Cancelar</button>-->
          <button type="button" class="btn btn-warning waves-effect boton-volver">Volver</button>
          <button type="button" class="btn btn-info waves-effect boton-pendiente">Dejar pendiente</button>
          <button type="button" class="btn btn-success waves-effect boton-finalizar">Finalizar</button>
        </div>
        <div class="col-md-12">
          <br><br>
        </div>
      </form>
    </div> 
    <div class="col-lg-7 col-sm-12 right caja-der-padding" id="caja-der">
      <form>
       <div class="col-md-12">
         <h3 class="grey-text">Búsqueda de incapacidades</h3>
       </div>
       <div class="col-md-3 col-md-offset-9">
        <button type="button" id="open-filter" class="btn btn-success waves-effect"><i class="material-icons">filter_list</i> Filtrar</button>
      </div>
       <div class="col-md-12">
         <br>
       </div>
<div class="col-md-12">
  <table  id="tabla-incapacidades" class="table table-bordered table-striped table-hover">
    <thead> 
      <tr>
        <th>No.</th>
        <th>Cédula</th>
        <th>Empleado</th>
        <th>Días</th>
        <th>Fecha corte</th>
        <th>Tipo</th>
        <th>Saldo</th>
        <th>Tomar vr. parcial</th>
        <th >Valor parcial</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
     <!--  <tr>
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
    </tr> -->
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
<!-- Default Size -->
    <div class="modal fade" id="Modalnuevo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Filtro de Incapacidades</h4>
                </div>
                <div class="modal-body">

                    <div class="body">
                        <form>

                            <div class="col-md-3">
                                <label for="">Codigo </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" min="0" step="200" class="form-control f-codigo" placeholder="Codigo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Rango de Codigos</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" min="0" step="200" class="form-control  f-codigodesde" placeholder="Codigo Desde" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" min="0" step="200" class="form-control f-codigohasta" placeholder="Codigo Hasta" />
                                    </div>
                                </div>
                            </div>
                            <div class="demo-masked-input">
                                <div class="col-md-3">
                                    <label for="">Cedula</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" min="0" step="200" class="form-control  f-cedula" placeholder="Documento" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <b>Fecha de Corte</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date f-fechacortedesde" placeholder="Desde Ej: 2017-07-30">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <b>.</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date f-fechacortehasta" placeholder="Hasta Ej: 2017-07-30">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <b>Fecha inicial</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date f-fechainicialdesde" placeholder="Desde Ej: 2017-07-30">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <b>.</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date f-fechainicialhasta" placeholder="Hasta Ej: 2017-07-30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Estado</label>
                                <div class="form-group">
                                    <select class="form-control show-tick select-estado">
                                        <option value="">--Selecciona Estado --</option>
                                        <?php
                                        $vector = Array_Get_EstadosIncapacidad(true);
                                        foreach ($vector as $value)
                                        {
                                           ?>
                                       }
                                       <option value="<?php echo $value['id_estados'] ?>"><?php echo $value['nombre'] ?></option>
                                       <?php
                                   }
                                   ?>

                               </select>
                           </div>
                       </div>
                       <div class="col-md-3">
                        <label for="">Tipo</label>
                        <div class="form-group">
                            <select class="form-control show-tick select-tipo">
                                <option value="">--Selecciona Tipo --</option>
                                <?php
                                $vector = Array_Get_TiposIncapacidad(true);
                                foreach ($vector as $value)
                                {
                                   ?>
                               }
                               <option value="<?php echo $value['id_tipos'] ?>"><?php echo $value['nombre'] ?></option>
                               <?php
                           }
                           ?>
                       </select>
                   </div>
               </div>
               <div class="col-md-3">
                <label for="">Eps</label>
                <div class="form-group">
                    <select class="form-control show-tick select-eps" id="eps-selected">
                        <option value="">--Selecciona Eps --</option>
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
        <div class="col-md-3"> 
            <label for="">Ciudad</label> 
            <div class="form-group">
               <select class="form-control show-tick select-ciudad"> 
                   <option value="">--Selecciona Ciudad --</option>
                   <?php
                   $vector = Array_Get_Ciudades(true);
                   foreach ($vector as $value)
                   {
                       ?>
                   }
                   <option value="<?php echo $value['id_ciudades'] ?>"><?php echo $value['nombre'] ?></option>
                   <?php
               }
               ?>
           </select> 
       </div> 
   </div>
   <div class="col-md-3"> 
    <label for="">Empresa</label> 
    <div class="form-group">
       <select  class="form-control show-tick select-empresa"> 
           <option value="">--Selecciona Empresa --</option>
           <?php
           $vector = Array_Get_Empresas(true);
           foreach ($vector as $value)
           {
               ?>
           }
           <option value="<?php echo $value['id_empresas'] ?>"><?php echo $value['nombre'] ?></option>
           <?php
       }
       ?>
   </select> 
</div> 
</div>
<div class="col-md-5">
    <label for="">Acronimo Cliente </label>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control f-acronimo" placeholder="Acronimo" />
        </div>
    </div>
</div>
<div class="col-md-3"> 
    <label for="">Cliente</label>
    <div class="form-group"> 
     <select id="select-cliente" class="form-control show-tick select-cliente"> 
         <option value="">--Selecciona Cliente --</option> 
     </select> 
 </div> 
</div>
</form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info waves-effect filtrar-boton">Filtrar</button>
    <button type="button" class="btn btn-link  waves-effect" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>
</div>
<!--  Js-principal -->
<script src="pages/pagos/js/editarpago.js"></script>


<?php
}else
{
  require("../sinpermiso.php");
}
?>