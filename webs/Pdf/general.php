
<?php
require('mc_table.php');

require('../../Admin/php/conexion.php');
require('../../Admin/php/funciones.php');

$pdf=new PDF_MC_Table();
$pdf->SetMargins(15, 15,30); 
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,20,30,40,40,20));

$vector = ObtenerFechasdePartidos('1','asc');

if(sizeof($vector > 0)){

   $pdf->Row(array('Lugar','Fecha','Hora','Local','Visitante','Categoria'));

   foreach ($vector as $value)
   {                
    $idcancha = $value['lugar'];
    $fecha = $value['fecha'];

    $vectores = ObtenerPartidoDeUnaFecha($fecha,'1',$idcancha);
    if(sizeof($vectores) > 0){


        foreach ($vectores as $values)
        {
            $idpartido  = $values['id_partido'];
            $equipo1    = $values['equipo1'];
            $equipo2    = $values['equipo2'];
            $fecha      = $values['fecha'];
            $hora       = $values['hora'];
            $lugar      = $values['lugar'];

             $pdf->Row(array(NombreCancha($lugar),FormatoFecha($fecha),FormatoHora($hora),NombreEquipo($equipo1),NombreEquipo($equipo2), CategoriaEquipo($equipo1)));
        }
    }
}

}

$pdf->Output();



?>