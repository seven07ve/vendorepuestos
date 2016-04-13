<?php
function preguntas(){
	//esta funcion es ppara todas las pagina menos la de listas de preguntas
	//la de listas de preguntas es la que sigue
	$id = $_SESSION["userid"];
	$nombretr = cual_nombre_oficial($_SESSION["userid"]);
	$busqueda = mysql_query("SELECT * FROM productos, preguntas WHERE productos.id_usuario_tienda = $id AND preguntas.id_producto=productos.id AND preguntas.status=0");
	$total = mysql_num_rows($busqueda);
	if ($total == 0){
		$seccion= '<tr>
        <td colspan="7" class="blue" style="text-align:right; height:30px;"><a href="/respuestas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Respuestas</a></td>
      </tr>';
	}
	elseif ($total == 1){
		$seccion= '<tr>
        <td colspan="7" class="blue" style="text-align:right; height:30px;"><a href="../../preguntas/'.$nombretr.'/0/" style="text-decoration:none;">Tienes una Pregunta</a> | <a href="/respuestas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Respuestas</a></td>
      </tr>';
	}
	elseif ($total > 1){
		$seccion= '<tr>
        <td colspan="7" class="blue" style="text-align:right; height:30px;"><a href="../../preguntas/'.$nombretr.'/0/" style="text-decoration:none;">Tienes '.$total.' Preguntas</a> | <a href="/respuestas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Respuestas</a></td>
      </tr>';
	}
	//$result=mysql_fetch_array(mysql_query("SELECT * FROM menu WHERE id=$id"));
	return $seccion;
}
/*
esta es solo para cuando ya se esta en la lista de preguntas
para que no repita preguntas/preguntas
*/
function preguntasLista(){
	$id = $_SESSION["userid"];
	$nombretr = cual_nombre_oficial($_SESSION["userid"]);
	$busqueda = mysql_query("SELECT * FROM productos, preguntas WHERE productos.id_usuario_tienda = $id AND preguntas.id_producto=productos.id AND preguntas.status=0");
	$total = mysql_num_rows($busqueda);
	if ($total == 0){
		$seccion= '<tr>
        <td colspan="3" class="blue" style="text-align:right; height:30px;"> <a href="/respuestas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Respuestas</a></td>
      </tr>';
	}
	elseif ($total == 1){
		$seccion= '<tr>
        <td colspan="3" class="blue" style="text-align:right; height:30px;"><a href="/preguntas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Tienes una Pregunta</a> | <a href="/respuestas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Respuestas</a></td>
      </tr>';
	}
	elseif ($total > 1){
		$seccion= '<tr>
		<td colspan="3" class="blue" style="text-align:right; height:30px;"><a href="/preguntas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Tienes '.$total.' Preguntas</a> | <a href="/respuestas/'.limpiar_cadena($nombretr).'/0/" style="text-decoration:none;">Respuestas</a></td>
      </tr>';
	}
	//$result=mysql_fetch_array(mysql_query("SELECT * FROM menu WHERE id=$id"));
	return $seccion;
}
function generate_salt($cant){
	if(!$cant || is_null($cant)) $cant = 10;
	
	$numbers = array("0","1","2","3","4","5","6","7","8","9");
	$lcchars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
	$ucchars = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	//$symbols = array('!','@','#','$','%','^','&','*','(',')','-','~','+','=','|','/','{','}',':',';',',','.','?','<','>','[');
	for($i=0; $i <= $cant; $i++) {
		$rand = rand(1, 100);
		if($rand <= 25) { 
			$fake_salt .= $numbers[array_rand($numbers)];
		} elseif($rand <= 50) {
			$fake_salt .= $lcchars[array_rand($lcchars)];
		} else {
			$fake_salt .= $ucchars[array_rand($ucchars)];
		}
	}
	
	$salt = str_shuffle($fake_salt);
	return $salt;
}

function cual_menu($id)
{
	if($id==0)
		return "No aplica";
	$result=mysql_fetch_array(mysql_query("SELECT * FROM menu WHERE id=$id"));
	return $result["nombre"];
}
function cual_submenu($id)
{
	if($id==0)
		return "No aplica";
	$result=mysql_fetch_array(mysql_query("SELECT * FROM submenu WHERE id=$id"));
	return $result["nombre"];
}
function cual_submenu2($id)
{
	if($id==0)
		return "No aplica";
	if($id==-1)
		return "Todas las opciones";	
	$result=mysql_fetch_array(mysql_query("SELECT * FROM submenu2 WHERE id=$id"));
	return $result["nombre"];
}
function cual_paquete($id)
{
	$paq=mysql_fetch_array(mysql_query("SELECT nombre FROM tarifas WHERE id='$id'"));
	return $paq["nombre"];
}
function cual_costo_paquete($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT total_bs FROM tarifas WHERE id=$id"));
	return $result["total_bs"];
}
function cual_id_paquete_persona($precio)
{
	$result=mysql_fetch_array(mysql_query("SELECT id FROM tarifas WHERE tipo='persona' && condicion_desde<=$precio && condicion_hasta>=$precio"));
	return $result["id"];
}
function productos_paquete($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT cantidad_productos FROM tarifas WHERE id=$id"));
	return $result["cantidad_productos"];
}
function productos_finalizados($idt)
{
	$result=mysql_fetch_array(mysql_query("SELECT COUNT(id) AS pf FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$idt' && vence<NOW()"));
	return $result["pf"];
}
function productos_activos($idt)
{
	$result=mysql_fetch_array(mysql_query("SELECT COUNT(id) AS pf FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$idt' && vence>=NOW()"));
	return $result["pf"];
}
function cual_estado($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM estado WHERE id=$id"));
	return $result["nombre"];
}
function cual_ciudad($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM ciudad WHERE id=$id"));
	return $result["nombre"];
}
function cual_portada($portada)
{
	if($portada==1)
		return "Sí";
	else
		return "No";
}
function cual_bolsa($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM bolsa_trabajo WHERE id=$id"));
	return $result["titulo"];
}
function cual_id_categoria($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT id_categoria FROM menu WHERE id='$id'"));
	return $result["id_categoria"];
}
function cual_categoria($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT nombre FROM categoria WHERE id='$id'"));
	return $result["nombre"];
}
function cual_tipo($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM tipo WHERE id=$id"));
	return $result["nombre"];
}

function limpiar_cadena($cadena) {
	$cadena = trim($cadena);
	$cadena = strtr($cadena,
	"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ.",
	"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn_");
	$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
	$cadena = preg_replace('#([^.a-z0-9]+)#i', '_', $cadena);
	$cadena = preg_replace('#-{2,}#','_',$cadena);
	$cadena = preg_replace('#-$#','',$cadena);
	$cadena = preg_replace('#^-#','',$cadena);
	return $cadena;
}
function cual_nombre_carpeta($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT razon_social FROM tienda_virtual WHERE id='$id'"));
	return limpiar_cadena($result["razon_social"]);
}
function cual_id_tr($razon_social)
{
	$result=mysql_fetch_array(mysql_query("SELECT id FROM tienda_virtual WHERE razon_social LIKE '%$razon_social%'"));
	return $result["id"];
}
function es_administrador($valor)
{
	if($valor==1)
		return "Si";
	else
		return "No";	
}
function cual_admin($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM admin WHERE id=$id"));
	return $result["nombre"];
}
function cual_modulo($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM modulo WHERE id=$id"));
	return $result["descripcion"];
}
function cual_accion($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM accion WHERE id=$id"));
	return $result["descripcion"];
}
function cual_tipo_usuario($id)
{
	$result=mysql_fetch_array(mysql_query("SELECT * FROM tipo_usuario WHERE id=$id"));
	return $result["descripcion"];
}
function cuantos_productos_categoria($idc,$idm,$idsm,$idssm)
{
	$cuantos = 0;
	if($idsm==0) 
		$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && (id_categoria='$idc' && id_menu='$idm')"));
	elseif($idssm==0)
		$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && (id_categoria='$idc' && id_menu='$idm' && id_submenu='$idsm')"));
	else
		$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && (id_categoria='$idc' && id_menu='$idm' && id_submenu='$idsm' && id_submenu2='$idssm')"));
	return $cuantos;
}
function autenticar($login,$password,$usuario_tienda)
{
		$id_user = 0;
		if($usuario_tienda == 1)
			$buscar_usuario = mysql_query("SELECT id FROM usuario WHERE usuario='$login' && clave='$password' && activo='1'");
		if($usuario_tienda == 2)
			$buscar_usuario = mysql_query("SELECT id FROM tienda_virtual WHERE usuario='$login' && clave='$password' && activo='1'");
			
		while($bu = mysql_fetch_array($buscar_usuario))
		{
			$id_user = $bu["id"];
		}
		return $id_user;
}
function cual_usuario($id,$usuario_tienda)
{
		$valor="";
		if($usuario_tienda == 1) 
		{
			$ver_n = mysql_query("SELECT nombre FROM usuario WHERE id='$id'");
			$vc = mysql_fetch_array($ver_n);
			$valor = $vc['nombre'];
		}
		elseif($usuario_tienda == 2)
		{
			$ver_n = mysql_query("SELECT nombre_oficial, persona_mantenimiento FROM tienda_virtual WHERE id='$id'");
			$vc = mysql_fetch_array($ver_n);
			$valor = strtoupper($vc['nombre_oficial'])." | (".$vc['persona_mantenimiento'].")";
		}
		return $valor;		
}
function cual_usuario_resultado($id,$usuario_tienda)
{
		$valor="";
		if($usuario_tienda == 1) 
		{
			$ver_n = mysql_query("SELECT nombre FROM usuario WHERE id='$id'");
			$vc = mysql_fetch_array($ver_n);
			$valor = $vc['nombre'];
		}
		elseif($usuario_tienda == 2)
		{
			$ver_n = mysql_query("SELECT nombre_oficial, persona_mantenimiento FROM tienda_virtual WHERE id='$id'");
			$vc = mysql_fetch_array($ver_n);
			$valor = strtoupper($vc['nombre_oficial']);
		}
		return $valor;		
}
function cual_nombre_oficial($id)
{
	$ver_n = mysql_query("SELECT nombre_oficial FROM tienda_virtual WHERE id='$id'");
	$vc = mysql_fetch_array($ver_n);
	$valor = $vc['nombre_oficial'];
	return $valor;
}
function datos_tienda($id,$campo)
{
	$dato="";
	$ver_n = mysql_query("SELECT $campo FROM tienda_virtual WHERE id='$id'");
	$vc = mysql_fetch_array($ver_n);
	$dato = $vc["$campo"];
	return $dato;
}
function cual_email_usuario($id,$usuario_tienda)
{
		$valor="";
		if($usuario_tienda == 1) 
		{
			$ver_n = mysql_query("SELECT email FROM usuario WHERE id='$id'");
			$vc = mysql_fetch_array($ver_n);
			$valor = $vc['email'];
		}
		elseif($usuario_tienda == 2)
		{
			$ver_n = mysql_query("SELECT email FROM tienda_virtual WHERE id='$id'");
			$vc = mysql_fetch_array($ver_n);
			$valor = $vc['email'];
		}
		return $valor;		
}
function cuantos_productos_categoria_tienda($idc,$idm,$idsm,$idssm,$idt)
{
	$cuantos = 0;
	if($idsm==0) 
		$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && id_categoria='$idc' && id_menu='$idm' && usuario_tienda='2' && id_usuario_tienda='$idt'"));
	elseif($idssm==0)
		$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && id_categoria='$idc' && id_menu='$idm' && id_submenu='$idsm' && usuario_tienda='2' && id_usuario_tienda='$idt'"));
	else
		$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && id_categoria='$idc' && id_menu='$idm' && id_submenu='$idsm' && id_submenu1='$idssm' && usuario_tienda='2' && id_usuario_tienda='$idt'"));
	return $cuantos;
}
function cuantos_productos_estado_tienda($ide,$idt)
{
	$cuantos = 0;
	$cuantos = mysql_num_rows(mysql_query("SELECT id FROM productos WHERE vence>= NOW() && id_estado='$ide' && usuario_tienda='2' && id_usuario_tienda='$idt'"));
	return $cuantos;
}
function categorias_activas_tienda($idt,$nom)
{
	$lcat = "";
	$link_categoria = mysql_query("SELECT productos.id_menu, productos.id_categoria, menu.nombre FROM productos INNER JOIN menu ON menu.id=productos.id_menu WHERE productos.vence>= NOW() && productos.id_menu!=0 && usuario_tienda = '2' && id_usuario_tienda = '$idt' GROUP BY id_menu");
	while($lc = mysql_fetch_array($link_categoria))
	{
			$lcat.= "<a href=\"/tr_categoria/$nom/".$idt."/".$lc["id_menu"]."/0/0/1"."\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".cuantos_productos_categoria_tienda($lc["id_categoria"],$lc["id_menu"],0,0,$idt).")<br>";
	}
	return $lcat;
}
function ubicacion_activas_tienda($idt,$nom)
{
	$lcat = "";
	$link_categoria = mysql_query("SELECT productos.id_estado, estado.nombre FROM productos INNER JOIN estado ON estado.id=productos.id_estado WHERE productos.vence>= NOW() && productos.id_estado!=0 && usuario_tienda = '2' && id_usuario_tienda = '$idt'  GROUP BY id_estado");
	while($lc = mysql_fetch_array($link_categoria))
	{
			$lcat.= "<a href=\"/tr_ubicacion/$nom/".$idt."/".$lc["id_estado"]."/0/0/1"."\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".cuantos_productos_estado_tienda($lc["id_estado"],$idt).")<br>";
	}
	return $lcat;
}
function ubicacion_activas_nivel3($idc,$idm,$idsm)
{
	$lcat = "";
	if($idsm!=0) $link_categoria = mysql_query("SELECT productos.id_estado, estado.nombre, COUNT(estado.id) AS cuantos FROM productos INNER JOIN estado ON estado.id=productos.id_estado WHERE id_categoria='$idc' && id_menu='$idm' && id_submenu='$idsm' && vence>= NOW()  GROUP BY id_estado");
	else 
	$link_categoria = mysql_query("SELECT productos.id_estado, estado.nombre, COUNT(estado.id) AS cuantos FROM productos INNER JOIN estado ON estado.id=productos.id_estado WHERE id_categoria='$idc' && id_menu='$idm' && vence>= NOW()  GROUP BY id_estado");
	while($lc = mysql_fetch_array($link_categoria))
	{
			$lcat.= "<div class=\"cat\"><a href=\"/vista_nivel3/".limpiar_cadena($lc["nombre"])."/".$idc."/".$idm."/".$idsm."/".$lc["id_estado"]."/1"."\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".$lc["cuantos"].")</div>";
	}
	return $lcat;
}
function ubicacion_activas_busqueda($yy,$palabra,$categoria_buscar)
{
	$lcat = "";
	$trozos=explode(" ",$palabra);
  	$numero=count($trozos);
	if($categoria_buscar==0) 
	{
  		if ($numero==1)
		{
			$link_categoria = mysql_query("SELECT productos.*, COUNT(estado.id) AS cuantos , estado.nombre FROM productos INNER JOIN estado ON estado.id = productos.id_estado WHERE productos.id_estado !=0 && productos.vence>=NOW() && (productos.descripcion LIKE '%$palabra%' OR productos.titulo LIKE '%$palabra%' OR productos.subtitulo LIKE '%$palabra%') OR productos.id='$palabra' GROUP BY id_estado");
			while($lc = mysql_fetch_array($link_categoria))
			{
			$lcat.= "<div class=\"cat\"><a href=\"/buscar/0/".$yy."/".$lc["id_estado"]."/1\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".$lc["cuantos"].")</div>";
			}
		}
		else
		{
			$link_categoria = mysql_query("SELECT productos.* , COUNT(estado.id) AS cuantos, estado.nombre FROM productos INNER JOIN estado ON estado.id = productos.id_estado WHERE productos.id_estado !=0  && productos.vence>=NOW() && MATCH (productos.titulo, productos.subtitulo, productos.descripcion) AGAINST ('$palabra') GROUP BY productos.id_estado");
			while($lc = mysql_fetch_array($link_categoria))
			{
				$lcat.= "<div class=\"cat\"><a href=\"/buscar/0/".$yy."/".$lc["id_estado"]."/1\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".$lc["cuantos"].")</div>";
			}
		}
	}
	else
	{
		if ($numero==1)
		{
			$link_categoria = mysql_query("SELECT p. *, c.*, COUNT(estado.id) AS cuantos, estado.nombre  FROM categoria c, productos p INNER JOIN estado ON estado.id = p.id_estado WHERE p.id_categoria='$categoria_buscar' && p.vence>= NOW() && (c.nombre LIKE '%$palabra%' OR p.descripcion LIKE '%$palabra%' OR p.titulo LIKE '%$palabra%' OR p.subtitulo LIKE '%$palabra%' OR p.id='%$palabra%') ORDER BY vence ASC");
			while($lc = mysql_fetch_array($link_categoria))
			{
				$lcat.= "<a href=\"resultado.php?palabra=".$palabra."&ide=".$lc["id_estado"]."\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".$lc["cuantos"].")<br>";
			}
		}
		else
		{
			$link_categoria = mysql_query($_pagi_sql="SELECT p. *, COUNT(estado.id) AS cuantos, MATCH(p.titulo,p.subtitulo,p.descripcion) AGAINST ('$palabra') AS puntuacion FROM productos p INNER JOIN estado ON estado.id = p.id_estado WHERE p.id_categoria='$categoria_buscar' && p.vence>= NOW() && (MATCH(p.titulo,p.subtitulo,p.descripcion) AGAINST ('$palabra'))  ORDER BY puntuacion DESC, vence ASC");
			while($lc = mysql_fetch_array($link_categoria))
			{
				$lcat.= "<a href=\"resultado.php?palabra=".$palabra."&ide=".$lc["id_estado"]."\" class=\"bluep\">".ucfirst(strtolower($lc["nombre"]))."</a> (".$lc["cuantos"].")<br>";
			}
		}
	}
	return $lcat;
}
function email_registro($id,$email,$id_paquete,$usuario_tienda,$certificado)
{
	$subject = "Confirmacion de Cuenta de Usuario [www.vendorepuestos.com.ve]";	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: atencion_cliente@vendorepuestos.com.ve\r\n";	
	
	$msj_general = "Gracias por usar <a href=\"http://www.vendorepuestos.com.ve/\">www.vendorepuestos.com.ve</a> como herramienta de Venta.<br><br>";
	
	if($usuario_tienda==2)//si es tr
	{
		$msj_general.= "Su registro fue realizado con éxito,<br>Los Datos de su registro son los siguientes:<br><b>Nombre de la TIENDAREPUESTOS: ".datos_tienda($id,"razon_social")."</b><br><b>Clave: ".datos_tienda($id,"clave")."</b><br>Número de Cédula / R.I.F. : </b>".datos_tienda($id,"rif")."<br><b>Telefóno Principal: </b>".datos_tienda($id,"telefono1")."<br><b>Telefóno Secundario:</b>".datos_tienda($id,"telefono2")."<br>";
	}
	$msj_general.= "Para formalizar la inscripción y proceder a realizar publicaciones a agradecemos completar los siguientes recaudos, de acuerdo a las Términos y Condiciones<br><br>El Paquete/Tarifa seleccionado es: ".cual_paquete($id_paquete). " cuyo monto es de Bs.".cual_costo_paquete($id_paquete);
	$msj_general.="<br><br>Si usted ya realizó el pago, ignore la Información Bancaria que presentamos a continuación:<br><br>";
	$msj_general.="BOD 0116-0183-94-0013599150<br><br>";
	$msj_general.="Banesco 0134-0030-08-0301026847<br><br>";
	$msj_general.="Banco Provincial 0108-0334-92-0100113038<br><br>";
	$msj_general.="Banco de Venezuela 0102-0859-93-0000009166<br><br>";
	$msj_general.="Banco Mercantil 0105-0672-75-1672068541<br><br>";
	
	$msj_general.="Una vez realizado el pago, por favor enviar la siguiente información:<br><br>";
	$msj_general.="Numero de Depósito, entidad Bancaria, Fecha en que se realizó el depósito, Usuario, Nombre del depositante<br><br>";
	
	//si es lciente Premium
	if($usuario_tienda==1)
	{
		//con certficado certificado
		if($certificado==1)
		{
			$msj_general.= "Ademas como <b>Cliente Premium Certificado</b> debe enviar escaneados los siguientes documentos:<br><br>- Copia legible de la Cedula de identidad o RIF.<br><br>- Copia de Recibo de Servicio Publico con domicilio o constancia de residencia emitida por un ente autorizado.<br><br>- Copia por ambos lados de la Tarjeta de Credito";
		}
	}
	else //tienda de repuestos
	{
			$msj_general.= "Al mismo tiempo le informamos que debe enviar copia los siguientes documentos que componen los Requisitos Técnicos:<br>- Copia legible de la Cedula de identidad o RIF.<br>- Copia de Documento constitutivo en caso de ser persona jurídica.<br>- Copia de Recibo de Servicio Publico con domicilio o constancia de residencia emitida por un ente autorizado.<br>- Copia por ambos lados de la Tarjeta de Crédito.<br><br>Si posee alguna duda, no dude en contactarnos.<br><br>@vendorepuestos";  
	}
	
	$msj_general.= "Atte: vendorepuestos.com\n\n ";
	$send_mail = mail($email, $subject, $msj_general, $headers);
}
function email_nuevo_paquete($email,$id_paquete,$id_user,$tipo)
{
	$subject = "Solicitud Activacion Paquete [www.vendorepuestos.com.ve]";	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: atencion_cliente@vendorepuestos.com.ve\r\n";	
	
	$msj_general = "Ha solicitado la Activacion de un nuevo Paquete en <a href=\"http://www.vendorepuestos.com.ve/\">www.vendorepuestos.com.ve</a>. Para proceder a la activación agradecemos completar el pago segun el paquete seleccionado.<br><br>El Paquete/Tarifa seleccionado es: ".cual_paquete($id_paquete). " por Bs.".cual_costo_paquete($id_paquete);
	$msj_general.="<br><br>Para realizar su pago las Cuentas Autorizadas son:<br><br>";
	$msj_general.="Banco Provincial 0000000000<br><br>";
	$msj_general.="Banco Mercantil 0000000000<br><br>";
	$msj_general.="Banesco 0000000000<br><br>";
	$msj_general.="Banco de Venezuela 0000000000<br><br>";
	$msj_general.="BOD 0000000000<br><br>";
	$msj_general.="Una vez realizado el pao, por favor enviar la siguiente información:<br><br>";
	$msj_general.="Numero de Depósito, entidad Bancaria, Fecha en que se realizó el depósito, Usuario, Nombre del depositante<br><br>";
	$msj_general.= "Atte: vendorepuestos.com\n\n ";
	$send_mail = mail($email, $subject, $msj_general, $headers);
	//email a vendorepuestos
	$msj_general = "El Usuario ".$tipo.", registrado bajo el <b>Nro. $id_user</b> ha solicitado la activacion de un nuevo paquete. Para mayor detalle ingrese al Administrador, seccion Activacion Paquetes.<br><br>El Paquete/Tarifa seleccionado es: ".cual_paquete($id_paquete). " por Bs.".cual_costo_paquete($id_paquete);
	$send_mail = mail("atencion_cliente@vendorepuestos.com.ve", $subject, $msj_general, $headers);
}
function numero_articulo($nro)
{
	$insertar_ceros="";
	$ceros = 9;
	$dif_diez = $ceros - strlen($nro);
	for($m = 0 ;$m < $dif_diez;$m++)
	{
		$insertar_ceros.=0;
	}
	return $insertar_ceros.= $nro;
}
function paquete_activo_usuario($id_user,$ut)
{
	$pactivo = 0;
	$ver_pu = mysql_fetch_array(mysql_query("SELECT id FROM paquete_usuario WHERE id_usuario='$id_user' && usuario_tienda='$ut' && estado='1'"));
	$pactivo = $ver_pu["id"];
	return $pactivo;
}
function productos_paquete_activo($idpa)
{
	$cuantos = 0;
	$ver_pa = mysql_fetch_array(mysql_query("SELECT COUNT(id) as cuantos FROM productos WHERE id_paquete_usuario='$idpa'"));
	$cuantos = $ver_pa["cuantos"];
	return $cuantos;
}
function id_paquete_activo($idpa)
{
	$idp = 0;
	$ver_pu = mysql_fetch_array(mysql_query("SELECT id_paquete FROM paquete_usuario WHERE id='$idpa'"));
	$idp = $ver_pu["id_paquete"];
	return $idp;
}
function cuantos_articulos($tienda)
{
	$cuantos=0;
	$tmas = mysql_query("SELECT count(id) AS cant FROM productos WHERE usuario_tienda = '2' && vence>NOW() && id_usuario_tienda = '$tienda'");
	$cu = mysql_fetch_array($tmas);
	return $cu["cant"];
}
function salutacion()
{
	$tmas = mysql_query("SELECT texto FROM salutacion ORDER BY id LIMIT 0,1");
	$cu = mysql_fetch_array($tmas);
	return $cu["texto"];
}
?>