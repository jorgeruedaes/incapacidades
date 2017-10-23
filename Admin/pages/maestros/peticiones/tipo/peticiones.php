<?php
session_start();
include('../../../../php/consultas.php');
include('../../../../php/incapacidad.php');

if(isset($_SESSION['id_usuarios']))
{
    $resultado = '{"salida":true,';
    $bandera = $_POST['bandera'];

// Modifica un club.
    if ($bandera === "m") {
    }
    // Guarda los datos de un nuevo campeonato.
    else if($bandera === "nuevo") {

        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $estado = $_POST['estado'];

        if (boolean_new_tipo($nombre,$codigo,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo perfil.
    else if($bandera === "modificar") {
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $tipo = $_POST['tipo'];

        if (Boolean_Set_tipo($nombre,$estado,$tipo)) {
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