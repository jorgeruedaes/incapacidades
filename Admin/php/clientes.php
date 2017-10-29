<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_Clientes()
{

	$clubs = consultar("SELECT `id_clientes`, `nombre`, `empresa`, `estado`, `acronimo` FROM `tb_clientes` order by nombre asc  ");	


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_clientes = $valor['id_clientes'];
		$nombre = $valor['nombre'];
		$empresa = $valor['empresa'];
		$acronimo = $valor['acronimo'];
		$estado = $valor['estado'];


		$vector = array(
			'id_clientes'=>"$id_clientes",
			'nombre'=>"$nombre",
			'empresa'=>"$empresa",
			'acronimo'=>"$acronimo",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}

function Array_Get_ClientesxEmpresa($empresa)
{

	$clubs = consultar("SELECT `id_clientes`, `nombre`, `empresa`, `estado`, `acronimo` FROM `tb_clientes` WHERE empresa='$empresa' order by nombre asc  ");	


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_clientes = $valor['id_clientes'];
		$nombre = $valor['nombre'];
		$empresa = $valor['empresa'];
		$acronimo = $valor['acronimo'];
		$estado = $valor['estado'];


		$vector = array(
			'id_clientes'=>"$id_clientes",
			'nombre'=>"$nombre",
			'empresa'=>"$empresa",
			'acronimo'=>"$acronimo",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}

function Boolean_Set_cliente($nombre,$acronimo,$estado,$empresa,$cliente)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_clientes` SET `nombre`='%s',`empresa`='%d',`estado`='%s',`acronimo`='%s' WHERE id_clientes='%d'  ",
		escape($nombre),escape($empresa),escape($estado),escape($acronimo),escape($cliente)));
	return $campeonatos;	
}

function boolean_new_cliente($nombre,$acronimo,$estado,$empresa)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_clientes`(`id_clientes`, `nombre`, `empresa`, `estado`, `acronimo`)
		VALUES (NULL,'%s','%d','%s','%s')",
		escape($nombre),escape($empresa),escape($estado),escape($acronimo)));
	return $campeonatos;	

}
