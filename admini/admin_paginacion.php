<?
session_start();
if (!isset($_SESSION['admin'])) {
 header("Location: index.php");
 exit;
} 
require("../conexion.php");
$action="";$id=1;$A="";
if(isset($_POST["action"]))$action=$_POST["action"];
$id=1;$imagen="";
if($action==1)
{
	$id=$_POST["id"];
	$buscador=$_POST["buscador"];
	$eventos=$_POST["eventos"];
	$noticias=$_POST["noticias"];
	$publicaciones=$_POST["publicaciones"];
	$usuarios_registrados=$_POST["usuarios_registrados"];	
	$actualizar=mysql_query("UPDATE paginacion SET buscador=$buscador, eventos=$eventos, noticias=$noticias, publicaciones=$publicaciones, usuarios_registrados=$usuarios_registrados WHERE id=$id"); 
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",17,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'Paginación')");	
	$id=1;$imagen="";
}
$ver=mysql_query("SELECT * FROM paginacion WHERE id=$id");
while($vp=mysql_fetch_array($ver))
{
	$id=$vp["id"];
	$buscador=$vp["buscador"];
	$eventos=$vp["eventos"];
	$noticias=$vp["noticias"];
	$publicaciones=$vp["publicaciones"];
	$usuarios_registrados=$vp["usuarios_registrados"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validar(formy)
{
	if(formy.buscador.value=="")
	{
		alert("Debe ingresar el número de resultados por página para el buscador");
		formy.buscador.focus();
		return false;
	}
	if(formy.eventos.value=="")
	{
		alert("Debe ingresar el número de resultados por página para los eventos");
		formy.eventos.focus();
		return false;
	}
	if(formy.noticias.value=="")
	{
		alert("Debe ingresar el número de resultados por página para las noticias");
		formy.noticias.focus();
		return false;
	}
	if(formy.publicaciones.value=="")
	{
		alert("Debe ingresar el número de resultados por página para las publicaciones");
		formy.publicaciones.focus();
		return false;
	}
	if(formy.usuarios_registrados.value=="")
	{
		alert("Debe ingresar el número de resultados por página para los contenidos de los usuarios registrados");
		formy.usuarios_registrados.focus();
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
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Paginaci&oacute;n</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU -->
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="index.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_paginacion.php" method="post" name="form1">
		  <table width="450" border="0" cellpadding="0" cellspacing="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Editar paginaci&oacute;n</td>
</tr>
<tr class="tabla">
  <td width="350" class="desc">Resultados por p&aacute;gina buscador:</td>
  <td width="100" class="campo"><input name="buscador" type="text" class="form" size="5" value="<?=$buscador?>" /></td>
</tr>
<tr class="tabla">
  <td class="desc">Resultados por p&aacute;gina eventos:</td>
  <td class="campo"><input name="eventos" type="text" class="form" size="5" value="<?=$eventos?>" /></td>
</tr>
<tr class="tabla">
  <td class="desc">Resultados por p&aacute;gina noticias:</td>
  <td class="campo"><input name="noticias" type="text" class="form" size="5" value="<?=$noticias?>" /></td>
</tr>
<tr class="tabla">
  <td class="desc">Resultados por p&aacute;gina publicaciones:</td>
  <td class="campo"><input name="publicaciones" type="text" class="form" size="5" value="<?=$publicaciones?>" /></td>
</tr>
<tr class="tabla">
  <td class="desc">Resultados por p&aacute;gina contenidos usuarios registrados:</td>
  <td class="campo"><input name="usuarios_registrados" type="text" class="form" size="5" value="<?=$usuarios_registrados?>" /></td>
</tr>
<tr>
  <td colspan="2" class="tabla_botones"><input type="hidden" name="id" value="<? echo $id;?>" />
    <input type="hidden" name="action" value="1" />
    <input type="image" src="imagenes/guardar.png" name="editar" id="editar" value="Enviar" onclick="return validar(this.form);" /></td>
  </tr>
</table>               
          </form>
		   <!-- Termina Contenido --></td>
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