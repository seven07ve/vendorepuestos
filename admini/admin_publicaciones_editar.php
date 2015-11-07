<? 
include "../conexion.php";
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
$id = $_GET['id'];	
$sql = "SELECT * FROM publicaciones WHERE id=$id";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
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
	if(formy.imagen.value=="")
	{
		alert("Debe seleccionar la imagen");
		formy.imagen.focus();
		return false;
	}
	if(formy.tipo.value==0)
	{
		alert("Debe seleccionar el tipo");
		formy.tipo.focus();
		return false;
	}
	if(formy.archivo.value=="")
	{
		alert("Debe seleccionar o ingresar la ruta del archivo");
		formy.archivo.focus();
		return false;
	}
	return true;
}
function BrowseServer(campo)
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '/admini/ckfinder/';	// The path for the installation of CKFinder (default = "/ckfinder/").
	if(campo=="imagen")
		finder.selectActionFunction = SetFileField;
	else if(campo=="archivo")	
		finder.selectActionFunction = SetFileField2;
	finder.popup();
	// It can also be done in a single line, calling the "static"
	// Popup( basePath, width, height, selectFunction ) function:
	// CKFinder.Popup( '../../', null, null, SetFileField ) ;
	//
	// The "Popup" function can also accept an object as the only argument.
	// CKFinder.Popup( { BasePath : '../../', selectActionFunction : SetFileField } ) ;
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl )
{
	document.getElementById( 'imagen' ).value = fileUrl;
}
function SetFileField2( fileUrl )
{
	document.getElementById( 'archivo' ).value = fileUrl;
}
function mostrar_campos(tipo)
{
	if(tipo==1)
	{	
		document.getElementById('_archivo').style.display='';
		document.getElementById('button_archivo').style.display='';
	}
	else if(tipo==2)
	{
		document.getElementById('_archivo').style.display='';
		document.getElementById('button_archivo').style.display='none';
	}
	else
	{
		document.getElementById('_archivo').style.display='none';
		document.getElementById('archivo').value='';
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
<? include("includes/header.php");?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Publicaciones</strong></td>
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
            <td><a href="admin_publicaciones.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="admin_publicaciones_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_publicaciones.php" method="post" name="form1" onsubmit="return validar(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td colspan="2" class="tabla_titulo">Editar Publicaci&oacute;n</td>
</tr>
<tr>
  <td class="desc">T&iacute;tulo:</td>
  <td class="campo"><input name="titulo" type="text" class="form" size="50" value="<?=$resul["titulo"]?>"/></td>
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
  <td class="desc">Imagen:</td>
  <td class="campo"><input id="imagen" name="imagen" type="text" class="form" size="33" value="<?=$resul["imagen"]?>"/>
      <input type="button" value="Examinar..." onclick="BrowseServer('imagen');"/></td>
</tr>
<tr class="tabla">
  <td colspan="2" class="desc"><img src="<?=$resul["imagen"]?>" width="490"/></td>
  </tr>
<tr class="tabla">
  <td class="desc">Tipo:</td>
  <td class="campo"><select class="form" name="tipo" onchange="mostrar_campos(this.value);">
    <option value="0">Seleccionar</option>
    <option value="1" <?php if($resul["tipo"]==1) echo "selected";?>>Documento</option>
    <option value="2" <?php if($resul["tipo"]==2) echo "selected";?>>URL</option>
  </select></td>
</tr>
<tr class="tabla" id="_archivo" style="display:none;">
  <td class="desc">Archivo:</td>
  <td class="campo"><input id="archivo" name="archivo" type="text" class="form" size="33" value="<?=$resul["archivo"]?>"/>
      <input id="button_archivo" type="button" value="Examinar..." onclick="BrowseServer('archivo');"/></td>
</tr>
<tr>
  <td height="41" class="desc">Men&uacute; Nivel 1:</td>
  <td class="campo"><select class="form" name="id_menu" onchange="cargar_submenu(this.value,0,0);">
      <?php 
	$id_menu=explode(",",$_SESSION["id_menu"]);
	if($_SESSION["administrador"]==1 || $id_menu[0]==0){
	?>
      <option value="0">No aplica</option>
      <?php }?>
      <?php 
	$sql_menu=mysql_query("SELECT * FROM menu ORDER BY id");
	while($menu=mysql_fetch_array($sql_menu))
	{
		if($_SESSION["administrador"]==1 || $id_menu[0]==0 || in_array($menu["id"],$id_menu)){
	?>
      <option value="<?=$menu["id"]?>" <?php if($resul["id_menu"]==$menu["id"]) echo "selected";?>>
      <?=$menu["nombre"]?>
      </option>
      <?php 
		}
	}?>
    </select>
      <script>cargar_submenu('<?=$resul["id_menu"]?>','<?=$resul["id_submenu"]?>','<?=$resul["id_submenu2"]?>');</script>
  </td>
</tr>
<tr>
  <td height="41" class="desc">Men&uacute; Nivel 2:</td>
  <td class="campo" id="submenu"><select class="form" name="id_submenu" onchange="cargar_submenu2(this.value,0)">
      <option value="0">No aplica</option>
  </select></td>
</tr>
<tr>
  <td height="41" class="desc">Men&uacute; Nivel 3:</td>
  <td class="campo" id="submenu2"><select class="form" name="id_submenu2">
      <option value="0">No aplica</option>
  </select></td>
</tr>
<script>mostrar_campos('<?=$resul["tipo"]?>');</script>
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