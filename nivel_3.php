<? 
include("conexion.php");
session_start();
include("funciones.php");
$idc=$_GET["idc"];
$idm=$_GET["idm"];
$idsm=$_GET["idsm"];

if($_GET["ide"]!=0)
{
	$busedo = "&& id_estado='".$_GET["ide"]."'";
}

if($idsm!=0)
{ 
	$ver_submenu = mysql_query("SELECT * FROM submenu2 WHERE id_submenu='".$idsm."' ORDER BY orden ASC");
	$_pagi_sql= "SELECT * FROM productos WHERE id_categoria='$idc' && id_menu='$idm' && id_submenu='$idsm' && vence>= NOW() $busedo ORDER BY vence ASC";
} 
else
{ 
	$_pagi_sql= "SELECT * FROM productos WHERE id_categoria='$idc' && id_menu='$idm' && vence>= NOW() $busedo ORDER BY vence ASC";
	//si tiene submenu
	$ver_submenu = mysql_query("SELECT * FROM submenu WHERE id_menu='".$idm."' ORDER BY orden ASC");
}
$div_ppal = "<div style=\"width:760px; height:110px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px;\">";
$div="<div style=\"width:500px; height:110px; float:left; margin-left:20px;\">";

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
<div id="banner"><script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://vendorepuestos.com.ve/publicidad/adjs.php?n=" + phpAds_random);
   document.write ("&amp;what=zone:5");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=a5786b0f' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:5&amp;n=a5786b0f' border='0' alt=''></a></noscript>
</div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <div class="titulo_ruta" style="height:30px;"><a href="/inicio/" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/vista_nivel2/<?=limpiar_cadena(cual_categoria($idc))?>/<?=$idc?>/" class="titulo_ruta"><?=cual_categoria($idc);?></a> > <a href="/vista_nivel3/<?=limpiar_cadena(cual_menu($idm))?>/<?=$idc?>/<?=$idm?>/0/0/1/" class="titulo_ruta"><?=cual_menu($idm);?></a> <? if($idsm!=0){ echo " > ";?> <a href="/vista_nivel3/<?=limpiar_cadena(cual_submenu($idsm))?>/<?=$idc?>/<?=$idm?>/<?=$idsm?>/0/1/" class="titulo_ruta"><?=cual_submenu($idsm)?></a> <? }?></div>
      <table width="960" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td rowspan="2" valign="top">
		  <?
		if($idsm!=0) 
			$ver_submenu = mysql_query("SELECT * FROM submenu2 WHERE id_submenu=".$idsm."ORDER BY orden ASC");
		else 
			$ver_submenu = mysql_query("SELECT * FROM submenu WHERE id_menu=".$idm." ORDER BY orden ASC");
	  	if(mysql_num_rows($ver_submenu)>0)
	  	{?>
      	<div style="clear:both; width:240px; float:left;">
      	  <div class="titcat2">CATEGORIAS</div>
      	  <?
				while($vsm = mysql_fetch_array($ver_submenu))
        		{
					//si tengo productos
					if($idsm!= 0)
					{
						$idsm_aux = $idsm; $idssm_aux = $vsm["id"];
						$canti = cuantos_productos_categoria($idc,$idm,$idsm_aux,$idssm_aux);
						if($canti > 0)
						{
					?>
      	  <div class="cat"><a href="/vista_nivel4/<?=limpiar_cadena($vsm["nombre"]);?>/<?=$idc?>/<?=$idm;?>/<?=$idsm_aux?>/<?=$idssm_aux?>/1" class="bluep"><?=ucfirst(strtolower($vsm["nombre"]))?></a> (<?=$canti;?>)</div>
      	  <? 		}
					}
					else
					{
						$idsm_aux = $vsm["id"]; $idssm_aux=0;
						$canti = cuantos_productos_categoria($idc,$idm,$idsm_aux,$idssm_aux); 
						if($canti > 0)
						{
						?>
      	  <div class="cat"><a href="/vista_nivel3/<?=limpiar_cadena($vsm["nombre"])?>/<?=$idc?>/<?=$idm;?>/<?=$idsm_aux?>/<?=$idssm_aux?>/1" class="bluep"><?=ucfirst(strtolower($vsm["nombre"]))?></a> (<?=$canti;?>)</div>
      	  <?		}
					}
				}?>
      	  <div class="ft"><img src="/imagenes/degrade_amarillo.jpg" width="240" height="37" /></div>
    	  </div>
      <?
	  }?>
      <div style="clear:both; width:240px; float:left;">
      <div class="titcat2">UBICACION</div>
    <?=ubicacion_activas_nivel3($idc,$idm,$idsm);?>
    <div class="ft"><img src="/imagenes/degrade_amarillo.jpg" width="240" height="37" /></div></div>
    <div><script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://vendorepuestos.com.ve/publicidad/adjs.php?n=" + phpAds_random);
   document.write ("&amp;what=zone:6");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=a93eb3ea' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:6&amp;n=a93eb3ea' border='0' alt=''></a></noscript>
</div>
    
	  <? include("paginar4.inc.php");?>      </td>
          <td valign="top" height="20px"><table width="100%" border="0" align="left" cellpadding="3" cellspacing="0">
            <tr>
              <td colspan="4" class="titulo_seccion"><span class="red">
                <?=$_pagi_totalReg;?>
              </span> art&iacute;culo(s) encontrados</td>
            </tr>
            <tr height="25" background="/imagenes/bg_botonera.jpg" class="menu">
              <td width="164" class="link">GALERIA</td>
              <td  class="link">DESCRIPCI&Oacute;N</td>
              <td width="110">PRECIO</td>
              <td width="110">VENCE</td>
            </tr>
            <tr>
              <td colspan="4" class="link" height="10"></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td valign="top"><? 
			while($b = mysql_fetch_array($_pagi_result))
        	{
				if($b["usuario_tienda"]==1) $carpeta_productos = "productos";
				elseif($b["usuario_tienda"]==2) $carpeta_productos = cual_nombre_carpeta($b["id_usuario_tienda"])."/productos";
			?>
            	<?=$div_ppal;?>
				<?=$div;?>
        		<a href="/articulo/<?=limpiar_cadena($b["titulo"])?>/<?=$b["id"]?>"><img src="/<?=$carpeta_productos?>/<?=$b["foto1"]?>" width="145" height="108" hspace="5" vspace="5" border="0" align="left" /></a>
				<span class="blue"><a href="/articulo/<?=limpiar_cadena($b["titulo"])?>/<?=$b["id"]?>" class="blue"><?=$b["titulo"]?></a></span><br /><?=$b["subtitulo"]?><br /> 
            	<span class="bluep"><a href="/articulo/<?=limpiar_cadena($b["titulo"])?>/<?=$b["id"]?>" class="bluep">Art&iacute;culo # <?=numero_articulo($b["id"]);?></a></span><br />
                <? if($b["usuario_tienda"]=="2"){?>visite <?=cual_usuario($b["id_usuario_tienda"],2)?><br /><a href="/tr/<?=limpiar_cadena(cual_usuario($b["id_usuario_tienda"],2))?>/<?=$b["id_usuario_tienda"]?>/0/0/1"><img src="/imagenes/icon_tr.jpg" width="33" height="25" border="0" /></a><? }?><br /></div>
				<div class="red" style="width:100px; float:left;">Bs. <?=$b["precio"]?></div>
            	<div class="gris" style="width:100px; float:left;"><?=date("d-m-Y",strtotime($b["vence"]))?><br /> 
            	<?=cual_estado($b["id_estado"])?></div>
                </div>
			<? }?></td>
        </tr>
      </table>
     
		
    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e1e1e1">
  	<form name="form_pag" action="" method="post">
    <tr>
    <td width="200" class="pag">P&aacute;g <?=$_pagi_actual;?> de <?=$_pagi_totalPags?></td>
    <td align="center" class="pag"><?=$_pagi_navegacion?></td>
    <td width="100" align="right">Ir a la p&aacute;gina:&nbsp;</td>
    <td width="50" align="right"><input name="pg" type="text" class="formpag" size="3" /></td>
    <td width="30" align="right"><input name="input" type="image" src="/imagenes/btn_ir.jpg" /></td>
    </tr>
  	</form>
</table></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
