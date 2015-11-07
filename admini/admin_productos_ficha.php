<?php
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id=$id";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);
$carpeta = cual_nombre_carpeta($_GET["id_tienda"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />

</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Productos</strong></td>
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
            <td><a href="admin_productos.php?t=<?=$_GET["t"]?>&id_tienda=<?=$_GET["id_tienda"];?>"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="admin_productos_agregar.php?t=<?=$_GET["t"]?>&id_tienda=<?=$_GET["id_tienda"];?>"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_productos.php?id_tienda=<?=$_GET["id_tienda"];?>" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validar(this);">
            <table width="500" border="0" cellpadding="0" cellspacing="0" class="tabla_resultados">

<tr class="tabla">
  <td class="campo"><? if($resul["foto1"]!=""){  ?><img src="../<?=$carpeta?>/productos/<?=$resul["foto1"]?>" height="80" /><? }?></td>
</tr>
<tr>
  <td height="41" class="campo"><? if($resul["foto2"]!=""){  ?><img src="../<?=$carpeta?>/productos/<?=$resul["foto2"]?>" height="80" /><? }?></td>
</tr>
<tr>
  <td height="41" class="campo"><? if($resul["foto3"]!=""){  ?><img src="../<?=$carpeta?>/productos/<?=$resul["foto3"]?>" height="80" /><? }?></td>
</tr>
<tr>
  <td class="campo" height="41"><?=$resul["titulo"];?></td>
</tr>
<tr>
  <td class="campo" height="41"><?=$resul["subtitulo"];?></td>
</tr>
<tr>
  <td class="campo" height="41"><?=$resul["descripcion"];?></td>
</tr>
<tr>
  <td height="41" class="campo"><?=$resul["condicion"];?></td>
</tr>
<tr>
  <td height="41" class="campo"><?=$resul["precio"];?></td>
</tr>
<tr>
  <td height="41" class="campo"><?=$resul["vence"];?></td>
</tr>
<tr>
  <td height="41" class="campo"><?=cual_categoria($resul["id_categoria"])?> - <?=cual_menu($resul["id_menu"])?></td>
</tr>
<tr>
  <td height="41" class="campo"><?=cual_submenu($resul["id_submenu"]);?></td>
</tr>
<tr>
  <td height="41" class="campo" id="submenu2"><?=cual_submenu2($resul["id_submenu2"])?></td>
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