<? 
include("conexion.php");
include("configuraciones.php"); 
session_start();
include("funciones.php");
if(!isset($_POST["paso"])) $paso=1; else $paso=$_POST["paso"];

if($paso==2)
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
		
//		$params = "?email=$email&tienda=$id&monto=$monto_paquete";
                $params = "?email=$email&eid=$id&act=new&amount=$monto_paquete&type=store";
		
		//email al cliente
		$to = $email;
		$subject = "Su registro se ha realizado con �xito";	
		
		//EMAIL A TR
		$to2 = "administracion@vendorepuestos.com.ve";
		$subject2 = "Registro de TR exitoso";
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "From: administracion@vendorepuestos.com.ve\r\n";
		
		$message= "El registro de su TIENDAREPUESTOS se ha realizado satisfactoriamente.<br><br>
		<b>Datos de la publicaci�n</b> 
		Nombre de la TIENDAREPUESTOS: $nombre_oficial<br>
		Documento de Identidad: $rif<br>
		Correo: $email<br>
		Persona que realiza Mantenimiento: $persona_mantenimiento<br>
		Tel�fono: $telefono1<br>
		N�mero de orden: $id<br>
		Paquete seleccionado:".cual_paquete($id_paquete)."<br>
		Monto a pagar: $monto_paquete<br>";
		
		$send_mail = mail($to2, $subject2, $message, $headers);
		
		$message="Gracias <b>$nombre_oficial</b> por confiar en vendorepuestos.com.ve<br><br> 
		El registro de su TIENDAREPUESTOS se ha realizado satisfactoriamente.<br><br>
		Para su publicaci�n el proceso toma cuatro sencillos pasos.<br>
		1. Realiza el pago a su conveniencia. (Solvencia)<br>
		2. Rep�rtalo en el Centro de Pagos.<br> 
		3. Espera la activaci�n de acuerdo a los T�rminos y Condiciones.<br>
		4. Completar los requisitos y enviarlos al correo administraci�n@vendorepuestos.com.ve<br>
		�	Copia de Registro de Comercio. (T�tulos I, T�tulos II y T�tulos III)<br>
		�	Copia de RIF. <br>
		�	Copia de servicio p�blico con domicilio Fiscal o un equivalente.<br>
		�	Copia de Tarjeta de Cr�dito<br><br>
		<b>Datos del registro:</b><br>
		Nombre de la TIENDAREPUESTOS: $nombre_oficial<br>
		Documento de Identidad: $rif<br>
		Correo: $email<br>
		Persona que realiza Mantenimiento: $persona_mantenimiento<br>
		Tel�fono: $telefono1<br>
		N�mero de orden: $id<br>
		Paquete seleccionado:".cual_paquete($id_paquete)."<br>
		Monto a pagar: $monto_paquete<br><br>
		<b>Informaci�n Bancaria</b><br>
		Tipo de Cuenta: Corriente<br> 
		Titular: Vendorepuestos Venezuela CA <br>  
		RIF: J-31737187-9<br>
		Email: administracion@vendorepuestos.com.ve <br><br>
		BOD			0116-0183-94-0013599150<br> 
		Banesco 		0134-0030-08-0301026847 <br>
		Banco Provincial	0108-0334-92-0100113038<br>
		Banco de Venezuela 	0102-0859-93-0000009166 <br>
		Banco Mercantil	0105-0672-75-1672068541<br><br> 
		No olvide reportar el monto pagado al Centro de Pagos para su activaci�n, usando el  n�mero de art�culo y n�mero de referencia bancaria usando exclusivamente la siguiente informaci�n.<br><br>
		Para informaci�n adicional contacte nuestra secci�n de Preguntas Frecuentes o a nuestro equipo de Soporte En L�nea  v�a Twitter @vendorepuestos<br><br>  
		Gracias por usar vendorepuestos.com.ve.";
		
		$send_mail = mail($to, $subject, $message, $headers);
}
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
    	alert("Debe escribir una direcci�n de e-mail valida");     
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
		alert("Debe ingresar una contrase�a entre 6 y 8 caracteres");
		formy.contrasena.focus();
		return false;
	}
	if(formy.confirmacion.value=="" || formy.contrasena.value!=formy.confirmacion.value)
	{
		alert("Debe ingresar la confirmaci�n de la contrase�a valida");
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

function openPOSWindow(url){
    window.open(url,'Punto de pago','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=1000,height=700');
    window.location = "https://pagos.vendorepuestos.com.ve/comprando"
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
    <div class="titulo_seccion" style="height:30px;">Registro <? echo " de TIENDAREPUESTOS";?></div></td>
    <td align="right" valign="top"><a href="/iniciar_sesion/" class="red">Ya esta registrado? Iniciar Sesi�n</a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	<?php
	if($paso==1)
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
  <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /></td>
  </tr>
</table> 
</form>
<?php } ?>
<?php if($paso==2) : ?>
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="3" align="center"><span class="titulo_seccion">Su informaci&oacute;n se ha registrado Satisfactoriamente.</span><br /><br />
            <span class="titulo_seccion">Para proceder a la publicaci&oacute;n, realiza el pago correspondiente. La informaci&oacute;n ha sido enviada a su correo electr&oacute;nico.</span><br /><br /><span class="red">Deseo pagar por mi publicaci�n<br />Monto Bs.
            <?=$monto_paquete?></span>
            </td>
        </tr>
        <tr>
        <td align="center"><!--<a href="javascript:;"><img src="/imagenes/icon_tarjeta.png" alt="Proximamente!" width="35" height="50" border="0" /></a>--></td>
        <td align="center"><a href="/centro_pagos/"><img src="/imagenes/boton_transferencia.png" width="220px" border="0" /></a></td>
        <td align="center"><a id="launcher" onclick="openPOSWindow('<?php echo HTTP_PTO_VENTA . CREAR_ORDEN_PAGO_URL .$params ?>'); return false;" href="#"><img src="/imagenes/boton_tarjeta.png" width="220px" border="0" /></a></td>
        </tr>
    </table>
<?php endif; ?>
        </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
