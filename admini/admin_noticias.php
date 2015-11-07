<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
	
if($_POST['editar']){
	$id = $_POST["id"];
	$titulo = $_POST["titulo"];
	$sumario = $_POST["sumario"];
	$texto = $_POST["texto"];
	$link = $_POST["link"];
	
	$update = mysql_query("UPDATE noticias SET titulo='$titulo', sumario='$sumario', texto='$texto', link='$link' WHERE id=$id");
	
	if($_FILES["fileField"]["tmp_name"]!="")
	{
		copy($_FILES["fileField"]["tmp_name"], "../imagenes_noticias/".$_FILES["fileField"]["name"]);
		$update = mysql_query("UPDATE noticias SET foto='".$_FILES["fileField"]["name"]."' WHERE id='$id'");
	}
	header('location:admin_noticias.php');
	}
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
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Noticia Home</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU 
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_noticias_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

         FINAL SUBMENU -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Noticia Home</td>
</tr>
<tr>
<td>
<?php 
$_pagi_sql = "SELECT * FROM noticias ORDER BY id DESC";
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="200">Título</th>
    <th nowrap="nowrap">Link</th>
    <th nowrap="nowrap">&nbsp;</th>
    </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["titulo"]?></td>
    <td nowrap="nowrap"><?=$resul["link"]?></td>
    <td nowrap="nowrap"><a href="admin_noticias_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
    </tr> 
  <?php }?>
</table></td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="6"></td>
                </tr>
                <tr>
                  <td class="texto"><? echo $_pagi_navegacion;?></td>
                </tr>
                <tr>
                  <td height="6"></td>
                </tr>
              </table>
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