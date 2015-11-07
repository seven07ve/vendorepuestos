<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
$id_usuario=$_GET["id_usuario"];
if($_POST['guardar']){
	$id_menu = $_POST["id_menu"];
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];
	$insert=mysql_query("INSERT INTO admin_permiso(id_admin, id_menu, id_submenu, id_submenu2) VALUES($id_usuario,$id_menu, $id_submenu, $id_submenu2)");
	$id=mysql_insert_id();
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",23,1,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'".cual_menu($id_menu)."->".cual_submenu($id_submenu)."->".cual_submenu2($id_submenu2).", Usuario: ".cual_admin($id_usuario)."')");	
	header('location:admin_usuarios_permiso.php?id_usuario='.$id_usuario.'');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$id_menu = $_POST["id_menu"];
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];	
	$update=mysql_query("UPDATE admin_permiso SET id_menu=$id_menu, id_submenu=$id_submenu, id_submenu2=$id_submenu2 WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",23,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'".cual_menu($id_menu)."->".cual_submenu($id_submenu)."->".cual_submenu2($id_submenu2).", Usuario: ".cual_admin($id_usuario)."')");
	header('location:admin_usuarios_permiso.php?id_usuario='.$id_usuario.'');
	}	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$permiso=mysql_fetch_array(mysql_query("SELECT * FROM admin_permiso WHERE id=$id"));
	$id_menu = $permiso["id_menu"];
	$id_submenu = $permiso["id_submenu"];
	$id_submenu2 = $permiso["id_submenu2"];
	$delete=mysql_query("DELETE FROM admin_permiso WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",23,3,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'".cual_menu($id_menu)."->".cual_submenu($id_submenu)."->".cual_submenu2($id_submenu2).", Usuario: ".cual_admin($id_usuario)."')");
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
		if(confirm('Esta seguro que desea eliminar este permiso de usuario?')){
			window.location.href='admin_usuarios_permiso.php?id_usuario=<?=$id_usuario?>&o=eliminar&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Permisos de Usuario</strong></td>
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
            <td><a href="admin_usuarios_permiso_agregar.php?id_usuario=<?=$id_usuario?>"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
        <!-- FINAL SUBMENU -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Permisos de Usuario</td>
</tr>
<tr>
<td>
<?php 
$sql = "SELECT * FROM admin_permiso WHERE id_admin=$id_usuario ORDER BY id";
$res = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap">Men&uacute; Nivel 1</th>
    <th nowrap="nowrap">Men&uacute; Nivel 2</th>
    <th nowrap="nowrap">Men&uacute; Nivel 3</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($res)){?>
   <tr>
     <td nowrap="nowrap"><?=cual_menu($resul["id_menu"])?></td>
     <td nowrap="nowrap"><?=cual_submenu($resul["id_submenu"])?></td>
     <td nowrap="nowrap"><?=cual_submenu2($resul["id_submenu2"])?></td>
    <td nowrap="nowrap"><a href="admin_usuarios_permiso_editar.php?id_usuario=<?=$resul["id_admin"]?>&id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="javascript:eliminar(<?=$resul["id"]?>)"><img src="imagenes/eliminar.png" width="20" height="20" border="0" /></a></td>
  </tr> 
  <?php }?>
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