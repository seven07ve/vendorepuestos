<?php
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
if(@$_GET["buscar"]==1)
{
	$id_menu=explode(",",$_SESSION["id_menu"]);
	$menu=$_GET["menu"];
	$id_submenu=explode(",",$_SESSION["id_submenu"]);
	if($id_menu[array_search($menu,$id_menu)]==$menu)
		$submenu=$id_submenu[array_search($menu,$id_menu)];
	else
		$submenu=0;	
	echo "<select name='id_submenu' class='form'>";
	if($_SESSION["administrador"]==1 || $submenu==0) 
		echo "<option value='0'>No aplica</option>";
	$sql_submenu=mysql_query("SELECT * FROM submenu WHERE id_menu=$menu");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		if($_SESSION["administrador"]==1 || $submenu==0 || in_array($resul_submenu["id"],$id_submenu)){
		echo "<option value='".$resul_submenu["id"]."'";
		if(($submenu==$resul_submenu["id"] && $_GET["submenu"]==0) || $_GET["submenu"]==$resul_submenu["id"]) echo " selected";
		echo ">".utf8_encode($resul_submenu["nombre"])."</option>";	
		}
	}	
	echo "</select>";
	return;
}
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
	if(formy.id_menu.value==0)
	{
		alert("Debe seleccionar el menú nivel 1");
		formy.id_menu.focus();
		return false;
	}
	if(formy.id_submenu.value==0)
	{
		alert("Debe seleccionar el menú nivel 2");
		formy.id_submenu.focus();
		return false;
	}
	return true;
}
function cargar_submenu(menu,submenu)
{
	new Ajax.Request("admin_submenu2_agregar.php?buscar=1&menu="+menu+"&submenu="+submenu,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu').update(transport.responseText);
	}
	});
}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Opciones men&uacute; nivel 3</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_submenu2.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
		<form action="admin_submenu2.php" method="post" name="form1" onsubmit="return validar(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Agregar Opci&oacute;n</td>
</tr>
<tr>
  <td class="desc">Nombre:</td>
  <td class="campo"><input name="nombre" type="text" class="form" size="50" /></td>
</tr>
<tr>
  <td height="41" class="desc">Categoria / Men&uacute; Nivel 1:</td>
  <td class="campo"><select class="form" name="id_menu" onchange="cargar_submenu(this.value,0);">
   <option value="0">Seleccione</option>
    <?php 
	$sql_menu=mysql_query("SELECT sm.nombre categoria, m.id, m.nombre menu FROM categoria sm INNER JOIN menu m ON m.id_categoria=sm.id ORDER BY sm.nombre ASC, m.orden ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?>
    <option value="<?=$menu["id"]?>"><?=$menu["categoria"];?> - <?=$menu["menu"]?>
    </option>
    <?php 
	}?>
  </select></td>
</tr>
<tr>
  <td height="41" class="desc">Men&uacute; Nivel 2:</td>
  <td class="campo" id="submenu"><select class="form" name="id_submenu">
    <option value="0">No aplica</option>
  </select></td>
</tr>
<script>cargar_submenu('<?=$id_menu[0]?>','0');</script>
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