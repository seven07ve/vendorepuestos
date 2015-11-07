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
	$descripcion = $_POST["descripcion"];
	$imagen = $_POST["imagen"];
	$tipo = $_POST["tipo"];
	$archivo = $_POST["archivo"];
	$id_menu = $_POST["id_menu"];
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];
	$insert = mysql_query("INSERT INTO publicaciones (titulo,descripcion,imagen,tipo,archivo, fecha,id_menu,id_submenu,id_submenu2) VALUES ('$titulo','$descripcion','$imagen',$tipo,'$archivo',NOW(),$id_menu,$id_submenu,$id_submenu2)");
	$id=mysql_insert_id();
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",18,1,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$titulo')");	
	header('location:admin_publicaciones.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$titulo = $_POST["titulo"];
	$descripcion = $_POST["descripcion"];
	$imagen = $_POST["imagen"];
	$tipo = $_POST["tipo"];
	$archivo = $_POST["archivo"];
	$id_menu = $_POST["id_menu"];
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];
	$update = mysql_query("UPDATE publicaciones SET titulo='$titulo',descripcion='$descripcion',imagen='$imagen',tipo=$tipo,archivo='$archivo', id_menu=$id_menu, id_submenu=$id_submenu, id_submenu2=$id_submenu2 WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",18,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$titulo')");	
	header('location:admin_publicaciones.php');
	}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$publicacion=mysql_fetch_array(mysql_query("SELECT * FROM publicaciones WHERE id=$id"));
	$titulo=$publicacion["titulo"];
	$delete = mysql_query("DELETE FROM publicaciones WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",18,3,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$titulo')");	
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
		if(confirm('Esta seguro que desea eliminar esta publicación?')){
			window.location.href='admin_publicaciones.php?o=eliminar&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Publicaciones</strong></td>
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
            <td><a href="admin_publicaciones_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
        <!-- FINAL SUBMENU -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap">Publicaciones</td>
</tr>
<tr>
<td>
<?php 
if($_SESSION['administrador']==1)
	$sql = "SELECT * FROM publicaciones ORDER BY id";
else
{
	$id_menu=explode(',',$_SESSION["id_menu"]);
	$id_submenu=explode(',',$_SESSION["id_submenu"]);
	$id_submenu2=explode(',',$_SESSION["id_submenu2"]);
	$sql="";
	for($i=0;$i<count($id_menu);$i++)
	{
		$sql .= "(SELECT * FROM publicaciones";
		if($id_menu[$i]!=0)
		{
			if($id_submenu2[$i]!=0)
				$sql.=" WHERE id_menu=$id_menu[$i] AND id_submenu=$id_submenu[$i] AND id_submenu2=$id_submenu2[$i]";
			else if($id_submenu[$i]!=0)	
				$sql.=" WHERE id_menu=$id_menu[$i] AND id_submenu=$id_submenu[$i]";
			else	
				$sql.=" WHERE id_menu=$id_menu[$i]";
		}
		if($i==count($id_menu)-1) $sql.=")";
		else $sql.=") UNION ";
	}	
	 $sql.=" ORDER BY id";
}
$_pagi_sql=$sql;
$paginacion=mysql_fetch_array(mysql_query("SELECT * FROM paginacion"));
$_pagi_cuantos=$paginacion["publicaciones"];
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="200">T&iacute;tulo</th>
    <th nowrap="nowrap">Men&uacute; Nivel 1</th>
    <th nowrap="nowrap">Men&uacute; Nivel 2</th>
    <th nowrap="nowrap">Men&uacute; Nivel 3</th>
    <th nowrap="nowrap">Tipo</th>
    <th nowrap="nowrap">URL</th>
    <th nowrap="nowrap">&nbsp;</th>
    <th nowrap="nowrap">&nbsp;</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["titulo"]?></td>
    <td nowrap="nowrap"><?=cual_menu($resul["id_menu"])?></td>
    <td nowrap="nowrap"><?=cual_submenu($resul["id_submenu"])?></td>
    <td nowrap="nowrap"><?=cual_submenu2($resul["id_submenu2"])?></td>
    <td nowrap="nowrap"><?php if($resul["tipo"]==1) echo "Documento"; else if($resul["tipo"]==2) echo "URL";?></td>
    <td nowrap="nowrap"><?="/publicaciones/1/".$resul["id_menu"]."/".$resul["id_submenu"]."/".$resul["id_submenu2"];?></td>
    <td nowrap="nowrap"><a href="<?=$resul["archivo"]?>" target="_blank"><img src="imagenes/ver.png" width="20" height="20" border="0" title="Ver Documento"/></a></td>
    <td nowrap="nowrap"><a href="admin_publicaciones_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
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