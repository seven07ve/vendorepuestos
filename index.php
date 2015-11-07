<? 
include("conexion.php");
session_start();
include("funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META ID="MetaDescription" NAME="DESCRIPTION" CONTENT="Vendorepuestos es una compañía de comercio electrónico que ofrece su plataforma de búsqueda y gestión para promover servicios, publicar y promocionar artículos del ramo automotor">
<META ID="MetaKeywords" NAME="KEYWORDS" CONTENT="repuestos, accesorios, venta, carros, ford, chevrolet, toyota, hyunday, nissan, en Caracas, Valencia, Maracaibo, Venezuela, vendorepuestos, motos, carros en venta, motos en venta, máquinas, bicicletas, barcos, Avión">
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
<link rel="stylesheet" type="text/css" href="/lib/skin_home.css" />
<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});
</script>
</head>
 
<body>
<?php include("includes/header_home.php"); ?>
<div id="banner"><script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://vendorepuestos.com.ve/publicidad/adjs.php?n=" + phpAds_random);
   document.write ("&amp;what=zone:1");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=a2745a5f' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:1&amp;n=a2745a5f' border='0' alt=''></a></noscript>
</div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top">
    <?
	$productos_vencer = mysql_query("SELECT * FROM productos WHERE vence>= NOW() ORDER BY fecha_publicacion DESC LIMIT 0,12");
	while($pv = mysql_fetch_array($productos_vencer))
	{
		if($pv["usuario_tienda"]==1) $carpeta_productos = "productos";
		elseif($pv["usuario_tienda"]==2) $carpeta_productos = cual_nombre_carpeta($pv["id_usuario_tienda"])."/productos";
    ?>
    <div class="gal"><a href="/articulo/<?=limpiar_cadena($pv["titulo"]);?>/<?=$pv["id"]?>"><img src="/<?=$carpeta_productos?>/<?=$pv["foto1"]?>" alt="<?=$pv["titulo"];?>" width="145" height="108" border="0" class="captify"/></a>
    <div class="price">Bs. <?=$pv["precio"]?></div>
    </div>
     <? }?>
     <div  style="clear:both">
   <div style="float:left; margin: 6px 36px 0 0">
     <div class="titcat">ULTIMO VISITADO</div>
    <div class="ultimo"><div class="homint2">
       <table width="100%" border="0" cellspacing="6" cellpadding="0">
        <tr>
          <td valign="top">
          <ul id="mycarousel" class="jcarousel-skin-tango">
          <? 
			$ultima_visita = mysql_query("SELECT id, foto1, usuario_tienda,id_usuario_tienda, titulo  FROM productos WHERE vence>= NOW() && foto1!='' ORDER BY ultima_visita DESC LIMIT 0,4");
			while($ulvi=mysql_fetch_array($ultima_visita))
			{
				if($ulvi["usuario_tienda"]==1) $carpeta = "productos";
				elseif($ulvi["usuario_tienda"]==2) $carpeta = cual_nombre_carpeta($ulvi["id_usuario_tienda"])."/productos";?>
          		<li><a href="/articulo/<?=limpiar_cadena($ulvi["titulo"]);?>/<?=$ulvi["id"];?>"><img src="/<?=$carpeta;?>/<?=$ulvi["foto1"];?>" width="81" height="55" class="imgult" alt="<?=$ulvi["titulo"];?>" /></a></li>
			<? }?>
          </ul></td>
          </tr>
      </table>
     </div></div>
     </div>
   </div>
    <div style="float:left; margin-top:6px;">
      <div class="titcat">LO MAS BUSCADO</div>
      <div class="lomas">
          <div class="homint">
            <ul style="text-align:justify; width:190px;">
            <? 
			$prod_vistos = mysql_query("SELECT id, titulo FROM productos WHERE vence>= NOW() ORDER BY visitas DESC LIMIT 0,2");
			while($pr_vi = mysql_fetch_array($prod_vistos))
			{?>
            <li style="padding-top:10px;" class="titulo_ruta"><a href="/articulo/<?=limpiar_cadena($pr_vi["titulo"]);?>/<?=$pr_vi["id"]?>" class="titulo_ruta"><?=$pr_vi["titulo"];?></a></li>
            <? }?>
            </ul>
          </div>
        </div>
    </div>
    </div></td>
<td width="300" valign="top"><div class="titcat"><div style="float:left; width:90px; height:20px;" align="right"><img src="/imagenes/icon_tr.jpg" width="28" height="20" border="0" /></div><div style="width:140px; height:20px; float:left">TIENDAREPUESTOS</div></div>
        <div id="tr">
        <?
		$tiendas_mas = mysql_query("SELECT count( productos.id ) AS cant, tienda_virtual.id, tienda_virtual.razon_social, tienda_virtual.nombre_oficial, tienda_virtual.logo FROM productos LEFT JOIN tienda_virtual ON productos.id_usuario_tienda = tienda_virtual.id WHERE productos.usuario_tienda = '2' && productos.vence > NOW() GROUP BY tienda_virtual.id ORDER BY cant DESC LIMIT 0 , 3");
		while($tim = mysql_fetch_array($tiendas_mas))
		{
			$carpeta = limpiar_cadena($tim["razon_social"]);
			$logo = "/".$carpeta."/".$tim["logo"];
        ?>
        <a href="/tr/<?=limpiar_cadena($tim["nombre_oficial"])?>/<?=$tim["id"]?>/0/0/1"><img src="<?=$logo?>" width="260" height="69" border="0" /></a>
        <? }?></div>
      <div id="ft"><a href="/tiendarepuestos/all/1"><img src="/imagenes/ver_mas_verde.jpg" width="300" height="33" border="0" /></a></div>
      <div class="titcat">NOTICIAS</div>
      <? 
	  $noticia = mysql_query("SELECT * FROM noticias WHERE id='1'");
	  $not = mysql_fetch_array($noticia);?>
      <div id="tr2"><img src="/imagenes_noticias/<?=$not["foto"]?>" width="255" /><br />
        <a href="<?=$not["link"]?>" target="_blank"><?=$not["sumario"];?></a></div>
      <div><a href="<? if($not["link"]!=""){ echo $not["link"]; } else { echo "/noticia/".limpiar_cadena($not["titulo"])."/1"; }?>"><img src="/imagenes/ver_mas_rojo.jpg" width="300" height="33" border="0" /></a></div></td>
    <td width="10" valign="top">&nbsp;</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
