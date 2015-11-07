<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
if($_POST['guardar']){
	$titulo = $_POST["titulo"];
	$sumario = $_POST["sumario"];
	$texto = $_POST["texto"];
	$id_tipo_usuario = $_POST["id_tipo_usuario"];
	$insert = mysql_query("INSERT INTO contenidos_usuarios (titulo,sumario,texto,fecha,id_tipo_usuario) VALUES ('$titulo','$sumario','$texto',NOW(),$id_tipo_usuario)");
	$id=mysql_insert_id();
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",24,1,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$titulo')");	
	header('location:admin_contenidos_usuarios.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$titulo = $_POST["titulo"];
	$sumario = $_POST["sumario"];
	$texto = $_POST["texto"];
	$id_tipo_usuario = $_POST["id_tipo_usuario"];
    $update = mysql_query("UPDATE contenidos_usuarios SET titulo='$titulo', sumario='$sumario', texto='$texto', id_tipo_usuario=$id_tipo_usuario WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",24,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$titulo')");	
	header('location:admin_contenidos_usuarios.php');
	}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$noticia=mysql_fetch_array(mysql_query("SELECT * FROM contenidos_usuarios WHERE id=$id"));
	$titulo=$noticia["titulo"];
	$delete = mysql_query("DELETE FROM contenidos_usuarios WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",24,3,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$titulo')");	
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
		if(confirm('Esta seguro que desea eliminar este contenido?')){
			window.location.href='admin_contenidos_usuarios.php?o=eliminar&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Contenidos Usuarios Registrados</strong></td>
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
            <td><a href="admin_contenidos_usuarios_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Contenidos</td>
</tr>
<tr>
<td>
<?php 
$sql = "SELECT * FROM contenidos_usuarios ORDER BY fecha DESC";
$_pagi_sql=$sql;
$paginacion=mysql_fetch_array(mysql_query("SELECT * FROM paginacion"));
$_pagi_cuantos=$paginacion["noticias"];
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="80">Fecha</th>
    <th nowrap="nowrap" width="200">Título</th>
    <th nowrap="nowrap">Tipo de Usuario</th>
    <th nowrap="nowrap">&nbsp;</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=date('d/m/Y',strtotime($resul["fecha"]))?></td>
    <td nowrap="nowrap"><?=$resul["titulo"]?></td>
    <td nowrap="nowrap"><?=cual_tipo_usuario($resul["id_tipo_usuario"])?></td>
    <td nowrap="nowrap"><a href="admin_contenidos_usuarios_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
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