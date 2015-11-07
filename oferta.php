<? 
include("conexion.php");
session_start();
include("funciones.php");

if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }
$id = $_SESSION["userid"];
$ver_tienda = mysql_query("SELECT * FROM tienda_virtual WHERE id='$id'");
$vt = mysql_fetch_array($ver_tienda);
$carpeta = limpiar_cadena($vt["razon_social"]);

if($_GET['sw']=='1'){
	$idofer = $_GET["idofer"];
	$update = mysql_query("UPDATE productos SET oferta_dia='1' WHERE id='$idofer' && usuario_tienda='2' && id_usuario_tienda='$id'");
	$update_otros =  mysql_query("UPDATE productos SET oferta_dia='0' WHERE id!='$idofer' && usuario_tienda='2' && id_usuario_tienda='$id'");
}

$_pagi_sql = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && oferta_dia='1' ORDER BY fecha_publicacion DESC";
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
<?php include("includes/header_home.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td colspan="6" align="right">
        <? 
			if($_SESSION["userid"]!="") 
			{
                echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";?>
 <a href="/salirTR/" class="red" target="_self">(Salir)</a>
 		<? }?>
        </td></tr>
        <tr>
          <td width="43"><a href="/mitr/<?=$carpeta?>"><img src="/imagenes/login_btn_1_off.jpg" name="mitr" width="43" height="20" border="0" /></a></td>
          <td width="131"><a href="/estado_cuenta/<?=$carpeta?>"><img src="/imagenes/login_btn_2_off.jpg" name="edo" width="131" height="20" border="0" /></a></td>
          <td width="143"><a href="/datos_vendedor/<?=$carpeta?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=$carpeta?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=$carpeta?>/1"><img src="/imagenes/login_btn_5_on.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=$carpeta?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
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
    <td width="625" colspan="3" valign="top">
       <table width="100%" border="0" align="right" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="6" class="titulo_seccion"><span class="red"><?=$_pagi_totalReg;?></span> Art&iacute;culos Activos</td>
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
      <div class="titulo_categoria" style="padding-bottom:10px; clear:both;"></div>
      <?
	while($vpt = mysql_fetch_array($_pagi_result))
	{
			$carpeta_productos = cual_nombre_carpeta($_SESSION["userid"])."/productos";
    ?>
      <div style="width:960px; height:110px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px;">
        <div style="width:360px; float:left;">
          <a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>"><img src="/<?=$carpeta_productos?>/<?=$vpt["foto1"]?>" width="125" height="88" hspace="5" vspace="5" border="0" align="left" /></a><span class="blue"><a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>" class="blue"><?=$vpt["titulo"]?></a></span><br />
          <?=$vpt["subtitulo"]?></div>
        <div class="red" style="width:120px; float:left;"><?=$vpt["precio"]?></div>
        <div class="gris" style="width:120px; float:left;"><?=$vpt["visitas"]?></div>
        <div class="gris" style="width:120px; float:left;"><?=numero_articulo($vpt["id"]);?></div>
        <div class="gris" style="width:120px; float:left;"><?=$vpt["vence"]?><br /> 
            <?=cual_estado($vpt["id_estado"])?></div>
        <div class="gris" style="width:120px; float:left;">Oferta del dia:<input type="radio" name="activo" id="1" <? if($vpt["oferta_dia"]=="1"){?>checked="checked"<? }?> onClick="activar_oferta(<?=$vpt["id"]?>)" /><br />
          <span class="bluep"><a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>/" class="bluep">ver</a> | <a href="/articulo_editar/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>/" class="bluep">editar</a></span></div></div>
      <? }?>
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
