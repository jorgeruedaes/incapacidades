<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_Ciudades($estado)
{
	if($estado)
	{
	$clubs = consultar("SELECT `id_ciudades`, `nombre`, `estado`, `acronimo` FROM `tb_ciudades` where estado='activo'  order by nombre ");	

	}
	else
	{
		
	$clubs = consultar("SELECT `id_ciudades`, `nombre`, `estado`, `acronimo` FROM `tb_ciudades`  order by nombre ");	
	}


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_ciudades = $valor['id_ciudades'];
		$nombre = $valor['nombre'];
		$acronimo = $valor['acronimo'];
		$estado = $valor['estado'];


		$vector = array(
			'id_ciudades'=>"$id_ciudades",
			'nombre'=>"$nombre",
			'acronimo'=>"$acronimo",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}

function Boolean_Set_ciudades($nombre,$acronimo,$estado,$ciudad)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_ciudades` SET `nombre`='%s',`estado`='%s',`acronimo`='%s' WHERE id_ciudades='%d' ",
		escape($nombre),escape($estado),escape($acronimo),escape($ciudad)));
	return $campeonatos;	
}

function Boolean_new_ciudades($nombre,$acronimo,$estado)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_ciudades`(`id_ciudades`, `nombre`, `estado`, `acronimo`)
		VALUES (NULL,'%s','%s','%s')",
		escape($nombre),escape($estado),escape($acronimo)));
	return $campeonatos;	

}