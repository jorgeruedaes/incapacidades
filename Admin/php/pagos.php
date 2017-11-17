<?php
/**
 * [Array_Get_Clientes Retorna los clientes de incapacidades]
 */
function Array_Get_Pagos()
{

	$clubs = consultar("SELECT  `id_pagos`, `valor`, `descripcion`, `fecha_pago`, `fecha_creacion`, `estado`, `usuario` FROM `tb_pagos` order by fecha_pago asc  ");	


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_pagos = $valor['id_pagos'];
		$valor = $valor['valor'];
		$descripcion = $valor['descripcion'];
		$fecha_pago = $valor['fecha_pago'];
		$fecha_creacion = $valor['fecha_creacion'];
		$estado = $valor['estado'];
		$usuario = $valor['usuario'];


		$vector = array(
			'id_pagos'=>"$id_pagos",
			'valor'=>"$valor",
			'descripcion'=>"$descripcion",
			'fecha_pago'=>"$fecha_pago",
			'fecha_creacion'=>"$fecha_creacion",
			'estado'=>"$estado",
			'usuario'=>"$usuario"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}

function Set_nuevo_pago($valorpago,$fechapago,$estadopago,$epspago,$usuario,$vector)
{

	global $conexion;
	$query = mysqli_query($conexion,sprintf("INSERT INTO `tb_pagos`(`id_pagos`, `valor`, `descripcion`, `fecha_pago`, `fecha_creacion`, `estado`, `usuario`, `id_eps`)
     	VALUES (NULL,'%d','','%s',NOW(),'%s','%d','%d') ",escape($valorpago),escape($fechapago),escape($estadopago),escape($usuario),escape($epspago)));

	$id = mysqli_insert_id($conexion); //idpago

	//pregunto si creó el pago
	if($id > 0)
	{

		$json = json_decode($vector);
	    //a guardar la relacion entre pagos e incapacidades
		    for ($i=0; $i < count($json) ; $i++) {

		           Set_Pago_Incapacidad($id,$json[$i][0],$json[$i][1],$json[$i][2],$json[$i][3]);
		         
		    }

		     for ($i=0; $i < count($json) ; $i++) {

		           Set_Saldo_Incapacidad($json[$i][0],$json[$i][1],$json[$i][2],$json[$i][3]);
		    }
	}
	else
	{
		$id=0;
	}

	return $id;
}

function Set_Pago_Incapacidad($idpago, $idincapacidad, $valor,$tipoincapacidad,$fechacorte)
{

	$campeonatos = insertar(sprintf("INSERT INTO `tr_incapacidadesxpago`(`incapacidad`, `pago`, `valor`, `tipoincapacidad`, `fecha_corte`) 
		VALUES ('%d','%d','%d','%d','%s')",
		escape($idincapacidad),escape($idpago),escape($valor),escape($tipoincapacidad),escape($fechacorte)));
	return $campeonatos;	

}

function Set_Saldo_Incapacidad($idincapacidad, $valor,$tipoincapacidad,$fechacorte)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_incapacidades` SET `saldo`=`saldo` - '%d' WHERE id_incapacidad='%d' AND tipo='%d' AND fecha_corte='%s'",
		escape($valor),escape($idincapacidad),escape($tipoincapacidad),escape($fechacorte)));
	return $campeonatos;	
}
/**
 * [Set_Clubs description]
 * @param [type] $nombre    [description]
 * @param [type] $categoria [description]
 * @param [type] $estado    [description]
 * @param [type] $torneo    [description]
 */
function Set_Clubs($nombre,$telefono,$direccion,$presidente,$horario,$cancha,$correo,$estado,$club)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_colegio` SET `nombre`='%s',`direccion`='%s',`telefono`='%s',`correo`='%s',`presidente`='%s',`cancha_entrenamiento`='%s',`horario`='%s',`estado`='%s' WHERE id_colegio='%d' ",
		escape($nombre),escape($direccion),escape($telefono),escape($correo),escape($presidente),
		escape($cancha),escape($horario),escape($estado),escape($club)));
	return $campeonatos;	
}

/**
 * [boolean_set_imagene_clubs description]
 * @param  [type] $reglamento [description]
 * @param  [type] $torneo     [description]
 * @return [type]             [description]
 */
function boolean_set_imagen_clubs($imagen,$club)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_colegio` SET `logo`='%s' WHERE  `id_colegio`='%d' ",
		escape($imagen),escape($club)));
	return $campeonatos;	
}
/**
 * [boolean_new_Club description]
 * @param  [type] $nombre    [description]
 * @param  [type] $categoria [description]
 * @return [type]            [description]
 */
function boolean_new_Club($nombre,$telefono,$direccion,$presidente,$horario,$cancha,$correo,$estado,$url)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_colegio`(`id_colegio`, `nombre`, `direccion`, `telefono`, `correo`, `presidente`, `cancha_entrenamiento`, `horario`, `logo`, `estado`) 
		VALUES (NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		escape($nombre),escape($direccion),escape($telefono),escape($correo),escape($presidente),
		escape($cancha),escape($horario),escape($url),escape($estado)));
	return $campeonatos;	

}
/**
 * [Get_nombre_club description]
 * @param [type] $identificador [id]
 */
function Get_nombre_club($identificador)
{
    $valor = mysqli_fetch_array(consultar("SELECT nombre 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['nombre'];
    
    return $valor;
}

function Array_Get_PagosxFiltro($consulta)
{
	$clubs = consultar("SELECT pg.id_pagos, pg.valor, pg.fecha_pago, pg.fecha_creacion, pg.estado, ep.nombre as nombreeps, us.nombre_usuario as nombreusuario FROM tb_pagos pg INNER JOIN tb_eps ep ON ep.id_eps = pg.id_eps INNER JOIN tb_usuarios us ON us.id_usuario = pg.usuario ".$consulta." ORDER BY fecha_creacion");

	$datos = array();
	while ($data = mysqli_fetch_array($clubs)) {
		$id_pago = $data['id_pagos'];
		$valor = $data['valor'];
		$eps = $data['nombreeps'];
		$fechapago = $data['fecha_pago'];
		$fechacreacion = $data['fecha_creacion'];
		$estado =$data['estado'];
		$usuario = $data['nombreusuario'];
	
		$vector = array(
			'id_pago'=>"$id_pago",
			'valor'=>"$valor",
			'eps'=>"$eps",
			'fechapago'=>"$fechapago",
			'fechacreacion'=>"$fechacreacion",
			'estado'=>"$estado",
			'usuario'=>"$usuario",

			);
		array_push($datos, $vector);
	}

	return $datos;	

}
