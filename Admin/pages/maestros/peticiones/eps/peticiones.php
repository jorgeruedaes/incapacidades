<?php
session_start();
include('../../../../php/consultas.php');
include('../../../../php/eps.php');

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

        if (boolean_new_eps($nombre,$codigo,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo perfil.
    else if($bandera === "modificar") {
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $estado = $_POST['estado'];
        $eps = $_POST['eps'];

        if (Boolean_Set_eps($nombre,$estado,$codigo,$eps)) {
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