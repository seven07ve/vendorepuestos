<? 
include("conexion.php");
session_start();
include("funciones.php");
if(!isset($_POST["paso"])) $paso=0; else $paso=$_POST["paso"];

if($paso==2)
{
		//esta todo en venta.php
		if($_POST["usuario_tienda"]==1)
		{
			/*$id_paquete = $_POST["id_paquete"];
			$nombre = $_POST["nombre"];
			$cedula = $_POST["cedula"];
			$telefono1 = $_POST["telefono1"];
			$telefono2 = $_POST["telefono2"];
			$pin = $_POST["pin"];
			$id_estado = $_POST["id_estado"];
			$id_ciudad = $_POST["id_ciudad"];
			$email = $_POST["email"];
			$usuario = $_POST["usuario"];
			$contrasena = $_POST["contrasena"];	
			$certificado = $_POST["certificado"];

			$insert = mysql_query("INSERT INTO usuario (usuario, clave, cedula, nombre, telefono1, telefono2, pin, id_estado, id_ciudad, email, certificado) VALUES ('$usuario', '$contrasena', '$cedula', '$nombre','$telefono1', '$telefono2', '$pin', '$id_estado', '$id_ciudad', '$email', '$certificado')");
			
			$id = mysql_insert_id();
			//insertar paquete
			$monto_paquete = cual_costo_paquete($id_paquete);
			$insert_paq = mysql_query("INSERT INTO paquete_usuario (id_paquete,id_usuario,usuario_tienda,estado, monto) VALUES ('$id_paquete','$id','1','0','$monto_paquete')");
			//email al usuario
			email_registro($email,$id_paquete,'1',$certificado);*/
		}
		elseif($_POST["usuario_tienda"]==2)
		{
			$id_paquete = $_POST["id_paquete"];
			$razon_social = $_POST["razon_social"];
			$rif = $_POST["rif"];
			$telefono1 = $_POST["telefono1"];
			$telefono2 = $_POST["telefono2"];
			$pin = $_POST["pin"];
			$id_estado = $_POST["id_estado"];
			$id_ciudad = $_POST["id_ciudad"];
			$direccion = $_POST["direccion"];
			$latitud = $_POST["latitud"];
			$longitud = $_POST["longitud"];
			$pagina_web = $_POST["pagina_web"];
			$email = $_POST["email"];
			$descripcion = $_POST["descripcion"];
			$horario = $_POST["horario"];
			$tipo_pagina = 1;
			$usuario = $_POST["usuario"];
			$contrasena = $_POST["contrasena"];
			$nombre_oficial = $_POST["nombre_oficial"];
			$color_titulo = $_POST["color_titulo"];
			$color_fondo = $_POST["color_fondo"];
			$color_contenido = $_POST["color_contenido"];
			$datos_pago = implode(",",$_POST["datos_pago"]);
			$datos_envio = implode(",",$_POST["datos_envio"]);
			$datos_banco = implode(",",$_POST["datos_banco"]);
			$persona_mantenimiento = $_POST["persona_mantenimiento"];
			$telefono_mantenimiento = $_POST["telefono_mantenimiento"];
			$email_mantenimiento = $_POST["email_mantenimiento"];
			

			$insert = mysql_query("INSERT INTO tienda_virtual (usuario, clave, rif, nombre_oficial, razon_social, telefono1, telefono2, pin, id_estado, id_ciudad, direccion, latitud, longitud, logo, pagina_web, email, descripcion, horario, datos_pago, datos_envio, datos_banco, color_titulo, color_fondo, color_contenido, persona_mantenimiento, telefono_mantenimiento, email_mantenimiento, activo) VALUES ('$usuario', '$contrasena', '$rif', '$nombre_oficial','$razon_social', '$telefono1', '$telefono2', '$pin','$id_estado', '$id_ciudad', '$direccion', '$latitud', '$longitud', '', '$pagina_web', '$email', '$descripcion', '$horario', '$datos_pago', '$datos_envio', '$datos_banco', '$color_titulo','$color_fondo','$color_contenido', '$persona_mantenimiento','$telefono_mantenimiento','$email_mantenimiento','0')");
	
			//crear carpeta 
			$carpeta = limpiar_cadena($razon_social);
			mkdir($carpeta, 0777);
			//subir imagen
			$id = mysql_insert_id();
			//insertar paquete
			$monto_paquete = cual_costo_paquete($id_paquete);
			$insert_paq = mysql_query("INSERT INTO paquete_usuario (id_paquete,id_usuario,usuario_tienda,estado, monto) VALUES ('$id_paquete','$id','2','0','$monto_paquete')");
			//logo
			if($_FILES["file"]["tmp_name"]!="") copy($_FILES["file"]["tmp_name"], $carpeta."/".$_FILES["file"]["name"]);
			$update = mysql_query("UPDATE tienda_virtual SET logo='".$_FILES["file"]["name"]."' WHERE id='$id'");
			//fotos tienda
			if($_FILES["file2"]["tmp_name"]!="") copy($_FILES["file2"]["tmp_name"], $carpeta."/".$_FILES["file2"]["name"]);
			$update = mysql_query("UPDATE tienda_virtual SET foto1='".$_FILES["file2"]["name"]."' WHERE id='$id'");
			//fotos tienda
			if($_FILES["file3"]["tmp_name"]!="") copy($_FILES["file3"]["tmp_name"], $carpeta."/".$_FILES["file3"]["name"]);
			$update = mysql_query("UPDATE tienda_virtual SET foto2='".$_FILES["file3"]["name"]."' WHERE id='$id'");
			//fotos tienda
			if($_FILES["file4"]["tmp_name"]!="") copy($_FILES["file4"]["tmp_name"], $carpeta."/".$_FILES["file4"]["name"]);
			$update = mysql_query("UPDATE tienda_virtual SET foto3='".$_FILES["file4"]["name"]."' WHERE id='$id'");
			
			email_registro($id, $email,$id_paquete,'2','0');
		}?>
       <script language="javascript">//alert("Su Registro ha sido realizado con exito!!. En breves momentos recibira un email de confirmacion."); window.location="login.php";</script>
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript">
function validar_tienda(formy)
{
	if(formy.id_paquete.value==0)
	{
		alert("Debe seleccionar un Paquete/Tarifa");
		formy.id_paquete.focus();
		return false;
	}
	if(formy.razon_social.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.razon_social.focus();
		return false;
	}
	if(formy.nombre_oficial.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.nombre_oficial.focus();
		return false;
	}
	if(formy.rif.value=="")
	{
		alert("Debe ingresar el RIF");
		formy.rif.focus();
		return false;
	}	
	numero = formy.rif.value;
	if (!/([J|V|G|E][-][?1234567890]*)+$/.test(numero))
	{
		alert("El RIF es invalido");
		formy.rif.focus();
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
	if(formy.id_estado.value==0)
	{
		alert("Debe seleccionar un Estado");
		formy.id_estado.focus();
		return false;
	}
	if(formy.id_ciudad.value==0)
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudad.focus();
		return false;
	}
	if(formy.direccion.value=="")
	{
		alert("Debe ingresar una Direccion");
		formy.direccion.focus();
		return false;
	}
	if(formy.descripcion.value=="" || formy.descripcion.value.lenght>300)
	{
		alert("Debe ingresar una Descripcion no mayor a 300 caracteres");
		formy.descripcion.focus();
		return false;
	}
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		formy.email.focus();
		return false;
	}
	if(formy.usuario.value=="")
	{
		alert("Debe ingresar un Usuario");
		formy.usuario.focus();
		return false;
	}
	if(formy.contrasena.value.length<6 || formy.contrasena.value.length>8)
	{
		alert("Debe ingresar una contraseña entre 6 y 8 caracteres");
		formy.contrasena.focus();
		return false;
	}
	if(formy.confirmacion.value=="" || formy.contrasena.value!=formy.confirmacion.value)
	{
		alert("Debe ingresar la confirmación de la contraseña valida");
		formy.confirmacion.focus();
		return false;
	}
	if(!formy.terminos.checked)
	{
		alert("Debe aceptar los Terminos y Condiciones");
		formy.terminos.focus();
		return false;
	}
	return true;
}
function validar_user(formy)
{
	if(formy.id_paquete.value==0)
	{
		alert("Debe seleccionar un Paquete/Tarifa");
		formy.id_paquete.focus();
		return false;
	}
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
	if(formy.telefono2.value!="")
	{
		numero = formy.telefono2.value;
		if (!/([?1234567890])+$/.test(numero))
		{
			alert("El Telefono2 es invalido");
			formy.telefono2.focus();
			return false;
		}
	}
	if(formy.id_estado.value==0)
	{
		alert("Debe seleccionar un Estado");
		formy.id_estado.focus();
		return false;
	}
	if(formy.id_ciudad.value==0)
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudad.focus();
		return false;
	}
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		formy.email.focus();
		return false;
	}
	if(formy.usuario.value=="")
	{
		alert("Debe ingresar un Usuario");
		formy.usuario.focus();
		return false;
	}
	if(formy.contrasena.value.length<6 || formy.contrasena.value.length>8)
	{
		alert("Debe ingresar una contraseña entre 6 y 8 caracteres");
		formy.contrasena.focus();
		return false;
	}
	if(formy.confirmacion.value=="" || formy.contrasena.value!=formy.confirmacion.value)
	{
		alert("Debe ingresar la confirmación de la contraseña valida");
		formy.confirmacion.focus();
		return false;
	}
	if(!formy.terminos.checked)
	{
		alert("Debe aceptar los Terminos y Condiciones");
		formy.terminos.focus();
		return false;
	}
	return true;
}
function cargar_ciudad(menu,submenu)
{
	new Ajax.Request("/admini/funciones_ajax.php?buscar=10&edo="+menu+"&ciu="+submenu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciu').update(transport.responseText);
	}
	});
}
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=400,left = 212,top = 184');");
}

</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="banner"><script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://vendorepuestos.com.ve/publicidad/adjs.php?n=" + phpAds_random);
   document.write ("&amp;what=zone:4");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=af04504e' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:4&amp;n=af04504e' border='0' alt=''></a></noscript>
</div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_seccion" style="height:30px;">Registro <? if($_POST["usuario_tienda"]==1) echo "/ Cliente Premium"; elseif($_POST["usuario_tienda"]==2) echo " de TIENDAREPUESTOS";?></div></td>
    <td align="right" valign="top"><a href="/iniciar_sesion/" class="red">Ya esta registrado? Iniciar Sesión</a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
    <? 
	if($paso==0)
	{?>
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td class="tituc"> 
          <form name="form_reg" method="post" action="/registroTR/">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>Para publicar tus productos en vendorepuestos.com, debes completar un registro con tus datos.<br />
                <span class="blue"><br />
                </span><span class="red">Deseo Registrarme como: </span><span class="blue"><br /><br />
                <input name="usuario_tienda" type="radio" value="2" checked="checked" />Tiendarepuesto <!--<input name="usuario_tienda" type="radio" value="1" />Cliente Premium</span>--><br />
                <div style="text-align:right">
                  <input type="hidden" name="paso" value="1" />
                  <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" />
                  </div></td>
            </tr>
          </table>
          </form>
          </td>
        </tr>        
    </table>
    <? }
	if($paso==1)
	{?>
    	<? 
		//registro para usuario normal
		if($_POST["usuario_tienda"]==1)
		{?>
    	<form action="/registroTR/" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar_user(this);">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
  <td width="216" class="desc">Paquete:</td>
  <td width="464" class="campo"><select name="id_paquete" class="form">
  <option value="0">Seleccionar</option>
  <?php 
$sql_categoria=mysql_query("SELECT * FROM tarifas WHERE tipo='persona' && habilitar='1' ORDER BY id");
while($categoria=mysql_fetch_array($sql_categoria)){
?>
  <option value="<?=$categoria["id"]?>"><?=$categoria["nombre"]?> - Bs. <?=$categoria["total_bs"]?></option>
  <?php }?>
  </select>
  *</td>
</tr>
        <tr>
  <td >Tipo de Cliente:</td>
  <td ><input name="certificado" type="radio" value="0" checked="checked" />Normal <input type="radio" name="certificado" value="1" />
  Certificado</td>
</tr>
<tr>
  <td width="216" class="desc">Nombre:</td>
  <td width="464" class="campo"><input name="nombre" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Documento de Identidad:</td>
  <td class="campo"><input name="cedula" type="text" class="form" size="50" maxlength="15" />
  (ej. V-0000)*</td>
</tr>
<tr>
  <td class="desc">Tel&eacute;fono1:</td>
  <td class="campo"><input name="telefono1" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Tel&aacute;fono2:</td>
  <td class="campo"><input name="telefono2" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Pin BB:</td>
  <td class="campo"><input name="pin" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Estado:</td>
  <td class="campo"><select class="form" name="id_estado" onChange="cargar_ciudad(this.value,0);">
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
  <td class="campo" id="ciu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select>
    *</td>
</tr>
<script>cargar_submenu('<?=$id_menu[0]?>','0');</script>
<tr>
  <td class="desc">Email:</td>
  <td class="campo"><input name="email" type="text" class="form" size="50" />
    *</td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="gold">Usuario:</td>
  <td bgcolor="#e1e1e1" class="campo"><input name="usuario" type="text" class="form" size="50" />
    *</td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="gold">Contrase&ntilde;a:</td>
  <td bgcolor="#e1e1e1" class="campo"><input name="contrasena" type="password" class="form" size="50" maxlength="8" />
    *</td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="gold">Confirmar Contrase&ntilde;a:</td>
  <td bgcolor="#e1e1e1" class="campo"><input name="confirmacion" type="password" class="form" size="50" maxlength="8" />
    *</td>
</tr>
<tr>
  <td colspan="2"class="tabla_botones"><input type="checkbox" name="terminos" value="1"/> <a href="/terminos_condiciones/">Acepto los T&eacute;rminos y Condiciones</a></td>
</tr>
<tr>
  <td colspan="2" align="right" class="tabla_botones">
  <input type="hidden" name="paso" value="2"/>
  <input type="hidden" name="usuario_tienda" value="1"/>
  <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /></td>
  </tr>
</table> 
     </form>
        	
		<? }
		//registro para tienda de repuestos
		if($_POST["usuario_tienda"]==2)
		{?>
		<form action="/registroTR/" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar_tienda(this);">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr>
  <td width="228" class="desc">Paquete:</td>
  <td colspan="2" class="campo"><select name="id_paquete" class="form">
  <option value="0">Seleccionar</option>
  <?php 
$sql_categoria=mysql_query("SELECT * FROM tarifas WHERE tipo='tienda' && habilitar='1' ORDER BY id");
while($categoria=mysql_fetch_array($sql_categoria)){
?>
  <option value="<?=$categoria["id"]?>"><?=$categoria["nombre"]?> - Bs. <?=$categoria["total_bs"]?></option>
  <?php }?>
  </select>
  *</td>
</tr>
<!--<tr>
  <td class="desc">Presentar Pagina:</td>
  <td class="campo">
    <input name="tipo_pagina" type="radio" value="1" checked="checked" />
  Tipo Listado 
  <input type="radio" name="tipo_pagina" value="2" />
  Tipo Galeria</td>
</tr>-->
<tr>
  <td class="desc">Logo:</td>
  <td colspan="2" class="campo"><input name="file" type="file" class="form" /> Recomendado 210x60 
</td>
</tr>
<tr>
  <td class="desc">Foto Tienda1:</td>
  <td colspan="2" class="campo"><input name="file2" type="file" class="form" /></td>
</tr>
<tr>
  <td class="desc">Foto Tienda2:</td>
  <td colspan="2" class="campo"><input name="file3" type="file" class="form" /></td>
</tr>
<tr>
  <td class="desc">Foto Tienda3:</td>
  <td colspan="2" class="campo"><input name="file4" type="file" class="form" /></td>
</tr>
<tr>
  <td class="desc">Razon Social:</td>
  <td colspan="2" class="campo"><input name="razon_social" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Nombre de la TIENDAREPUESTOS:
</td>
  <td colspan="2" class="campo"><input name="nombre_oficial" type="text" class="form" size="50" maxlength="35" />
  *</td>
</tr>
<tr>
  <td class="desc">Documento de Identidad/RIF:</td>
  <td colspan="2" class="campo"><input name="rif" type="text" class="form" value="J-" size="20" maxlength="12" /> 
    (ej. J-12345678-9)*</td>
</tr>
<tr>
  <td class="desc">Telefono1:</td>
  <td colspan="2" class="campo"><input name="telefono1" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Telefono2:</td>
  <td colspan="2" class="campo"><input name="telefono2" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Pin BB:</td>
  <td colspan="2" class="campo"><input name="pin" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Estado:</td>
  <td colspan="2" class="campo"><select class="form" name="id_estado" onChange="cargar_ciudad(this.value,0);">
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
  <td colspan="2" class="campo" id="ciu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select>
  *</td>
</tr>
<script>cargar_submenu('<?=$id_menu[0]?>','0');</script>
<tr>
  <td class="desc">Direccion:</td>
  <td colspan="2" class="campo"><input name="direccion" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Google Maps:</td>
  <td colspan="2" class="campo">
     <input name="latitud" type="text" class="form" size="50" />
    <!--Longitud:
      <input name="longitud" type="text" class="form" size="10" />-->
    </td>
</tr>
<tr>
  <td class="desc">Pagina Web:</td>
  <td colspan="2" class="campo">http://
    <input name="pagina_web" type="text" class="formt2" size="50" /></td>
</tr>
<tr>
  <td class="desc">Descripcion:</td>
  <td colspan="2" valign="top" class="campo"><textarea name="descripcion" cols="45" rows="5" class="form"></textarea>
    *</td>
</tr>
<tr>
  <td class="desc">Horario de Atenci&oacute;n:</td>
  <td colspan="2" valign="top" class="campo"><textarea name="horario" cols="45" rows="5" class="form"></textarea>
    *</td>
</tr>
<tr>
  <td class="desc">Datos para Pagos:</td>
  <td colspan="2" class="campo">
  <? 
  $ver_datos_pago = mysql_query("SELECT * FROM medio_pago ORDER BY nombre ASC");
  while($vdp = mysql_fetch_array($ver_datos_pago))
  {?>
    <input type="checkbox" name="datos_pago[]" value="<?=$vdp["id"]?>"/> <?=$vdp["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Datos para Envios:</td>
  <td colspan="2" class="campo">
  <? 
  $ver_datos_envio = mysql_query("SELECT * FROM medio_envio ORDER BY nombre ASC");
  while($vde = mysql_fetch_array($ver_datos_envio))
  {?>
    <input type="checkbox" name="datos_envio[]" value="<?=$vde["id"]?>"/> <?=$vde["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Bancos para pagos:</td>
  <td colspan="2" class="campo">
  <? 
  $ver_datos_banco = mysql_query("SELECT * FROM banco ORDER BY nombre ASC");
  while($vdb = mysql_fetch_array($ver_datos_banco))
  {?>
    <input type="checkbox" name="datos_banco[]" value="<?=$vdb["id"]?>"/> <?=$vdb["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Email Tienda:</td>
  <td colspan="2" class="campo"><input name="email" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td class="desc">Color Letra:</td>
  <td width="373" class="campo">#
    <input name="color_titulo" type="text" size="33" maxlength="6"/>
    &nbsp;<a href="javascript:popUp('/color_reference.php?target=titulo')" class="texto11">Seleccionar color</a></td>
  <td width="73" rowspan="3" class="campo"><a href="javascript:;" onMouseOver="javascript:getElementById('img_ejemplo').style.display='block';" onMouseOut="javascript:getElementById('img_ejemplo').style.display='none';">ver ejemplo</a><div id="img_ejemplo" style=" display:none; position:absolute;"><img src="/imagenes/ejemplo_coloresTR.png" width="303" height="246" /></div></td>
</tr>
<tr>
  <td class="desc">Color Fondo Titulos:</td>
  <td class="campo">#
    <input name="color_fondo" type="text" size="33" maxlength="6" value=""/>
  &nbsp;<a href="javascript:popUp('/color_reference.php?target=fondo')" class="texto11">Seleccionar color</a></td>
  </tr>
<tr>
  <td class="desc">Color Fondo Contenido:</td>
  <td class="campo">#
    <input name="color_contenido" type="text" size="33" maxlength="6"/>
    &nbsp;<a href="javascript:popUp('/color_reference.php?target=contenido')" class="texto11">Seleccionar color</a></td>
  </tr>
<tr>
  <td class="desc">Persona que realiza Mantenimiento:</td>
  <td colspan="2" class="campo"><input name="persona_mantenimiento" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Telf. Persona Mantenimiento:</td>
  <td colspan="2" class="campo"><input name="telefono_mantenimiento" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Email Persona Mantenimiento:</td>
  <td colspan="2" class="campo"><input name="email_mantenimiento" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="gold">Usuario:</td>
  <td colspan="2" bgcolor="#e1e1e1" class="campo"><input name="usuario" type="text" class="form" size="50" />
  *</td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="gold">Contrase&ntilde;a:</td>
  <td colspan="2" bgcolor="#e1e1e1" class="campo"><input name="contrasena" type="password" class="form" size="50" maxlength="8" />
  *</td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="gold">Confirmar Contrase&ntilde;a:</td>
  <td colspan="2" bgcolor="#e1e1e1" class="campo"><input name="confirmacion" type="password" class="form" size="50" maxlength="8" />
  *</td>
</tr>
<tr>
  <td colspan="3"class="tabla_botones"><input type="checkbox" name="terminos" value="1"/>
    <a href="/terminos_condiciones/"> Acepto los T&eacute;rminos y Condiciones</a></td>
</tr>
<tr>
  <td colspan="3" align="right" class="tabla_botones">
  <input type="hidden" name="paso" value="2"/>
  <input type="hidden" name="usuario_tienda" value="2"/>
  <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /></td>
  </tr>
</table> 
</form>
		<? }?>
<? }
if($paso==2)
{?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><span class="red">Su información se ha registrado Satisfactoriamente.</span><br /><br />
      <span class="titulo_seccion">Para proceder a la publicación,<br />Realiza el pago correspondiente y envía la información solicitada en el correo.</span><br /><br />
      <a href="/centro_pagos/"><img src="imagenes/TRANSFERENCIA ICONO.jpg" width="150" height="69" border="0" /></a></td>
  </tr>
</table>
<? }?></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
