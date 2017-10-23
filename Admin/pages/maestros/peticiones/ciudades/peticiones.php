<?php
session_start();
include('../../../../php/consultas.php');
include('../../../../php/ciudades.php');

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

        if (Boolean_new_ciudades($nombre,$acronimo,$estado)) {
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
        $ciudad = $_POST['ciudad'];

        if (Boolean_Set_ciudades($nombre,$acronimo,$estado,$ciudad)) {
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