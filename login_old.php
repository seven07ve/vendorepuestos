<? 
include("conexion.php");
session_start();
include("funciones.php");

if($_POST['act']=="login")
{
  	$login = $_POST["login"];
	$clave = $_POST["clave"];
	$usuario_tienda = $_POST["usuario_tienda"];
	$id_user = autenticar($login,$clave,$usuario_tienda);//echo "id_user=$id_user";
	if($id_user!=0)
	{
		$_SESSION['userid'] = $id_user;
		$_SESSION['usertipo'] = $usuario_tienda;
		?>
			<script language="javascript">alert("Bienvenid@ a Tiendarepuesto.com"); window.location="cuenta.php";</script>
		<?
	}
	else
	{?>
		<script language="javascript">alert("Por favor verifique sus datos de acceso y que su cuenta este activa"); window.location="login.php";</script>
	<? }  
}
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
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validar_login(form_login)
{
	if(form_login.login.value=="")
	{ 
    	alert("Debe ingresar un email válido para iniciar sesión");     
		form_login.login.focus();
		return false;
	}
	if(form_login.clave.value=="")
	{
		alert("Debe completar el campo clave para iniciar sesión");
		form_login.clave.focus();
		return false;
	}
	return true;
}
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
<div id="banner"><img src="imagenes/banner_ppla.jpg" width="728" height="90" /></div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_seccion" style="height:30px;">Ingresar a mis Anuncios</div><br /></td>
  </tr>
  <tr>
    <td valign="top"><table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td class="tituc"> 
          <form id="form_login" name="form_login" method="post" action="login.php" onSubmit="return validar_login(this);">
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><span class="blue">Usuario</span><br />
              <input type="text" name="login" class="formt2" /></td>
            </tr>
            <tr>
              <td><span class="blue">Contrase&ntilde;a</span><br />
              <input type="password" name="clave" class="formt2" /></td>
            </tr>
            <tr>
              <td><input name="usuario_tienda" type="radio" value="2" checked="checked" />Tiendarepuesto <input name="usuario_tienda" type="radio" value="1" />Cliente Premium<br />
              <div style="text-align:right">
                <input type="hidden" name="act" value="login" />
                <input name="" type="image"  value="Submit" src="imagenes/btn_send.jpg" />
              </div></td>
            </tr>
          </table>
          </form>
          </td>
          <td width="1" rowspan="2" valign="top" bgcolor="#D3D3D3"></td>
          <td rowspan="2" valign="top">
          <form id="form_olvido" name="form_olvido" method="post" action="registro.php" onSubmit="return validar_olvido(this);">
          <table border="0" cellpadding="0" cellspacing="0">
  			<tr>
    			<td><span class="blue">&iquest;Olvid&oacute; su Contrase&ntilde;a?</span><br />
            Ingrese el correo con el cual realizo su registro en nuestro sistema y le enviaremos un vinculo para que pueda restablecer su contrase&ntilde;a<br />
            <br />
            <input type="text" name="login" class="formt2" /><br />
            <input name="usuario_tienda" type="radio" value="2" checked="checked" />Tiendarepuesto <input name="usuario_tienda" type="radio" value="1" />Persona Natural<br />
  <span class="tituc"><br />
 <div style="text-align:right">
   <input type="hidden" name="act" value="olvido" /> 
   <input name="" type="image"  value="Submit" src="imagenes/btn_send.jpg" /></div>
  </span></td>
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
