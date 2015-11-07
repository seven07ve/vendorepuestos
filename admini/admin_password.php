<? 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
if($_POST['editar']){
	$contrasena = $_POST["contrasena"];
	$update = mysql_query("UPDATE admin SET contrasena='$contrasena' WHERE id=".$_SESSION["id_usuario"]."");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",20,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'Contraseña')");	
	echo "<script>alert('La contraseña fue actualizada satisfactoriamente');</script>";
	header('location:admin_password.php');
}
$sql = "SELECT * FROM admin WHERE id=".$_SESSION["id_usuario"]."";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
function validar(formy)
{
	if(formy.contrasena.value=="")
	{
		alert("Debe ingresar la contraseña");
		formy.contrasena.focus();
		return false;
	}
	if(formy.confirmacion.value=="")
	{
		alert("Debe ingresar la confirmación de la contraseña");
		formy.confirmacion.focus();
		return false;
	}
	if(formy.contrasena.value!=formy.confirmacion.value)
	{
		alert("Las contraseñas no coinciden");
		formy.contrasena.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<? include("includes/header.php");?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Cambiar Contrase&ntilde;a</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU -->
        <!-- FINAL SUBMENU -->
        
		<form action="admin_password.php" method="post" name="form1" onsubmit="return validar(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Cambiar Contrase&ntilde;a</td>
</tr>

<tr>
  <td class="desc">Nueva Contrase&ntilde;a:</td>
  <td class="campo"><input name="contrasena" type="password" class="form" size="50" value="<?=$resul["contrasena"]?>"/></td>
</tr>
<tr>
  <td class="desc">Confirmar Contrase&ntilde;a:</td>
  <td class="campo"><input name="confirmacion" type="password" class="form" size="50" value="<?=$resul["contrasena"]?>"/></td>
</tr>
<tr>
  <td colspan="2" class="tabla_botones">
  <input type="hidden" name="id" value="<?=$resul["id"]?>"/>
  <input type="hidden" name="editar" value="1"/>
  <input type="image" src="imagenes/guardar.png" name="editar" id="editar" value="Enviar" /></td>
  </tr>
</table>               
          </form>
          <br />
          <br />          
          <!-- Termina Contenido -->        </td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="1" bgcolor="#666666"></td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php mysql_close($db);?>