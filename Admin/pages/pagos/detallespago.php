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
  <title>-Detalle del pago  : <?php echo $id ?> </title>

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

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
            </div>
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

            </form>
          </div>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
          </div>
          <div class="body">
           <table  id="tabla-detalle" class="table table-bordered table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Fecha Corte</th>
                <th>Días</th>
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
                  <td><?php echo get_name_tipo($value['tipoincapacidad']); ?></td>
                  <td><?php echo $value['fechacorte'] ?></td>
                  <td><?php echo $value['dias'] ?></td>
                  <td><?php echo $value['valor'] ?></td>
                </tr>

                <?php
              }
              ?>

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

<!--  Js-principal -->
<script src="pages/pagos/js/gestionar.js"></script>


<?php
}else
{
  require("../sinpermiso.php");
}
?>





