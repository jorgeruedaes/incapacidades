 <?php  
 include("../../administracion.php");
 $id_modulos=Int_RutaModulo($_SERVER['REQUEST_URI']);
 if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
  ?>
  <div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
      <div class="container-fluid">
        <h2 class="no-margin-bottom">Charts</h2>
      </div>
    </header>
    <!-- Breadcrumb-->
    <ul class="breadcrumb">
      <div class="container-fluid">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Charts</li>
      </div>
    </ul>
    <!-- Charts Section-->
    <section class="charts">
      <div class="container-fluid">
        <div class="row">
          <!-- Line Charts-->
          <div class="col-lg-8">
            <div class="line-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Line Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="lineChartExample"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="line-chart-example card no-margin-bottom">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Line Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="lineChartExample1"></canvas>
              </div>
            </div>
            <div class="line-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-body">
                <canvas id="lineChartExample2"></canvas>
              </div>
            </div>
          </div>
          <!-- Bar Charts-->
          <div class="col-lg-4">
            <div class="bar-chart-example card no-margin-bottom">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Bar Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="barChart1"></canvas>
              </div>
            </div>
            <div class="line-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-body">
                <canvas id="barChart2"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="bar-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Bar Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="barChartExample"></canvas>
              </div>
            </div>
          </div>
          <!-- Doughnut Chart -->
          <div class="col-lg-6">
            <div class="pie-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Doughnut  Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="doughnutChartExample"></canvas>
              </div>
            </div>
          </div>
          <!-- Pie Chart -->
          <div class="col-lg-6">
            <div class="pie-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Pie  Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="pieChartExample"></canvas>
              </div>
            </div>
          </div>
          <!-- Polar Chart-->
          <div class="col-lg-6">
            <div class="polar-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Polar Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="polarChartExample"></canvas>
              </div>
            </div>
          </div>
          <!-- Radar Chart-->
          <div class="col-lg-6">
            <div class="radar-chart-example card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                </div>
              </div>
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Radar Chart Example</h3>
              </div>
              <div class="card-body">
                <canvas id="radarChartExample"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php
}else
{
  require("../sinpermiso.php");
}
?>