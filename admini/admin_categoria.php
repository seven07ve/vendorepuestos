<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
if($_POST['guardar']){
	$nombre = $_POST["nombre"];
	$presentacion = $_POST["presentacion"];
	$insert = mysql_query("INSERT INTO categoria (nombre,presentacion) VALUES ('$nombre','$presentacion')");
	header('location:admin_categoria.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$presentacion = $_POST["presentacion"];
	$update = mysql_query("UPDATE categoria SET nombre='$nombre',presentacion='$presentacion' WHERE id=$id");
	header('location:admin_categoria.php');
	}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$delete = mysql_query("DELETE FROM categoria WHERE id=$id");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
	function eliminar(_id){
		if(confirm('Esta seguro que desea eliminar esta categorķa?')){
			window.location.href='admin_categoria.php?o=eliminar&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Categor&iacute;as</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBcategoria -->
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_categoria_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBcategoria -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Categorķas</td>
</tr>
<tr>
<td>
<?php 
$_pagi_sql = "SELECT * FROM categoria ORDER BY id";
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="80">Nombre</th>
    <th nowrap="nowrap">Presentacion</th>
    <th nowrap="nowrap">&nbsp;</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["nombre"]?></td>
    <td nowrap="nowrap"><? if($resul["presentacion"]==1) echo "Nivel 2"; else echo "Logos";?></td>
    <td nowrap="nowrap"><a href="admin_categoria_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="javascript:eliminar(<?=$resul["id"]?>)"><img src="imagenes/eliminar.png" width="20" height="20" border="0" /></a></td>
  </tr> 
  <?php }?>
</table></td>
</tr>
<tr>
  <td><table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="texto" height="25"><?=$_pagi_navegacion;?></td>
                </tr>
              </table></td>
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