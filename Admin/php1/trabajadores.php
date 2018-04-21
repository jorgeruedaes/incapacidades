<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_Trabajadores()
{

	$clubs = consultar("SELECT `id_trabajadores`, `nombre`, `apellido` FROM  `tb_trabajadores`  order by apellido ");	


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_trabajadores = $valor['id_trabajadores'];
		$nombre = $valor['nombre'];
		$apellido = $valor['apellido'];


		$vector = array(
			'id_trabajadores'=>"$id_trabajadores",
			'nombre'=>"$nombre",
			'apellido'=>"$apellido"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}

function Boolean_Set_trabajador($nombre,$apellido,$cedula)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_trabajadores` SET `nombre`='%s',`apellido`='%s' WHERE `id_trabajadores`='%d' ",
		escape($nombre),escape($apellido),escape($cedula)));
	return $campeonatos;	
}

function Boolean_new_trabajador($nombre,$apellido,$cedula)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_trabajadores`(`id_trabajadores`, `nombre`, `apellido`)
		VALUES ('%d','%s','%s')",
		escape($cedula),escape($nombre),escape($apellido)));
	return $campeonatos;	

}
