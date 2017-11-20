<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/incapacidad.php');
include('../../php/pagos.php');
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
                                LISTADO DE PAGOS  
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li><button type="button" class="btn bg-green 
                                    waves-effect filtro">
                                    <i class="material-icons">filter_list</i>
                                </button>
                                </li>
                                <li><button type="button" class="btn bg-red 
                                    waves-effect add-payment">
                                    <i class="material-icons">add</i>
                                </button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table  id="tabla-pagos" class="table table-bordered table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Eps</th>
                                        <th>Valor</th>
                                        <th>Fecha Pago</th>
                                        <th>Estado</th>
                                        <th>Fecha Creación</th>
                                        <th>Usuario Creación</th>
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
                    <h4 class="modal-title" id="defaultModalLabel">Filtro de Pagos</h4>
                </div>
                <div class="modal-body">

                    <div class="body">
                        <form>
                                <div class="col-md-3">
                                    <b>Fecha pago</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date f-fechapago" placeholder="Ej: 2017-07-30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Estado</label>
                                <div class="form-group">
                                    <select class="form-control show-tick select-estado">
                                        <option value="">--Selecciona Estado --</option>
                                     <option value="pendiente">Pendiente</option>
                                     <option value="completado">Completado</option>
                                    </select>
                         </div>
                     </div>
                    
                 <div class="col-md-3">
                    <label for="">Eps</label>
                    <div class="form-group">
                        <select class="form-control show-tick select-eps">
                            <option value="">--Selecciona Eps --</option>
                            <?php
                            $vector = Array_Get_Eps(true);
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
<script src="pages/pagos/js/gestionar.js"></script>


<?php
}else
{
    require("../sinpermiso.php");
}
?>





