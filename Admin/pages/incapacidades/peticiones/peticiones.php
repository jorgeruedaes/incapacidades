<?php
session_start();
Require_once('../../../php/principal.php');
Require_once('../../../php/clientes.php');
Require_once('../../../php/incapacidad.php');
if(isset($_SESSION['perfil']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un partido al sitio.
	if ($bandera === "nuevo") {

	}
	// Obtiene los datos de un partido.
	else if($bandera === "get_datos") {

	}
	// Modifica un partido del sitio.
	else if($bandera === "modificar") {
		
	}
	//  Elimina un partido.
	else if($bandera === "eliminar") {
		
	}else if($bandera === "getcampeonato") {
		
		// saber si ha sido o no definida la session del campeonato.
	}else if($bandera === "getcampeonato-diferente") {
		
		// saber si ha sido o no definida la session del campeonato.
	}else if($bandera === "filtrar") {
		$filtro = $_POST['where'];
		$vector = Array_Get_IncapcidadesxFiltro($filtro);
		if (!empty($vector)) {
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($vector).'';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	else if($bandera === "getclientes") {
		$empresa = $_POST['empresa'];
		$vector = Array_Get_ClientesxEmpresa($empresa);
		if (!empty($vector)) {
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($vector).'';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	else if ($bandera === "agregardetalles")
	{
		
	}else if($bandera === "getpartidosdobleestado") {

	}else if ($bandera === "agregardetalles-goles")
	{
		$json = json_encode($_POST['json']); 
		$partido = $_POST['partido'];
		$fecha = $_POST['fecha'];
		$estado = $_POST['estado'];
		$tipo = $_POST['tipo'];
		$resultado1 = $_POST['resultado1'];
		$resultado2 = $_POST['resultado2'];

		if ($tipo=='editar')
		{
			Delete_Detalles_Partido($partido);
			Reinicia_Detalles_Partido($partido);
		}

		if($estado==='1')
		{
			$estadop ='8';
		}
		else if ($estado==='7' or $estado==='2' )
		{
			$estadop ='2';

		}
		if (Set_resultado_Partido($partido,$resultado1,$resultado2,$estadop) and Add_detalles_partido($json,$partido)) 
		{
			$resultado.='"mensaje":true';
		}
		else {
			$resultado.='"mensaje":false';
		}

	}
	else if ($bandera === "get_detalles_partido")
	{
		$partido = $_POST['partido'];
		$vector = Array_Get_Datos_Partido($partido);
		if (!empty($vector)) 
		{
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($vector).'';
		} 
		else {
			$resultado.='"mensaje":false';
		}
	}
	else if ($bandera === "agregarresultado-rapido")
	{
		$partido = $_POST['partido'];
		$resultado1 = $_POST['resultado1'];
		$resultado2 = $_POST['resultado2'];
		if (Set_resultado_Partido($partido,$resultado1,$resultado2,'2'))
		{
			$resultado.='"mensaje":true';
		} 
		else {
			$resultado.='"mensaje":false';
		}
	}
	else if ($bandera === "modificar_tiporesultado")
	{
		$partido = $_POST['partido'];
		$tiporesultado = $_POST['tiporesultado'];
		if (Set_tiporesultado_Partido($partido,$tiporesultado))
		{
			$resultado.='"mensaje":true';
		} 
		else {
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

//---FUNCIONES--ESPECIFICAS--//
function Transforma_paritdo($array)
{
	$vector  = array();
	foreach ($array as $value) {

		$id_partido = $value['id_partido'];
		$equipo1    = $value['equipo1'];
		$nombre_equipo1 = Get_NombreEquipo($value['equipo1']);
		$equipo2    = $value['equipo2'];
		$nombre_equipo2 = Get_NombreEquipo($value['equipo2']);
		$estado     = $value['estado'];
		$nombre_estado = Get_NombreEstado_Partido($value['estado']);
		$fecha      = $value['fecha'];
		$hora       = $value['hora'];
		$lugar      = $value['lugar'];
		$nombre_lugar =    Get_NombreCancha($value['lugar']);
		$Nfecha     = $value['Nfecha'];
		$resultado1 = $value['resultado1'];
		$resultado2 = $value['resultado2'];
		$tiporesultado = $value['tiporesultado'];

		$arreglo = array(
			"id_partido" => "$id_partido",
			"equipo1" => "$equipo1",
			"equipo2" => "$equipo2",
			"estado" => "$estado",
			"fecha" => "$fecha",
			"hora" => "$hora",
			"lugar" => "$lugar",
			"Nfecha" => "$Nfecha",
			"resultado1" => "$resultado1",
			"resultado2" => "$resultado2",
			"nombre_equipo1"=>"$nombre_equipo1",
			"nombre_equipo2"=>"$nombre_equipo2",
			"nombre_estado"=>"$nombre_estado",
			"nombre_lugar"=>"$nombre_lugar",
			"tiporesultado" => "$tiporesultado"
			);

		array_push($vector, $arreglo);
	}


	return $vector;
}


?>