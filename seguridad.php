<? 
include("conexion.php");
session_start();
include("funciones.php");

if(isset($_POST["reportar"]))
{
	
	$numero_articulo = $_POST["numero_articulo"];
	$correo = $_POST["correo"];
	$comentarios = $_POST["comentarios"];
	
	//email cliente
	$to = $correo;
	$subject = "Su notificación al Centro de seguridad se ha completado";
	
	//email a VR
	$to2 = "centrodeseguridad@vendorepuestos.com.ve";
	$subject2 = "Su notificación al Centro de seguridad se ha completado";
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers.= "X-Priority: 1\n";
	$headers.= "From: centrodeseguridad@vendorepuestos.com.ve\r\n";
	
	$message = "Hemos recibido el siguiente reporte:<br><br>";
	$message.= "Correo de quien reporta: $correo<br>";
	$message.= "Reportar Artículo Número: $numero_articulo<br>";
	$message.= "Comentarios: $comentarios<br><br>";
	
	$send_mail = mail($to2, $subject2, $message, $headers);
	
	$message.= "En caso de que usted no haya enviado esta información, contáctenos a la brevedad.<br><br>
Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea vía Twitter @vendorepuestos<br><br> 
Gracias por usar vendorepuestos.com.ve<br><br>
Saludos.";

	$send_mail = mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
function validar(form1)
{
	if(form1.correo.value=="")
	{
		alert("Debe Ingresar el Correo");
		form1.correo.focus();
		return false;
	}
	if(form1.numero_articulo.value=="" || form1.numero_articulo.value=="0")
	{
		alert("Debe Ingresar el Numero de Articulo");
		form1.numero_articulo.focus();
		return false;
	}
	if(form1.comentario.value=="")
	{
		alert("Debe Ingresar un Comentario");
		form1.comentario.focus();
		return false;
	}
}
</script>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_categoria" style="height:30px;">Centro de Seguridad</div><br /></td>
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
                  <span class="titulo_seccion">Su Reporte se ha realizado Satisfactoriamente</span><br /><br />
                  <span class="titulo_seccion">Información enviada a su correo electrónico
</span></td>
              </tr>
            </table>
		 <? }
		  else
		  {?>
          <form id="form1" name="form1" method="post" action="" onSubmit="return validar(this)">
          <table width="500" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="154">Correo de quien reporta:</td>
              <td width="246"><input name="correo" type="text" class="form" /></td>
            </tr>
            <tr>
              <td>Reportar Artículo Número:</td>
              <td><input name="numero_articulo" type="text" class="form" value="<?=$_GET["num"]?>"/></td>
            </tr>
            <tr>
              <td>Comentario:</td>
              <td><textarea name="comentario" cols="45" rows="5" class="form"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" align="right"><input type="hidden" name="reportar" value="1"/>
              <input type="image" name="imageField" id="imageField" src="/imagenes/btn_send.jpg" /></td>
              </tr>
          </table>
        </form>
        <? }?>
          <p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
          <span class="titulo_seccion">Protegiendo Compradores</span><br /><br />
          <div style="width:450px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px;" >
          <span class="titulo_seccion"> Posibles razones para reportar un artículo</span>
                <div id="linea_division"></div>
                <ul>
<li>Ofreciendo artículo diferente al publicado.</li>
<li>Vendedor fraudulento.</li>
<li>Artículo agotado.</li>
<li>Precio diferente al publicado.</li>
<li>Teléfono fuera de servicio. Telefono errado No contestan el teléfono.</li> 
<li>Producto de dudosa procedencia.</li>
<li>Oferta engañosa.</li>
<li>Descripción de un artículo mal publicado.</li>
<li>Mala practica del negocio.</li>
<li>Depósito realizado, pero sin recibir el artículo.</li>
<li>Otros motivos.</li></ul>
</div>
<p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<span class="titulo_seccion">Protegiendo Compradores</span><br /><br />
<span class="titulo_seccion">Cliente Premium</span><br /><br />
Si usted es un Cliente Premium y desea dar de baja o editar un artículo, visita Vende tu Artículo para realizar la modificación.<br /><br />
<span class="titulo_seccion">TIENDAREPUESTOS</span><br /><br />
<div align="center"><b>1. En el registro</b></div><br />
a. Asegurarse de que la barra de navegación pertenezca a <a href="/inicio/" class="bluep">vendorepuestos.com.ve</a>.<br />
b. La clave de usuario sea una combinación de letras y números, fácilmente memorizables.<br />
•	Algunas recomendaciones para tener una clave segura.<br />
- Cambia tu contraseña al menos cada 6 meses.<br />
- No compartas ni distribuyas tu clave con otras personas por e-mail, ni la guardes en un archivo en tu computadora.<br />
- Sé cuidadoso con las preguntas para recuperar tu contraseña, no elijas una cuya respuesta sea muy fácil.<br />
- Modifica tu clave si recibes un e-mail con tu nombre de usuario y tu clave sin haberlo solicitado.<br />
c. Asegurarse de proveer los medios de contacto que están destinados para clientes con fines comerciales, es aconsejable atender la venta en un horario acorde, para ello se ha dispuesto de un sección de Horario de Atención al Público, como una manera de concentrar los contactos a las horas asignadas por el cliente.<br />
d. Proveer la información real, pues en caso de detectarse alguna anormalidad, podría provocar la suspensión parcial o permanente de la cuenta.<br />
e. Verifica la información antes de ser enviada.<br /><br />

<div align="center"><b>2. En la Cuenta</b></div><br />
a Controla la actividad de tu cuenta periódicamente:<br />
b Revisa que tus datos sean los correctos.<br />
c. Verifica si tienes publicaciones no autorizadas.<br />
d.	Cierra siempre tu sesión al dejar la computadora.
e.	Desconfía de e-mails que te pidan datos de tu cuenta. <a href="/inicio/" class="bluep">Vendorepuestos.com.ve</a> nunca te los solicitará por e-mail o algún otro medio. Los correos oficiales, están disponibles en la seccion de contáctanos.<br />
f.	Los correos de <a href="/inicio/" class="bluep">vendorespuestos.com.ve</a> serán netamente informativos o promocionales.<br /><br />
<div align="center"><b>Cómo identificar e-mails falsos</b></div><br />
En la seccion de contáctanos, estan disponibles los correos oficiales de interaccion entre vendorepuestos y el cliente.<br />
Usualmente, contienen links que llevan a sitios web falsos que imitan el aspecto de los verdaderos, en los que se solicita información personal.<br />
Características de los e-mails falsos <br /><br />
<b>A. Dirección del remitente</b> <br />
•	La dirección del remitente parece legítima.<br /><br />
<b>B. Saludo</b> <br />
•	Usan saludos generales. Los e-mails de vendorepuestos.com.ve siempre son personalizados. <br /><br />
<b>C. Urgencia y amenaza sobre tu cuenta</b> <br />
•	Informan que Vendorepuestos.com.ve tiene la necesidad urgente de actualizar tus datos personales.<br /> 
•	Amenazan con suspender la suscripción si no lo haces.<br /><br />
<b>D. Pedido de información personal</b><br />
•	Solicitan información personal, como usuario o clave, número de tarjeta de crédito o cuenta de banco, mediante links o formularios incluidos en el cuerpo del e-mail.<br />
•	<a href="/inicio/" class="bluep">Vendorepuestos.com.ve</a> nunca solicita datos por e-mail, ni requiere que ingreses tu clave o usuario.<br /><br />
<b>E. Links en el e-mail</b><br />
•	Incluyen links con apariencia legítima pero que dirigen a sitios falsos.<br />
•	Revisa la URL del sitio al que te lleva el link <br /><br />

<div align="center"><b>3. En el pago</b></div><br />
Si la negociación amerita una transacción bancaria, verifique el depósito tomándose el tiempo necesario, no permita ser presionado por el comprador en enviar el articulo sin chequear antes su pago. <br />
Provea por email o texto un formulario de informacion del cliente  para que sea completado por los clientes.<br />
No suministre información por teléfono, es recomendable el uso de correo electónico.<br />
La manera recomendable de comenzar una negociación, es a través de mensaje de texto. <br /><br />

<div align="center"><b>4. En la entrega del producto</b></div> <br />
a. Utilizar la  sede oficial de la TIENDAREPUESTOS para entregas personalizadas.<br />
b. Planifica el intercambio en un lugar seguro, puede ser un lugar público y concurrido.<br /> 
c. Verifica siempre los datos de tu comprador, pídele una copia de su Cédula de identidad y un teléfono fijo en donde puedas localizarlo.<br />
d. Emplea servicios de envío con seguro y que te proporcionen códigos de seguimiento. <br />
e. Envía tu producto a nombre de tu comprador para asegurarte de que lo reciba directamente.<br />
f.Guarda copias de los recibos de envío y los certificados de depósito. Esto te ayudará en caso de reclamos por parte de los compradores.<br /><br />
Si  usted considerada que su cuenta está siendo usada por otra persona y desea reportarlo, escribe a <a href="mailto:centrodeseguridad@vendorepuestos.com.ve" class="bluep">centrodeseguridad@vendorepuestos.com.ve</a></td></tr></table>



</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
