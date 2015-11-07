<? 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
if(@$_GET["buscar"]==1)
{
	echo "<select name='id_submenu' class='form' onchange='cargar_submenu2(this.value,0);'>";
	echo "<option value='0'>No aplica</option>";
	$sql_submenu=mysql_query("SELECT * FROM submenu WHERE id_menu=".$_GET["id_menu"]."");
	while($submenu = mysql_fetch_array($sql_submenu))
	{
		echo "<option value='".$submenu["id"]."'";
		if($_GET["id_submenu"]==$submenu["id"]) echo " selected";
		echo ">".utf8_encode($submenu["nombre"])."</option>";	
	}	
	echo "</select>";
	return;
}
else if(@$_GET["buscar"]==2)
{
	echo "<select name='id_submenu2' class='form'>";
	echo "<option value='0'>No aplica</option>";
	$sql_submenu=mysql_query("SELECT * FROM submenu2 WHERE id_submenu=".$_GET["id_menu"]."");
	while($submenu = mysql_fetch_array($sql_submenu))
	{
		echo "<option value='".$submenu["id"]."'";
		if($_GET["id_submenu"]==$submenu["id"]) echo " selected";
		echo ">".utf8_encode($submenu["nombre"])."</option>";	
	}	
	echo "</select>";
	return;
}
$id = $_GET['id'];	
$sql = "SELECT * FROM admin WHERE id=$id";
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
	if(formy.nombre.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.nombre.focus();
		return false;
	}
	if(formy.usuario.value=="")
	{
		alert("Debe ingresar el usuario");
		formy.usuario.focus();
		return false;
	}
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
function cargar_submenu(menu,submenu)
{
	new Ajax.Request("admin_usuarios_editar.php?buscar=1&id_menu="+menu+"&id_submenu="+submenu,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu').update(transport.responseText);
	}
	});
}
function cargar_submenu2(menu,submenu)
{
	new Ajax.Request("admin_usuarios_editar.php?buscar=2&id_menu="+menu+"&id_submenu="+submenu,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu2').update(transport.responseText);
	}
	});
}
</script>
</head>
<body>
<? include("includes/header.php");?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Usuario</strong></td>
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
            <td><a href="admin_usuarios.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="admin_usuarios_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_usuarios.php" method="post" name="form1" onsubmit="return validar(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Editar Usuario</td>
</tr>
<tr>
  <td class="desc">Nombre:</td>
  <td class="campo"><input name="nombre" type="text" class="form" size="50" value="<?=$resul["nombre"]?>"/></td>
</tr>
<tr>
  <td class="desc">Usuario:</td>
  <td class="campo"><input name="usuario" type="text" class="form" size="50" value="<?=$resul["usuario"]?>"/></td>
</tr>
<tr>
  <td class="desc">Contrase&ntilde;a:</td>
  <td class="campo"><input name="contrasena" type="password" class="form" size="50" value="<?=$resul["contrasena"]?>"/></td>
</tr>
<tr>
  <td class="desc">Confirmar Contrase&ntilde;a:</td>
  <td class="campo"><input name="confirmacion" type="password" class="form" size="50" value="<?=$resul["contrasena"]?>"/></td>
</tr>
<tr>
  <td height="41" class="desc">Administrador:</td>
  <td class="campo"><select class="form" name="administrador" onchange="cargar_tipo(this.value);">
    <option value="1" <?php if($resul["administrador"]==1) echo "selected";?>>S&iacute;</option>
    <option value="0" <?php if($resul["administrador"]==0) echo "selected";?>>No</option>
  </select></td>
</tr>

<script>cargar_submenu('<?=$resul["id_menu"]?>','<?=$resul["id_submenu"]?>');</script>

<script>cargar_submenu2('<?=$resul["id_submenu"]?>','<?=$resul["id_submenu2"]?>');</script>
<script>cargar_tipo('<?=$resul["administrador"]?>');</script>
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