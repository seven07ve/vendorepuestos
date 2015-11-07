<?php
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";

if(@$_GET["buscar"]==1)
{
	echo "<select name='id_ciudad' class='form'>";
	if($_GET["ciu"]==0) 
		echo "<option value='0'>Seleccione</option>";
	$sql_submenu=mysql_query("SELECT * FROM ciudad WHERE id_estado='".$_GET["edo"]."'");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		echo "<option value='".$resul_submenu["id"]."'";
		if($_GET["ciu"]==$resul_submenu["id"]) echo " selected";
		echo ">".utf8_encode($resul_submenu["nombre"])."</option>";	
	}	
	echo "</select>";
	return;
}

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
<script type="text/javascript" src="js/prototype.js"></script>
<script src="../jscalendar/src/js/jscal2.js"></script>
<script src="../jscalendar/src/js/lang/es.js"></script>
<link rel="stylesheet" type="text/css" href="../jscalendar/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="../jscalendar/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="../jscalendar/src/css/steel/steel.css" />
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript">
function validar(formy)
{
	if(formy.titulo.value=="")
	{
		alert("Debe ingresar el titulo");
		formy.titulo.focus();
		return false;
	}
	if(formy.descripcion.value=="")
	{
		alert("Debe ingresar una Descripcion");
		formy.descripcion.focus();
		return false;
	}
	if(formy.id_estado.value=="0")
	{
		alert("Debe seleccionar un Estado");
		formy.id_estado.focus();
		return false;
	}
	if(formy.id_ciudad.value=="0")
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudad.focus();
		return false;
	}
	if(formy.precio.value=="")
	{
		alert("Debe Ingresar un Precio");
		formy.precio.focus();
		return false;
	}
	numero = formy.precio.value;
	if (!/([?1234567890][.][1234567890][1234567890])+$/.test(numero))
	{
		alert("El Precio " + numero + " es invalido");
		formy.precio.focus();
		return false;
	}
	if(formy.id_menu.value=="0")
	{
		alert("Debe seleccionar una Categoria");
		formy.id_menu.focus();
		return false;
	}
	if(formy.id_submenu.value=="0")
	{
		alert("Debe seleccionar una opcion de Menu Nivel 2");
		formy.id_submenu.focus();
		return false;
	}
	return true;
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
function cargar_ciudad(edo,ciu)
{
	new Ajax.Request("admin_productos_editar.php?buscar=1&edo="+edo+"&ciu="+ciu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciu').update(transport.responseText);
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
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Modificar Productos</td>
</tr>
<tr>
  <td class="desc">T&iacute;tulo:</td>
  <td class="campo"><input name="titulo" type="text" class="form" value="<?=$resul["titulo"];?>" size="50" maxlength="75" /></td>
</tr>
<tr>
  <td class="desc">Sub Titulo:</td>
  <td class="campo"><input name="subtitulo" type="text" class="form" size="50" value="<?=$resul["subtitulo"];?>" /></td>
</tr>
<tr>
  <td class="desc">Descripci&oacute;n:</td>
  <td class="campo"><?php
				include_once "ckeditor/ckeditor.php";
				include_once 'ckfinder/ckfinder.php';
				$initialValue = $resul["descripcion"];
				$CKEditor = new CKEditor();
				$CKEditor->basePath = '/admini/ckeditor/';
				$CKFinder = new CKFinder();
 				$CKFinder->BasePath = '/admini/ckfinder/';
	 			$CKFinder->SetupCKEditorObject($CKEditor);
				$CKEditor->config["width"]=650;
				$CKEditor->config["height"]=300;
				$CKEditor->editor("descripcion", $initialValue);
			?></td>
</tr>
<tr class="tabla">
  <td class="desc">Estado de Ubicaci&oacute;n:</td>
  <td class="campo"><select class="form" name="id_estado" onChange="cargar_ciudad(this.value);">
   <option value="0">Seleccione</option>
    <?php 
	$sql_edo=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
	while($edo=mysql_fetch_array($sql_edo))
	{
	?>
    <option value="<?=$edo["id"]?>" <? if($edo["id"]==$resul["id_estado"]){?> selected="selected"<? }?>><?=$edo["nombre"]?>
    </option>
    <?php 
	}?>
  </select></td>
</tr>
<tr class="tabla">
  <td class="desc">Ciudad de Ubicaci&oacute;n:</td>
  <td class="campo" id="ciu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select></td>
</tr>
<script>cargar_ciudad('<?=$resul["id_estado"]?>','<?=$resul["id_ciudad"]?>');</script>
<tr class="tabla">
  <td rowspan="2" class="desc">Imagen 1:</td>
  <td class="campo"><? if($resul["foto1"]!=""){  ?><img src="../<?=$carpeta?>/productos/<?=$resul["foto1"]?>" height="50" /><? }?></td>
</tr>
<tr class="tabla">
  <td class="campo"><input name="file" type="file" class="form" /></td>
</tr>
<tr>
  <td rowspan="2" class="desc">Imagen 2:</td>
  <td height="41" class="campo"><? if($resul["foto2"]!=""){  ?><img src="../<?=$carpeta?>/productos/<?=$resul["foto2"]?>" height="50" /><? }?></td>
</tr>
<tr>
  <td height="41" class="campo"><input name="file2" type="file" class="form" /></td>
</tr>
<tr>
  <td rowspan="2" class="desc">Imagen 3:</td>
  <td height="41" class="campo"><? if($resul["foto3"]!=""){  ?><img src="../<?=$carpeta?>/productos/<?=$resul["foto3"]?>" height="50" /><? }?></td>
</tr>
<tr>
  <td height="41" class="campo"><input type="file" name="file3" class="form"/></td>
</tr>
<tr>
  <td height="41" class="desc">Condicion:</td>
  <td class="campo"><select name="condicion" class="form">
      <option selected="selected"><?=$resul["condicion"]?></option>
      <option>Nuevo</option>
      <option>Remanufacturado</option>
      <option>Usado</option>
      </select></td>
</tr>
<tr>
  <td height="41" class="desc">Precio:</td>
  <td class="campo"><input name="precio" type="text" class="form" size="10" value="<?=$resul["precio"];?>"/> 
  (ej. 00.00)</td>
</tr>
<!--<tr>
  <td height="41" class="desc">Vence:</td>
  <td class="campo"><input id="vence" name="vence" class="form" size="40" value="<?=$resul["vence"];?>"/>
  <input type="button" id="f_btn1" class="form2" value="..." />
  <script type="text/javascript">//<![CDATA[
	var cal = Calendar.setup({
	onSelect: function(cal) { cal.hide() },
	showTime: true
	});
	cal.manageFields("f_btn1", "vence", "%Y-%m-%d");
	//]]></script>    </td>
</tr>-->
<tr>
  <td height="41" class="desc">Categoria / Men&uacute; Nivel 1:</td>
  <td class="campo"><select class="form" name="id_menu" onchange="cargar_submenu(this.value,0,0);">
    <option value="0">Seleccione</option>
    <?php 
	$sql_menu=mysql_query("SELECT sm.nombre categoria, m.id, m.nombre menu FROM categoria sm INNER JOIN menu m ON m.id_categoria=sm.id ORDER BY sm.nombre ASC, m.orden ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?><option value="<?=$menu["id"]?>" <?php if($resul["id_menu"]==$menu["id"]) echo "selected";?>><?=$menu["categoria"]?> - <?=$menu["menu"]?></option>
    <?php 
	}
	?>
    </select>
    <script>cargar_submenu('<?=$resul["id_menu"]?>','<?=$resul["id_submenu"]?>','<?=$resul["id_submenu2"]?>');</script>
    </td>
</tr>
<tr>
  <td height="41" class="desc">Men&uacute; Nivel 2:</td>
  <td class="campo" id="submenu"><select class="form" name="id_submenu">
      <option value="0">No aplica</option>
  </select></td>
</tr>
<tr>
  <td height="41" class="desc">Men&uacute; Nivel 3:</td>
  <td class="campo" id="submenu2"><select class="form" name="id_submenu2">
      <option value="0">No aplica</option>
  </select></td>
</tr>
<tr>
  <td colspan="2" class="tabla_botones">
  <input type="hidden" name="id" value="<?=$resul["id"]?>"/>
  <input type="hidden" name="editar" value="1"/>
  <input type="image" src="imagenes/guardar.png" name="editar" id="editar" value="Enviar" /></td>
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