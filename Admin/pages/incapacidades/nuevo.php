<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/incapacidad.php');
include('../../php/eps.php');
include('../../php/ciudades.php');
include('../../php/empresas.php');
include('../../php/trabajadores.php');
include('../../php/clientes.php');
$id_modulos ='75';

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
          
            <div class="col-lg-12" id="caja-izq">
              <form>
                <div class="col-md-6">
                  <h3 class="grey-text">Nueva incapacidad</h3>
                </div>
                <div class="col-md-2 col-md-offset-4">
                  <label for="" style="padding-top: 1.7em">No. Incapacidad </label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" class="form-control incapacidad-number" placeholder="" />
                    </div>
                  </div>
                </div>

       
           
         <div class="col-md-4 ">
          <label for="">Trabajador</label>
          <div class="form-group">
             <select class="form-control show-tick  " id="select-worker">
                      <option value="">--Selecciona trabajador --</option>
                      <?php
                      $vector = Array_Get_Trabajadores();
                      foreach ($vector as $value)
                      {

                       ?>
                     }
                     <option value="<?php echo $value['id_trabajadores'] ?>"><?php echo $value['apellido'] . " " .  $value['nombre']  ?></option>
                     <?php
                   }
                   ?>
                 </select>
          </div>
        </div>
        <div class="col-md-4 ">
          <label for="">Cliente</label>
          <div class="form-group">
             <select class="form-control show-tick" id="select-customer">
                      <option value="">--Selecciona cliente --</option>
                      <?php
                      $vector = Array_Get_Clientes();
                      foreach ($vector as $value)
                      {

                       ?>
                     }
                     <option value="<?php echo $value['id_clientes'] ?>"><?php echo $value['nombre'] ?></option>
                     <?php
                   }
                   ?>
                 </select>
          </div>
        </div>
        <div class="col-md-4">
          <label for="">Ciudad</label>
          <div class="form-group">
             <select class="form-control show-tick" id="select-city">
                      <option value="">--Selecciona ciudad --</option>
                      <?php
                      $vector = Array_Get_Ciudades('activo');
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
            <div class="col-md-4 ">
          <label for="">Eps</label>
          <div class="form-group">
             <select class="form-control show-tick" id="select-eps" >
                      <option value="">--Selecciona eps --</option>
                      <?php
                      $vector = Array_Get_Eps('activo');
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
         <div class="col-md-4 ">
          <label for="">Tipo</label>
          <div class="form-group">
             <select class="form-control show-tick" id="select-type">
                      <option value="">--Selecciona tipo --</option>
                      <?php
                      $vector = Array_Get_TiposIncapacidad('activo');
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
        <div class="col-md-4 ">
          <label for="">Valor </label>
          <div class="form-group">
            <div class="form-line">
              <input type="number" min="0" class="form-control incapacidad-full-value" placeholder="$" />
            </div>
          </div>
        </div>

       <div class="col-md-4 demo-masked-input">
        <b>Fecha inicial</b>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control date payment-date" id="initial-date" placeholder="Ej: 2017-07-30">
            </div>
          </div>
        </div>
          <div class="col-md-4 demo-masked-input">
        <b>Fecha final</b>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control date payment-date" id="final-date" placeholder="Ej: 2017-07-30">
            </div>
          </div>
        </div>
         <div class="col-md-4 demo-masked-input">
        <b>Fecha corte</b>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control date payment-date" id="cut-date" placeholder="Ej: 2017-07-30">
            </div>
          </div>
        </div>
         <div class="col-md-4 demo-masked-input ">
          <label for="">DÍAS </label>
          <div class="form-group">
            <div class="form-line">
              <input class="form-control" type="text" id="daysincapacidad" />
            </div>
          </div>
        </div>
        <div class="col-md-2 col-md-offset-10">
          <button type="button" class="btn btn-success waves-effect boton-finalizar">Guardar</button>
        </div>
        <div class="col-md-12">
          <br><br>
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
<script src="pages/incapacidades/js/nuevo.js"></script>


<?php
}else
{
  require("../sinpermiso.php");
}
?>


