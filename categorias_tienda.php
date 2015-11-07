<? 
include("conexion.php");
session_start();
include("funciones.php");
$id = $_GET["id"];
$ver_tienda = mysql_query("SELECT * FROM tienda_virtual WHERE id='$id'");
$vt = mysql_fetch_array($ver_tienda);
$carpeta = limpiar_cadena($vt["razon_social"]);
$carpeta_productos = $carpeta."/productos";
if($vt["color_contenido"]!="") $color_contenido = "#".$vt["color_contenido"]; else $color_contenido = "#FFFFFF";
if($vt["color_titulo"]!="") $color_titulo = "#".$vt["color_titulo"]; else $color_titulo = "#33333";
if($vt["color_fondo"]!="") $color_fondo = "#".$vt["color_fondo"]; else $color_fondo = "#FFFFFF";

if(isset($_GET["idm"])!=0)$idm=$_GET["idm"];

$_pagi_sql = "SELECT * FROM productos WHERE vence>= NOW() && usuario_tienda='2' && id_usuario_tienda='$id' && id_menu='$idm'";
if($_GET["p"]!=0) $_pagi_sql.=" ORDER BY precio ASC";
if($_GET["f"]!=0) $_pagi_sql.=" ORDER BY vence ASC";
include("paginar4.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/over-text/sample.css" />
	<script type="text/javascript" src="/over-text/jquery.js"></script>
	<script type="text/javascript" src="/over-text/captify.tiny.js"></script>
	<script type="text/javascript">
	$(function(){
		$('img.captify').captify({});
	});
	</script>
    <!--carrusel-->
<script type="text/javascript" src="/lib/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/skin_tienda.css" />
<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});

</script>  
</head>
<body>
<?php include("includes/header_tienda.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<div class="titulo_ruta" style="height:30px; padding-top:10px;"><a href="/inicio/" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/tr/<?=$carpeta?>/<?=$id?>/0/0/1" class="titulo_ruta"><?=$vt["nombre_oficial"]?></a> > <?=cual_menu($idm);?></div>
</td>
     <td width="400" align="right"><? 
			if($_SESSION["userid"]!="") 
			{
                echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";?>
  | <a href="/mitr/<?=limpiar_cadena($vt["nombre_oficial"])?>" class="blue">Mi Cuenta</a> | <a href="/salirTR/" class="red" target="_self">Salir (X)</a>
<? 
			}
			elseif($_SESSION["userid"]=="")
			{?><a href="/registroTR/" class="red">¿Deseas una TIENDAREPUESTOS?</a> | <a href="/iniciar_sesion/" class="red">Mi Cuenta</a>
<? }?></td>
  </tr>
</table>
<div id="banner2"><? require_once("top_tienda.php");?></div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="240" rowspan="2" valign="top"><? require_once("lateral_tienda.php");?></td>
    <td>&nbsp;</td>
    <td width="300" height="10" valign="top"><div class="titcat3">NUEVOS PRODUCTOS</div>
      <?
		$ultimos_productos = mysql_query("SELECT id, titulo, foto1 FROM productos WHERE vence>= NOW() && usuario_tienda='2' && id_usuario_tienda='$id' ORDER BY vence DESC LIMIT 0,1");
		$up = mysql_fetch_array($ultimos_productos);
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="8" class="cat4">
  		<tr>
    		<td width="145" valign="top"><a href="/articulo/<?=limpiar_cadena($up["titulo"])?>/<?=$up["id"]?>/"><img src="/<?=$carpeta_productos?>/<?=$up["foto1"]?>" alt="<?=$up["titulo"];?>" width="145" height="108" border="0"/></a></td>
    		<td valign="top"><a href="/articulo/<?=limpiar_cadena($up["titulo"])?>/<?=$up["id"]?>/" class="bluep2"><?=$up["titulo"]?> </a><br /></td>
  		</tr>
		</table>
        </div>
    <div class="ft"><a href="/articulo/<?=limpiar_cadena($up["titulo"])?>/<?=$up["id"]?>/" class="bluep2"><img src="/imagenes/ver_mas_amarillo.jpg" width="310" height="29" border="0" /></a></div></td>
    <td width="25">&nbsp;</td>
    <td width="300" valign="top"><div class="titcat3">OFERTA DEL D&Iacute;A</div>
      <?
		$oferta_producto = mysql_query("SELECT id, titulo, foto1 FROM productos WHERE oferta_dia='1' && vence>= NOW() && usuario_tienda='2' && id_usuario_tienda='$id'");
		$op = mysql_fetch_array($oferta_producto);
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="8" class="cat4">
  		<tr>
    		<td width="145" valign="top"><a href="/articulo/<?=limpiar_cadena($op["titulo"])?>/<?=$op["id"]?>/"><img src="/<?=$carpeta_productos?>/<?=$op["foto1"]?>" alt="<?=$op["titulo"];?>" width="145" height="108" border="0"/></a></td>
    		<td valign="top"><a href="/articulo/<?=limpiar_cadena($op["titulo"])?>/<?=$op["id"]?>/" class="bluep2"><?=$op["titulo"]?> </a><br /></td>
  		</tr>
		</table>
     <div class="ft"><a href="/articulo/<?=limpiar_cadena($op["titulo"])?>/<?=$op["id"]?>/"><img src="/imagenes/ver_mas_amarillo.jpg" width="310" height="29" border="0" /></a></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><table width="100%" border="0" align="right" cellpadding="3" cellspacing="0">
      <tr>
    <td colspan="6" class="titulo_seccion"><span class="red"><?=$_pagi_totalReg;?></span> Art&iacute;culos Publicados</td>
    </tr>
       <tr>
     <td width="44"><span class="titulo_ruta" style="padding-bottom:10px;">VISTA:</span></td>
    <td width="20"><a href="/tr/<?=$carpeta?>/<?=$id?>/0/0/1/"><img src="/imagenes/btn_listado.jpg" width="17" height="25" hspace="3" vspace="3" border="0" /></a></td>
    <td width="100"><a href="/tr_galeria/<?=$carpeta?>/<?=$id?>/1/"><img src="/imagenes/btn_galeria.jpg" width="17" height="25" hspace="3" vspace="3" border="0" /></a></td>
    <td width="310">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
      <tr height="25" background="/imagenes/bg_botonera.jpg" class="menu">
    	<td colspan="3" class="link">GALERIA</td>
    	<td class="link">DESCRIPCI&Oacute;N</td>
  	<td width="110"><form action="/tr_categoria/<?=$carpeta?>/<?=$id?>/<?=$idm?>/1/0/1/" method="post">PRECIO <input type="image" name="imageField" id="imageField" src="/imagenes/icon_arrow_sist_ne.jpg" /></form></td>
    <td width="110"><form action="/tr_categoria/<?=$carpeta?>/<?=$id?>/<?=$idm?>/0/1/1/" method="post">
    VENCE 
        <input type="image" name="imageField" id="imageField" src="/imagenes/icon_arrow_sist_ne.jpg" /></form></td>
        </tr>
        <tr height="5">
    <td colspan="6">&nbsp;</td>
    </tr>
</table>
    <?
	while($vpt = mysql_fetch_array($_pagi_result))
	{
			$carpeta_productos = cual_nombre_carpeta($id)."/productos";
    ?>
  			<div style="width:660px; height:110px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px; clear:both;">
	  		<div style="width:460px; float:left;">
            <a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>/"><img src="/<?=$carpeta_productos?>/<?=$vpt["foto1"]?>" width="145" height="108" hspace="5" vspace="5" border="0" align="left" /></a><span class="blue"><a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>/" class="blue"><?=$vpt["titulo"]?></a></span><br />
			<?=$vpt["subtitulo"]?><br /> 
            <span class="bluep"><a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>/" class="bluep">Art&iacute;culo # <?=numero_articulo($vpt["id"]);?></a></span></div>
		 	<div class="red" style="width:100px; float:left;">Bs. <?=$vpt["precio"]?></div>
     		<div class="gris" style="width:100px; float:left;"><?=date("d-m-Y",strtotime($vpt["vence"]))?><br /><?=cual_estado($vpt["id_estado"])?></div>
            </div>
    <? }?>
  </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e1e1e1">
  	<form name="form_pag" action="" method="post">
    <tr>
    <td width="100" class="pag">P&aacute;g <?=$_pagi_actual;?> de <?=$_pagi_totalPags?></td>
    <td align="center" class="pag"><?=$_pagi_navegacion?></td>
    <td width="80" align="right">Ir a la p&aacute;gina:&nbsp;</td>
    <td width="40" align="right"><input name="pg" type="text" class="formpag" size="3" /></td>
    <td width="30" align="right"><input name="input" type="image" src="/imagenes/btn_ir.jpg" /></td>
    </tr>
  	</form>
</table></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
