<?php 
include("conexion.php");
include("configuraciones.php");
session_start();
include("funciones.php");

if(isset($_POST["paso"])==2)
{
	//datos usuario
	$nombre = $_POST["nombre"];
	$cedula = $_POST["cedula"];
	$telefono1 = $_POST["telefono1"];
	$telefono2 = $_POST["telefono2"];
	$pin = $_POST["pin"];
	$id_estadop = $_POST["id_estadop"];
	$id_ciudadp = $_POST["id_ciudadp"];
	$email = $_POST["email"];
	$horario = $_POST["horario"];
	if($_POST["desea_cliente_premium"]=="si" || $_POST["cliente_premium"]=="si") $certificado = "1"; else $certificado = "0";
	$datos_pago = implode(",",$_POST["datos_pago"]);
	$datos_envio = implode(",",$_POST["datos_envio"]);
	$datos_banco = implode(",",$_POST["datos_banco"]);
		
	//datos producto
	$titulo = str_replace("'",'\"',$_POST["titulo"]);
	$subtitulo = str_replace("'",'\"',$_POST["subtitulo"]);
	$descripcion = $_POST["descripcion"];
	$condicion = $_POST["condicion"];
	$precio = $_POST["precio"];
	$vence = "DATE_ADD(NOW(), INTERVAL -1 DAY)";
	$id_menu = $_POST["id_menu"];
	$id_estado = $_POST["id_estado"];
	$id_ciudad = $_POST["id_ciudad"];
	$id_paquete_usuario = paquete_activo_usuario($_SESSION["userid"],2);

	$insert = mysql_query("INSERT INTO usuario (cedula, nombre, telefono1, telefono2, pin, id_estado, id_ciudad, datos_pago, datos_envio, datos_banco, email, horario, certificado) VALUES ('$cedula', '$nombre','$telefono1', '$telefono2', '$pin', '$id_estadop', '$id_ciudadp','$datos_pago','$datos_envio','$datos_banco', '$email', '$horario', '$certificado')");
		
	$id = mysql_insert_id();
		
	//ver como obtener el monto del paquete
	$id_paquete = cual_id_paquete_persona(round($precio)); 
	$monto_paquete = cual_costo_paquete($id_paquete);
	
	$insert_paq = mysql_query("INSERT INTO paquete_usuario (id_paquete,id_usuario,usuario_tienda,estado, monto) VALUES ('$id_paquete','$id','0','1','$monto_paquete')");
	//insertar producto
	$insert = mysql_query("INSERT INTO productos (titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu2, id_paquete_usuario, usuario_tienda, id_usuario_tienda) VALUES ('$titulo', '$subtitulo', '', '', '', '$descripcion', '$id_estado', '$id_ciudad', '$condicion', '$precio', $vence, '0', '0', '0', '0', '$id_paquete', '1', '$id')");
		
	$idp = mysql_insert_id();
	$params = "?email=$email&paquete=$idp&monto=$monto_paquete";
	
	$carpeta_productos = "productos";
	
	if($_FILES["file"]["tmp_name"]!="") 
	{
		copy($_FILES["file"]["tmp_name"], $carpeta_productos."/".$_FILES["file"]["name"]);
		$update = mysql_query("UPDATE productos SET foto1='$id_$idp_1_".$_FILES["file"]["name"]."' WHERE id='$idp'");
	}
	
	if($_FILES["file2"]["tmp_name"]!="") 
	{
		copy($_FILES["file2"]["tmp_name"], $carpeta_productos."/".$_FILES["file2"]["name"]);
		$update = mysql_query("UPDATE productos SET foto2='$id_$idp_2_".$_FILES["file2"]["name"]."' WHERE id='$idp'");
	}
	
	if($_FILES["file3"]["tmp_name"]!="") 
	{
			copy($_FILES["file3"]["tmp_name"], $carpeta_productos."/".$_FILES["file3"]["name"]);
			$update = mysql_query("UPDATE productos SET foto3='$id_$idp_3_".$_FILES["file3"]["name"]."' WHERE id='$idp'");
	}
	
	//email al cliente
	$to = $email;
	$subject = "El art?culo se ha registrado exitosamente";	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: ${CORREO_ADMIN}\r\n";
	
	$numero_articulo = numero_articulo($idp);
	
	
	$message = "Gracias <b>$nombre</b> por confiar en vendorepuestos.com.ve <br><br>
	El registro se ha realizado satisfactoriamente.<br>
	Para su publicaci�n el proceso toma tres sencillos pasos.<br>
	1.	Realiza el pago a su conveniencia.<br>
	2.	Rep�rtalo en el Centro de Pagos.<br>
	3.	Espera la activaci�n de acuerdo a los T�rminos y Condiciones especificados en la secci�pn de Tarifas.<br><br>
	<b>Datos de la publicaci�n</b><br> 
	El n�mero de su art�culo es: $numero_articulo<br>
	Documento de Identidad: $cedula<br>
	T�tulo: $titulo<br>
	Monto a pagar Bs $monto_paquete<br><br>
	No olvide reportar el monto pagado al Centro de Pagos para su activaci�n, usando el  n�mero de art�culo y n�mero de referencia bancaria usando exclusivamente la siguiente informaci�n.<br><br>
	<b>Informaci�n Bancaria</b><br> 
	Tipo de Cuenta: Corriente <br>
	Titular: Vendorepuestos Venezuela CA<br>   
	RIF: J-31737187-9<br>
	Email: administracion@vendorepuestos.com.ve<br><br> 
	BOD			0116-0183-94-0013599150<br> 
	Banesco 		0134-0030-08-0301026847 <br>
	Banco Provincial	0108-0334-92-0100113038<br>
	Banco de Venezuela 	0102-0859-93-0000009166<br> 
	Banco Mercantil	0105-0672-75-1672068541<br><br> 
	Para informaci�n adicional contacte nuestra secci�n de Preguntas Frecuentes o a nuestro equipo de Soporte En L�nea  v�a Twitter @vendorepuestos<br><br>  
	Si desea realizar modificaciones, usa la secci�n Modificar art�culo. <br><br> 
	Gracias por usar vendorepuestos.com.ve.<br><br>
	Saludos.";
	$send_mail = mail($to, $subject, $message, $headers);
	
	if($_POST["desea_cliente_premium"]=="si")//email al cliente
	{
		
		$subject = "Solicitud de informaci�n CP Certificado";	
		$message = "Gracias <b>$nombre</b> por confiar en vendorepuestos.com.ve <br><br>
		A continuaci�n realizamos el enunciado de las Pol�ticas y Condiciones para convertirse en  Cliente Premium Certificado sin costo adicional.<br><br>
		<b>CLIENTE PREMIUM CERTIFICADO (CPC):</b><br>
		Es el Cliente Premium que completa una serie de requisitos adicionales (Copia de la c�dula, RIF, recibo de servicio p�blico con domicilio o constancia de residencia emitida por un ente autorizado, y Tarjeta de Cr�dito) al del Cliente Premium, generando una distinci�n y calificaci�n por parte de Vendorepuestos Venezuela CA. <br><br>
		Esta informaci�n puede enviarla al siguiente correo administracion@vendorepuestos.com.ve, indicando el n�mero de art�culo y documento de identidad bajo el cual est� siendo registrado.<br><br>
		Mientras usted coteja la informaci�n para adquirir la distinci�n de CPC, el proceso de publicaci�n puede realizarse normalmente, siguiendo las indicaciones correspondientes.<br><br>
		Para informaci�n adicional contacte nuestra secci�n de Preguntas Frecuentes o a nuestro equipo de Soporte En L�nea  v�a Twitter @vendorepuestos<br><br>  
		Gracias por usar vendorepuestos.com.ve.<br><br>
		Saludos.";
		$send_mail = mail($to, $subject, $message, $headers);
	}
	
	//email a VR
	$to2 =  CORREO_ADMIN;
	$subject = "Se ha registrado un art�culo CP";	
	$message = "El usuario $nombre<br> 
		Documento de Identidad: $cedula<br>
		El n�mero de su art�culo es: $numero_articulo<br>
		T�tulo: $titulo
		Monto a pagar Bs $monto_paquete
		�Es un Cliente Premium? ".$_POST["cliente_premium"]."<br>
		�Desea ser un Cliente Premium? ".$_POST["desea_cliente_premium"]."<br>
		Fecha de Registro:".date("d-m-Y");
	$send_mail = mail($to2, $subject, $message, $headers);
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<script type="text/javascript" src="/js/prototype.js"></script>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
function validar_user(formy)
{
	if(formy.nombre.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.nombre.focus();
		return false;
	}
	if(formy.cedula.value=="")
	{
		alert("Debe ingresar el Nro. de Documento de Identidad");
		formy.cedula.focus();
		return false;
	}	
	numero = formy.cedula.value;
	if (!/([J|V|G|E][-][?1234567890]*)+$/.test(numero))
	{
		alert("El Nro. de Documento de Identidad es invalido");
		formy.cedula.focus();
		return false;
	}
	if(formy.telefono1.value=="")
	{
		alert("Debe ingresar un Telefono");
		formy.telefono1.focus();
		return false;
	}
	numero = formy.telefono1.value;
	if (!/([?1234567890])+$/.test(numero))
	{
		alert("El Telefono1 es invalido");
		formy.telefono1.focus();
		return false;
	}
	if(formy.id_estadop.value==0)
	{
		alert("Debe seleccionar un Estado");
		formy.id_estadop.focus();
		return false;
	}
	if(formy.id_ciudadp.value==0)
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudadp.focus();
		return false;
	}
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una direcci�n de e-mail valida");     
		formy.email.focus();
		return false;
	}
	if((formy.confirmacion_email.value.indexOf ('@', 0) == -1) || (formy.confirmacion_email.value.indexOf ('.', 0) == -1) ||(formy.confirmacion_email.value.length < 5))
	{ 
    	alert("Debe escribir una direcci�n de e-mail valida");     
		formy.confirmacion_email.focus();
		return false;
	}
	if(formy.email.value!=formy.confirmacion_email.value)
	{
		alert("Email no coinciden");
		formy.email.focus();
		return false;
	}
	//datos del producto
	if(formy.titulo.value=="")
	{
		alert("Debe ingresar el t�tulo");
		formy.titulo.focus();
		return false;
	}
	if(formy.descripcion.value=="")
	{
		alert("Debe ingresar una Descripci�n");
		formy.descripcion.focus();
		return false;
	}
	if(formy.id_estado.value=="0")
	{
		alert("Debe seleccionar un Estado");
		formy.id_estado.focus();
		return false;
	}
	if(formy.id_ciudad.value=="0")
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudad.focus();
		return false;
	}
	if(formy.precio.value=="")
	{
		alert("Debe Ingresar un Precio");
		formy.precio.focus();
		return false;
	}
	numero = formy.precio.value;
	if (!/([?1234567890][.][1234567890][1234567890])+$/.test(numero))
	{
		alert("El Precio " + numero + " es invalido");
		formy.precio.focus();
		return false;
	}
	//fin datos producto
	if(!formy.terminos.checked)
	{
		alert("Debe aceptar los Terminos y Condiciones");
		formy.terminos.focus();
		return false;
	}
	return true;
}
function cargar_ciudad(edo,ciu)
{
	new Ajax.Request("/admini/funciones_ajax.php?buscar=10&edo="+edo+"&ciu="+ciu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciu').update(transport.responseText);
	}
	});
}
function cargar_ciudadp(edo,ciu)
{
	new Ajax.Request("/admini/funciones_ajax.php?buscar=20&edo="+edo+"&ciu="+ciu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciup').update(transport.responseText);
	}
	});
}
</script>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="112"><a href="/vendeTR/"><img src="/imagenes/login_btn_8_on.jpg" name="edo" width="112" height="20" border="0" id="edo" /></a></td>
        <td width="137"><a href="/modificaTR/"><img src="/imagenes/login_btn_9_off.jpg" name="datos" width="137" height="20" border="0" id="datos" /></a></td>
        <td width="118"><a href="/notificaTR/0"><img src="/imagenes/login_btn_10_off.jpg" name="pub" width="118" height="20" border="0" id="pub" /></a></td>
        </tr>
      <tr>
        <td height="8" colspan="3" background="/imagenes/login_bg_bot.jpg"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">
      <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td height="150">
          <? if(isset($_POST["paso"]))
		  {?>
			  	<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center"><span class="titulo_seccion">Su informaci�n se ha registrado Satisfactoriamente.</span><br /><br />
      <span class="titulo_seccion">Para proceder a la publicaci�n, Realiza el pago correspondiente. Informaci�n enviada a su correo electr�nico.</span><br /><br /><span class="red">Deseo pagar por mi publicaci�n<br />Monto Bs.
<?=$monto_paquete?></span>
</td>
  </tr>
  <tr>
    <td align="center"><!--<a href="javascript:;"><img src="/imagenes/icon_tarjeta.png" alt="Proximamente!" width="35" height="50" border="0" /></a>--></td>
    <td align="center"><a href="/centro_pagos/"><img src="/imagenes/TRANSFERENCIA ICONO.jpg" width="150" height="69" border="0" /></a></td>
    <td align="center"><a href="<?php echo HTTP_PTO_VENTA . "$params" ?>"><img src="/imagenes/TRANSFERENCIA ICONO.jpg" width="150" height="69" border="0" /></a></td>
  </tr>
            </table>
		  <? }
		  else
		  {?>
          <div class="titulo_seccion" align="center" style="height:40px;">Cliente Premium - Deseas una <a href="/preguntas_frecuentes/" class="titulo_seccion">TIENDAREPUESTOS</a>?</div>
          <div class="blue" align="center">Complete los datos en l�nea y comienza a vender tus productos</div>
          <form action="/vendeTR/" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar_user(this);">
        <table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr>
  <td colspan="2" class="blue">Datos del Vendedor</td>
  </tr>
<tr>
  <td width="216" class="desc">Nombre:</td>
  <td width="464" class="campo"><input name="nombre" type="text" class="form" size="50" />
    *</td>
</tr>
<tr>
  <td class="desc">Documento de Identidad:<br />
  (no ser&aacute; publicado)</td>
  <td class="campo"><input name="cedula" type="text" class="form" size="50" maxlength="12" />
  (ej. V-0000)*</td>
</tr>
<tr>
  <td class="desc">Tel&eacute;fono1:</td>
  <td class="campo"><input name="telefono1" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Tel&eacute;fono2:</td>
  <td class="campo"><input name="telefono2" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Pin BB:</td>
  <td class="campo"><input name="pin" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Estado:</td>
  <td class="campo"><select class="form" name="id_estadop" onChange="cargar_ciudadp(this.value,0);">
   <option value="0">Seleccione</option>
    <?php 
	$sql_menu=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?>
    <option value="<?=$menu["id"]?>"><?=$menu["nombre"]?>
    </option>
    <?php 
	}?>
  </select>
    *</td>
</tr>
<tr>
  <td class="desc">Ciudad:</td>
  <td class="campo" id="ciup"><select class="form" name="id_ciudadp">
    <option value="0">Seleccione</option>
  </select>
    *</td>
</tr>
<script>cargar_submenu('<?=$id_menu[0]?>','0');</script>
<tr>
  <td class="desc">Horario de Atencion al P&uacute;blico:</td>
  <td class="campo"><input name="horario" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Email:</td>
  <td class="campo"><input name="email" type="text" class="form" size="50" />
    *</td>
</tr>
<tr>
  <td class="desc">Confirmaci&oacute;n de Email:</td>
  <td class="campo"><input name="confirmacion_email" type="text" class="form" size="50" />
*</td>
</tr>
<tr>
  <td class="desc">Datos para Pagos:</td>
  <td class="campo">
  <? 
  $ver_datos_pago = mysql_query("SELECT * FROM medio_pago ORDER BY nombre ASC");
  while($vdp = mysql_fetch_array($ver_datos_pago))
  {?>
    <input type="checkbox" name="datos_pago[]" value="<?=$vdp["id"]?>" <? if(@in_array($vdp["id"],$datos_pago)){?> checked="checked"<? }?>/> <?=$vdp["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Datos para Envios:</td>
  <td class="campo">
  <? 
  $ver_datos_envio = mysql_query("SELECT * FROM medio_envio ORDER BY nombre ASC");
  while($vde = mysql_fetch_array($ver_datos_envio))
  {?>
    <input type="checkbox" name="datos_envio[]" value="<?=$vde["id"]?>" <? if(@in_array($vde["id"],$datos_envio)){?> checked="checked"<? }?>/> <?=$vde["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Bancos para pagos:</td>
  <td class="campo">
    <? 
  $ver_datos_banco = mysql_query("SELECT * FROM banco ORDER BY nombre ASC");
  while($vdb = mysql_fetch_array($ver_datos_banco))
  {?>
    <input type="checkbox" name="datos_banco[]" value="<?=$vdb["id"]?>" <? if(@in_array($vdb["id"],$datos_banco)){?> checked="checked"<? }?>/> <?=$vdb["nombre"]?><br />
    <? }?></td>
</tr>
</table>
<br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr align="right">
<td colspan="4" align="left" class="blue">Datos del Art&iacute;culo</td>
</tr>
<tr>
  <td width="313" class="desc">T&iacute;tulo:</td>
  <td colspan="3" class="campo"><input name="titulo" type="text" class="form" size="50" maxlength="80" />
  *</td>
</tr>
<tr>
  <td class="desc">Sub T&iacute;tulo:</td>
  <td colspan="3" class="campo"><input name="subtitulo" type="text" class="form" size="50" maxlength="55" /></td>
</tr>
<tr>
  <td class="desc">Descripci&oacute;n:</td>
  <td colspan="3" class="campo"><?php
				include_once "admini/ckeditor/ckeditor.php";
				include_once 'admini/ckfinder/ckfinder.php';
				$CKEditor = new CKEditor();
				$CKEditor->basePath = '/admini/ckeditor/';
				$CKFinder = new CKFinder();
 				$CKFinder->BasePath = '/admini/ckfinder/';
	 			$CKFinder->SetupCKEditorObject($CKEditor);
				$CKEditor->config["width"]=650;
				$CKEditor->config["height"]=300;
				$CKEditor->editor("descripcion", " ");
			?></td>
</tr>
<tr class="tabla">
  <td>Estado de Ubicaci&oacute;n:</td>
  <td colspan="3"><select class="form" name="id_estado" onChange="cargar_ciudad(this.value,0);">
   <option value="0">Seleccione</option>
    <?php 
	$sql_edo=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
	while($edo=mysql_fetch_array($sql_edo))
	{
	?>
    <option value="<?=$edo["id"]?>"><?=$edo["nombre"]?>
    </option>
    <?php 
	}?>
  </select></td>
</tr>
<tr class="tabla">
  <td>Ciudad de Ubicaci&oacute;n:</td>
  <td colspan="3" id="ciu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select></td>
</tr>
<tr class="tabla">
  <td class="desc">Imagen 1:</td>
  <td colspan="3" class="campo"><input name="file" type="file" class="form" /></td>
</tr>
<tr>
  <td height="41" class="desc">Imagen 2:</td>
  <td colspan="3" class="campo"><input name="file2" type="file" class="form" /></td>
</tr>
<tr>
  <td height="41" class="desc">Imagen 3:</td>
  <td colspan="3" class="campo"><input type="file" name="file3" class="form"/></td>
</tr>
<tr>
  <td height="15" colspan="4" class="desc"><strong><em>Nota : Las fotografias
 no son propiedad de
 vendorepuesto.com.ve
  </em></strong></td>
  </tr>
<tr>
  <td height="41" class="desc">Condicion:</td>
  <td colspan="3" class="campo">
      <select name="condicion" class="form">
      <option selected="selected">Nuevo</option>
      <option>Remanufacturado</option>
      <option>Usado</option>
      </select>
    </td>
</tr>
<tr>
  <td height="41" class="desc">Precio:</td>
  <td colspan="3" class="campo"><input name="precio" type="text" class="form" size="10" /> 
  (ej. 00.00)</td>
</tr>
<tr>
  <td height="41" class="desc">Es ud. un Cliente Premium Certificado?:</td>
  <td colspan="3" class="campo"><input type="radio" name="cliente_premium" value="si" />
    Si 
      <input name="cliente_premium" type="radio" value="no" checked="checked" />
      No</td>
</tr>
<tr>
  <td height="41" class="desc">Desea ser un Cliente Premium Certificado?:</td>
  <td width="358" class="campo"><input type="radio" name="desea_cliente_premium" value="si" />
    Si 
    <input name="desea_cliente_premium" type="radio" value="no" checked="checked" /> 
    No</td>
  <td width="50" class="campo"><a href="/preguntas_frecuentes/" target="_blank">Qu&eacute; es?</a></td>
  <td width="25" class="campo"><a href="/preguntas_frecuentes/" target="_blank"><img src="/imagenes/icon_cliente_premium.png" width="24" height="30" border="0" /></a></td>
</tr>
<tr>
  <td colspan="4"class="tabla_botones"><input type="checkbox" name="terminos" value="1"/> Acepto los <a href="/terminos_condiciones/" target="_blank">T&eacute;rminos y Condiciones</a></td>
</tr>
<tr>
  <td colspan="4" align="right" class="tabla_botones">
  <input type="hidden" name="paso" value="2"/>
  <input type="hidden" name="usuario_tienda" value="1"/>
  <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /></td>
  </tr> 
</table> 
     </form> 
          <? }?> </td></tr></table>
</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
