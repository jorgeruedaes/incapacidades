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

	//

	//$clubs = consultar("SELECT inc.*,  concat(tr.nombre, ' ', tr.apellido) as fullname FROM tb_incapacidades inc INNER JOIN tb_trabajadores tr ON tr.id_trabajadores = inc.trabajador ".$consulta." ORDER BY fecha_corte");
	
	$clubs = consultar("SELECT inc.*, concat(tr.nombre, ' ', tr.apellido) as fullname, ti.nombre as nombreincapacidad, ti.id_tipos as tipoincapacidad FROM tb_incapacidades inc INNER JOIN tb_trabajadores tr ON tr.id_trabajadores = inc.trabajador INNER JOIN tb_tipos_incapacidad ti ON ti.id_tipos = inc.tipo ".$consulta." ORDER BY fecha_corte");
	

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
		$nombreincapacidad = $data['nombreincapacidad'];
		$tipoincapacidad = $data['tipoincapacidad'];
		$saldo = $data['saldo'];
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
			'nombreincapacidad'=>"$nombreincapacidad",
			'tipoincapacidad'=>"$tipoincapacidad",
			'saldo'=>"$saldo",

			);
		array_push($datos, $vector);
	}

	return $datos;	

}


function Guardar_Incapacidad($vector,$usuario)
{
	global $conexion;

	$json = json_decode($vector);

		    for ($i=0; $i < count($json) ; $i++) {

		    	$tipo = $json[$i][4];
		    	

		    	if($tipo == "53")

		    	{
		    		$estado = "4"; //180 dias
		    	}
		    	else if($tipo == "1151" || $tipo == "1161")

		    	{
		    		$estado = "3"; //empresa
		    	}
		   		else{
		   			$estado = "6"; //pendiente
		   		}	 

		   		break;

		    }


	for ($i=0; $i < count($json) ; $i++) {

		$ciudad = $json[$i][2];
		$trabajador = $json[$i][0];
		$cliente = $json[$i][1];
		$fechainicial = $json[$i][6];
		$fechafinal = $json[$i][7];
		$fechacorte = $json[$i][8];
		$cantidad = $json[$i][9];
		$valor = $json[$i][5];
		$eps = $json[$i][3];
		$saldo = $json[$i][5];
		$idincapacidad = $json[$i][10];
		break;
	}

	
		$query = insertar(sprintf("INSERT INTO `tb_incapacidades`(`id_incapacidad`, `ciudad`, `trabajador`, `cliente`, `tipo`, `estado`, `fecha_inicial`, `fecha_final`,`fecha_creacion`, `fecha_corte`, `cantidad`, `valor`,`eps`, `usuario`, `saldo`)
     		VALUES ('%d','%d','%d','%d','%d','%d','%s','%s',NOW(),'%s','%d','%d','%d','%d','%d') ",escape($idincapacidad),escape($ciudad),escape($trabajador),escape($cliente),escape($tipo),escape($estado),escape($fechainicial),escape($fechafinal),escape($fechacorte),escape($cantidad),escape($valor),escape($eps),escape($usuario),escape($saldo)));
	
	
	return $query;
}

function Delete_Incapacidad($idincapacidad,$tipo,$fechacorte)
{
	
	$eliminado  = eliminar("DELETE FROM `tb_incapacidades` WHERE id_incapacidad= $idincapacidad AND tipo=$tipo AND fecha_corte = '$fechacorte'");
	 
	return $eliminado;
}

function Guardar_Incapacidad_Editada($vector,$usuario,$tipoviejo,$fechacortevieja)
{
		$json = json_decode($vector);

		    for ($i=0; $i < count($json) ; $i++) {

		    	$tipo = $json[$i][4];
		    	

		    	if($tipo == "53")

		    	{
		    		$estado = "4"; //180 dias
		    	}
		    	else if($tipo == "1151" || $tipo == "1161")

		    	{
		    		$estado = "3"; //empresa
		    	}
		   		else{
		   			$estado = "6"; //pendiente
		   		}	 

		   		break;

		    }


	for ($i=0; $i < count($json) ; $i++) {

		$ciudad = $json[$i][2];
		$trabajador = $json[$i][0];
		$cliente = $json[$i][1];
		$fechainicial = $json[$i][6];
		$fechafinal = $json[$i][7];
		$fechacorte = $json[$i][8];
		$cantidad = $json[$i][9];
		$valor = $json[$i][5];
		$eps = $json[$i][3];
		$saldo = $json[$i][5];
		$idincapacidad = $json[$i][10];
		break;
	}


	//actualizamos el pago
	$cambios = modificar(sprintf("UPDATE `tb_incapacidades` SET `ciudad`='%d',`trabajador`='%d',`cliente`='%d',`tipo`='%d' ,`estado`='%d',`fecha_inicial`='%s',`fecha_final`='%s',`fecha_corte`='%s',`cantidad`='%d',`valor`='%d',`eps`='%d',`usuario`='%d',`saldo`='%d' WHERE id_incapacidad='%d' AND tipo='%d' AND fecha_corte='%s'",
		escape($ciudad),escape($trabajador),escape($cliente),escape($tipo),escape($estado),escape($fechainicial),escape($fechafinal),escape($fechacorte),escape($cantidad),escape($valor),escape($eps),escape($usuario),escape($valor),escape($idincapacidad),escape($tipoviejo),escape($fechacortevieja)));
	//borramos relacion

	return $cambios;
}

function Array_Get_DatosIncapacidad($idincapacidad,$tipo,$fechacorte)
{
	$clubs = consultar("SELECT * FROM tb_incapacidades WHERE id_incapacidad = ".$idincapacidad." AND tipo = ".$tipo." AND fecha_corte= '".$fechacorte."'");
	$datos = array();
	while ($data = mysqli_fetch_array($clubs)) {
		$idincapacidad = $data['id_incapacidad'];
		$trabajador = $data['trabajador'];
		$cliente = $data['cliente'];
		$ciudad = $data['ciudad'];
		$eps = $data['eps'];
		$tipo = $data['tipo'];
		$valor = $data['valor'];
		$fechainicial = $data['fecha_inicial'];
		$fechafinal = $data['fecha_final'];
		$fechacorte = $data['fecha_corte'];
		$dias = $data['cantidad'];
	
		$vector = array(
			'idincapacidad'=>"$idincapacidad",
			'trabajador'=>"$trabajador",
			'cliente'=>"$cliente",
			'ciudad'=>"$ciudad",
			'eps'=>"$eps",
			'tipo'=>"$tipo",
			'valor'=>"$valor",
			'fechainicial'=>"$fechainicial",
			'fechafinal'=>"$fechafinal",
			'fechacorte'=>"$fechacorte",
			'dias'=>"$dias",
			);
		array_push($datos, $vector);
	}
	return $datos;	
}