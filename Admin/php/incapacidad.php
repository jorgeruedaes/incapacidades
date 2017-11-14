<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_TiposIncapacidad($estado)
{
	if ($estado)
	{
		$clubs = consultar("SELECT `id_tipos`, `nombre`, `estado` FROM `tb_tipos_incapacidad`   order by nombre ");
	}
	else
	{
		$clubs = consultar("SELECT `id_tipos`, `nombre`, `estado` FROM `tb_tipos_incapacidad`  where estado='activo' order by nombre ");
	}


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

function Array_Get_EstadosIncapacidad($estado)
{
	if ($estado)
	{
		$clubs = consultar("SELECT `id_estados`, `nombre`, `estado` FROM `tb_estados_incapacidad`   order by nombre ");
	}
	else
	{
		$clubs = consultar("SELECT `id_estados`, `nombre`, `estado` FROM `tb_estados_incapacidad` where estado='activo' order by nombre ");
	}


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_estados = $valor['id_estados'];
		$nombre = $valor['nombre'];
		$estado = $valor['estado'];


		$vector = array(
			'id_estados'=>"$id_estados",
			'nombre'=>"$nombre",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [get_name_tipo description]
 * @param  [type] $tipo [description]
 * @return [type]       [description]
 */
function get_name_tipo($tipo)
{

	$campeonatos = mysqli_fetch_array(consultar("SELECT nombre FROM  `tb_tipos_incapacidad`  WHERE id_tipos =$tipo "));
	return $campeonatos['nombre'];	
}

function get_name_eps($eps)
{

	$campeonatos = mysqli_fetch_array(consultar("SELECT nombre FROM  `tb_eps`  WHERE id_eps =$eps "));
	return $campeonatos['nombre'];	
}

function get_name_estado($estado)
{

	$campeonatos = mysqli_fetch_array(consultar("SELECT nombre FROM  `tb_estados_incapacidad`  WHERE id_estados =$estado "));
	return $campeonatos['nombre'];	
}

function Array_Get_IncapcidadesxFiltro($consulta)
{
	//$clubs = consultar("SELECT * FROM tb_incapacidades ".$consulta.' ORDER BY fecha_corte ');	


	$clubs = consultar("SELECT inc.*,  concat(tr.nombre, ' ', tr.apellido) as fullname FROM tb_incapacidades inc INNER JOIN tb_trabajadores tr ON tr.id_trabajadores = inc.trabajador ".$consulta." ORDER BY fecha_corte");


	$datos = array();
	while ($data = mysqli_fetch_array($clubs)) {
		$id_incapacidad = $data['id_incapacidad'];
		$ciudad = $data['ciudad'];
		$trabajador = $data['trabajador'];
		$cliente = $data['cliente'];
		$tipo = get_name_tipo($data['tipo']);
		$estado =get_name_estado($data['estado']);
		$fecha_inicial = $data['fecha_inicial'];
		$fecha_final = $data['fecha_final'];
		$fecha_creacion = $data['fecha_creacion'];
		$fecha_corte = $data['fecha_corte'];
		$cantidad = $data['cantidad'];
		$valor = $data['valor'];
		$eps = get_name_eps($data['eps']);
		$nombretrabajador = $data['fullname'];


		$vector = array(
			'id_incapacidad'=>"$id_incapacidad",
			'ciudad'=>"$ciudad",
			'trabajador'=>"$trabajador",
			'cliente'=>"$cliente",
			'tipo'=>"$tipo",
			'estado'=>"$estado",
			'fecha_inicial'=>"$fecha_inicial",
			'fecha_final'=>"$fecha_final",
			'fecha_creacion'=>"$fecha_creacion",
			'fecha_corte'=>"$fecha_corte",
			'cantidad'=>"$cantidad",
			'valor'=>"$valor",
			'eps'=>"$eps",
			'nombretrabajador'=>"$nombretrabajador",

			);
		array_push($datos, $vector);
	}

	return $datos;	

}



