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
	$id_menu = $_POST["id_menu"];
	$id_categoria = cual_id_categoria($id_menu);
	$insert = mysql_query("INSERT INTO submenu (nombre,id_categoria,id_menu) VALUES ('$nombre','$id_categoria',$id_menu)");
	$id=mysql_insert_id();
	header('location:admin_submenu.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$id_menu = $_POST["id_menu"];	
	$id_categoria = cual_id_categoria($id_menu);
	$update = mysql_query("UPDATE submenu SET nombre='$nombre', id_categoria='$id_categoria',id_menu='$id_menu' WHERE id=$id");
	header('location:admin_submenu.php');
	}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$delete = mysql_query("DELETE FROM submenu WHERE id=$id");
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
		if(confirm('Esta seguro que desea eliminar esta opción del menú nivel 2?')){
			window.location.href='admin_submenu.php?o=eliminar&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Opciones men&uacute; nivel 2</strong></td>
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
            <td><a href="admin_submenu_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
        <!-- FINAL SUBMENU -->
        
        <!-- BUSCADOR-->
        <form action="admin_submenu.php" method="post" name="form1" id="form1">
          <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados" width="800">
            <tr>
              <td colspan="2" nowrap="nowrap" class="tabla_titulo"> Buscar (<a href="admin_submenu.php?mostrar_todo=si">Mostrar todo</a>)</td>
            </tr>
            <tr>
              <td width="33%" class="desc">Nombre:</td>
              <td class="campo"><input name="titulo" type="text" class="form" size="50" value=""/></td>
            </tr>
            <tr>
              <td class="desc">Categoria / Menu Nivel 1:</td>
              <td class="campo"><select name="id_menu" class="form">
                <option value="0">Seleccionar</option>
                <?php 
$sql_menu=mysql_query("SELECT sm.nombre categoria, m.id, m.nombre menu FROM categoria sm INNER JOIN menu m ON m.id_categoria=sm.id ORDER BY sm.nombre ASC, m.orden ASC");
while($menu=mysql_fetch_array($sql_menu)){
?>
                <option value="<?=$menu["id"]?>">
                  <?=$menu["categoria"]?>
                  -
                  <?=$menu["menu"]?>
                  </option>
                <?php }?>
              </select></td>
              </tr>
            <tr>
              <td colspan="2" class="tabla_botones"><input type="hidden" name="buscar" value="1"/>
                  <img src="imagenes/cancelar.png" style="cursor:pointer;" onclick="document.form1.reset();"/>
                  <input type="image" src="imagenes/buscar.png" name="buscar" value="Enviar" /></td>
            </tr>
          </table>
        </form>
        <!-- FINAL BUSCADOR -->
        <br /><br />
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Opciones [<a href="ordenar_submenu.php">Ordenar</a>] </td>
</tr>
<tr>
<td>
<?php 
if($_GET["mostrar_todo"]=="si")
{
	$_SESSION["titulo"]="";
	$_SESSION["id_menu"]="";
	$_SESSION["buscar"]="";
}
if($_POST["buscar"] || $_SESSION["buscar"]!="") 
{
	$_SESSION["buscar"] = 1;
	if($_POST["titulo"]!="" || $_SESSION["titulo"]!="")
	{
		if(isset($_POST["titulo"])) $_SESSION["titulo"]=$_POST["titulo"]; 
		$_pagi_sql = "SELECT sm.id, sm.nombre submenu, m.nombre menu, m.id_categoria idc FROM submenu sm INNER JOIN menu m ON m.id=sm.id_menu WHERE sm.nombre LIKE '%".$_SESSION["titulo"]."%' ORDER BY m.orden ASC,sm.orden ASC";
	}
	if($_POST["id_menu"]!=0 || $_SESSION["id_menu"]!="")
	{
		if(isset($_POST["id_menu"])) $_SESSION["id_menu"]=$_POST["id_menu"]; 
		$_pagi_sql = "SELECT sm.id, sm.nombre submenu, m.nombre menu, m.id_categoria idc FROM submenu sm INNER JOIN menu m ON m.id=sm.id_menu WHERE m.id='".$_SESSION["id_menu"]."' ORDER BY m.orden ASC,sm.orden ASC";
	}
}
else
{
	$_pagi_sql = "SELECT sm.id, sm.nombre submenu, m.nombre menu, m.id_categoria idc FROM submenu sm INNER JOIN menu m ON m.id=sm.id_menu ORDER BY m.orden ASC,sm.orden ASC";
}

include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <th nowrap="nowrap" width="80">Nombre</th>
    <th nowrap="nowrap" width="200">Categoria</th>
    <th nowrap="nowrap">Men&uacute; Nivel 1</th>
    <th nowrap="nowrap">&nbsp;</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["submenu"]?></td>
    <td nowrap="nowrap"><?=cual_categoria($resul["idc"]);?></td>
    <td nowrap="nowrap"><?=$resul["menu"]?></td>
    <td nowrap="nowrap"><a href="admin_submenu_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
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