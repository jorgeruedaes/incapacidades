<?php
include('../../menuinicial.php');
$id = $_GET['id'];
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'noticia'.'_'.$id);
?>
<div class="ec-loading-section"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>
<div class="ec-mini-header">
    <span class="ec-blue-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ec-mini-title">
                    <h1></h1>
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
                        <div class="col-md-12 ec-spacer-section">
                         <?php 

                            $vector = ObtenerNoticia($id);

                            foreach ($vector as $value)
                            {
                            	
                           
                            ?>
                            <div class="ec-detail-editor">
                            <ul class="ec-blog-option">
												<li>
												<i class="fa fa-clock-o"></i> Fecha publicación: 
												<a href="javascript:void();" class="ec-colorhover"><?php echo $value['fecha'];?></a>
												<a href="javascript:void();" class="ec-color float-right font-15"><?php echo NombreTorneo($value['torneo']);?></a>
												</li>
											</ul>
                                <h4 class="center font-20"><?php echo $value['titulo']?></h4>
                                <br>
                                <div class="row">
                                	<div class="col-md-6">
                                		  <figure class="ec-detail-thumb" ><img src="<?php echo $value['imagen']; ?>" alt=""></figure>
                                	</div>
                                	<div class="col-md-6">
                                <p class="justify" style=""><?php echo $value['texto']?></p>
                                	</div>
                                </div>
                              
                               
                            </div>
                            <?php } ?>
                            <!--// Related Post //-->
                     
                            <!--// Authore Post //-->
                       
                            <!--// Authore Post //-->
                            <!--// User Comment //-->
                     
                            <!--// User Comment //-->
                            <!--// Comment Form //-->
                         
                            <!--// Comment Form //-->
                        </div>
                        
                    </div>
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
