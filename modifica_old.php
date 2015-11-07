<? 
include("conexion.php");
session_start();
include("funciones.php");


if(isset($_POST["paso"])==2)
{
	//enviar email al cliente y a vendorespuestos
	$semi_rand = md5(time()); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	
	$to = $_POST["email"];
	$to2 = "administracion@vendorepuestos.com.ve";
	$subject = "Modificar Articulo [www.vendorepuestos.com.ve]";	
	$headers = "From: administracion@vendorepuestos.com.ve\r\n";
	$headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
	
	$message = "<b>Datos del Vendedor</b><br>";
	$message.= "Nombre: ".$_POST["nombre"]."<br>";
	$message.= "Cedula: ".$_POST["cedula"]."<br>";
	$message.= "Email: ".$_POST["email"]."<br>";
	$message.= "<b>Datos del Articulo</b><br>";
	$message.= "#: ".$_POST["articulo"]."<br>";
	$message.= "<b>Datos a Modificar</b><br>";
	$message.= "<b>Datos del Vendedor</b><br>";
	if($_POST["telefono2"]!="") $message.= "Telefono2: ".$_POST["telefono2"]."<br>";
	if($_POST["pin"]!="") $message.= "Pin: ".$_POST["pin"]."<br>";
	if($_POST["id_estado"]!="0") $message.= "Estado: ".cual_estado($_POST["id_estado"])."<br>";
	if($_POST["id_ciudad"]!="0") $message.= "Ciudad: ".cual_ciudad($_POST["id_ciudad"])."<br>";
	if($_POST["datos_pago"]!="") $message.= "Datos Pago: ".implode(",",$_POST["datos_pago"])."<br>";
	if($_POST["datos_envio"]!="") $message.= "Datos Envio: ".implode($_POST["datos_envio"])."<br>";
	if($_POST["datos_banco"]!="") $message.= "Datos Banco: ".implode($_POST["datos_banco"])."<br>";
	$message.= "<b>Datos del Articulo</b><br>";
	if($_POST["titulo"]!="") $message.= "Titulo: ".$_POST["titulo"]."<br>";
	if($_POST["subtitulo"]!="") $message.= "Subtitulo: ".$_POST["subtitulo"]."<br>";
	if($_POST["condicion"]!="0") $message.= "Condicion: ".$_POST["condicion"]."<br>";
	if($_POST["precio"]!="") $message.= "Precio: ".$_POST["precio"]."<br>";
	if($_POST["id_estadop"]!="0") $message.= "Estado: ".cual_estado($_POST["id_estadop"])."<br>";
	if($_POST["id_ciudadp"]!="0") $message.= "Ciudad: ".cual_ciudad($_POST["id_ciudadp"])."<br>";
	if($_FILES["file"]["tmp_name"]!=0) $message.= "Foto 1: Adjunta";
	if($_FILES["file2"]["tmp_name"]!=0) $message.= "Foto 2: Adjunta";
	if($_FILES["file3"]["tmp_name"]!=0) $message.= "Foto 3: Adjunta";
	
	$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
	$message.= "--{$mime_boundary}\n";
	
	if($_FILES["file"]["size"] > 0)
   	{
		// preparing attachments
		$file = fopen($_FILES["file"]["tmp_name"],"rb");
		$data = fread($file,filesize($_FILES["file"]["tmp_name"]));
		fclose($file);
		$data = chunk_split(base64_encode($data));
		$message.= "Content-Type: {\"".$_FILES["file"]["type"]."\"};\n" ." name=\"".$_FILES["file"]["name"]."\"\n" ."Content-Disposition: attachment;\n" ." filename=\"".$_FILES["file"]["name"]."\"\n" ."Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message.= "--{$mime_boundary}--\n";
   }
   if($_FILES["file2"]["size"] > 0)
   	{
		// preparing attachments
		$file = fopen($_FILES["file2"]["tmp_name"],"rb");
		$data = fread($file,filesize($_FILES["file2"]["tmp_name"]));
		fclose($file);
		$data = chunk_split(base64_encode($data));
		$message.= "Content-Type: {\"".$_FILES["file2"]["type"]."\"};\n" ." name=\"".$_FILES["file2"]["name"]."\"\n" ."Content-Disposition: attachment;\n" ." filename=\"".$_FILES["file2"]["name"]."\"\n" ."Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message.= "--{$mime_boundary}--\n";
   }
   if($_FILES["file3"]["size"] > 0)
   	{
		// preparing attachments
		$file = fopen($_FILES["file3"]["tmp_name"],"rb");
		$data = fread($file,filesize($_FILES["file3"]["tmp_name"]));
		fclose($file);
		$data = chunk_split(base64_encode($data));
		$message.= "Content-Type: {\"".$_FILES["file3"]["type"]."\"};\n" ." name=\"".$_FILES["file3"]["name"]."\"\n" ."Content-Disposition: attachment;\n" ." filename=\"".$_FILES["file3"]["name"]."\"\n" ."Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message.= "--{$mime_boundary}--\n";
   }
	
	$send_mail = mail($to, $subject, $message, $headers);
	$send_mail = mail($to2, $subject, $message, $headers);
	?>
<? }
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
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		formy.email.focus();
		return false;
	}
	
	//fin datos producto
	if(formy.articulo.value=="")
	{
		alert("Debe ingresar el # de Articulo");
		formy.articulo.focus();
		return false;
	}
	numero = formy.articulo.value;
	if (!/([?1234567890])+$/.test(numero))
	{
		alert("El Nro. de Articulo es invalido");
		formy.articulo.focus();
		return false;
	}
	if(formy.precio.value!="")
	{
		numero = formy.precio.value;
		if (!/([?1234567890][.][1234567890][1234567890])+$/.test(numero))
		{
			alert("El Precio " + numero + " es invalido");
			formy.precio.focus();
			return false;
		}
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
        <td width="112"><a href="/vendeTR/"><img src="/imagenes/login_btn_8_off.jpg" name="edo" width="112" height="20" border="0" id="edo" /></a></td>
        <td width="137"><a href="/modificaTR/"><img src="/imagenes/login_btn_9_on.jpg" name="datos" width="137" height="20" border="0" id="datos" /></a></td>
        <td width="118"><a href="/notificaTR/"><img src="/imagenes/login_btn_10_off.jpg" name="pub" width="118" height="20" border="0" id="pub" /></a></td>
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
                <td align="center">
                  <span class="titulo_seccion">Su información se ha registrado Satisfactoriamente</span><br /><br />
                  <span class="titulo_seccion">En caso de que la publicación
 haya sufrido modificación de precio,
Proceda a realizar el pago diferencial
 y repórtalo al Centro de Pagos.<br /><br />Información enviada 
a su correo electrónico
</span></td>
              </tr>
            </table>
		 <? }
		  else
		  {?>
          <div class="titulo_seccion">Datos de la Publicación (para efectos de verificación)</div>
          <form action="/modificaTR/" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar_user(this);">
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
  <td class="desc">Documento de Identidad:</td>
  <td class="campo"><input name="cedula" type="text" class="form" size="50" />
  (ej. V-0000)*</td>
</tr>
<tr>
  <td class="desc">Email:</td>
  <td class="campo"><input name="email" type="text" class="form" size="50" />
    *</td>
</tr>
</table>
<br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr align="right">
<td colspan="2" align="left" class="blue">Datos del Art&iacute;culo</td>
</tr>
<tr>
  <td class="desc">Art&iacute;culo #:</td>
  <td class="campo"><input name="articulo" type="text" class="form" size="50" />
*</td>
</tr>
</table>
<br /><br />
<div class="titulo_seccion">Campo a Modificar (Completar solamente el campo a modificar)</div>
<br /><br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr align="right">
<td colspan="2" align="left" class="blue">Datos del Vendedor</td></tr>
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
  </select></td>
</tr>
<tr>
  <td class="desc">Ciudad:</td>
  <td class="campo" id="ciu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select></td>
</tr>
<tr>
  <td class="desc">Datos para Pagos:</td>
  <td class="campo">
  <? 
  $ver_datos_pago = mysql_query("SELECT * FROM medio_pago ORDER BY nombre ASC");
  while($vdp = mysql_fetch_array($ver_datos_pago))
  {?>
    <input type="checkbox" name="datos_pago[]" value="<?=$vdp["id"]?>" <? if(in_array($vdp["id"],$datos_pago)){?> checked="checked"<? }?>/> <?=$vdp["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Datos para Envios:</td>
  <td class="campo">
  <? 
  $ver_datos_envio = mysql_query("SELECT * FROM medio_envio ORDER BY nombre ASC");
  while($vde = mysql_fetch_array($ver_datos_envio))
  {?>
    <input type="checkbox" name="datos_envio[]" value="<?=$vde["id"]?>" <? if(in_array($vde["id"],$datos_envio)){?> checked="checked"<? }?>/> <?=$vde["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Bancos para pagos:</td>
  <td class="campo">
    <? 
  $ver_datos_banco = mysql_query("SELECT * FROM banco ORDER BY nombre ASC");
  while($vdb = mysql_fetch_array($ver_datos_banco))
  {?>
    <input type="checkbox" name="datos_banco[]" value="<?=$vdb["id"]?>" <? if(in_array($vdb["id"],$datos_banco)){?> checked="checked"<? }?>/> <?=$vdb["nombre"]?><br />
    <? }?></td>
</tr>
</table><br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr align="right">
<td colspan="2" align="left" class="blue">Datos del Art&iacute;culo</td></tr>

<tr>
  <td width="221" class="desc">T&iacute;tulo:</td>
  <td width="459" class="campo"><input name="titulo" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Sub T&iacute;tulo:</td>
  <td class="campo"><input name="subtitulo" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Descripci&oacute;n:</td>
  <td class="campo"><?php
				include_once "admini/ckeditor/ckeditor.php";
				include_once 'admini/ckfinder/ckfinder.php';
				$initialValue = "";
				$CKEditor = new CKEditor();
				$CKEditor->basePath = '/admini/ckeditor/';
				$CKFinder = new CKFinder();
 				$CKFinder->BasePath = '/admini/ckfinder/';
	 			$CKFinder->SetupCKEditorObject($CKEditor);
				$CKEditor->config["width"]=650;
				$CKEditor->config["height"]=300;
				$CKEditor->editor("descripcionp", $initialValue);
			?></td>
</tr>
<tr class="tabla">
  <td>Estado de Ubicaci&oacute;n:</td>
  <td><select class="form" name="id_estadop" onChange="cargar_ciudadp(this.value,0);">
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
  <td id="ciup"><select class="form" name="id_ciudadp">
    <option value="0">Seleccione</option>
  </select></td>
</tr>
<tr class="tabla">
  <td class="desc">Imagen 1:</td>
  <td class="campo"><input name="file" type="file" class="form" /></td>
</tr>
<tr>
  <td class="desc">Imagen 2:</td>
  <td class="campo"><input name="file2" type="file" class="form" /></td>
</tr>
<tr>
  <td class="desc">Imagen 3:</td>
  <td class="campo"><input type="file" name="file3" class="form"/></td>
</tr>
<tr>
  <td height="41" class="desc">Condicion:</td>
  <td class="campo">
      <select name="condicion" class="form">
      <option selected="selected" value="0">Seleccione</option>
      <option>Nuevo</option>
      <option>Remanufacturado</option>
      <option>Usado</option>
      </select>
    </td>
</tr>
<tr>
  <td height="41" class="desc">Precio:</td>
  <td class="campo"><input name="precio" type="text" class="form" size="10" /> 
    (ej. 00.00) <br />*Genera cargo extra en caso de que el precio sea mas elevado,
y se debe pagar la diferencia. Consulta la sección de Tarifas</td>
</tr>
 <tr>
   <td colspan="2" align="right" class="tabla_botones">
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
