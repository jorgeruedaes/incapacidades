<?php
session_start();
include('../../../../php/consultas.php');
include('../../../../php/empresas.php');

if(isset($_SESSION['id_usuarios']))
{
    $resultado = '{"salida":true,';
    $bandera = $_POST['bandera'];

// Modifica un club.
    if ($bandera === "modificar-imagen") {
    }
    // Guarda los datos de un nuevo campeonato.
    else if($bandera === "nuevo") {

        $nombre = $_POST['nombre'];
        $acronimo = $_POST['acronimo'];
        $estado = $_POST['estado'];

        if (boolean_new_Empresa($nombre,$acronimo,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo perfil.
    else if($bandera === "modificar") {
        $nombre = $_POST['nombre'];
        $acronimo = $_POST['acronimo'];
        $estado = $_POST['estado'];
        $empresa = $_POST['empresa'];

        if (Boolean_Set_Empresa($nombre,$acronimo,$estado,$empresa)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
}
else
{
    $resultado = '{"salida":false';
}
$resultado.='}';
echo ($resultado);
?>