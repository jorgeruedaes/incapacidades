<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_TiposIncapacidad()
{

	$clubs = consultar("SELECT `id_tipos`, `nombre`, `estado` FROM `tb_tipos_incapacidad`  order by nombre ");	


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_tipos = $valor['id_tipos'];
		$nombre = $valor['nombre'];
		$estado = $valor['estado'];


		$vector = array(
			'id_tipos'=>"$id_tipos",
			'nombre'=>"$nombre",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}

function boolean_set_tipo($nombre,$estado,$tipo)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_tipos_incapacidad` SET `nombre`='%s',`estado`='%s' WHERE id_tipos ='%d' ",
		escape($nombre),escape($estado),escape($tipo)));
	return $campeonatos;	
}

function boolean_new_tipo($nombre,$codigo,$estado)
{
	$campeonatos = insertar(sprintf("INSERT INTO  `tb_tipos_incapacidad`(`id_tipos`, `nombre`, `estado`) 
		VALUES ('%d','%s','%s')",
		escape($codigo),escape($nombre),escape($estado)));
	return $campeonatos;	

}
