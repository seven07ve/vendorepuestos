<? 
include("conexion.php");
session_start();
include("funciones.php");
if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }
$nombretr = cual_nombre_oficial($_SESSION["userid"]);


if($_POST['guardar']){
	$titulo = str_replace("'",'\"',$_POST["titulo"]);
	$subtitulo = str_replace("'",'\"',$_POST["subtitulo"]);
	$descripcion = $_POST["descripcion"];
	$condicion = $_POST["condicion"];
	$precio = $_POST["precio"];
	$vence = "DATE_ADD(NOW(), INTERVAL 1 YEAR)";
	$id_menu = $_POST["id_menu"];
	$id_categoria = cual_id_categoria($id_menu);
	$id_submenu = $_POST["id_submenu"];
	$id_submenu2 = $_POST["id_submenu2"];
	$id_estado = $_POST["id_estado"];
	$id_ciudad = $_POST["id_ciudad"];
	$id_paquete_usuario = paquete_activo_usuario($_SESSION["userid"],2);

	$insert = mysql_query("INSERT INTO productos (titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu2, id_paquete_usuario, usuario_tienda, id_usuario_tienda) VALUES ('$titulo', '$subtitulo', '', '', '', '$descripcion', '$id_estado', '$id_ciudad', '$condicion', '$precio', $vence, '$id_categoria', '$id_menu', '$id_submenu', '$id_submenu2', '$id_paquete_usuario', '2', '".$_SESSION["userid"]."')");
	
	
	$carpeta = cual_nombre_carpeta($_SESSION["userid"]);
	$carpeta_productos = $carpeta."/productos";
	//crear carpeta si no existe
	if(!file_exists($carpeta_productos)) mkdir($carpeta_productos, 0777);
	//subir imagenes
	$id = mysql_insert_id();
	
	if($_FILES["file"]["tmp_name"]!="") copy($_FILES["file"]["tmp_name"], $carpeta_productos."/".$_FILES["file"]["name"]);
	$update = mysql_query("UPDATE productos SET foto1='$id_1_".$_FILES["file"]["name"]."' WHERE id='$id'");
	
	if($_FILES["file2"]["tmp_name"]!="") copy($_FILES["file2"]["tmp_name"], $carpeta_productos."/".$_FILES["file2"]["name"]);
	$update = mysql_query("UPDATE productos SET foto2='$id_2_".$_FILES["file2"]["name"]."' WHERE id='$id'");
	
	if($_FILES["file3"]["tmp_name"]!="") copy($_FILES["file3"]["tmp_name"], $carpeta_productos."/".$_FILES["file3"]["name"]);
	$update = mysql_query("UPDATE productos SET foto3='$id_3_".$_FILES["file3"]["name"]."' WHERE id='$id'");
	?>
    <script language="javascript">alert("El Anuncio fue publicado con exito!"); window.location="/publicaciones/<?=$carpeta?>";</script>
<? }
$idpa = paquete_activo_usuario($_SESSION["userid"],"2");
if($idpa!="")
{
	$productos_publicados = productos_paquete_activo($idpa); //productos publicados hasta ahora
	$id_paquete = id_paquete_activo($idpa);//id del paquete activo
	$productos_total_paquete = productos_paquete($id_paquete); //cuantos productos incluye el paquete acyivo
	$productos_disponibles = $productos_total_paquete - $productos_publicados; 
}
else
{
		$productos_publicados = 0;
		$productos_total_paquete = 0;
		$productos_disponibles = 0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/prototype.js"></script>
<script src="/jscalendar/src/js/jscal2.js"></script>
<script src="/jscalendar/src/js/lang/es.js"></script>
<link rel="stylesheet" type="text/css" href="/jscalendar/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="/jscalendar/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="/jscalendar/src/css/steel/steel.css" />
<script type="text/javascript" src="/admini/ckfinder/ckfinder.js"></script>
<style type="text/css">
.image-upload > input{
    display: none;
}
.image-upload img{
	opacity:0.7;
}
.image-upload img:hover{
	opacity:1;
}
</style>
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
	new Ajax.Request("/admini/funciones_ajax.php?buscar=1&menu="+menu+"&submenu="+submenu+"&submenu2="+submenu2,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu').update(transport.responseText);
	}
	});
}
function cargar_submenu2(submenu,submenu2)
{
	new Ajax.Request("/admini/funciones_ajax.php?buscar=2&submenu="+submenu+"&submenu2="+submenu2,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu2').update(transport.responseText);
	}
	});
}
function cargar_ciudad(edo,ciu)
{
	new Ajax.Request("/admini/funciones_ajax.php?buscar=10&edo="+edo+"&ciu="+ciu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciu').update(transport.responseText);
	}
	});
}
</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <table border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
          <td height="30" colspan="4" class="titulo_ruta"><?=$nombretr?> > Mi Cuenta > Publicaciones</td>
          <td align="right" colspan="3"><? 
			if($_SESSION["userid"]!="") 
			{
                echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";?>
             | <a href="/salirTR/" class="red" target="_self">Salir</a>
          <? }?></td>
        </tr>
        <tr>
         <td width="70"><a href="/bienvenidoTR/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/btn_resumen_off.jpg" name="mitr" width="70" height="21" border="0" id="mitr" /></a></td>
          <td width="43"><a href="/mitr/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_1_off.jpg" name="mitr" width="43" height="20" border="0" /></a></td>
          <td width="131"><a href="/estado_cuenta/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_2_off.jpg" name="edo" width="131" height="20" border="0" /></a></td>
          <td width="143"><a href="/datos_vendedor/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_on.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        <tr>
          <td height="8" colspan="6" background="/imagenes/login_bg_bot.jpg"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="titulo_seccion">
    <? if($productos_disponibles==0)
	{?>
    	No tiene Anuncios Disponibles, por favor revise el Estado de Cuenta y Solicite un nuevo paquete...
    <? }
	else
	{?>
		Anuncios Disponibles: <span class="red"><?=$productos_disponibles;?></span><br /><br />
    <form action="/publicaciones/<?=$nombretr?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar(this);">
        <table width="850" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr align="right">
<td colspan="2" align="left" class="blue">Nuevo Anuncio</td>
</tr>
<tr>
  <td height="41" class="desc">Categoria / Men&uacute; Nivel 1:</td>
  <td class="campo"><select class="form" name="id_menu" onChange="cargar_submenu(this.value,0,0);">
    <option value="0">Seleccione</option>
    <?php 
	$sql_menu=mysql_query("SELECT sm.nombre categoria, m.id, m.nombre menu FROM categoria sm INNER JOIN menu m ON m.id_categoria=sm.id ORDER BY sm.nombre ASC, m.orden ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?><option value="<?=$menu["id"]?>"><?=$menu["categoria"]?> - <?=$menu["menu"]?></option>
    <?php 
	}
	?>
    </select>
    <script>cargar_submenu('<?=$id_menu[0]?>','0','0');</script>
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
  <td width="221" class="desc">T&iacute;tulo:</td>
  <td width="459" class="campo"><input name="titulo" type="text" class="form" size="50" maxlength="80" /></td>
</tr>
<tr>
  <td class="desc">Sub Titulo:</td>
  <td class="campo"><input name="subtitulo" type="text" class="form" size="50" maxlength="55" /></td>
</tr>
<tr class="tabla">
  <td class="desc">Agregar Imagenes:</td>
  <td class="campo">
  <div class="image-upload">
    <label for="file-input">
        <img src="../imagenes/camera.png"/>
    </label>
	<input id="file-input" name="file" type="file" class="form"/>
    <label for="file-input2">
        <img src="../imagenes/camera.png"/>
    </label>
	<input id="file-input2" name="file2" type="file" class="form"/>
    <label for="file-input3">
        <img src="../imagenes/camera.png"/>
    </label>
	<input id="file-input3" name="file3" type="file" class="form"/>
</div>
</td>
</tr>
<!-- <tr>
  <td height="41" class="desc">Imagen 2:</td>
  <td class="campo"><input name="file2" type="file" class="form" /></td>
</tr>
<tr>
  <td height="41" class="desc">Imagen 3:</td>
  <td class="campo"><input type="file" name="file3" class="form"/></td>
</tr> -->
<tr>
    <td height="41" class="desc">Condici&oacute;n:</td>
    <td class="campo">
        <select name="condicion" class="form">
            <option selected="selected">Nuevo</option>
            <option>Remanufacturado</option>
            <option>Usado</option>
        </select>
    </td>
</tr>
<tr>
  <td class="desc">Descripci&oacute;n:</td>
  <td class="campo"><?php
				include_once "admini/ckeditor/ckeditor.php";
				include_once 'admini/ckfinder/ckfinder.php';
				$CKEditor = new CKEditor();
				$CKEditor->basePath = '/admini/ckeditor/';
				$CKFinder = new CKFinder();
 				$CKFinder->BasePath = '/admini/ckfinder/';
	 			$CKFinder->SetupCKEditorObject($CKEditor);
				$CKEditor->config["width"]=650;
				$CKEditor->config["height"]=300;
				$CKEditor->editor("descripcion", " ");
			?></td>
</tr>
<tr>
  <td height="41" class="desc">Precio:</td>
  <td class="campo"><input name="precio" type="text" class="form" size="10" /> 
  (ej. 00.00)</td>
</tr>
<tr class="tabla">
  <td>Estado de Ubicaci&oacute;n:</td>
  <td><select class="form" name="id_estado" onChange="cargar_ciudad(this.value,0);">
   <option value="0">Seleccione</option>
    <?php 
	$sql_edo=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
	while($edo=mysql_fetch_array($sql_edo))
	{
	?>
    <option value="<?=$edo["id"]?>"><?=$edo["nombre"]?>
    </option>
    <?php 
	}?>
  </select></td>
</tr>
<tr class="tabla">
  <td>Ciudad de Ubicaci&oacute;n:</td>
  <td id="ciu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select></td>
</tr>
<tr align="right">
  <td colspan="2" class="tabla_botones">
  <input type="hidden" name="guardar" value="1"/>
  <input type="image" src="/imagenes/btn_send.jpg" name="guardar" id="guardar" value="Enviar" /></td>
  </tr>
</table>               
    </form>
    <? }?></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
