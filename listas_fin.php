<?php 
include("conexion.php");
session_start();
include("funciones.php");

if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<?php }
$id = $_SESSION["userid"];
$ver_tienda = mysql_query("SELECT * FROM tienda_virtual WHERE id='$id'");
$vt = mysql_fetch_array($ver_tienda);
$carpeta = limpiar_cadena($vt["razon_social"]);
$nombretr = limpiar_cadena($vt["nombre_oficial"]);
if (empty($_POST['busqueda'])){
  date_default_timezone_set('America/Caracas');
  if ($_GET['ord'] == 'min'){
    $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY precio ASC";
  include("paginar4.inc.php");
  }
   elseif ($_GET['ord'] == 'max'){
    $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY precio DESC";
  include("paginar4.inc.php");
  }
   elseif ($_GET['ord'] == 'menosvisitas'){
    $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY visitas ASC";
  include("paginar4.inc.php");
  }
   elseif ($_GET['ord'] == 'masvisitas'){
    $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY visitas DESC";
  include("paginar4.inc.php");
  }
  elseif ($_GET['ord'] == 'antiguos'){
    $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY vence ASC";
  include("paginar4.inc.php");
  }
  elseif ($_GET['ord'] == 'recientes'){
    $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY vence DESC";
  include("paginar4.inc.php");
  }
  else{
 $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' ORDER BY vence DESC";
  include("paginar4.inc.php");
  }
}
else{
  //echo "hola".$_POST["busqueda"];
  $palabra = $_POST['palabra'];
$_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence < '".date("Y-m-j")."' && (descripcion LIKE '%$palabra%' OR titulo LIKE '%$palabra%' OR subtitulo LIKE '%$palabra%' OR id='$palabra') ORDER BY fecha_publicacion DESC";
include("paginar4.inc.php");
}
//echo $_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence<NOW() ORDER BY vence DESC";
//include("paginar4.inc.php");
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
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<body>
<?php include("includes/header_home.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
          <td height="30" colspan="4" class="titulo_ruta"><?=$nombretr?> > Mi Cuenta > Productos Finalizados</td>
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
          <td width="192"><a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_on.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        <tr>
          <td height="8" colspan="6" background="/imagenes/login_bg_bot.jpg"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
    <tr>
    <td>
    <!-- Buscador -->
    <table width="600" border="0" cellpadding="0" cellspacing="0">
    <form method="post" action="/articulos_finalizados/tienda_master/1" name="form_bus" id="form_bus">
      <tr>
        <td width="500" align="left"><input name="busqueda" type="hidden" value="1"><input name="palabra" type="text" class="formt"value="" /></td>
        <td width="100" align="left"><input name="button" type="image" id="button" value="Submit" src="/imagenes/btn_busca_dere.jpg" /></td>
      </tr>
      </form>
    </table>      
    </td>
  </tr>
  <tr>
    <td width="625" colspan="3" valign="top">
    <table width="100%" border="0" align="right" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="3" class="titulo_seccion"><span class="red"><?=$_pagi_totalReg;?></span> Art&iacute;culos Finalizados
<?php 
if (!empty($_POST['busqueda'])){
  echo ' que coinciden con: <span style="color:red;">'.$palabra.'</span>';
}
 ?>
    </td>
       <td colspan="4"  class="titulo_seccion" style="text-align:right;">Ordenar por:
    <form id="form2" name="form2" method="post" action="" style="width:150px; display:inline;">
      <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" class="form">
        <option selected>seleccione</option>
          <option value="/articulos_finalizado/<?=limpiar_cadena($nombretr)?>/1/min">Menor precio</option>
          <option value="/articulos_finalizado/<?=limpiar_cadena($nombretr)?>/1/max">Mayor precio</option>
          <option value="/articulos_finalizado/<?=limpiar_cadena($nombretr)?>/1/menosvisitas">Menos Visitas</option>
          <option value="/articulos_finalizado/<?=limpiar_cadena($nombretr)?>/1/masvisitas">M&aacute;s Visitas</option>
          <option value="/articulos_finalizado/<?=limpiar_cadena($nombretr)?>/1/antiguos">Antiguos</option>
          <option value="/articulos_finalizado/<?=limpiar_cadena($nombretr)?>/1/recientes">Recientes</option>
      </select>
    </form>
    </td>
    </tr>
  <tr height="25" background="/imagenes/bg_botonera.jpg" class="menu">
    <td width="154" class="link">FOTO</td>
    <td width="210" class="link">DESCRIPCI&Oacute;N</td>
    <td width="110">PRECIO</td>
    <td width="110">VISITAS</td>
    <td width="110">ARTICULO #</td>
    <td width="110">VENCE</td>
    <td width="110">ACCIONES</td>
  </tr>
    </table>
    <form action="/articulos_republicar/<?=$nombretr?>/0" method="post">
      <div class="titulo_categoria" style="padding-bottom:10px; clear:both;"></div>
      <?
	while($vpt = mysql_fetch_array($_pagi_result))
	{
			$carpeta_productos = cual_nombre_carpeta($_SESSION["userid"])."/productos";
    ?>
      <div style="width:960px; height:110px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px;">
         <div style="width:20px; float:left;"><input name="rep[]" type="checkbox" value="<?=$vpt["id"]?>"></div>
         <div style="width:360px; float:left;">
          <a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>"><img src="/<?=$carpeta_productos?>/<?=$vpt["foto1"]?>" width="125" height="88" hspace="5" vspace="5" border="0" align="left" /></a><span class="blue"><a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>" class="blue"><?=$vpt["titulo"]?></a></span><br />
          <?=$vpt["subtitulo"]?></div>
        <div class="red" style="width:120px; float:left;"><?=$vpt["precio"]?></div>
        <div class="gris" style="width:120px; float:left;"><?=$vpt["visitas"]?></div>
        <div class="gris" style="width:120px; float:left;"><?=numero_articulo($vpt["id"]);?></div>
        <div class="gris" style="width:120px; float:left;"><?=$vpt["vence"]?><br /><?=cual_estado($vpt["id_estado"])?></div>
        
        <div class="gris" style="width:100px; float:left;"><a href="/articulos_republicar/<?=$nombretr?>/<?=$vpt["id"]?>/" class="republicar">republicar</a></div></div>
      <? }?>
      <div align="center"><input name="" type="image" src="/imagenes/btn_republicar.jpg" />
        <input type="hidden" name="republicar" value="1" />
        <br />
        Al realizar esta acci&oacute;n los art&iacute;culos ser&aacute;n tomados como nuevas publicaciones y seran descontados de su paquete activo.<br /><br /></div>
      </form>
    </td>
  </tr>
  <tr>
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
