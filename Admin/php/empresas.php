<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_Empresas($estado)
{

	if ($estado)
	{

	$empresas = consultar("SELECT `id_empresas`, `nombre`, `estado`, `acronimo` FROM `tb_empresas` where estado='activo' order by nombre asc  ");	
	}
	else
	{
	$empresas = consultar("SELECT `id_empresas`, `nombre`, `estado`, `acronimo` FROM `tb_empresas` order by nombre asc  ");	
	}

	$datos = array();
	while ($valor = mysqli_fetch_array($empresas)) {
		$id_empresas = $valor['id_empresas'];
		$nombre = $valor['nombre'];
		$acronimo = $valor['acronimo'];
		$estado = $valor['estado'];


		$vector = array(
			'id_empresas'=>"$id_empresas",
			'nombre'=>"$nombre",
			'acronimo'=>"$acronimo",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Boolean_Set_Empresa description]
 * @param [type] $nombre   [description]
 * @param [type] $acronimo [description]
 * @param [type] $estado   [description]
 * @param [type] $empresa  [description]
 */
function Boolean_Set_Empresa($nombre,$acronimo,$estado,$empresa)
{

	$empresa = modificar(sprintf("UPDATE `tb_empresas` SET `nombre`='%s',`estado`='%s',`acronimo`='%s' WHERE  id_empresas='%d' ",
		escape($nombre),escape($estado),escape($acronimo),escape($empresa)));
	return $empresa;	
}
/**
 * [boolean_new_Empresa description]
 * @param  [type] $nombre   [description]
 * @param  [type] $acronimo [description]
 * @param  [type] $estado   [description]
 * @return [type]           [description]
 */
function boolean_new_Empresa($nombre,$acronimo,$estado)
{
	$empresa = insertar(sprintf("INSERT INTO `tb_empresas`(`id_empresas`, `nombre`, `estado`, `acronimo`) 
		VALUES (NULL,'%s','%s','%s')",
		escape($nombre),escape($estado),escape($acronimo)));
	return $empresa;	

}

function Get_nombre_empresa($empresa)
{
	$empresa = consultar("SELECT  `acronimo` FROM `tb_empresas` where id_empresas='$empresa'   ");	
	$valor = mysqli_fetch_array($empresa);
	return $valor['acronimo'];


}