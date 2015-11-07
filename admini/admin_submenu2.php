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
	$id_submenu = $_POST["id_submenu"];
	$insert = mysql_query("INSERT INTO submenu2 (nombre,id_categoria,id_menu,id_submenu) VALUES ('$nombre','$id_categoria','$id_menu','$id_submenu')");
	$id=mysql_insert_id();
	header('location:admin_submenu2.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$id_menu = $_POST["id_menu"];
	$id_categoria = cual_id_categoria($id_menu);
	$id_submenu = $_POST["id_submenu"];	
	$update = mysql_query("UPDATE submenu2 SET nombre='$nombre', id_categoria='$id_categoria', id_menu='$id_menu', id_submenu='$id_submenu' WHERE id='$id'");
	header('location:admin_submenu2.php');
	}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$delete = mysql_query("DELETE FROM submenu2 WHERE id='$id'");
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
	if(confirm('Esta seguro que desea eliminar esta opción del menú nivel 3?')){
		window.location.href='admin_submenu2.php?o=eliminar&id=' + _id;		
	}
}
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
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en:<strong> Opciones men&uacute; nivel 3</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_submenu2_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
        <!--buscador-->
        <form action="admin_submenu2.php" method="post" name="form1">
                <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados" width="800">
                  <tr>
                    <td colspan="3" nowrap="nowrap" class="tabla_titulo"> Buscar (<a href="admin_submenu2.php?mostrar_todo=si">Mostrar todo</a>)</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="desc">T&iacute;tulo:
                    <input name="titulo" type="text" class="form" size="50" value=""/></td>
                  </tr>
                  <tr>
                    <td width="297" class="desc campo">Categoria / Nivel 1:&nbsp;<br />
                      <select name="id_menu" class="form" onchange="cargar_submenu(this.value,0,0);">
                <option value="0">Seleccionar</option>
                <?php 
					$sql_menu=mysql_query("SELECT sm.nombre categoria, m.id, m.nombre menu FROM categoria sm INNER JOIN menu m ON m.id_categoria=sm.id ORDER BY sm.nombre ASC, m.orden ASC");
					while($menu=mysql_fetch_array($sql_menu)){
				?>
                	<option value="<?=$menu["id"]?>"><?=$menu["categoria"]?> - <?=$menu["menu"]?></option>
                <?php }?>
              </select>
                    </td>
                <td width="235" class=" desc campo">Nivel 2:&nbsp;<br /><span id="submenu">
                      <select class="form" name="id_submenu">
                        <option value="0">No aplica</option>
                      </select></span>
                    </td>
                    
                    <td width="266" class="desc campo">Nivel 3:&nbsp; <br /><span id="submenu2">
                      <select class="form" name="id_submenu2">
                        <option value="0">No aplica</option>
                      </select></span>
                    </td>
                    
                  </tr>
                  <tr>
                    <td colspan="3" class="tabla_botones"><input type="hidden" name="buscar" value="1"/>
                      <img src="imagenes/cancelar.png" style="cursor:pointer;" onclick="document.form1.reset();"/>
                       <input type="image" src="imagenes/buscar.png" name="buscar" value="Enviar" /></td>
                  </tr>
                </table>
          </form>
        <!--fin buscador--><br /><br />
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Opciones [<a href="ordenar_submenu2.php">Ordenar</a>]</td>
</tr>
<tr>
<td>
<?php 
	$sql= "SELECT sm2.id, sm2.nombre opcion, sm2.id_categoria idc, m.nombre menu, sm.nombre submenu FROM submenu2 sm2 INNER JOIN submenu sm ON sm.id=sm2.id_submenu INNER JOIN menu m ON m.id=sm.id_menu ";

$condicion="";
if($_GET["mostrar_todo"]=="si")
{
	$_SESSION["titulo"]="";
	$_SESSION["menu"]="";
	$_SESSION["submenu"]="";
	$_SESSION["submenu2"]="";
}
if(($_POST["buscar"] && $_POST["titulo"]!="") || $_SESSION["titulo"]!="") 
{
	if(isset($_POST["titulo"])) $_SESSION["titulo"]=$_POST["titulo"];
	if(isset($_SESSION["titulo"])) $condicion=" WHERE sm2.nombre LIKE '%".$_SESSION["titulo"]."%'";
}
if(($_POST["buscar"] && $_POST["id_menu"]!=0))
{
	if(isset($_POST["id_menu"])) $_SESSION["menu"]=$_POST["id_menu"];
	if(isset($_SESSION["menu"]) && $_SESSION["menu"]!=0) $condicion=" WHERE sm2.id_menu=".$_SESSION["menu"]."";
}	
if(($_POST["buscar"] && $_POST["id_submenu"]!=0) || $_SESSION["submenu"]!=0) 
{
	if(isset($_POST["id_submenu"])) $_SESSION["submenu"]=$_POST["id_submenu"];
	if(isset($_SESSION["submenu"]) && $_SESSION["submenu"]!=0) $condicion=" WHERE sm2.id_menu=".$_SESSION["menu"]." AND sm2.id_submenu=".$_SESSION["submenu"]."";
}	
if(($_POST["buscar"] && $_POST["id_submenu2"]!=0) || $_SESSION["submenu2"]!=0)
{
	if(isset($_POST["id_submenu2"])) $_SESSION["submenu2"]=$_POST["id_submenu2"];
	if(isset($_SESSION["submenu2"]) && $_SESSION["submenu2"]!=0) $condicion.=" WHERE sm2.id_menu=".$_SESSION["menu"]." AND sm2.id_submenu=".$_SESSION["submenu"] ."AND sm2.id_submenu2=".$_SESSION["submenu2"]."";
}	
$_pagi_sql=$sql." ".$condicion." ORDER BY m.orden ASC, sm.orden ASC, sm2.orden ASC";
$_pagi_cuantos=30;
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="80">Nombre</th>
    <th nowrap="nowrap">Categoria</th>
    <th nowrap="nowrap">Men&uacute; Nivel 1</th>
    <th nowrap="nowrap">Men&uacute; Nivel 2</th>
    <th nowrap="nowrap">&nbsp;</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["opcion"]?></td>
    <td nowrap="nowrap"><?=cual_categoria($resul["idc"]);?></td>
    <td nowrap="nowrap"><?=$resul["menu"]?></td>
    <td nowrap="nowrap"><?=$resul["submenu"]?></td>
    <td nowrap="nowrap"><a href="admin_submenu2_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" width="20" height="20" border="0" /></a></td>
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