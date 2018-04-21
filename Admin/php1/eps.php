<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_Eps($estado)
{
	if($estado)
	{
	$clubs = consultar("SELECT `id_eps`, `nombre`, `estado` FROM `tb_eps` where estado='activo' order by nombre asc  ");	
	}
	else
	{
		
	$clubs = consultar("SELECT `id_eps`, `nombre`, `estado` FROM `tb_eps` order by nombre asc  ");	
	}


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_eps = $valor['id_eps'];
		$nombre = $valor['nombre'];
		$estado = $valor['estado'];


		$vector = array(
			'id_eps'=>"$id_eps",
			'nombre'=>"$nombre",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Boolean_set_eps description]
 * @param [type] $nombre [description]
 * @param [type] $estado [description]
 * @param [type] $codigo [description]
 * @param [type] $eps    [description]
 */
function Boolean_set_eps($nombre,$estado,$codigo,$eps)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_eps` SET `id_eps`='%s',`nombre`='%s',`estado`='%s' WHERE id_eps='%d' ",
		escape($codigo),escape($nombre),escape($estado),escape($eps)));
	return $campeonatos;	
}


/**
 * [boolean_new_eps description]
 * @param  [type] $nombre [description]
 * @param  [type] $codigo [description]
 * @param  [type] $estado [description]
 * @return [type]         [description]
 */
function boolean_new_eps($nombre,$codigo,$estado)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_eps`(`id_eps`, `nombre`, `estado`) VALUES ('%d','%s','%s')",
		escape($codigo),escape($nombre),escape($estado)));
	return $campeonatos;	

}

