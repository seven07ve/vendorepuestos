<?php
include("conexion.php");
session_start();
include("funciones.php");
if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<?php }
$nombretr = cual_nombre_carpeta($_SESSION["userid"]);

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
//var_dump($_POST['rep']);
if($_POST['republicar']){
	$rep = $_POST["rep"];
	$cuantos_republicar = count($rep);
	if($cuantos_republicar<=$productos_disponibles)
		$total = $cuantos_republicar;
	else
		$total = $productos_disponibles;
	for($i=0;$i<$total;$i++){
/*		$insert = mysql_query("INSERT INTO productos (titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu2, id_paquete_usuario, usuario_tienda, id_usuario_tienda) SELECT titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu, id_paquete_usuario, usuario_tienda, id_usuario_tienda FROM productos WHERE id='".$rep[$i]."'");
		$id = mysql_insert_id();
		$update = mysql_query("UPDATE productos SET vence=DATE_ADD(NOW(), INTERVAL 1 MONTH), id_paquete_usuario='$idpa' WHERE id='$id'");*/
		$update = mysql_query("UPDATE productos SET vence=DATE_ADD(NOW(), INTERVAL 1 YEAR), id_paquete_usuario='$idpa', fecha_publicacion=NOW() WHERE id='".$rep[$i]."'");
		$productos_disponibles_now = $productos_disponibles - $cuantos_republicar;
	}
?>
<?php }

elseif($_GET["ida"]!=0)
{
	//var_dump($_GET["ida"]);
	if($productos_disponibles>0)
	{
		$ida = $_GET["ida"];
/*		$insert = mysql_query("INSERT INTO productos (titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu2, id_paquete_usuario, usuario_tienda, id_usuario_tienda) SELECT titulo, subtitulo, foto1, foto2, foto3, descripcion, id_estado, id_ciudad, condicion, precio, vence, id_categoria, id_menu, id_submenu, id_submenu, id_paquete_usuario, usuario_tienda, id_usuario_tienda FROM productos WHERE id='".$ida."'");
		$id = mysql_insert_id();
		$update = mysql_query("UPDATE productos SET vence=DATE_ADD(NOW(), INTERVAL 1 MONTH), id_paquete_usuario='$idpa' WHERE id='$id'");*/
		$update = mysql_query("UPDATE productos SET vence=DATE_ADD(NOW(), INTERVAL 1 YEAR), id_paquete_usuario='$idpa', fecha_publicacion=NOW() WHERE id='$ida'");
		$productos_disponibles_now = $productos_disponibles - 1;
	}
}
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
      <table border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
    <td colspan="6" align="right">
<?php
if($_SESSION["userid"]!=""){
	echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";
?>
	<a href="/salirTR/" class="red" target="_self">(Salir)</a>
<?php }?>
        </td></tr>
        <tr>
          <td width="43"><a href="/mitr/<?=$nombretr?>"><img src="/imagenes/login_btn_1_off.jpg" name="mitr" width="43" height="20" border="0" /></a></td>
          <td width="131"><a href="/estado_cuenta/<?=$nombretr?>"><img src="/imagenes/login_btn_2_off.jpg" name="edo" width="131" height="20" border="0" /></a></td>
          <td width="143"><a href="/datos_vendedor/<?=$nombretr?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=$nombretr?>"><img src="/imagenes/login_btn_4_on.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=$nombretr?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=$nombretr?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        <tr>
          <td height="8" colspan="6" background="/imagenes/login_bg_bot.jpg"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="titulo_seccion">
    <?php if($productos_disponibles==0)
	{?>
    	No tiene Anuncios Disponibles, por favor revise el Estado de Cuenta y Solicite un nuevo paquete...
    <?php }
	else
	{?>
		Anuncios Disponibles: <span class="red"><?=$productos_disponibles_now;?></span><br /><br />
    <?php }?>
    
    <?=$total;?> articulos republicados</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
