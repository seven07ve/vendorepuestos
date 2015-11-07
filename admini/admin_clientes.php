<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
if($_POST['guardar']){
		$nombre = $_POST["nombre"];
		$cedula = $_POST["cedula"];
		$telefono1 = $_POST["telefono1"];
		$telefono2 = $_POST["telefono2"];
		$pin = $_POST["pin"];
		$id_estadop = $_POST["id_estadop"];
		$id_ciudadp = $_POST["id_ciudadp"];
		$email = $_POST["email"];
		$certificado = "1";
		$datos_pago = implode(",",$_POST["datos_pago"]);
		$datos_envio = implode(",",$_POST["datos_envio"]);
		$datos_banco = implode(",",$_POST["datos_banco"]);
	

		$insert = mysql_query("INSERT INTO usuario (cedula, nombre, telefono1, telefono2, pin, id_estado, id_ciudad, datos_pago, datos_envio, datos_banco, email, certificado) VALUES ('$cedula', '$nombre','$telefono1', '$telefono2', '$pin', '$id_estadop', '$id_ciudadp','$datos_pago','$datos_envio','$datos_banco', '$email', '$certificado')");
	
	header('location:admin_clientes.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$cedula = $_POST["cedula"];
	$telefono1 = $_POST["telefono1"];
	$telefono2 = $_POST["telefono2"];
	$pin = $_POST["pin"];
	$id_estadop = $_POST["id_estadop"];
	$id_ciudadp = $_POST["id_ciudadp"];
	$email = $_POST["email"];
	$certificado = $_POST["certificado"];
	$certificado = "1";
	$datos_pago = implode(",",$_POST["datos_pago"]);
	$datos_envio = implode(",",$_POST["datos_envio"]);
	$datos_banco = implode(",",$_POST["datos_banco"]);
	
	$update = mysql_query("UPDATE usuario SET cedula='$cedula', nombre='$nombre', telefono1='$telefono1', telefono2='$telefono2', pin='$pin', id_estado='$id_estadop', id_ciudad='$id_ciudadp', datos_pago='$datos_pago', datos_envio='$datos_envio', datos_banco='$datos_banco', email='$email',certificado='$certificado' WHERE id='$id'") or die(mysql_error());
	
	header('location:admin_clientes.php');
}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	
	$delete = mysql_query("DELETE FROM usuario WHERE id='$id'");
	
	$delete = mysql_query("DELETE FROM productos WHERE usuario_tienda='1' && id_usuario_tienda='$id'");
	
}
if($_GET['sw']=='1'){
		$act = $_GET["act"];
		$id = $_GET["id"];
		if($act==1)
		{
			$act=0;
			//descativo el usuario y el producto
			$vence = "DATE_ADD(NOW(), INTERVAL -1 DAY)";
			$update = mysql_query("UPDATE productos SET vence=$vence WHERE usuario_tienda='1' && id_usuario_tienda='$id'");
		}
		elseif($act==0)
		{
			$act=1;
			//activo el producto y el usuario
			$vence = "DATE_ADD(NOW(), INTERVAL 60 DAY)";
			$update = mysql_query("UPDATE productos SET vence=$vence WHERE usuario_tienda='1' && id_usuario_tienda='$id'");
			
			$nombre = cual_usuario($id,'1');
			
			//email al cliente
			$to = cual_email_usuario($id,'1');
			$subject = "Aprobación Cliente Certificado";	
			
			//EMAIL A TR
			$to2 = "centrodeseguridad@vendorepuestos.com.ve";
			$subject2 = "Aprobación Cliente Certificado";
			
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
			$headers .= "X-Priority: 1\n";
			$headers .= "From: centrodeseguridad@vendorepuestos.com.ve\r\n";
			
			$message="Gracias <b>$nombre</b> por confiar en vendorepuestos.com.ve<br><br> 
			Su pago ha sido recibido satisfactoriamente y su articulo ha sido publicado.<br><br>
			Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea  vía Twitter @vendorepuestos<br><br>  
			Gracias por usar vendorepuestos.com.ve.<br><br>
			Saludos.";
			
			$send_mail = mail($to, $subject, $message, $headers);
			$send_mail = mail($to2, $subject2, $message, $headers);
		}
		$update = mysql_query("UPDATE usuario SET activo='$act' WHERE id='$id'");
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
			window.location.href='admin_clientes.php?o=eliminar&id=' + _id;		
		}
	}
	function activar(id,act)
	{
		window.location.href="admin_clientes.php?sw=1&id="+ id+"&act="+act;	
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Clientes Premium</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU -->
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_clientes_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
<table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados" align="left">
          <tr>
            <td class="tabla_titulo" nowrap="nowrap" align="center"> | <a href="admin_clientes.php" class="textobold">Todos</a> |<br />
              |
              <?
            for ($i=97; $i<123; $i++) 
            {
            ?>
              <a href="admin_clientes.php?letra=<? echo chr($i) ?>" class="textobold"><? echo chr($i) ?></a> |
              <?
            }
            ?></td>
          </tr>
        </table><br />
        <!-- FINAL SUBMENU -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Clientes Premium</td>
</tr>
<tr>
<td>
<?php
if(isset($_GET["letra"]))
{
	$letra=$_GET["letra"];
	$sql = "SELECT * FROM usuario WHERE SUBSTRING(nombre,1,1)='$letra' ORDER BY id";
}	
else
	$sql = "SELECT * FROM usuario ORDER BY id";
$res = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="107">Nombre</th>
    <th width="104" nowrap="nowrap">CI</th>
    <th width="121" nowrap="nowrap">Email</th>
    <th width="87" nowrap="nowrap">Activar</th>
    <th width="87" nowrap="nowrap">Fecha Registro</th>
    <th width="20" nowrap="nowrap">Estado de Cuenta</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">Productos</th>
  </tr>
  <?php while($resul = mysql_fetch_array($res)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["nombre"]?></td>
    <td nowrap="nowrap"><?=$resul["cedula"]?></td>
    <td nowrap="nowrap" align="center"><?=$resul["email"]?></td>
    <td align="center" nowrap="nowrap"><input type="checkbox" name="activo" id="1" <? if($resul["activo"]=="1"){?>checked="checked"<? }?> onclick="activar(<?=$resul["id"]?>,<?=$resul["activo"]?>)" /></td>
    <td nowrap="nowrap"><?=$resul["fecha_activacion"]?></td>
    <td align="center" nowrap="nowrap"><a href="admin_estado_cuenta.php?t=1&idt=<?=$resul["id"]?>">ver</a></td>    
    <td nowrap="nowrap"><a href="admin_clientes_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" alt="Modificar" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="javascript:eliminar(<?=$resul["id"]?>)"><img src="imagenes/eliminar.png" alt="Eliminar" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="admin_productos.php?t=1&id_tienda=<?=$resul["id"];?>"><img src="imagenes/ver.png" alt="Productos" width="20" height="20" border="0" /></a></td>
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