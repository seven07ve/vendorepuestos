<? 
include("conexion.php");
session_start();
include("funciones.php");
if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }
$idpa = paquete_activo_usuario($_SESSION["userid"],"2");
$nombretr = cual_nombre_oficial($_SESSION["userid"]);
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
if(isset($_POST["solicitar_paquete"]))
{
	//insertar
	$monto_paquete = cual_costo_paquete($_POST["id_paquete"]);
	$insertpu = mysql_query("INSERT INTO paquete_usuario (id_paquete,id_usuario,usuario_tienda,estado,monto) VALUES ('".$_POST["id_paquete"]."','".$_SESSION["userid"]."','2','0','$monto_paquete')");
	//email al vendorepuestos y al cliente para que pague
	$email_user = cual_email_usuario($_SESSION["userid"],'2','TR');
	email_nuevo_paquete($email_user,$_POST["id_paquete"],$_SESSION["userid"]);?>
   <script language="javascript">alert("El Paquete/Tarifa ha sido solicitado exitosamente, pronto recibira un email con los datos del pago!"); window.location="/estado_cuenta/<?=$nombretr;?>";</script>
<? }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
function validar(formy)
{
	if(formy.id_paquete.value=="0")
	{
		alert("Debe Seleccionar un Paquete/Tarifa");
		formy.id_paquete.focus();
		return false;
	}
 }
 </script>
<body>
<?php include("includes/header_home.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" colspan="4" class="titulo_ruta"><?=$nombretr?> > Mi Cuenta > Resumen</td>
          <td align="right" colspan="3"><? 
			if($_SESSION["userid"]!="") 
			{
                echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";?>
             | <a href="/salirTR/" class="red" target="_self">Salir</a>
          <? }?></td>
        </tr>
        <tr>
          <td width="70"><a href="/bienvenidoTR/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/btn_resumen_on.jpg" name="mitr" width="70" height="21" border="0" id="mitr" /></a></td>
          <td width="43"><a href="/mitr/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_1_off.jpg" name="mitr" width="43" height="20" border="0" id="mitr" /></a></td>
          <td width="131"><a href="/estado_cuenta/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_2_off.jpg" name="edo" width="131" height="20" border="0" /></a></td>
          <td width="143"><a href="/datos_vendedor/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        <tr>
          <td height="8" colspan="7" background="/imagenes/login_bg_bot.jpg"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
    <table width="700" border="0" align="center">
  <tr>
    <td> <br />
      <div style="border:1px solid #D3D3D3; width:700px;">
      <div class="titcat_bienvenido"><div style="width:36px; float:left;"><img src="/imagenes/clock_icon.jpg" width="30" height="26" /></div><div style="float:left;"> STATUS</div></div><div id="linea_division_tienda"></div>
        <ul>
          <?
          $ver_paquetes_usuario = mysql_query("SELECT * FROM paquete_usuario WHERE id_usuario='".$_SESSION["userid"]."' && usuario_tienda='2' ORDER BY fecha_activacion DESC");
		  while($ver_pu = mysql_fetch_array($ver_paquetes_usuario))
		  {?>
         
			<li>&nbsp;<b><?=cual_paquete($ver_pu["id_paquete"])?></b> -  <? if($ver_pu["estado"]=="1") echo "Activo"; else echo "Finalizado";?>  - Solicitado el:             <?=date("d-m-Y H:i",strtotime($ver_pu["fecha_activacion"]));?></li>
          <? }?></ul>
        </div>
        <br />
      <div style="border:1px solid #D3D3D3; width:700px;">
      <div class="titcat_bienvenido"><div style="width:40px; float:left;"><img src="/imagenes/icon_tr.jpg" width="33" height="25" /></div><div style="float:left;"> RESUMEN</div></div>
      <div id="linea_division_tienda"></div>
      <UL>
      <li>&nbsp;Productos Disponibles: <?=$productos_disponibles;?></li>
      <li><a href="/articulos_activos/<?=$nombretr?>" class="link">Productos Activos</a>:
<?=productos_activos($_SESSION["userid"]);?></li>
      <li><a href="/articulos_finalizados/<?=$nombretr?>" class="link">Productos Finalizados</a>:
<?=productos_finalizados($_SESSION["userid"]);?></li>
      </UL>
      </div></td>
  </tr>
</table>
     
      </td>
  </tr>
  <tr>
    <td width="625" colspan="3" valign="top">
      <div class="titulo_categoria" style="padding-bottom:10px;"></div></td>
  </tr>
  <tr>
    <td valign="top" colspan="3">&nbsp;</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
