<? 
include("conexion.php");
session_start();
include("funciones.php");
$idc=$_GET["idc"];

$tp = mysql_fetch_array(mysql_query("SELECT count(id) as total FROM menu WHERE id_categoria='$idc'"));
$total = $tp["total"];
$columna = round($total/3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("includes/header.php"); ?>
<!--<div id="banner"><img src="/imagenes/banner_ppla.jpg" width="728" height="90" /></div>-->
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <div class="titulo_ruta" style="height:30px; padding-top:10px;"><a href="/inicio/" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/vista_nivel2/<?=limpiar_cadena(cual_categoria($idc))?>/<?=$idc?>/" class="titulo_ruta"><?=cual_categoria($idc);?></a></div>
      <div class="titulo_categoria" style="height:40px; padding-top:10px;"><?=cual_categoria($idc);?></div>
      <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr>
<td><div style="width:308px; float:left; padding-right:10px;">
        <? 
	$ver_menu = mysql_query("SELECT * FROM menu WHERE id_categoria='$idc' ORDER BY orden, nombre ASC LIMIT 0,".$columna."");
	while($vm = mysql_fetch_array($ver_menu))
	{?>
        <div class="blue" style="padding-bottom:10px; padding-top:10px;"><a href="/vista_nivel3/<?=limpiar_cadena($vm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/0/0/1/" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($idc,$vm["id"],0,0);?>)</div>
        <?
		$ver_submenu = mysql_query("SELECT * FROM submenu WHERE id_menu='".$vm["id"]."' ORDER BY nombre ASC LIMIT 0,4");
		while($vsm = mysql_fetch_array($ver_submenu))
        {?>
        <li style="margin-left:10px; padding-bottom:5px; list-style:none;" class="bluep"><a href="/vista_nivel3/<?=limpiar_cadena($vsm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/<?=$vsm["id"];?>/0/1" class="bluep"><?=$vsm["nombre"]?></a> (<?=cuantos_productos_categoria($idc,$vm["id"],$vsm["id"],0);?>)</li>
        <? }?>
        <div align="left" style="padding-right:10px; padding-bottom:15px;"><? if(mysql_num_rows($ver_submenu)>3){?><a href="/vista_nivel2_detalle/<?=limpiar_cadena($vm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/0/" class="blue">ver mas <img src="/imagenes/icon_arrow_sist.jpg" width="11" height="5" border="0" /></a>
          <? }?></div>
        <? }?>
      </div>
      
      <div style="width:308px; float:left; padding-right:10px;">
        <? 
	$ver_menu = mysql_query("SELECT * FROM menu WHERE id_categoria='$idc' ORDER BY orden, nombre ASC LIMIT ".$columna.",".$columna."");
	while($vm = mysql_fetch_array($ver_menu))
	{?>
        <div class="blue" style="padding-bottom:10px;padding-top:10px;"><a href="/vista_nivel3/<?=limpiar_cadena($vm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/0/0/1/" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($idc,$vm["id"],0,0);?>)</div>
        <?
		$ver_submenu = mysql_query("SELECT * FROM submenu WHERE id_menu='".$vm["id"]."' ORDER BY nombre ASC LIMIT 0,4");
		while($vsm = mysql_fetch_array($ver_submenu))
        {?>
        <li style="margin-left:10px; padding-bottom:5px; list-style:none;" class="bluep"><a href="/vista_nivel3/<?=limpiar_cadena($vsm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/<?=$vsm["id"];?>/0/1" class="bluep"><?=$vsm["nombre"]?></a> (<?=cuantos_productos_categoria($idc,$vm["id"],$vsm["id"],0);?>)</li>
        <? }?>
        <div align="left" style="padding-right:10px; padding-bottom:15px;"><? if(mysql_num_rows($ver_submenu)>3){?><a href="/vista_nivel2_detalle/<?=limpiar_cadena($vm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/0/" class="blue">ver mas <img src="/imagenes/icon_arrow_sist.jpg" width="11" height="5" border="0" /></a> <? }?></div>
        <? }?>
      </div>
      
      <div style="width:308px; float:left;">
        <? 
	$ver_menu = mysql_query("SELECT * FROM menu WHERE id_categoria='$idc' ORDER BY orden, nombre ASC LIMIT ".(2*$columna).",".$total."");
	while($vm = mysql_fetch_array($ver_menu))
	{?>
        <div class="blue" style="padding-bottom:10px;padding-top:10px;"><a href="/vista_nivel3/<?=limpiar_cadena($vm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/0/0/1/" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($idc,$vm["id"],0,0);?>)</div>
        <?
		$ver_submenu = mysql_query("SELECT * FROM submenu WHERE id_menu='".$vm["id"]."' ORDER BY nombre ASC LIMIT 0,4");
		while($vsm = mysql_fetch_array($ver_submenu))
        {?>
        <li style="margin-left:10px; padding-bottom:5px; list-style:none;" class="bluep"><a href="/vista_nivel3/<?=limpiar_cadena($vsm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/<?=$vsm["id"];?>/0/1" class="bluep"><?=$vsm["nombre"]?></a> (<?=cuantos_productos_categoria($idc,$vm["id"],$vsm["id"],0);?>)</li>
        <? }?>
        <div align="left" style="padding-right:10px; padding-bottom:15px;"><? if(mysql_num_rows($ver_submenu)>3){?><a href="/vista_nivel2_detalle/<?=limpiar_cadena($vm["nombre"])?>/<?=$idc?>/<?=$vm["id"]?>/0/" class="blue">ver mas <img src="/imagenes/icon_arrow_sist.jpg" width="11" height="5" border="0" /></a><? }?></div>
        <? }?>
      </div></td></tr></table>
    </td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
