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
<!--carrusel-->
<script type="text/javascript" src="/over-text/jquery.js"></script>
<script type="text/javascript" src="/lib/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/skin_home.css" />
<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});
</script>
<script type="text/javascript" src="/js/prototype.js"></script>
<!--<script src="/jscalendar/src/js/jscal2.js"></script>
<script src="/jscalendar/src/js/lang/es.js"></script>
<link rel="stylesheet" type="text/css" href="/jscalendar/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="/jscalendar/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="/jscalendar/src/css/steel/steel.css" />
<script type="text/javascript" src="/admini/ckfinder/ckfinder.js"></script>-->
 

<script type="text/javascript">
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
function validar(formn3)
{
	if(formn3.id_menu.value=="0")
	{
		alert("Debe Seleccionar una Marca");
		formn3.id_menu.focus();
		return false;
	}
	else
	{
		idc = <?=$idc?>;
		if(formn3.id_submenu2.value=="0")
		{
			if(formn3.id_estado.value=="0")
				document.formn3.action = "/vista_nivel3/<?=limpiar_cadena(cual_categoria($idc));?>/"+idc+"/"+formn3.id_menu.value+"/"+formn3.id_submenu.value+"/0/1";
			else
				document.formn3.action = "/vista_nivel3/<?=limpiar_cadena(cual_categoria($idc));?>/"+idc+"/"+formn3.id_menu.value+"/"+formn3.id_submenu.value+"/"+formn3.id_estado.value+"/1";
		}
		else
		{
			document.formn3.action = "/vista_nivel4/<?=limpiar_cadena(cual_categoria($idc));?>/"+idc+"/"+formn3.id_menu.value+"/"+formn3.id_submenu.value+"/"+formn3.id_submenu2.value+"/"+formn3.id_estado.value+"/1";
		}
		return true;
	}
}
</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<!--<div id="banner"><img src="/imagenes/banner_ppla.jpg" width="728" height="90" /></div>-->
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <div class="titulo_ruta" style="height:30px; padding-top:10px;"><a href="/inicio/" class="titulo_ruta">vendorepuestos.com.ve</a> > <a href="/vista_nivel2_full/<?=limpiar_cadena(cual_categoria($idc));?>/<?=$idc?>" class="titulo_ruta"><?=cual_categoria($idc);?></a></div>
      <div class="titulo_categoria" style="height:40px; padding-top:10px;"><?=cual_categoria($idc);?></div>
      <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr>
<td>
<form name="formn3" id="formn3" action="" method="post" onsubmit="return validar(this);">
<div style="width:260px; float:left; padding-right:10px; padding-left:90px; padding-top:20px;">
<table width="240" cellpadding="0" cellspacing="0" style="border:1px solid #D3D3D3;">
        <tr>
          <td height="41" colspan="2" class="desc"><div class="titcat_tienda">MARCA</div><div id="linea_division_tienda"></div></td>
          </tr>
        <tr>
  <td height="41" colspan="2" class="desc" align="center">
  <select class="form" name="id_menu" onChange="cargar_submenu(this.value,0,0);">
    <option value="0">Seleccione</option>
    <?php 
	$sql_menu=mysql_query("SELECT * FROM menu WHERE id_categoria='$idc' ORDER BY nombre ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?><option value="<?=$menu["id"]?>"><?=$menu["nombre"]?></option>
    <?php 
	}
	?>
  </select>
    <script>cargar_submenu('<?=$id_menu[0]?>','0','0');</script>  </td>
  </tr>
</table>
      </div>
      <div style="width:260px; float:left; padding-right:10px; padding-top:20px;">
<table width="240" cellpadding="0" cellspacing="0" style="border:1px solid #D3D3D3;">
        <tr>
          <td height="41" class="desc"><div class="titcat_tienda">MODELO</div>
            <div id="linea_division_tienda"></div></td>
        </tr>
        <tr>
          <td height="41" class="campo" id="submenu" align="center"><select class="form" name="id_submenu">
            <option value="0">No aplica</option>
          </select></td>
</tr></table>
      </div>
      <div style="width:260px; float:left; padding-right:10px; padding-top:20px;">
<table width="240" cellpadding="0" cellspacing="0" style="border:1px solid #D3D3D3;">
        <tr>
          <td height="41" class="desc"><div class="titcat_tienda">A&Ntilde;O</div>
            <div id="linea_division_tienda"></div></td>
          </tr>
<tr>
  <td height="41" class="campo" id="submenu2" align="center"><select class="form" name="id_submenu2">
    <option value="0">No aplica</option>
  </select></td>
</tr></table>
      </div>
      <br /><br />
      <div style="width:260px; float:left; padding-right:10px; padding-left:80px; padding-top:20px; padding-bottom:20px;">
       <table width="240" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #D3D3D3;">
       <tr class="tabla" >
         <td><div class="titcat_tienda">UBICACION</div>
       <div id="linea_division_tienda"></div></td>
         </tr>
       <tr class="tabla">
  <td height="41" align="center"><select class="form" name="id_estado">
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
  </tr></table></div>
<div style="width:520px; float:left; padding-top:70px; padding-bottom:20px;" align="right"><input name="" type="image" src="/imagenes/btn_busca_dere.jpg" />
</div>
</form>
<br /><br />
<div align="center" style="width:780px; clear:both; padding-left:90px; padding-top:20px; padding-bottom:20px;">
	<iframe src="/marcas_logos.php?idc=<?=$idc?>" marginwidth="0" height="77" width="780" marginheight="0" scrolling="auto"  style="border:1px solid #D3D3D3;"></iframe>
</div>
       </td></tr>
<tr>
  <td><div  style="clear:both">
   <div style="float:left; margin: 6px 10px 0 0">
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
			$prod_vistos = mysql_query("SELECT id, titulo FROM productos WHERE id_categoria!='1' && vence>= NOW() ORDER BY visitas DESC LIMIT 0,2");
			while($pr_vi = mysql_fetch_array($prod_vistos))
			{?>
            <li style="padding-top:10px;" class="titulo_ruta"><a href="/articulo/<?=limpiar_cadena($pr_vi["titulo"]);?>/<?=$pr_vi["id"]?>" class="titulo_ruta"><?=$pr_vi["titulo"];?></a></li>
            <? }?>
            </ul>
          </div>
        </div>
    </div>
    
    <div style="float:left; margin-top:6px; margin-left:10px;">
      <div class="titcat">REPUESTOS Y ACCESORIOS</div>
      <div class="lomas">
          <div class="homint">
            <ul style="text-align:justify; width:190px;">
            <? 
			$prod_vistos = mysql_query("SELECT id, titulo FROM productos WHERE id_categoria='1' && vence>= NOW() ORDER BY visitas DESC LIMIT 0,2");
			while($pr_vi = mysql_fetch_array($prod_vistos))
			{?>
            <li style="padding-top:10px;" class="titulo_ruta"><a href="/articulo/<?=limpiar_cadena($pr_vi["titulo"]);?>/<?=$pr_vi["id"]?>" class="titulo_ruta"><?=$pr_vi["titulo"];?></a></li>
            <? }?>
            </ul>
          </div>
        </div>
    </div>
   </td>
</tr>
      </table>
    </td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
