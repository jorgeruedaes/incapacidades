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
function Delete_pago($idpago,$estado)
{
		if ($estado == "pendiente") {
			$eliminadorelacion = eliminar("DELETE FROM `tr_incapacidadesxpago` WHERE pago=$idpago");
			$eliminado  = eliminar("DELETE FROM `tb_pagos` WHERE id_pagos= $idpago");
		} else if($estado == "completado") {
		
			//consulto las incapacidades del pago
			$array = Array_Get_IncapacidadesxPago($idpago);
			if(count($array) > 0)
			{
	 			for ($i=0; $i < count($array); $i++) {
 
			    	//restablezco el valor sumandolo a la incapacidad
			    	//id, valor, tipo, fecha
			    	// ejemplo funcionando
			        Set_Nuevo_Saldo_Incapacidad($array[$i]['idincapacidad'],$array[$i]['valor'],$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
			    }
				for ($i=0; $i < count($array); $i++) {
						
					$nueva = 6;
		  			$entramite = 2;
		  			$saldoinc = Get_Saldo_Incapacidad($array[$i]['idincapacidad'],$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
		  			$valorinc = Get_Valor_Incapacidad($array[$i]['idincapacidad'],$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
				          if($saldoinc == $valorinc)
				          {
				          	 //liquidada
				          	Set_Estado_Incapacidad($array[$i]['idincapacidad'],$nueva,$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
				          } else 
				          {	
				          	//en tramite
				          	Set_Estado_Incapacidad($array[$i]['idincapacidad'],$entramite,$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
				          }
				 }
			}
		   	
		   	$eliminadorelacion = eliminar("DELETE FROM `tr_incapacidadesxpago` WHERE pago=$idpago");
		   	$eliminado  = eliminar("DELETE FROM `tb_pagos` WHERE id_pagos= $idpago");
		}
	 
	return $eliminado;
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
		    if($estadopago != "pendiente")
		    {
		    	for ($i=0; $i < count($json) ; $i++) {
		        Set_Saldo_Incapacidad($json[$i][0],$json[$i][1],$json[$i][2],$json[$i][3]);
  				
		    	}
			    for ($i=0; $i < count($json) ; $i++) {
					
					$liquidada = 1;
	  				$entramite = 2;
	  				$saldoinc = Get_Saldo_Incapacidad($json[$i][0],$json[$i][2],$json[$i][3]);
	  				//$valorinc = Get_Valor_Incapacidad($json[$i][0],$json[$i][2],$json[$i][3]);
			          if($saldoinc == 0)
			          {
			          	 //liquidada
			          	Set_Estado_Incapacidad($json[$i][0],$liquidada,$json[$i][2],$json[$i][3]);
			          } else 
			          {	
			          	//en tramite
			          	Set_Estado_Incapacidad($json[$i][0],$entramite,$json[$i][2],$json[$i][3]);
			          }
			     }
		    }
	}
	else
	{
		$id=0;
	}
	return $id;
}
function Delete_Pago_Incapacidad($idpago)
{
    $valor  = eliminar("DELETE FROM `tr_incapacidadesxpago` WHERE pago=$idpago");
    return $valor;
}
function Reestablecer_Pago($idpago)
{
	$array = Array_Get_IncapacidadesxPago($idpago);
			if(count($array) > 0)
			{
	 			for ($i=0; $i < count($array); $i++) {
 
			    	//restablezco el valor sumandolo a la incapacidad
			    	//id, valor, tipo, fecha
			        Set_Nuevo_Saldo_Incapacidad($array[$i]['idincapacidad'],$array[$i]['valor'],$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
			    }
			    for ($i=0; $i < count($array); $i++) {
						
					$nueva = 6;
		  			$entramite = 2;
		  			$saldoinc = Get_Saldo_Incapacidad($array[$i]['idincapacidad'],$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
		  			$valorinc = Get_Valor_Incapacidad($array[$i]['idincapacidad'],$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
				          if($saldoinc == $valorinc)
				          {
				          	 //liquidada
				          	Set_Estado_Incapacidad($array[$i]['idincapacidad'],$nueva,$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
				          } else 
				          {	
				          	//en tramite
				          	Set_Estado_Incapacidad($array[$i]['idincapacidad'],$entramite,$array[$i]['tipoincapacidad'],$array[$i]['fechacorte']);
				          }
				 }
			}
}
function Set_nuevo_pago_editado($valorpago,$fechapago,$estadopago,$epspago,$usuario,$vector,$idpago)
{
	//global $conexion;
	//actualizamos el pago
	$cambios = modificar(sprintf("UPDATE `tb_pagos` SET `valor`='%d',`fecha_pago`='%s',`id_eps`='%d',`estado`='%s' WHERE id_pagos='%d'",
		escape($valorpago),escape($fechapago),escape($epspago),escape($estadopago),escape($idpago)));
	//borramos relacion
	Delete_Pago_Incapacidad($idpago);
		$json = json_decode($vector);
	    //a guardar la relacion entre pagos e incapacidades
		    for ($i=0; $i < count($json) ; $i++) {
		        Set_Pago_Incapacidad($idpago,$json[$i][0],$json[$i][1],$json[$i][2],$json[$i][3]);
		    }
		    if($estadopago != "pendiente")
		    {
		    	for ($i=0; $i < count($json) ; $i++) {
		        Set_Saldo_Incapacidad($json[$i][0],$json[$i][1],$json[$i][2],$json[$i][3]);
  				
		    	}
			    for ($i=0; $i < count($json) ; $i++) {
					
					$liquidada = 1;
	  				$entramite = 2;
	  				$saldoinc = Get_Saldo_Incapacidad($json[$i][0],$json[$i][2],$json[$i][3]);
	  				//$valorinc = Get_Valor_Incapacidad($json[$i][0],$json[$i][2],$json[$i][3]);
			          if($saldoinc == 0)
			          {
			          	 //liquidada
			          	Set_Estado_Incapacidad($json[$i][0],$liquidada,$json[$i][2],$json[$i][3]);
			          } else 
			          {	
			          	//en tramite
			          	Set_Estado_Incapacidad($json[$i][0],$entramite,$json[$i][2],$json[$i][3]);
			          }
			     }
		    }
	return $idpago;
}
function Set_Pago_Incapacidad($idpago, $idincapacidad, $valor,$tipoincapacidad,$fechacorte)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tr_incapacidadesxpago`(`incapacidad`, `pago`, `valor`, `tipoincapacidad`, `fecha_corte`) 
		VALUES ('%d','%d','%d','%d','%s')",
		escape($idincapacidad),escape($idpago),escape($valor),escape($tipoincapacidad),escape($fechacorte)));
	return $campeonatos;	
}
function Set_Nuevo_Saldo_Incapacidad($idincapacidad, $valor,$tipoincapacidad,$fechacorte)
{
	$campeonatos = modificar(sprintf("UPDATE `tb_incapacidades` SET `saldo`=`saldo` + '%d' WHERE id_incapacidad='%d' AND tipo='%d' AND fecha_corte='%s'",
		escape($valor),escape($idincapacidad),escape($tipoincapacidad),escape($fechacorte)));
	return $campeonatos;	
}
function Set_Saldo_Incapacidad($idincapacidad, $valor,$tipoincapacidad,$fechacorte)
{
	$campeonatos = modificar(sprintf("UPDATE `tb_incapacidades` SET `saldo`=`saldo` - '%d' WHERE id_incapacidad='%d' AND tipo='%d' AND fecha_corte='%s'",
		escape($valor),escape($idincapacidad),escape($tipoincapacidad),escape($fechacorte)));
	return $campeonatos;	
}
function Get_Saldo_Incapacidad($idincapacidad,$tipoincapacidad,$fechacorte)
{
    $saldoincapacidad = mysqli_fetch_array(consultar("SELECT saldo FROM `tb_incapacidades` WHERE id_incapacidad=$idincapacidad AND fecha_corte='$fechacorte' AND tipo=$tipoincapacidad"));
    
    return $saldoincapacidad['saldo'];	
}
function Get_Valor_Incapacidad($idincapacidad,$tipoincapacidad,$fechacorte)
{
     $valorincapacidad = mysqli_fetch_array(consultar("SELECT valor FROM `tb_incapacidades` WHERE id_incapacidad=$idincapacidad AND fecha_corte='$fechacorte' AND tipo=$tipoincapacidad"));
    
    return $valorincapacidad['valor'];	
}
function Set_Estado_Incapacidad($idincapacidad, $estado,$tipoincapacidad,$fechacorte)
{
	$campeonatos = modificar(sprintf("UPDATE `tb_incapacidades` SET `estado`='%d' WHERE id_incapacidad='%d' AND tipo='%d' AND fecha_corte='%s'",
		escape($estado),escape($idincapacidad),escape($tipoincapacidad),escape($fechacorte)));
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
function Get_nombre_eps($identificador)
{
    $valor = mysqli_fetch_array(consultar("SELECT nombre 
      FROM tb_eps WHERE id_eps=$identificador"));
    $valor = $valor['nombre'];
    
    return $valor;
}
function Array_Get_PagosxFiltro($consulta)
{
	$clubs = consultar("SELECT pg.id_pagos, pg.valor, pg.fecha_pago, pg.fecha_creacion, pg.estado, ep.nombre as nombreeps, us.nombre_usuario as nombreusuario FROM tb_pagos pg INNER JOIN tb_eps ep ON ep.id_eps = pg.id_eps INNER JOIN tb_usuarios us ON us.id_usuario = pg.usuario ".$consulta." ORDER BY pg.fecha_creacion DESC");
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
function Array_Get_DatosPago($idpago)
{
	$clubs = consultar("SELECT pg.valor, pg.fecha_pago, pg.id_eps FROM tb_pagos pg WHERE id_pagos = ".$idpago."");
	$datos = array();
	while ($data = mysqli_fetch_array($clubs)) {
		$valor = $data['valor'];
		$eps = $data['id_eps'];
		$fechapago = $data['fecha_pago'];
	
		$vector = array(
			'valor'=>"$valor",
			'eps'=>"$eps",
			'fechapago'=>"$fechapago",
			);
		array_push($datos, $vector);
	}
	return $datos;	
}
function Array_Get_IncapacidadesxPago($idpago)
{
	$clubs = consultar("SELECT incpago.valor, incpago.incapacidad, tp.id_tipos as tipoincapacidad, tp.nombre as nombreincapacidad, incpago.fecha_corte, inc.trabajador, concat(tr.nombre, ' ', tr.apellido) as fullname, inc.cantidad FROM `tr_incapacidadesxpago` incpago INNER JOIN tb_incapacidades inc ON inc.id_incapacidad = incpago.incapacidad INNER JOIN tb_trabajadores tr ON tr.id_trabajadores = inc.trabajador INNER JOIN tb_tipos_incapacidad tp ON tp.id_tipos = incpago.tipoincapacidad WHERE incpago.pago = ".$idpago." 
		AND incpago.fecha_corte = inc.fecha_corte AND inc.tipo = incpago.tipoincapacidad");
	$datos = array();
	while ($data = mysqli_fetch_array($clubs)) {
		$valor = $data['valor'];
		$idincapacidad = $data['incapacidad'];
		$tipoincapacidad = $data['tipoincapacidad'];
		$nombreincapacidad = $data['nombreincapacidad'];
		$cedula = $data['trabajador'];
		$nombre = $data['fullname'];
		$dias = $data['cantidad'];
		$fechacorte = $data['fecha_corte'];
		$vector = array(
			'valor'=>"$valor",
			'idincapacidad'=>"$idincapacidad",
			'tipoincapacidad'=>"$tipoincapacidad",
			'nombreincapacidad'=>"$nombreincapacidad",
			'cedula'=>"$cedula",
			'nombre'=>"$nombre",
			'dias'=>"$dias",
			'fechacorte'=>"$fechacorte",
			);
		array_push($datos, $vector);
	}
	return $datos;	
}
