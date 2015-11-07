<? 
include("conexion.php");
session_start();
include("funciones.php");
if($_GET["tipo"]=="all")
{
	$_SESSION["palabra_tienda"]="";
}
if($_POST["palabra_tienda"])
{
	$palabra_tienda=$_POST["palabra_tienda"];
	$_SESSION["palabra_tienda"] = $palabra_tienda;
}
$palabra_tienda = $_SESSION["palabra_tienda"];

if($palabra_tienda!="") 
{
	$trozos=explode(" ",$palabra_tienda);
  	$numero=count($trozos);
  	if ($numero==1)
		$_pagi_sql="SELECT razon_social, id, logo, nombre_oficial, descripcion FROM tienda_virtual p WHERE (nombre_oficial LIKE '%$palabra_tienda%' OR descripcion LIKE '%$palabra_tienda%' OR razon_social LIKE '%$palabra_tienda%') && activo='1'";
	else
		$_pagi_sql="SELECT razon_social, id, logo, nombre_oficial, descripcion, MATCH(nombre_oficial,razon_social,direccion,descripcion) AGAINST ('$palabra_tienda') AS puntuacion FROM tienda_virtual WHERE activo='1' ORDER BY puntuacion DESC"; 
}
else
{
	$_pagi_sql= "SELECT count( productos.id ) AS cant, tienda_virtual.razon_social, tienda_virtual.id, tienda_virtual.logo, tienda_virtual.nombre_oficial, tienda_virtual.descripcion FROM productos LEFT JOIN tienda_virtual ON productos.id_usuario_tienda = tienda_virtual.id WHERE productos.usuario_tienda = '2' && productos.vence > NOW() && tienda_virtual.activo='1' GROUP BY tienda_virtual.id ORDER BY cant DESC";
}
include("paginar4.inc.php");
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
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<div class="titulo_ruta" style="height:30px; padding-top:10px;"><a href="/inicio/" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/tiendarepuestos/all/1/" class="titulo_ruta">Tiendarepuestos</a> <? if($palabra_tienda!=""){?> > <? echo $palabra_tienda; }?></div>
</td>
    <td width="500" align="right"><? 
			if($_SESSION["userid"]!="") 
			{
                echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";?>
 <a href="/mitr/<?=cual_nombre_carpeta($_SESSION["userid"])?>/" class="blue">Mi TIENDAREPUESTOS</a> | <a href="/salirTR/" class="red" target="_self">(Salir)</a>
<? 
			}
			elseif($_SESSION["userid"]=="")
			{?>
			<a href="/registroTR/" class="blue">¿Deseas una TIENDAREPUESTOS?</a> | <a href="/iniciar_sesion/" class="blue">Mi TIENDAREPUESTOS</a>
<? }?></td>
  </tr>
</table>
<div align="center" style="width:940px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 auto; padding:8px;">
<table border="0" align="center" cellpadding="0" cellspacing="0" width="900">
  <tr>
    <td colspan="2" valign="top" class="titulo_categoria">Directorio de TIENDAREPUESTOS</td>
    </tr>
  <tr>
    <td height="50" colspan="2" valign="top"><table width="850" border="0" cellpadding="0" cellspacing="8">
    <form name="busti" id="busti" action="/tiendarepuestos/buscar/1" method="post">
      <tr>
        <td class="titulo_seccion">Buscar TIENDA REPUESTOS:</td>
        <td><input name="palabra_tienda" type="text" class="formt" value="" /></td>
        <td><input name="button2" type="image" id="button2" value="Submit" src="/imagenes/btn_busca_dere.jpg" /></td>
      </tr>
      </form>
    </table></td>
    </tr>
  <tr>
    <td width="150" valign="top"><script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://vendorepuestos.com.ve/publicidad/adjs.php?n=" + phpAds_random);
   document.write ("&amp;what=zone:2");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=a1618f08' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:2&amp;n=a1618f08' border='0' alt=''></a></noscript>
</td>
    <td valign="top">
      <? 
	while($vt = mysql_fetch_array($_pagi_result))
	{
			$carpeta = limpiar_cadena($vt["razon_social"]);?>
            <div style="width:750px; height:90px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px; float:left;">
      		<a href="/tr/<?=limpiar_cadena($vt["nombre_oficial"])?>/<?=$vt["id"]?>/0/0/1"><img src="/<?=$carpeta?>/<?=$vt["logo"]?>" width="280" height="80" hspace="5" vspace="5" border="0" align="left" /></a><span class="blue"><?=$vt["nombre_oficial"];?></span><br />
      		<span class="bluep">Cantidad de Art&iacute;culos: <?=cuantos_articulos($vt["id"])?>
      		</span><br /><?=$vt["descripcion"];?></a>
      		</div>
      <? }?>
     </td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e1e1e1">
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
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
