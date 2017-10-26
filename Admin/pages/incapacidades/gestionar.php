<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/equipo.php');
include('../../php/clubs.php');
include('../../php/campeonatos.php');
include('../../php/jugador.php');
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
                                <li></li>
                            </ul>
                        </div>
                        <div class="body">
                            <table  id="tabla-incapacidades" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Eps</th>
                                        <th>Fecha Inicial</th>
                                        <th>Fecha Final</th>
                                        <th>Estado</th>
                                        <th widht="10%">Opciones</th>
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
                                        <input type="text" class="form-control f-codigo" placeholder="Codigo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Rango de Codigos</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control  f-codigodesde" placeholder="Codigo Desde" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control f-codigohasta" placeholder="Codigo Hasta" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Cedula</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control f-cedula" placeholder="Documento" />
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
                                        <input type="text" class="form-control date f-fechacortedesde" placeholder="Desde Ej: 30/07/2016">
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
                                        <input type="text" class="form-control date f-fechacortehasta" placeholder="Hasta Ej: 30/07/2016">
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
                                        <input type="text" class="form-control date f-fechainicialdesde" placeholder="Desde Ej: 30/07/2016">
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
                                        <input type="text" class="form-control date f-fechainicialhasta" placeholder="Hasta Ej: 30/07/2016">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Estado</label>
                                <div class="form-group">
                                    <select class="form-control show-tick select-estado">
                                        <option value="">--Selecciona un Estado --</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Tipo</label>
                                <div class="form-group">
                                    <select class="form-control show-tick select-tipo">
                                        <option value="">--Selecciona un Tipo --</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Eps</label>
                                <div class="form-group">
                                    <select class="form-control show-tick select-eps">
                                        <option value="">--Selecciona una Eps --</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3"> 
                                <label for="">Cliente</label>
                                <div class="form-group"> 
                                   <select class="form-control show-tick select-cliente"> 
                                       <option value="">--Selecciona un Cliente --</option> 
                                       <option value="1">Activo</option> 
                                       <option value="2">Inactivo</option> </select> 
                                   </div> 
                               </div>
                               <div class="col-md-3"> 
                                <label for="">Ciudad</label> 
                                <div class="form-group">
                                 <select class="form-control show-tick select-ciudad"> 
                                     <option value="">--Selecciona una Ciudad --</option>
                                     <option value="1">Activo</option>
                                     <option value="2">Inactivo</option> 
                                 </select> 
                             </div> 
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect filtrar">Filtrar</button>
                    <button type="button" class="btn btn-link  waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Js-principal -->
<script src="pages/incapacidades/js/gestionar.js"></script>


<!-- Modal Dialogs ====================================================================================================================== -->
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Edición de jugador</h4>
            </div>
            <div class="modal-body">

                <div class="body">
                    <form>
                        <label for="">Primer nombre</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control nombre1" placeholder="Primer nombre" />
                            </div>
                        </div>
                        <label for="">Segundo nombre</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control nombre2" placeholder="Primer nombre" />
                            </div>
                        </div>
                        <label for="">Primer apellido</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control apellido1" placeholder="Segundo apellido" />
                            </div>
                        </div>
                        <label for="">Segundo apellido</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control apellido2" placeholder="Segundo apellido" />
                            </div>
                        </div>
                        <label for="">Fecha de nacimiento</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="datepicker form-control fechanacimiento" placeholder="Seleccina una fecha...">
                            </div>
                        </div>
                        <label for="">Estado</label>
                        <div class="form-group">
                            <select class="form-control show-tick select-estado">
                                <option value="">--Selecciona un estado --</option>

                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>

                            </select>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button"  data-idjugador="" class="btn btn-info waves-effect guardar">Guardar cambios</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}else
{
    require("../sinpermiso.php");
}
?>


