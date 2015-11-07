<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
if($_POST['guardar']){
	$nombre = $_POST["nombre"];
	$usuario = $_POST["usuario"];
	$contrasena = $_POST["contrasena"];
	$administrador = $_POST["administrador"];
	if(mysql_num_rows(mysql_query("SELECT * FROM admin WHERE usuario='$usuario'"))==0)
	{
		$insert = mysql_query("INSERT INTO admin (nombre, usuario,contrasena, administrador) VALUES ('$nombre','$usuario','$contrasena', $administrador)");
		$id=mysql_insert_id();
		$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",19,1,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$nombre')");	
	}
	else
	{
		echo "<script>alert('El usuario ya existe, por favor inténtelo nuevamente');</script>";
	}	
	header('location:admin_usuarios.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$usuario = $_POST["usuario"];
	$contrasena = $_POST["contrasena"];
	$administrador = $_POST["administrador"];
	$update = mysql_query("UPDATE admin SET nombre='$nombre', usuario='$usuario', contrasena='$contrasena', administrador=$administrador WHERE id=$id");
	if($administrador==1) $delete_permiso=mysql_query("DELETE FROM admin_permiso WHERE id_admin=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",19,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$nombre')");	
	header('location:admin_usuarios.php');
}
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$usuario=mysql_fetch_array(mysql_query("SELECT * FROM admin WHERE id=$id"));
	$nombre=$usuario["nombre"];
	$delete = mysql_query("DELETE FROM admin WHERE id=$id");
	$delete_permiso=mysql_query("DELETE FROM admin_permiso WHERE id_admin=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",19,3,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$nombre')");	
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
		if(confirm('Esta seguro que desea eliminar este usuario?')){
			window.location.href='admin_usuarios.php?o=eliminar&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Usuarios</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU -->
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_usuarios_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
       <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados" align="center">
		<tr>
			<td class="tabla_titulo" nowrap="nowrap" align="center">
            | <a href="admin_usuarios.php" class="textobold">Todos</a> |
            <a href="admin_usuarios.php?adm=1" class="textobold">Administradores</a> |<br />
            | 
			<?
            for ($i=97; $i<123; $i++) 
            {
            ?>
                <a href="admin_usuarios.php?letra=<? echo chr($i) ?>" class="textobold"><? echo chr($i) ?></a> |
                  <?
            }
            ?>
		</td>
	</tr>
</table>  
<br />  
        <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Usuarios</td>
</tr>
<tr>
<td>
<?php 
if(isset($_GET["letra"]))
{
	$letra=$_GET["letra"];
	$_pagi_sql = "SELECT * FROM admin WHERE SUBSTRING(nombre,1,1)='$letra' OR SUBSTRING(usuario,1,1)='$letra' ORDER BY id";
}	
else if(isset($_GET["adm"]) and $_GET["adm"]==1)
	$_pagi_sql = "SELECT * FROM admin WHERE administrador=1 ORDER BY id";	
else
	$_pagi_sql = "SELECT * FROM admin ORDER BY id";	
$_pagi_cuantos=10;
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="190">Nombre</th>
    <th width="71" nowrap="nowrap">Usuario</th>
    <th width="71" nowrap="nowrap">Administrador</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["nombre"]?></td>
    <td nowrap="nowrap"><?=$resul["usuario"]?></td>
    <td nowrap="nowrap" align="center"><?=es_administrador($resul["administrador"])?></td>
    <td nowrap="nowrap"><?php if($resul["administrador"]==0){?><a href="admin_usuarios_permiso.php?id_usuario=<?=$resul["id"]?>"><img src="imagenes/ver.png" width="20" height="20" border="0" title="Ver Permisos"/></a><?php } else echo "-";?></td>
    <td nowrap="nowrap"><a href="admin_usuarios_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="javascript:eliminar(<?=$resul["id"]?>)"><img src="imagenes/eliminar.png" width="20" height="20" border="0" /></a></td>
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