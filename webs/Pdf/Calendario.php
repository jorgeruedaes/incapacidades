
<?php
require('mc_table.php');

require('../../Admin/php/conexion.php');
require('../../Admin/php/funciones.php');

$pdf=new PDF_MC_Table();
$pdf->SetMargins(15, 15,30, 30);
$pdf->AddPage(); 
$pdf->SetFont('Arial','',10);

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,30,40,40,40));


if(isset($_GET['id'])){

    $id = $_GET['id'];
    $vectores = ObtenerPartidosPorJugarDeUnTorneo($id,'1');
    if(sizeof($vectores) == 0){
        $pdf->Write(5,'No hay programacion');
    }else{

        $pdf->Row(array('Fecha','Hora','Lugar','Local','Visitante'));


        foreach ($vectores as $value)
        {
            $idpartido  = $value['idpartido'];
            $equipo1    = $value['equipo1'];
            $equipo2    = $value['equipo2'];
            $fecha      = $value['fecha'];
            $hora       = $value['hora'];
            $lugar      = $value['lugar'];

            $pdf->Row(array(FormatoFecha($fecha),FormatoHora($hora),NombreCancha($lugar),NombreEquipo($equipo1),NombreEquipo($equipo2)));
        }
    }

$pdf->Output();

}

?>