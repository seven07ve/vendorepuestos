<? 
include("conexion.php");
session_start();
include("funciones.php");
if($_POST["categoria_buscar"]) 
{
	$categoria_buscar = $_POST["categoria_buscar"];
	$_SESSION["categoria_buscar"] =  $categoria_buscar;
}
if($_POST["palabra"]){
	$palabra=$_POST["palabra"];
	$_SESSION["palabra"] = $palabra;
}
else{
	$palabra = "todos";
	$_SESSION["palabra"] = $palabra;
}
$categoria_buscar = $_SESSION["categoria_buscar"];
$palabra = $_SESSION["palabra"];


//version 2.
if($_GET["ide"]!=0)
{
	$busedo = "&& p.id_estado='".$_GET["ide"]."'";
}
if ($_GET["ord"] == "min"){
  $orden = " ORDER BY precio ASC";
}
elseif ($_GET["ord"] == "max"){
  $orden = " ORDER BY precio DESC";
}
else{
  $orden = "";
}

if($categoria_buscar==0) 
{
	if($palabra!="todos"){
		$trozos=explode(" ",$palabra);
  		$numero=count($trozos);
  		if ($numero==1){
 			$_pagi_sql="SELECT p. * FROM productos p LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.vence>= NOW() && (c.nombre LIKE '%$palabra%' OR p.descripcion LIKE '%$palabra%' OR p.titulo LIKE '%$palabra%' OR p.subtitulo LIKE '%$palabra%' OR p.id='$palabra') $busedo$orden";
  		}
		else{
			if ($_GET["ord"] == "0"){
				$orden = " ORDER BY puntuacion DESC";
			}
			$_pagi_sql="SELECT p. *, MATCH(p.titulo,p.subtitulo,p.descripcion) AGAINST ('$palabra') AS puntuacion FROM productos p LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.vence>= NOW() AND MATCH(p.titulo,p.subtitulo,p.descripcion) AGAINST ('$palabra') $busedo$orden"; 
		}
	}
	else
	{
		echo $_pagi_sql="SELECT p. * FROM productos p LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.vence>= NOW() $busedo$orden";
	}
}
else
{
	if($palabra!="todos"){
		$trozos=explode(" ",$palabra);
		$numero=count($trozos);
		if ($numero==1){
			if ($_GET["ord"] == "0"){
				$orden = " ORDER BY vence ASC";
			}
			$_pagi_sql="SELECT p. *, c.*  FROM productos p LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.vence>= NOW() && (c.id='$categoria_buscar' && (c.nombre LIKE '%$palabra%' OR p.descripcion LIKE '%$palabra%' OR p.titulo LIKE '%$palabra%' OR p.subtitulo LIKE '%$palabra%' OR p.id='$palabra') $busedo)$orden";
		}
		else{
			if ($_GET["ord"] == "0"){
				$orden = " ORDER BY puntuacion DESC, vence ASC";
			}
			$_pagi_sql="SELECT p. *, c.*, MATCH(p.titulo,p.subtitulo,p.descripcion) AGAINST ('$palabra') AS puntuacion FROM productos p LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.vence>= NOW() && (c.id='$categoria_buscar' && MATCH(p.titulo,p.subtitulo,p.descripcion) AGAINST ('$palabra')) $busedo$orden";
		}
	}
	else
	{
		if ($_GET["ord"] == "0"){
			$orden = " ORDER BY vence ASC";
		}
		$_pagi_sql="SELECT p. *, c.*  FROM productos p LEFT JOIN categoria c ON p.id_categoria = c.id WHERE p.vence>= NOW() $busedo$orden";
	}
}
include("paginar4.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
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
   document.write ("&amp;what=zone:4");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://vendorepuestos.com.ve/publicidad/adclick.php?n=af04504e' target='_blank'><img src='http://vendorepuestos.com.ve/publicidad/adview.php?what=zone:4&amp;n=af04504e' border='0' alt=''></a></noscript>
</div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titcat2">UBICACION</div>
    <?=ubicacion_activas_busqueda($_GET["yy"],$palabra,$categoria_buscar);?>
    <div class="ft"><img src="/imagenes/degrade_amarillo.jpg" width="240" height="37" /></div>
    <div align="center"><script language='JavaScript' type='text/javascript' src='http://vendorepuestos.com.ve/publicidad/adx.js'></script>
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
</div>
    </td>
    <td valign="top">
    <table width="700" border="0" align="left" cellpadding="3" cellspacing="0">
      <tr>
        <td colspan="2" class="titulo_seccion"><span class="red"><?=$_pagi_totalReg;?></span> art&iacute;culo(s) encontrados para: <span class="negra"><?=$palabra;?></span></td>
              <td colspan="4"  class="titulo_seccion" style="text-align:right;">Ordenar por:
                <form id="form2" name="form2" method="post" action="" style="width:150px; display:inline;">
                  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" class="form">
                    <option selected>seleccione</option>
                    <option value="/buscar/<?php echo $categoria_buscar ?>/<?php echo $palabra ?>/0/1/min">Menor precio</option>
                    <option value="/buscar/<?php echo $categoria_buscar ?>/<?php echo $palabra ?>/0/1/max">Mayor precio</option>
                  </select>
                </form>
              </td>
      </tr>
       <tr height="25" background="/imagenes/bg_botonera.jpg" class="menu">
         <td width="164" class="link">GALERIA</td>
         <td width="310" colspan="-1" class="link">DESCRIPCI&Oacute;N</td>
         <td width="110">PRECIO</td>
         <td width="110">VENCE</td>
       </tr>
       <tr>
         <td colspan="4" class="link" height="10"></td>
        </tr>
      </table>
	<?
	while($b = mysql_fetch_array($_pagi_result))
	{
			if($b["usuario_tienda"]==1) $carpeta_productos = "productos";
			elseif($b["usuario_tienda"]==2) $carpeta_productos = cual_nombre_carpeta($b["id_usuario_tienda"])."/productos";
    ?>
    <div style="width:685px; height:120px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px; clear:both;">
	  <div style="width:480px; float:left; margin:0 5px 0 0">
            <a href="/articulo/<?=limpiar_cadena($b["titulo"])?>/<?=$b["id"]?>"><img src="/<?=$carpeta_productos?>/<?=$b["foto1"]?>" width="145" height="108" hspace="5" vspace="5" border="0" align="left" /></a>
            <span class="blue"><a href="/articulo/<?=limpiar_cadena($b["titulo"])?>/<?=$b["id"]?>" class="blue"><?=$b["titulo"]?></a></span><br />
			<?=$b["subtitulo"]?><br />
            <span class="bluep"><a href="/articulo/<?=limpiar_cadena($b["titulo"])?>/<?=$b["id"]?>" class="bluep">Art&iacute;culo # <?=numero_articulo($b["id"]);?></a></span><br />
			<? if($b["usuario_tienda"]=="2"){?>visite <?=cual_usuario_resultado($b["id_usuario_tienda"],2)?><br /><a href="/tr/<?=limpiar_cadena(cual_usuario($b["id_usuario_tienda"],2))?>/<?=$b["id_usuario_tienda"]?>/0/0/1"><img src="/imagenes/icon_tr.jpg" width="33" height="25" border="0" /></a><? }?><br />
            </div>
			<div class="red" style="width:100px; float:left;">Bs. <?=$b["precio"]?></div>
            <div class="gris" style="width:100px; float:left;"><?=date("d-m-Y",strtotime($b["vence"]))?><br /> 
            <?=cual_estado($b["id_estado"])?></div>
            </div>
    	<? }?></td>
  </tr>
  <tr>
    <td colspan="2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e1e1e1">
  	<form name="form_pag" action="" method="post">
    <tr>
    <td width="200" class="pag">P&aacute;g <?=$_pagi_actual;?> de <?=$_pagi_totalPags?></td>
    <td align="center" class="pag"><?=$_pagi_navegacion?></td>
    <td width="100" align="right">Ir a la p&aacute;gina:&nbsp;</td>
    <td width="50" align="right"><input name="pg" type="text" class="formpag" size="3" /></td>
    <td width="30" align="right"><input name="input" type="image" src="/imagenes/btn_ir.jpg" /></td>
    </tr>
  	</form>
</table>
</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
