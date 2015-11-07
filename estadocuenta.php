<? 
include("conexion.php");
session_start();
include("funciones.php");

if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }
$nombretr = cual_nombre_oficial($_SESSION["userid"]);
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
if(isset($_POST["solicitar_paquete"]))
{
	//insertar
	$monto_paquete = cual_costo_paquete($_POST["id_paquete"]);
	$insertpu = mysql_query("INSERT INTO paquete_usuario (id_paquete,id_usuario,usuario_tienda,estado,monto) VALUES ('".$_POST["id_paquete"]."','".$_SESSION["userid"]."','2','0','$monto_paquete')");
	
	$orden = mysql_insert_id();
	$paquete = cual_paquete($_POST["id_paquete"]);
	$riftr =  datos_tienda($_SESSION["userid"],"rif");
	$nombre_personatr =  datos_tienda($_SESSION["userid"],"persona_mantenimiento");
	
	$email = cual_email_usuario($_SESSION["userid"],'2');
	
	//email al cliente
	$to = $email;
	$subject = "Su TR ha solicitado un nuevo paquete";	
	
	//EMAIL A TR
	$to2 = "administracion@vendorepuestos.com.ve";
	$subject2 = "Solicitud de un nuevo paquete";
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "From: administracion@vendorepuestos.com.ve\r\n";
	
	$message="La TIENDAREPUESTOS, ha solicitado un nuevo Paquete.<br><br>
	Datos de la TIENDAREPUESTOS<br>
	Nombre de la TIENDAREPUESTOS: $nombretr<br>
	Documento de Identidad: $riftr<br>
	Número de orden: $orden<br>
	Paquete solicitado: $paquete<br>";
	
	$send_mail = mail($to2, $subject2, $message, $headers);
	
	$message="Gracias <b>$nombre_personatr</b> por confiar en vendorepuestos.com.ve <br><br>
	La TIENDAREPUESTOS, ha solicitado un nuevo Paquete.<br>
	Datos de la TIENDAREPUESTOS<br>
	Nombre de la TIENDAREPUESTOS: $nombretr<br>
	Documento de Identidad: $riftr<br>
	Número de orden: $orden<br>
	Paquete solicitado: $paquete<br><br>
	No olvide reportar el monto pagado al Centro de Pagos para su activación, usando el  número de artículo y número de referencia bancaria usando exclusivamente la siguiente información.<br><br>
	<b>Información Bancaria</b><br>
	Tipo de Cuenta: Corriente <br>
	Titular: Vendorepuestos Venezuela CA <br>  
	RIF: J-31737187-9<br>
	Email: administracion@vendorepuestos.com.ve <br><br>
	BOD			0116-0183-94-0013599150 <br>
	Banesco 		0134-0030-08-0301026847<br> 
	Banco Provincial	0108-0334-92-0100113038<br>
	Banco de Venezuela 	0102-0859-93-0000009166<br> 
	Banco Mercantil	0105-0672-75-1672068541 <br><br>
	Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea  vía Twitter @vendorepuestos<br><br>  
	Gracias por usar vendorepuestos.com.ve.<br><br>
	Saludos.<br><br>";
		
	$send_mail = mail($to, $subject, $message, $headers);
	
	?>
   <script language="javascript">alert("El Paquete/Tarifa ha sido solicitado exitosamente, pronto recibira un email con los datos del pago!"); window.location="estado_cuenta.php";</script>
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
          <td height="30" colspan="5" class="titulo_ruta"><?=$nombretr?> > Mi Cuenta > Estado de Cuenta</td>
          <td align="right" colspan="2"><? 
			if($_SESSION["userid"]!="") 
			{
                echo " <span class=\"blue\">Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."</span>";?>
             | <a href="/salirTR/" class="red" target="_self">Salir</a>
          <? }?></td>
        </tr>
        <tr>
         <td width="70"><a href="/bienvenidoTR/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/btn_resumen_off.jpg" name="mitr" width="70" height="21" border="0" id="mitr" /></a></td>
          <td width="43"><a href="/mitr/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_1_off.jpg" name="mitr" width="43" height="20" border="0" /></a></td>
          <td width="131"><a href="/estado_cuenta/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_2_on.jpg" name="edo" width="131" height="20" border="0" /></a></td>
          <td width="143"><a href="/datos_vendedor/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        <tr>
          <td height="8" colspan="6" background="/imagenes/login_bg_bot.jpg"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
    <? if (false) //($productos_disponibles>0)
	{?>
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
              <tr class="blue">
                <td width="17%">Paquete Activo</td>
                <td width="18%">Anuncios Disponbles</td>
                <td width="18%">Productos Publicados</td>
              </tr> 
			  <tr class="link">
            <td bgcolor="#FFFFFF"><?=cual_paquete($id_paquete);?></td>
                    <td bgcolor="#FFFFFF"><?=$productos_disponibles;?></td>
                    <td bgcolor="#FFFFFF"><?=$productos_publicados;?></td>
        </tr>
                </table>
        <? }
		else
		{?>
        <form id="form1" name="form1" method="post" action="/estado_cuenta/<?=$nombretr?>" onSubmit="return validar(this);">
        <table width="500" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
          <tr class="gold">
            <td colspan="2" bgcolor="#FFFFFF" class="titulo_seccion">Actualmente no tiene paquetes activos, puede realizar su solicitud aqu&iacute;:</td>
          </tr>
          <tr class="gold">
            <td colspan="2" class="blue">Solicitar Paquete</td>
          </tr>
          <tr class="link">
            <td width="82%" bgcolor="#FFFFFF"><select name="id_paquete" class="form">
  <option value="0">Seleccionar</option>
  <?php 
$sql_categoria=mysql_query("SELECT * FROM tarifas WHERE tipo='tienda' && habilitar='1' ORDER BY id");
while($categoria=mysql_fetch_array($sql_categoria)){
?>
  <option value="<?=$categoria["id"]?>"><?=$categoria["nombre"]?> - Bs. <?=$categoria["total_bs"]?></option>
  <?php }?>
  </select>
            <input type="hidden" name="solicitar_paquete" value="1"/></td>
            <td width="18%" bgcolor="#FFFFFF"><input name="" type="image"  value="Submit" src="/imagenes/btn_send.jpg" /></td>
          </tr>
        </table>
        </form>
        <? }?>
        <br />
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
          <tr class="gold">
            <td colspan="4" class="blue">Historial de Publicaciones</td>
          </tr>
          <tr class="gris">
            <td width="18%">Nro. Orden</td>
            <td width="18%">Estado</td>
            <td width="18%">Fecha</td>
            <td width="18%">Monto Bs.</td>
          </tr>
          <?
          $ver_paquetes_usuario = mysql_query("SELECT * FROM paquete_usuario WHERE id_usuario='".$_SESSION["userid"]."' && usuario_tienda='2' ORDER BY fecha_activacion DESC");
		  while($ver_pu = mysql_fetch_array($ver_paquetes_usuario))
		  {?>
          <tr class="link">
            <td bgcolor="#FFFFFF"><?=$ver_pu["id"];?></td>
            <td bgcolor="#FFFFFF"><? if($ver_pu["estado"]=="1") echo "Activo"; else echo "Finalizado";?></td>
            <td bgcolor="#FFFFFF"><?=date("d-m-Y H:i",strtotime($ver_pu["fecha_activacion"]));?></td>
            <td bgcolor="#FFFFFF"><?=$ver_pu["monto"];?></td>
          </tr>
          <? }?>
        </table></td>
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
