<? 
include("conexion.php");
session_start();
include("funciones.php");

if($_POST['act']=="olvido")
{
  	$login = $_POST["login"];
	$usuario_tienda = $_POST["usuario_tienda"];
	$subject = "Recordatorio de Cuenta de Usuario [www.vendorepuestos.com.ve]";	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/plain; charset=utf-8\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: atencion_cliente@vendorepuestos.com.ve\r\n";	

	if($usuario_tienda==1) $buscar_usuario = mysql_query("SELECT usuario, clave, id FROM usuario WHERE email='$login'");
	elseif($usuario_tienda==1) $buscar_usuario = mysql_query("SELECT usuario, clave, id FROM tienda_virtual WHERE email='$login'");
	
	if(mysql_num_rows($buscar_usuario)>0)
	{
		$bu = mysql_fetch_array($buscar_usuario);
		$pass = $bu["clave"];	
		$user = $bu["usuario"];
		$to = $login;
		$message = "Los datos de su registro en vendorepuestos son:\n\n";
		$message.= "Usuario: $user\n";
		$message.= "Password: $pass\n\n ";
		$message.= "Atte: vendorepuestos.com\n\n ";
		$send_mail = mail($to, $subject, $message, $headers);
		?>
		<script language="javascript">alert("Sus datos han sido enviados exitosamente!");</script>
	<?		
	}	
	else
	{?>
	<script language="javascript">alert("El email suministrado no se encuentra registrado");</script>
	<? }  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script language="javascript">

function validar_olvido(form_olvido)
{
	if((form_olvido.login.value.indexOf ('@', 0) == -1) || (form_olvido.login.value.indexOf ('.', 0) == -1) ||(form_olvido.login.value.length < 5))
	{ 
    	alert("Debe ingresar un email válido");     
		form_olvido.login.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="banner"><img src="/imagenes/banner_ppla.jpg" width="728" height="90" /></div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_ruta" style="height:30px; padding-top:10px;"><a href="index.php" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/tiendarepuestos/all/1" class="titulo_ruta">Tiendarepuestos</a> > <a href="login.php" class="titulo_ruta">Recuperar Clave</a></div>
    </td>
    <td align="right" valign="top"><a href="/iniciar_sesion/" class="red">Ya esta inscrito? Iniciar Sesión</a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td valign="top">
            <form id="form_olvido" name="form_olvido" method="post" action="/recuperar_datos/" onSubmit="return validar_olvido(this);">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><span class="blue">&iquest;Olvidaste su Contrase&ntilde;a?</span><br />
                    Ingrese el correo con el cual realizo su registro en nuestro sistema y le enviaremos un vinculo para que pueda restablecer su contrase&ntilde;a<br />
                    <input type="text" name="login" class="formt2" /><br />
                    
                    <br />
                    <div style="text-align:right">
                      <input type="hidden" name="usuario_tienda" value="2" />
                      <input type="hidden" name="act" value="olvido" /> 
                    <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /></div>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>
          </td>
        </tr>        
    </table></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
