<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";

$id_tienda = $_GET["id_tienda"];
$t = $_GET["t"];

if($_POST['guardar']){
	$titulo = str_replace("'",'\"',$_POST["titulo"]);
	$subtitulo = str_replace("'",'\"',$_POST["subtitulo"]);
	$descripcion = $_POST["descripcion"];
	$condicion = $_POST["condicion"];
	$precio = $_POST["precio"];
	$vence = "DATE_ADD(NOW(), INTERVAL 1 MONTH)";
	$id_menu = $_POST["id_menu"];
	$id_categoria = cual_id_categoria($id_menu);
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];
	$id_estado = $_POST["id_estado"];
	$id_ciudad = $_POST["id_ciudad"];

	$insert = mysql_query("INSERT INTO productos (titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu2, usuario_tienda, id_usuario_tienda) VALUES ('$titulo', '$subtitulo', '', '', '', '$descripcion', '$id_estado', '$id_ciudad','$condicion', '$precio', $vence, '$id_categoria', '$id_menu', '$id_submenu', '$id_submenu2', '2', '$id_tienda')");
	//crear carpeta 
	$carpeta = cual_nombre_carpeta($id_tienda);
	$carpeta_productos = "../".$carpeta."/productos";
	mkdir($carpeta_productos, 0777);
	//subir imagenes
	$id = mysql_insert_id();
	
	if($_FILES["file"]["tmp_name"]!="") copy($_FILES["file"]["tmp_name"], $carpeta_productos."/".$_FILES["file"]["name"]);
	$update = mysql_query("UPDATE productos SET foto1='$id_1_".$_FILES["file"]["name"]."' WHERE id='$id'");
	
	if($_FILES["file2"]["tmp_name"]!="") copy($_FILES["file2"]["tmp_name"], $carpeta_productos."/".$_FILES["file2"]["name"]);
	$update = mysql_query("UPDATE productos SET foto2='$id_2_".$_FILES["file2"]["name"]."' WHERE id='$id'");
	
	if($_FILES["file3"]["tmp_name"]!="") copy($_FILES["file3"]["tmp_name"], $carpeta_productos."/".$_FILES["file3"]["name"]);
	$update = mysql_query("UPDATE productos SET foto3='$id_3_".$_FILES["file3"]["name"]."' WHERE id='$id'");
	
	header('location:admin_productos.php?id_tienda='.$id_tienda);
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$titulo = str_replace("'",'\"',$_POST["titulo"]);
	$subtitulo = str_replace("'",'\"',$_POST["subtitulo"]);
	$descripcion = $_POST["descripcion"];
	$condicion = $_POST["condicion"];
	$precio = $_POST["precio"];
	$id_menu = $_POST["id_menu"];
	$id_categoria = cual_id_categoria($id_menu);
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];
	$id_estado = $_POST["id_estado"];
	$id_ciudad = $_POST["id_ciudad"];
	
	$update = mysql_query("UPDATE productos SET titulo='$titulo', subtitulo='$subtitulo', descripcion='$descripcion', id_estado='$id_estado', id_ciudad='$id_ciudad', condicion='$condicion', precio='$precio', id_categoria='$id_categoria', id_menu='$id_menu', id_submenu='$id_submenu', id_submenu2='$id_submenu2' WHERE id='$id'") or die(mysql_error());
	
	//crear carpeta 
	$carpeta = cual_nombre_carpeta($id_tienda);
	$carpeta_productos = "../".$carpeta."/productos";
	//subir imagen
	
	if($_FILES["file"]["tmp_name"]!="") 
	{
		copy($_FILES["file"]["tmp_name"], $carpeta_productos."/".$_FILES["file"]["name"]);
		if(copy($_FILES["file"]["tmp_name"], $carpeta_productos."/".$_FILES["file"]["name"])) $update = mysql_query("UPDATE productos SET foto1='$id_1_".$_FILES["file"]["name"]."' WHERE id='$id'");
	}
	
	if($_FILES["file2"]["tmp_name"]!="") 
	{
		copy($_FILES["file2"]["tmp_name"], $carpeta_productos."/".$_FILES["file2"]["name"]);
		if(copy($_FILES["file2"]["tmp_name"], $carpeta_productos."/".$_FILES["file2"]["name"])) $update = mysql_query("UPDATE productos SET foto2='$id_2_".$_FILES["file2"]["name"]."' WHERE id='$id'");
	}
	
	if($_FILES["file3"]["tmp_name"]!="") 
	{
		copy($_FILES["file3"]["tmp_name"], $carpeta_productos."/".$_FILES["file3"]["name"]);
		if(copy($_FILES["file3"]["tmp_name"], $carpeta_productos."/".$_FILES["file3"]["name"])) $update = mysql_query("UPDATE productos SET foto3='$id_3_".$_FILES["file3"]["name"]."' WHERE id='$id'");
	}
	
	header('location:admin_productos.php?t='.$t.'&id_tienda='.$id_tienda);
}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$sql_tienda = mysql_query("DELETE FROM productos WHERE id='$id'");	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
	function eliminar(_id,_idt){
		if(confirm('Esta seguro que desea eliminar este Producto?')){
			window.location.href='admin_productos.php?o=eliminar&id=' + _id +'&id_tienda=' + _idt ;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Tienda Virtual</strong></td>
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
            <td><a href="admin_productos_agregar.php?t=<?=$t?>&id_tienda=<?=$id_tienda;?>"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
<?php 
if($t==2)
{
$sql = "SELECT * FROM tienda_virtual WHERE id='$id_tienda'";
$res = mysql_query($sql);
$resul = mysql_fetch_array($res);
?>
<table width="200" border="0" cellpadding="0" cellspacing="0" class="tabla_resultados">
  <tr>
    <td><? if($resul["logo"]!=""){ $carpeta = limpiar_cadena($resul["razon_social"]); ?><img src="../<?=$carpeta?>/<?=$resul["logo"]?>" height="50" /><? }?></td>
  </tr>
  <tr>
  <td class="tabla_titulo"><?=$resul["razon_social"]?><br />
    <?=$resul["rif"]?><br />
    <?=$resul["email"]?><br />
    <?=cual_paquete($resul["id_paquete"])?><br />
    <?=$resul["fecha_activacion"]?></td>
</tr>
</table>
<? }
elseif($t==1)
{
	$sql = "SELECT * FROM usuario WHERE id='$id_tienda'";
	$res = mysql_query($sql);
	$resul = mysql_fetch_array($res);
?>
<table width="200" border="0" cellpadding="0" cellspacing="0" class="tabla_resultados">
  <tr>
    <td class="tabla_titulo"><?=$resul["nombre"]?><br />
      <?=$resul["cedula"]?><br />
      <?=$resul["email"]?><br />
      <?=$resul["fecha_activacion"]?></td>
</tr>
</table>
<? }?>
<!-- Termina Contenido -->
<br />
<table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados" align="left">
          <tr>
            <td class="tabla_titulo" nowrap="nowrap" align="center"> | <a href="admin_productos.php?t=2&id_tienda=<?=$id_tienda?>" class="textobold">Todos</a> |<br />
              |
              <?
            for ($i=97; $i<123; $i++) 
            {
            ?>
              <a href="admin_productos.php?t=2&id_tienda=<?=$id_tienda?>&letra=<? echo chr($i) ?>" class="textobold"><? echo chr($i) ?></a> |
              <?
            }
            ?></td>
          </tr>
        </table><br />
<table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Productos</td>
</tr>
<tr>
<td>
<?php
if(isset($_GET["letra"]))
{
	$letra=$_GET["letra"];
	$sql = "SELECT * FROM productos WHERE usuario_tienda='$t' && id_usuario_tienda='$id_tienda' && SUBSTRING(titulo,1,1)='$letra' ORDER BY id";
}	
else
	$sql = "SELECT * FROM productos WHERE usuario_tienda='$t' && id_usuario_tienda='$id_tienda'";
$res = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="107">Productos</th>
    <th width="104" nowrap="nowrap">#Art&iacute;culo</th>
    <th width="104" nowrap="nowrap">Precio</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($res)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["titulo"]?></td>
    <td nowrap="nowrap"><?=numero_articulo($resul["id"])?></td>
    <td nowrap="nowrap"><?=$resul["precio"];?></td>
    <td nowrap="nowrap"><a href="admin_productos_editar.php?t=<?=$t?>&id_tienda=<?=$id_tienda?>&id=<?=$resul["id"]?>"><img src="imagenes/editar.png" alt="Modificar" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="javascript:eliminar(<?=$resul["id"]?>,<?=$id_tienda?>)"><img src="imagenes/eliminar.png" alt="Eliminar" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="admin_productos_ficha.php?t=<?=$t?>&id_tienda=<?=$id_tienda?>&id=<?=$resul["id"]?>"><img src="imagenes/ver.png" alt="Productos" width="20" height="20" border="0" /></a></td>
  </tr> 
  <?php }?>
</table></td>
</tr>
</table><!-- termina productos-->        </td>
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