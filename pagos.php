<? 
include("conexion.php");
session_start();
include("funciones.php");

if(isset($_POST["pago"]))
{
	$pago = $_POST["pago"];
	//email para confirmar al cliente
	$email = $_POST["email"];
	$subject2 = "Su reporte al Centro de Pagos ha sido recibido";
	$message2.="Gracias por confiar en vendorepuestos.com.ve, hemos recibido la siguiente información, acerca del pago por su publicación, agradecemos corroborar la misma para efectos de publicación, así como completar los Requisitos Técnicos sólo en caso de ser un Cliente TIENDAREPUESTOS.<br><br>";
	
	//email a VR
	$to = "centrodepagos@vendorepuestos.com.ve";
	$subject = "Reporte al  Centro de Pagos";
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: centrodepagos@vendorepuestos.com.ve\r\n";
	
	if($pago =="tc")
	{
		$numero_articulo = $_POST["articulo_tr"]."-".$_POST["numero_articulo"];
		$numero_confirmacion = $_POST["numero_confirmacion"];
		$comentarios = $_POST["comentarios"];
		$message.= "Los datos de Pago con Tarjeta de Credito en vendorepuestos son:<br><br>";
		$message.= "Numero de Articulo: $numero_articulo<br>";
		$message.= "Numero de confirmacion: $numero_confirmacion<br>";
		$message.= "Comentarios: $comentarios<br><br>";
		$send_mail = mail($to, $subject, $message, $headers);
	}
	elseif($pago =="dt")
	{
		$message = "Se ha recibido la siguiente información en el Centro de Pagos<br>";
		$message.= "Correo: $email<br>";
		$message.= "Los datos de Pago con Deposito o Transferencia en vendorepuestos son:<br><br>";
		$message.= "Número de Artículo / Orden: $numero_articulo<br>";
		$message.= "Entidad Bancaria: $entidad_bancaria<br>";
		$message.= "Fecha: $fecha<br>";
		$message.= "Numero de Deposito o Transferencia: $numero_confirmacion<br>";
		$message.= "Monto: $monto<br>";
		$message.= "Comentarios: $comentarios<br><br>";
		$send_mail = mail($to, $subject, $message, $headers);
	}
	$message2.=$message;
	$message2.="Si, la misma posee alguna inconsistencia, realizar nuevamente el reporte al Centro de Pagos y agrega la aclaratoria en la sección de Comentarios.<br><br>
	Nuestro Departamento de Administración procederá a verificar la información recibida y procederá a su validación en un tiempo prudencial.<br><br>
	Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea  vía Twitter @vendorepuestos<br><br>  
	Gracias por usar vendorepuestos.com.ve<br><br>
	Saludos.";
	
	$send_mail = mail($email, $subject2, $message2, $headers);
	?>
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validar(form1)
{
	if(form1.numero_articulo.value=="")
	{
		alert("Debe Ingresar el Numero de Articulo");
		form1.numero_articulo.focus();
		return false;
	}
	if(form1.numero_confirmacion.value=="")
	{
		alert("Debe Ingresar el Numero de Confirmacion");
		form1.numero_confirmacion.focus();
		return false;
	}
}
function validar2(form2)
{
	if(form2.numero_articulo.value=="")
	{
		alert("Debe Ingresar el Numero de Articulo");
		form2.numero_articulo.focus();
		return false;
	}
	if(form2.entidad_bancaria.value=="")
	{
		alert("Debe Ingresar la entidad Bancaria");
		form2.entidad_bancaria.focus();
		return false;
	}
	if(form2.fecha.value=="")
	{
		alert("Debe Ingresar la Fecha");
		form2.fecha.focus();
		return false;
	}
	if(form2.numero_confirmacion.value=="")
	{
		alert("Debe Ingresar el Numero de Confirmacion");
		form2.numero_confirmacion.focus();
		return false;
	}
	if(form2.monto.value=="")
	{
		alert("Debe Ingresar el Monto");
		form2.monto.focus();
		return false;
	}
	if((form2.email.value.indexOf ('@', 0) == -1) || (form2.email.value.indexOf ('.', 0) == -1) ||(form2.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		form2.email.focus();
		return false;
	}
}

</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_categoria" style="height:30px;">Centro de Pagos</div><br /></td>
  </tr>
  <tr>
    <td valign="top">
      <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td height="150">
          <? if(!isset($_POST["pago"]))
          {?>
          <div align="justify">
          <span class="titulo_seccion">Si ya hiciste el Pago haz </span><a href="#1">click aquí</a><br /><br />

Gracias por elegir <a href="/inicio/">www.vendorepuestos.com.ve</a> como herramienta de publicación.<br /><br />

Esta información bancaria es sólo para pagos de publicación, en ningún momento es para pagos de artículos. Si usted desea pagar un producto, por favor ponerse en contacto con el vendedor.<br /><br />

Si usted es Cliente Premiun y desea pagar por una publicación, debe depositar el monto del costo de publicación de un artículo según el rango de precio mostrado en las <a href="/tarifasTR/">Tarifas</a>. No puede hacer pagos parciales, en cuotas o pagar de más. Por favor hacer 1 transacción por publicación, ya que usted necesita los código de confirmación de cada pago (transferencia o depósito) para poder subir los artículos a <a href="/inicio/">www.vendorepuestos.com.ve</a> una vez registrados en la sección de <a href="/vendeTR/">Vende tu Artículo</a>.<br /><br />

Si usted como cliente TIENDAREPUESTOS desea pagar por un paquete de publicación, le recomendamos utilice la sección de su ESTADO DE CUENTA ingresando a MI TR para cancelar con tarjeta de crédito cómoda e inmediatamente. Sin embargo, si usted desea hacer un depósito o transferencia, aquí proveemos la información bancaria. Tenga en cuenta que los pagos por depósito o transferencia toman hasta 2 días hábiles para activar el paquete de publicación. <br /><br />
</div>
<p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#333333">
  <tr class="gold">
    <td>Medio de Pago</td>
    <td>Tiempo de Acreditaci&oacute;n</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Tarjeta de Cr&eacute;dito</td>
    <td bgcolor="#FFFFFF">Acreditaci&oacute;n Inmediata</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Transferencia de la misma entidad<br />(una transferncia  por publicaci&oacute;n)                                         </td>
    <td bgcolor="#FFFFFF">Acreditaci&oacute;n 1 d&iacute;a h&aacute;bil</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Transferencia de otra entidad (uno por publicaci&oacute;n)<br />(una transferncia  por publicaci&oacute;n)</td>
    <td bgcolor="#FFFFFF">Acreditaci&oacute;n2 d&iacute;a h&aacute;biles</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Dep&oacute;sito Bancario<br />
    (un deposito por publicacion sólo efectivo)        </td>
    <td bgcolor="#FFFFFF">Acreditaci&oacute;n2 d&iacute;a h&aacute;biles</td>
  </tr>
</table><p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<span class="titulo_seccion">Información Bancaria</span><br /><br />
Tipo de Cuenta: Corriente<br /> 
Titular: Vendorepuestos Venezuela CA <br />  
RIF: J-31737187-9<br />
Email: <a href="mailto:administracion@vendorepuestos.com.ve" class="bluep">administracion@vendorepuestos.com.ve</a><br /><br />
<table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#333333">
  <tr class="gold">
    <td>Entidad Bancaria</td>
    <td>Números de Cuenta</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">BOD</td>
    <td bgcolor="#FFFFFF">0116-0183-94-0013599150</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Banesco</td>
    <td bgcolor="#FFFFFF">0134-0030-08-0301026847</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Banco Provincial</td>
    <td bgcolor="#FFFFFF">0108-0334-92-0100113038</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Banco de Venezuela</td>
    <td bgcolor="#FFFFFF">0102-0859-93-0000009166</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Banco Mercantil</td>
    <td bgcolor="#FFFFFF">0105-0672-75-1672068541</td>
  </tr>
</table>
<!--<p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<a name="1" id="1"></a><span class="titulo_seccion">Formulario de Notificación de Pago

Pagando a través de Tarjeta de Crédito<br />
</span><br />
<form id="form1" name="form1" method="post" action="/centro_pagos/" onSubmit="return validar(this)">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td width="154">N&uacute;mero de Art&iacute;culo:</td>
      <td width="246"><input name="numero_articulo" type="text" class="form" /></td>
    </tr>
    <tr>
      <td>N&uacute;mero de Confirmaci&oacute;n:</td>
      <td><input name="numero_confirmacion" type="text" class="form"/></td>
    </tr>
    <tr>
      <td>Comentario:</td>
      <td><textarea name="comentario" cols="45" rows="5" class="form"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="hidden" name="pago" value="tc"/>        <input type="image" name="imageField" id="imageField" src="/imagenes/btn_send.jpg" /></td>
      </tr>
  </table>
</form>-->

<p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<span class="titulo_seccion">Pagando a través de Depósito Bancario o Transferencia</span>
<form id="form2" name="form2" method="post" action="/centro_pagos/" onSubmit="return validar2(this)"><br />
  <table width="555" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td width="23"><input name="articulo_tr" type="radio" value="ART" checked="checked" /></td>
      <td width="194">N&uacute;mero de Art&iacute;culo:</td>
      <td width="303" rowspan="2"><input name="numero_articulo" type="TR" class="form" /></td>
    </tr>
    <tr>
      <td><input type="radio" name="articulo_tr"  value="2" /></td>
      <td>Orden TR:</td>
    </tr>
    <tr>
      <td colspan="2">Entidad Bancaria:</td>
      <td><input name="entidad_bancaria" type="text" class="form" /></td>
    </tr>
    <tr>
      <td colspan="2">Fecha:</td>
      <td><input name="fecha" type="text" class="form" /></td>
    </tr>
    <tr>
      <td colspan="2">N&uacute;mero de Dep&oacute;sito o Transferencia:</td>
      <td><input name="numero_confirmacion" type="text" class="form" /></td>
    </tr>
    <tr>
      <td colspan="2">Monto:</td>
      <td><input name="monto" type="text" class="form"/></td>
    </tr>
    <tr>
      <td colspan="2">Email:</td>
      <td><input name="email" type="text" class="form"/></td>
    </tr>
    <tr>
      <td colspan="2">Comentario:</td>
      <td><textarea name="comenatario" cols="40" rows="5" class="form"></textarea></td>
    </tr>
    <tr>
      <td colspan="3" align="right"><input type="hidden" name="pago" value="dt"/>        <input type="image" name="imageField" id="imageField" src="/imagenes/btn_send.jpg" /></td>
      </tr>
  </table>
  <br />
</form>
<? 
}
elseif(isset($_POST["pago"]))
{?><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><span class="red">Gracias</span><br />
      <span class="titulo_seccion">El Formulario ha sido enviado</span><br /><br />
      <span class="titulo_seccion">Le Contactaremos brevemente<br />para informarle el estado de la activaci&oacute;n</span><br />
    (en caso de haber enviado la informaci&oacute;n de manera errada, reenviela en el mismo formato y agregue un comentario)<br /><br />
    No olvide enviar la informaci&oacute;n adicional en caso de ser necesario<br />
    para cumplir con los requisitos t&eacute;cnicos</td>
  </tr>
</table>
<? }?>
</td></tr></table>
</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
