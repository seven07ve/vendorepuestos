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
		$nombretr = cual_nombre_carpeta($_SESSION["userid"]);
		?>
			<script language="javascript">/*alert("Bienvenid@ a Tiendarepuesto.com");*/ window.location="/bienvenidoTR/<?=$nombretr?>/";</script>
		<?
	}
	else
	{?>
		<script language="javascript">alert("Por favor verifique sus datos de acceso y que su cuenta este activa"); window.location="/iniciar_sesion/";</script>
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

</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="banner"></div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_ruta" style="height:30px; padding-top:10px;"><a href="index.php" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/tiendarepuestos/all/1" class="titulo_ruta">Tiendarepuestos</a> > <a href="login.php" class="titulo_ruta">Iniciar Sesi&oacute;n</a></div>
    </td>
    <td align="right" valign="top">
    <a href="/registroTR/" class="blue">¿Deseas una TIENDAREPUESTOS?</a>
    <!-- <a href="/iniciar_sesion/" class="blue">¿Ya esta inscrito? Mi TIENDAREPUESTOS</a> -->
    </td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td class="tituc"> 
	          <form id="form_login" name="form_login" method="post" action="/iniciar_sesion/" onSubmit="return validar_login(this);">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<div class="blue" id="ingreso">Entrar a Mi TIENDAREPUESTOS </div>
							<img src="/imagenes/ico-user.jpg" alt="" /><input type="text" name="login" class="formt2 login-user" placeholder=" Usuario"/>
						</td>
					</tr>
					<tr>
						<td>
							<img src="/imagenes/ico-pass.jpg" alt="" /><input type="password" name="clave" class="formt2 login-user"  placeholder=" Contrase&ntilde;a"/>
						</td>
					</tr>
					<tr>
						<td>
							<div style="text-align:center">
								<input type="hidden" name="usuario_tienda" value="2" />
								<input type="hidden" name="act" value="login" />
								<br><br>
								<input type="submit" name="submit" id="submit" value="Ingresar" class="login-button">
								<br><br>
								<a href="/recuperar_datos/" class="blue">&iquest;Olvidaste tu Contrase&ntilde;a?</a>
								<!-- <input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /> -->
							</div>
						</td>
					</tr>
	          		</table>
	             </form>
          </td>
          <td width="1" rowspan="4" valign="top" bgcolor="#D3D3D3"></td>
          <td width="300" rowspan="4" align="center" valign="middle">
          <script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
		<script language='JavaScript' type='text/javascript'>
		<!--
		   if (!document.phpAds_used) document.phpAds_used = ',';
		   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
		   
		   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
		   document.write ("http://vendorepuestos.com.ve/publicidad/adjs.php?n=" + phpAds_random);
		   document.write ("&amp;what=zone:7");
		   document.write ("&amp;exclude=" + document.phpAds_used);
		   if (document.referrer)
		      document.write ("&amp;referer=" + escape(document.referrer));
		   document.write ("'><" + "/script>");
		//-->
		</script>
		<noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=aba8c689' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:7&amp;n=aba8c689' border='0' alt=''></a></noscript>
		</td>
        </tr>
        <tr>
          <td class="tituc">
          <form name="form_reg" method="post" action="/registroTR/">
          <input name="usuario_tienda" type="hidden" value="2"/>
          <input type="hidden" name="paso" value="1" />
          <div align="center">
            <a href="/registroTR/" class="blue">¿Deseas una TIENDAREPUESTOS?</a><br />
          </div>
          <!-- <input name="" type="image"  value="Submit" src="/imagenes/btn_inscribete.jpg" /><br />-->
            <!-- <img src="/imagenes/icon_tr.jpg" width="33" height="25" hspace="5" vspace="5" /> -->
            
            </form>
          </td>
        </tr>        
    </table></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
