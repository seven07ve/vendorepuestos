<? 
include("conexion.php");
session_start();
include("funciones.php");


if(isset($_POST["paso"])==2)
{
	//datos usuario
	$nombre = $_POST["nombre"];
	$cedula = $_POST["cedula"];
	$articulo = $_POST["articulo"];
	$email = $_POST["email"];
		
	//email al cliente
	$to = $email;
	$subject = "Su notificación de venta se ha completado";	
	
	//EMAIL A TR
	$to2 = "administracion@vendorepuestos.com.ve";
	$subject2 = "Su notificación de venta se ha completado";
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: administracion@vendorepuestos.com.ve\r\n";
	
	$numero_articulo = numero_articulo((int)$idp);
	$message.="Hemos recibido la siguiente información de Notificación de venta.<br><br>
	<b>Datos del Vendedor</b><br>
	Nombre: $nombre<br>	
	Documento de Identidad:<br>
	Email: 	$cedula<br>
	# del artículo: $numero_articulo<br><br>";
	
	$send_mail = mail($to2, $subject2, $message, $headers);
	
	$message.="En caso de que usted no haya enviado esta información, contáctenos a la brevedad.<br><br>
	Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea  vía Twitter @vendorepuestos<br>v  
	Gracias por usar vendorepuestos.com.ve<br><br>
	Saludos.";
	
	$send_mail = mail($to, $subject, $message, $headers);
	
	?>
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<script type="text/javascript" src="js/prototype.js"></script>
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
	//datos del producto
	if(formy.articulo.value=="" || formy.articulo.value=="0")
	{
		alert("Debe ingresar el # de Articulo");
		formy.articulo.focus();
		return false;
	}
	return true;
}
function cargar_ciudad(edo,ciu)
{
	new Ajax.Request("vende.php?buscar=1&edo="+edo+"&ciu="+ciu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciu').update(transport.responseText);
	}
	});
}
function cargar_ciudadp(edo,ciu)
{
	new Ajax.Request("vende.php?buscar=2&edo="+edo+"&ciu="+ciu,{
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
        <td width="137"><a href="http://pagos.vendorepuestos.com.mx/producto.php/producto/buscar"><img src="/imagenes/login_btn_9_off.jpg" name="datos" width="137" height="20" border="0" id="datos" /></a></td>
        <td width="118"><a href="/notificaTR/0"><img src="/imagenes/login_btn_10_on.jpg" name="pub" width="118" height="20" border="0" id="pub" /></a></td>
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
                  <span class="titulo_seccion">Su Notificacion se ha realizado Satisfactoriamente</span><br /><br />
                  <span class="titulo_seccion">Información enviada a su correo electrónico
</span></td>
              </tr>
            </table>
		 <? }
		  else
		  {?>
          <form action="" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar_user(this);">
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
  <td width="221" class="desc">Art&iacute;culo #:</td>
  <td width="459" class="campo"><input name="articulo" type="text" class="form" size="50" value="<?=$_GET["num"]?>"/>
  *</td>
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
