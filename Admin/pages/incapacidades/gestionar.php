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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                LISTADO DE INCAPACIDADES  
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li><button type="button" class="btn bg-green 
                                    waves-effect filtro">
                                    <i class="material-icons">filter_list</i>
                                </button></li>
                                <li><button type="button" class="btn bg-red 
                                    waves-effect add-incapacidad">
                                    <i class="material-icons">add</i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <table  id="tabla-incapacidades" class="table table-bordered table-striped table-hover " style="font-size:0.8em">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Eps</th>
                                    <th>Tipo</th>
                                    <th>Fecha Inicial</th>
                                    <th>Fecha Final</th>
                                    <th>Fecha Corte</th>
                                    <th>Días</th>
                                    <th>Valor</th>
                                    <th>Saldo</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JS ====================================================================================================================== -->
<!-- Modal Dialogs ====================================================================================================================== -->
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
                                    $vector = Array_Get_EstadosIncapacidad(false);
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
                        <select class="form-control show-tick select-tipo" multiple>
                            <option selected="selected" value="">--Selecciona Tipo --</option>
                            <?php
                            $vector = Array_Get_TiposIncapacidad(false);
                            foreach ($vector as $value)
                            {
                               ?>
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
                    <select class="form-control show-tick select-eps">
                        <option value="">--Selecciona Eps --</option>
                        <?php
                        $vector = Array_Get_Eps(false);
                        foreach ($vector as $value)
                        {

                            ?>
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
                       $vector = Array_Get_Ciudades(false);
                       foreach ($vector as $value)
                       {

                           ?>
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
                <select  class="form-control show-tick select-empresa"  data-live-search="true"> 
                   <option value="">--Selecciona Empresa --</option>
                   <?php
                   $vector = Array_Get_Empresas(false);
                   foreach ($vector as $value)
                   {

                       ?>
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
            <select id="select-cliente" class="form-control show-tick select-cliente" data-live-search="true"> 
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

<!-- Modal Crear Incapacidad -->
<div class="modal fade" id="ModalIncapacidad" tabindex="-1" role="dialog">
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
                                    $vector = Array_Get_EstadosIncapacidad(false);
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
                        <select class="form-control show-tick select-tipo" multiple>
                            <option selected="selected" value="">--Selecciona Tipo --</option>
                            <?php
                            $vector = Array_Get_TiposIncapacidad(false);
                            foreach ($vector as $value)
                            {
                               ?>
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
                    <select class="form-control show-tick select-eps">
                        <option value="">--Selecciona Eps --</option>
                        <?php
                        $vector = Array_Get_Eps(false);
                        foreach ($vector as $value)
                        {

                            ?>
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
                       $vector = Array_Get_Ciudades(false);
                       foreach ($vector as $value)
                       {

                           ?>
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
                <select  class="form-control show-tick select-empresa"  data-live-search="true"> 
                   <option value="">--Selecciona Empresa --</option>
                   <?php
                   $vector = Array_Get_Empresas(false);
                   foreach ($vector as $value)
                   {

                       ?>
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
            <select id="select-cliente" class="form-control show-tick select-cliente" data-live-search="true"> 
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
<script src="pages/incapacidades/js/gestionar.js"></script>


<?php
}else
{
    require("../sinpermiso.php");
}
?>


