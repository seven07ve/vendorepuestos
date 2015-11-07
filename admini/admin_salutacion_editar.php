<? 
include "../conexion.php";
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
$id = $_GET['id'];	
$sql = "SELECT * FROM salutacion WHERE id=$id";
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
function cargar_submenu(menu,submenu,submenu2)
{
	new Ajax.Request("funciones_ajax.php?buscar=1&menu="+menu+"&submenu="+submenu+"&submenu2="+submenu2,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu').update(transport.responseText);
	}
	});
}
function cargar_submenu2(submenu,submenu2)
{
	new Ajax.Request("funciones_ajax.php?buscar=2&submenu="+submenu+"&submenu2="+submenu2,{
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
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Salutacion</strong></td>
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
            <td><a href="admin_salutacion.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
            <td>&nbsp;&nbsp;</td>
            </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_salutacion.php" method="post" enctype="multipart/form-data" name="form1">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
  <td colspan="2" class="tabla_titulo">Editar Salutacion</td>
</tr>
<tr>
  <td class="desc">Texto:</td>
  <td class="campo"><input name="texto" type="text" class="form" size="50" value="<?=$resul["texto"]?>" /></td>
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