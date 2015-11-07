<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
$idt=$_GET["idt"];
$t = $_GET["t"];

if($_GET['sw']=='1'){
		$act = $_GET["act"];
		$id = $_GET["id"];
		if($act==1)
		{
			$act=0;
		}
		elseif($act==0)
		{
			$act=1;
			$paquete = cual_paquete($id);
			$riftr =  datos_tienda($idt,"nombre_oficial");
			$riftr =  datos_tienda($idt,"rif");
			$email = cual_email_usuario($idt,'2');
			
			//email al cliente
			$to = $email;
			$subject = "Su paquete ha sido activado";	
			
			//EMAIL A TR
			$to2 = "administracion@vendorepuestos.com.ve";
			$subject2 = "Su paquete ha sido activado";
			
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
			$headers .= "X-Priority: 1\n";
			$headers .= "From: administracion@vendorepuestos.com.ve\r\n";
			
			$message="Paquete ha sido activado<br><br>
			Datos de la TIENDAREPUESTOS<br>
			Nombre de la TIENDAREPUESTOS: $nombretr<br>
			Documento de Identidad: $riftr<br>
			Número de orden: $id<br>
			Paquete solicitado: $paquete<br>";
			
			$send_mail = mail($to2, $subject2, $message, $headers);
			
			$message="Su nuevo paquete ha sido activado<br><br>
			Datos de la TIENDAREPUESTOS<br>
			Nombre de la TIENDAREPUESTOS: $nombretr<br>
			Documento de Identidad: $riftr<br>
			Número de orden: $id<br>
			Paquete solicitado: $paquete<br><br>
			Proceda a accesar a su cuenta y comienza a realizar publicaciones.<br><br>
			Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea  vía Twitter @vendorepuestos  
			Gracias por usar vendorepuestos.com.ve.<br><br>
			Saludos.";
				
			$send_mail = mail($to, $subject, $message, $headers);
		}
		$update = mysql_query("UPDATE paquete_usuario SET estado='$act' WHERE id='$id'");
}
if($t==1) 
{
	$sql = "SELECT nombre FROM usuario WHERE id=$idt";
	$res = mysql_query($sql);
	$rtienda= mysql_fetch_array($res);
	$de_quien = "Cliente: ".$rtienda["nombre"];
}
elseif($t==2) 
{
	$sql = "SELECT razon_social FROM tienda_virtual WHERE id=$idt";
	$res = mysql_query($sql);
	$rtienda= mysql_fetch_array($res);
	$de_quien = "Tienda Virtual: ".$rtienda["razon_social"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
	function eliminar(_id){
		if(confirm('Al eliminar la Tienda, se eliminaran los productos e imagenes asociadas, Esta seguro que desea eliminarla?')){
			window.location.href='admin_tiendas.php?o=eliminar&id=' + _id;		
		}
	}
	function activar(id,act,idt)
	{
		window.location.href="admin_estado_cuenta.php?sw=1&id="+ id+"&act="+act+"&idt="+idt;	
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Tienda Virtual</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU -->
        <!-- FINAL SUBMENU -->
            <table width="500" border="0" cellpadding="0" cellspacing="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> <?=$de_quien?> - Estado de Cuenta</td>
</tr>
<tr>
<td>
<?php 
$sql = "SELECT * FROM paquete_usuario WHERE id_usuario='$idt' && usuario_tienda='$t' ORDER BY fecha_activacion DESC";
$res = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr class="textobold">
    <td width="18%">Nro. Orden</td>
            <td width="18%">Fecha</td>
            <td width="18%">Monto Bs.</td>
            <td width="18%">Activar</td>
    </tr>
  <?php while($resul = mysql_fetch_array($res)){?>
   <tr>
   <td bgcolor="#FFFFFF"><?=$resul["id"];?></td>
            <td bgcolor="#FFFFFF"><?=date("d-m-Y H:i",strtotime($resul["fecha_activacion"]));?></td>
            <td bgcolor="#FFFFFF"><?=$resul["monto"];?></td>
   
    <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="activo" id="1" <? if($resul["estado"]=="1"){?>checked="checked"<? }?> onclick="activar(<?=$resul["id"]?>,<?=$resul["estado"]?>,<?=$idt?>)" /></td>
    </tr> 
  <?php }?>
</table></td>
</tr>
</table>
          <!-- Termina Contenido -->        </td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="1" bgcolor="#666666"></td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php mysql_close($db);?>