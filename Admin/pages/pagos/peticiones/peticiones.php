<?php
session_start();
Require_once('../../../php/principal.php');
Require_once('../../../php/clientes.php');
Require_once('../../../php/pagos.php');
if(isset($_SESSION['perfil']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un partido al sitio.
	if ($bandera === "guardar-pendiente") {

		$valorpago = $_POST['valor'];
		$fechapago = $_POST['fecha'];
		$estadopago = $_POST['estado'];
		$epspago = $_POST['eps'];
		$usuario = $_SESSION['id_usuarios'];

		$id= Set_nuevo_pago($valorpago,$fechapago,$estadopago,$epspago,$usuario);
		if ($id!=0)
		{
			$resultado.='"mensaje":true,';
			$resultado.='"idpago":'.$id.'';
		} 
		else {
			$resultado.='"mensaje":false';
		}

	}
	// Obtiene los datos de un partido.
	else if($bandera === "get_datos") {

	}
	 


}
else
{
	$resultado = '{"salida":false';
}
$resultado.='}';
echo ($resultado);

?>