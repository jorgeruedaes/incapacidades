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
	if ($bandera === "guardar-pago") {
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
	}else if ($bandera === "borrar-pago") {
		$idpago = $_POST['idpago'];
		$estado = $_POST['estado'];
		$id= Delete_pago($idpago,$estado);
		if ($id!=0)
		{
			//guardo ahora las incapacidades
			$resultado.='"mensaje":true';
		} 
		else {
			$resultado.='"mensaje":false';
		}
	}
	else if($bandera === "guardar-pago-editado") {
		$json = json_encode($_POST['json']); 
		$valorpago = $_POST['valor'];
		$fechapago = $_POST['fecha'];
		$estadopago = $_POST['estado'];
		$epspago = $_POST['eps'];
		$usuario = $_SESSION['id_usuarios'];
		$idpago =  $_POST['idpago'];
		$id= Set_nuevo_pago_editado($valorpago,$fechapago,$estadopago,$epspago,$usuario,$json,$idpago);
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
	else if($bandera === "reestablecer-pago") {
		$json = json_encode($_POST['json']); 
		$idpago =  $_POST['idpago'];
		$id= Reestablecer_Pago($idpago);
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
	else if($bandera === "filtrar") {
		$filtro = $_POST['where'];
		$vector = Array_Get_PagosxFiltro($filtro);
		if (!empty($vector)) {
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($vector).'';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	else if($bandera === "editar-pago") {
		$idpago = $_POST['id'];
		$vector1 = Array_Get_DatosPago($idpago);
		$vector2 = Array_Get_IncapacidadesxPago($idpago);
		
		if (!empty($vector1)) {
			$resultado.='"mensaje":true,';
			$resultado.='"datospago":'.json_encode($vector1).',';
			$resultado.='"datosincapacidades":'.json_encode($vector2).'';
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