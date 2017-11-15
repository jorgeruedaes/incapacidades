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

		$json = json_encode($_POST['json']); 
		$valorpago = $_POST['valor'];
		$fechapago = $_POST['fecha'];
		$estadopago = $_POST['estado'];
		$epspago = $_POST['eps'];
		$usuario = $_SESSION['id_usuarios'];

		$id= Set_nuevo_pago($valorpago,$fechapago,$estadopago,$epspago,$usuario,$json);

		if ($id!=0)
		{

			//guardo ahora las incapacidades
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