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
	$subject = "Su notificaci�n al Centro de seguridad se ha completado";
	
	//email a VR
	$to2 = "centrodeseguridad@vendorepuestos.com.ve";
	$subject2 = "Su notificaci�n al Centro de seguridad se ha completado";
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers.= "X-Priority: 1\n";
	$headers.= "From: centrodeseguridad@vendorepuestos.com.ve\r\n";
	
	$message = "Hemos recibido el siguiente reporte:<br><br>";
	$message.= "Correo de quien reporta: $correo<br>";
	$message.= "Reportar Art�culo N�mero: $numero_articulo<br>";
	$message.= "Comentarios: $comentarios<br><br>";
	
	$send_mail = mail($to2, $subject2, $message, $headers);
	
	$message.= "En caso de que usted no haya enviado esta informaci�n, cont�ctenos a la brevedad.<br><br>
Para informaci�n adicional contacte nuestra secci�n de Preguntas Frecuentes o a nuestro equipo de Soporte En L�nea v�a Twitter @vendorepuestos<br><br> 
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
                  <span class="titulo_seccion">Informaci�n enviada a su correo electr�nico
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
              <td>Reportar Art�culo N�mero:</td>
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
          <span class="titulo_seccion"> Posibles razones para reportar un art�culo</span>
                <div id="linea_division"></div>
                <ul>
<li>Ofreciendo art�culo diferente al publicado.</li>
<li>Vendedor fraudulento.</li>
<li>Art�culo agotado.</li>
<li>Precio diferente al publicado.</li>
<li>Tel�fono fuera de servicio. Telefono errado No contestan el tel�fono.</li> 
<li>Producto de dudosa procedencia.</li>
<li>Oferta enga�osa.</li>
<li>Descripci�n de un art�culo mal publicado.</li>
<li>Mala practica del negocio.</li>
<li>Dep�sito realizado, pero sin recibir el art�culo.</li>
<li>Otros motivos.</li></ul>
</div>
<p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<span class="titulo_seccion">Protegiendo Compradores</span><br /><br />
<span class="titulo_seccion">Cliente Premium</span><br /><br />
Si usted es un Cliente Premium y desea dar de baja o editar un art�culo, visita Vende tu Art�culo para realizar la modificaci�n.<br /><br />
<span class="titulo_seccion">TIENDAREPUESTOS</span><br /><br />
<div align="center"><b>1. En el registro</b></div><br />
a. Asegurarse de que la barra de navegaci�n pertenezca a <a href="/inicio/" class="bluep">vendorepuestos.com.ve</a>.<br />
b. La clave de usuario sea una combinaci�n de letras y n�meros, f�cilmente memorizables.<br />
�	Algunas recomendaciones para tener una clave segura.<br />
- Cambia tu contrase�a al menos cada 6 meses.<br />
- No compartas ni distribuyas tu clave con otras personas por e-mail, ni la guardes en un archivo en tu computadora.<br />
- S� cuidadoso con las preguntas para recuperar tu contrase�a, no elijas una cuya respuesta sea muy f�cil.<br />
- Modifica tu clave si recibes un e-mail con tu nombre de usuario y tu clave sin haberlo solicitado.<br />
c. Asegurarse de proveer los medios de contacto que est�n destinados para clientes con fines comerciales, es aconsejable atender la venta en un horario acorde, para ello se ha dispuesto de un secci�n de Horario de Atenci�n al P�blico, como una manera de concentrar los contactos a las horas asignadas por el cliente.<br />
d. Proveer la informaci�n real, pues en caso de detectarse alguna anormalidad, podr�a provocar la suspensi�n parcial o permanente de la cuenta.<br />
e. Verifica la informaci�n antes de ser enviada.<br /><br />

<div align="center"><b>2. En la Cuenta</b></div><br />
a Controla la actividad de tu cuenta peri�dicamente:<br />
b Revisa que tus datos sean los correctos.<br />
c. Verifica si tienes publicaciones no autorizadas.<br />
d.	Cierra siempre tu sesi�n al dejar la computadora.
e.	Desconf�a de e-mails que te pidan datos de tu cuenta. <a href="/inicio/" class="bluep">Vendorepuestos.com.ve</a> nunca te los solicitar� por e-mail o alg�n otro medio. Los correos oficiales, est�n disponibles en la seccion de cont�ctanos.<br />
f.	Los correos de <a href="/inicio/" class="bluep">vendorespuestos.com.ve</a> ser�n netamente informativos o promocionales.<br /><br />
<div align="center"><b>C�mo identificar e-mails falsos</b></div><br />
En la seccion de cont�ctanos, estan disponibles los correos oficiales de interaccion entre vendorepuestos y el cliente.<br />
Usualmente, contienen links que llevan a sitios web falsos que imitan el aspecto de los verdaderos, en los que se solicita informaci�n personal.<br />
Caracter�sticas de los e-mails falsos <br /><br />
<b>A. Direcci�n del remitente</b> <br />
�	La direcci�n del remitente parece leg�tima.<br /><br />
<b>B. Saludo</b> <br />
�	Usan saludos generales. Los e-mails de vendorepuestos.com.ve siempre son personalizados. <br /><br />
<b>C. Urgencia y amenaza sobre tu cuenta</b> <br />
�	Informan que Vendorepuestos.com.ve tiene la necesidad urgente de actualizar tus datos personales.<br /> 
�	Amenazan con suspender la suscripci�n si no lo haces.<br /><br />
<b>D. Pedido de informaci�n personal</b><br />
�	Solicitan informaci�n personal, como usuario o clave, n�mero de tarjeta de cr�dito o cuenta de banco, mediante links o formularios incluidos en el cuerpo del e-mail.<br />
�	<a href="/inicio/" class="bluep">Vendorepuestos.com.ve</a> nunca solicita datos por e-mail, ni requiere que ingreses tu clave o usuario.<br /><br />
<b>E. Links en el e-mail</b><br />
�	Incluyen links con apariencia leg�tima pero que dirigen a sitios falsos.<br />
�	Revisa la URL del sitio al que te lleva el link <br /><br />

<div align="center"><b>3. En el pago</b></div><br />
Si la negociaci�n amerita una transacci�n bancaria, verifique el dep�sito tom�ndose el tiempo necesario, no permita ser presionado por el comprador en enviar el articulo sin chequear antes su pago. <br />
Provea por email o texto un formulario de informacion del cliente  para que sea completado por los clientes.<br />
No suministre informaci�n por tel�fono, es recomendable el uso de correo elect�nico.<br />
La manera recomendable de comenzar una negociaci�n, es a trav�s de mensaje de texto. <br /><br />

<div align="center"><b>4. En la entrega del producto</b></div> <br />
a. Utilizar la  sede oficial de la TIENDAREPUESTOS para entregas personalizadas.<br />
b. Planifica el intercambio en un lugar seguro, puede ser un lugar p�blico y concurrido.<br /> 
c. Verifica siempre los datos de tu comprador, p�dele una copia de su C�dula de identidad y un tel�fono fijo en donde puedas localizarlo.<br />
d. Emplea servicios de env�o con seguro y que te proporcionen c�digos de seguimiento. <br />
e. Env�a tu producto a nombre de tu comprador para asegurarte de que lo reciba directamente.<br />
f.Guarda copias de los recibos de env�o y los certificados de dep�sito. Esto te ayudar� en caso de reclamos por parte de los compradores.<br /><br />
Si  usted considerada que su cuenta est� siendo usada por otra persona y desea reportarlo, escribe a <a href="mailto:centrodeseguridad@vendorepuestos.com.ve" class="bluep">centrodeseguridad@vendorepuestos.com.ve</a></td></tr></table>



</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
