<?php
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
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
	if(formy.nombre.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.nombre.focus();
		return false;
	}
	if(formy.id_categoria.value==0)
	{
		alert("Debe seleccionar la opci�n Categoria");
		formy.id_categoria.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Opciones men&uacute; nivel 2</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBsubmenu -->
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_menu.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBsubmenu -->
        
		<form action="admin_menu.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validar(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Agregar Opci&oacute;n</td>
</tr>
<tr>
  <td class="desc">Logo (solo presentacion Logo):</td>
  <td class="campo"><input type="file" name="fileField" id="fileField" class="form" /></td>
</tr>
<tr>
  <td class="desc">Nombre:</td>
  <td class="campo"><input name="nombre" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td class="desc">Categoria:</td>
  <td class="campo">
  <select name="id_categoria" class="form">
  <option value="0">Seleccionar</option>
  <?php 
$sql_menu=mysql_query("SELECT * FROM categoria ORDER BY id");
while($menu=mysql_fetch_array($sql_menu)){
?>
  <option value="<?=$menu["id"]?>"><?=$menu["nombre"]?></option>
  <?php }?>
  </select></td>
</tr>
<tr>
  <td colspan="2" class="tabla_botones">
  <input type="hidden" name="guardar" value="1"/>
  <input type="image" src="imagenes/agregar.png" name="guardar" id="guardar" value="Enviar" /></td>
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