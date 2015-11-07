<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
if($_POST['guardar']){
	$razon_social = $_POST["razon_social"];
	$rif = $_POST["rif"];
	$telefono1 = $_POST["telefono1"];
	$telefono2 = $_POST["telefono2"];
	$pin = $_POST["pin"];
	$id_estado = $_POST["id_estado"];
	$id_ciudad = $_POST["id_ciudad"];
	$direccion = $_POST["direccion"];
	$latitud = $_POST["latitud"];
	$longitud = $_POST["longitud"];
	$pagina_web = $_POST["pagina_web"];
	$email = $_POST["email"];
	$descripcion = $_POST["descripcion"];
	$horario = $_POST["horario"];
	$tipo_pagina = $_POST["tipo_pagina"];
	$usuario = $_POST["usuario"];
	$contrasena = $_POST["contrasena"];
	$nombre_oficial = $_POST["nombre_oficial"];
	$color_titulo = $_POST["color_titulo"];
	$color_fondo = $_POST["color_fondo"];
	$color_contenido = $_POST["color_contenido"];
	$datos_pago = implode(",",$_POST["datos_pago"]);
	$datos_envio = implode(",",$_POST["datos_envio"]);
	$datos_banco = implode(",",$_POST["datos_banco"]);
	$persona_mantenimiento = $_POST["persona_mantenimiento"];
	$telefono_mantenimiento = $_POST["telefono_mantenimiento"];
	$email_mantenimiento = $_POST["email_mantenimiento"];
	

	$insert = mysql_query("INSERT INTO tienda_virtual (usuario, clave, rif, nombre_oficial, razon_social, telefono1, telefono2, pin, id_estado, id_ciudad, direccion, latitud, longitud, logo, pagina_web, email, descripcion, horario, datos_pago, datos_envio, datos_banco, color_titulo, color_fondo, color_contenido, persona_mantenimiento, telefono_mantenimiento, email_mantenimiento, activo) VALUES ('$usuario', '$contrasena', '$rif', '$nombre_oficial','$razon_social', '$telefono1', '$telefono2', '$pin','$id_estado', '$id_ciudad', '$direccion', '$latitud', '$longitud', '', '$pagina_web', '$email', '$descripcion', '$horario', '$datos_pago', '$datos_envio','$datos_banco','$color_titulo','$color_fondo','$color_contenido', '$persona_mantenimiento','$telefono_mantenimiento','$email_mantenimiento','0')");
	
	
	//crear carpeta 
	$carpeta = "../".limpiar_cadena($razon_social);
	mkdir($carpeta, 0777);
	//subir imagen
	$id = mysql_insert_id();
	//insertar paquete
	$monto_paquete = cual_costo_paquete($id_paquete);
	$insert_paq = mysql_query("INSERT INTO paquete_usuario (id_paquete,id_usuario,usuario_tienda,estado, monto) VALUES ('$id_paquete','$id','2','0','$monto_paquete')");
	//logo
	if($_FILES["file"]["tmp_name"]!="") copy($_FILES["file"]["tmp_name"], $carpeta."/".$_FILES["file"]["name"]);
	$update = mysql_query("UPDATE tienda_virtual SET logo='".$_FILES["file"]["name"]."' WHERE id='$id'");
	//fotos tienda
	if($_FILES["file2"]["tmp_name"]!="") copy($_FILES["file2"]["tmp_name"], $carpeta."/".$_FILES["file2"]["name"]);
	$update = mysql_query("UPDATE tienda_virtual SET foto1='".$_FILES["file2"]["name"]."' WHERE id='$id'");
	//fotos tienda
	if($_FILES["file3"]["tmp_name"]!="") copy($_FILES["file3"]["tmp_name"], $carpeta."/".$_FILES["file3"]["name"]);
	$update = mysql_query("UPDATE tienda_virtual SET foto2='".$_FILES["file3"]["name"]."' WHERE id='$id'");
	//fotos tienda
	if($_FILES["file4"]["tmp_name"]!="") copy($_FILES["file4"]["tmp_name"], $carpeta."/".$_FILES["file4"]["name"]);
	$update = mysql_query("UPDATE tienda_virtual SET foto3='".$_FILES["file4"]["name"]."' WHERE id='$id'");
	
	header('location:admin_tiendas.php');
}
	
if($_POST['editar']){
	$id = $_POST["id"];
	$id_paquete = $_POST["id_paquete"];
	$razon_social = $_POST["razon_social"];
	$rif = $_POST["rif"];
	$telefono1 = $_POST["telefono1"];
	$telefono2 = $_POST["telefono2"];
	$pin = $_POST["pin"];
	$id_estado = $_POST["id_estado"];
	$id_ciudad = $_POST["id_ciudad"];
	$direccion = $_POST["direccion"];
	$latitud = $_POST["latitud"];
	$longitud = $_POST["longitud"];
	$pagina_web = $_POST["pagina_web"];
	$email = $_POST["email"];
	$descripcion = $_POST["descripcion"];
	$horario = $_POST["horario"];
	$tipo_pagina = $_POST["tipo_pagina"];
	$usuario = $_POST["usuario"];
	$contrasena = $_POST["contrasena"];
	$nombre_oficial = $_POST["nombre_oficial"];
	$color_titulo = $_POST["color_titulo"];
	$color_fondo = $_POST["color_fondo"];
	$color_contenido = $_POST["color_contenido"];
	$datos_pago = implode(",",$_POST["datos_pago"]);
	$datos_envio = implode(",",$_POST["datos_envio"]);
	$datos_banco = implode(",",$_POST["datos_banco"]);
	$persona_mantenimiento = $_POST["persona_mantenimiento"];
	$telefono_mantenimiento = $_POST["telefono_mantenimiento"];
	$email_mantenimiento = $_POST["email_mantenimiento"];
	
	$update = mysql_query("UPDATE tienda_virtual SET usuario='$usuario', clave='$contrasena', nombre_oficial='$nombre_oficial', rif='$rif',  telefono1='$telefono1', telefono2='$telefono2', pin='$pin', id_estado='$id_estado', id_ciudad='$id_ciudad', direccion='$direccion', latitud='$latitud', longitud='$longitud', pagina_web='$pagina_web', email='$email', descripcion='$descripcion', horario='$horario', datos_pago='$datos_pago', datos_envio='$datos_envio',datos_banco='$datos_banco',color_titulo='$color_titulo', color_fondo='$color_fondo', color_contenido='$color_contenido',persona_mantenimiento='$persona_mantenimiento',telefono_mantenimiento='$telefono_mantenimiento',email_mantenimiento='$email_mantenimiento' WHERE id='$id'") or die(mysql_error());
	
	//crear carpeta 
	$carpeta = "../".limpiar_cadena($razon_social);
	//logo
	if($_FILES["file"]["tmp_name"]!="")
	{
		copy($_FILES["file"]["tmp_name"], $carpeta."/".$_FILES["file"]["name"]);
		$update = mysql_query("UPDATE tienda_virtual SET logo='".$_FILES["file"]["name"]."' WHERE id='$id'");
	}
	//fotos tienda
	if($_FILES["file2"]["tmp_name"]!="")
	{
		copy($_FILES["file2"]["tmp_name"], $carpeta."/".$_FILES["file2"]["name"]);
		$update = mysql_query("UPDATE tienda_virtual SET foto1='".$_FILES["file2"]["name"]."' WHERE id='$id'");
	}
	//fotos tienda
	if($_FILES["file3"]["tmp_name"]!="") 
	{
		copy($_FILES["file3"]["tmp_name"], $carpeta."/".$_FILES["file3"]["name"]);
		$update = mysql_query("UPDATE tienda_virtual SET foto2='".$_FILES["file3"]["name"]."' WHERE id='$id'");
	}
	//fotos tienda
	if($_FILES["file4"]["tmp_name"]!="")
	{
		copy($_FILES["file4"]["tmp_name"], $carpeta."/".$_FILES["file4"]["name"]);
		$update = mysql_query("UPDATE tienda_virtual SET foto3='".$_FILES["file4"]["name"]."' WHERE id='$id'");
	}
	//echo $carpeta."-logo=".$_FILES["file"]["tmp_name"];
	header('location:admin_tiendas.php');
}
	
if($_GET['o']=='eliminar'){
	$id = $_GET["id"];
	$sql_tienda = mysql_fetch_array(mysql_query("SELECT * FROM tienda_virtual WHERE id=$id"));
	
	$delete = mysql_query("DELETE FROM tienda_virtual WHERE id='$id'");
	
	$delete = mysql_query("DELETE FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id'");
	
	$carpeta = "../".limpiar_cadena($sql_tienda["razon_social"]);
	@rmdir($carpeta);
}
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
			$nombre_oficial = datos_tienda($id,"nombre_oficial");
			$razon_social = datos_tienda($id,"razon_social");
			
			//email al cliente
			$to = cual_email_usuario($id,'2');
			$subject = "Su Clave y Usuario activado";	
			
			//EMAIL A TR
			$to2 = "administracion@vendorepuestos.com.ve";
			$subject2 = "Clave y Usuario activado";
			
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
			$headers .= "X-Priority: 1\n";
			$headers .= "From: administracion@vendorepuestos.com.ve\r\n";
			
			$message="La siguiente TIENDAREPUESTOS ha sido activada:<br><br>
			Nombre de la TIENDAREPUESTOS: $nombre_oficial<br>
			Razón Social: $razon_social";
			
			$send_mail = mail($to2, $subject2, $message, $headers);
			
			$message="Gracias <b>".datos_tienda($id,"persona_mantenimiento")."</b> que realiza Mantenimiento por confiar en vendorepuestos.com.ve <br><br>
			Luego de haber completado todos los pasos, su Clave y Usuario TIENDAREPUESTOS ha sido activado con éxito.<br><br>
			Nombre de la TIENDAREPUESTOS:$nombre_oficial<br><br>
			GUIA DE ACCESO A TIENDAREPUESTOS<br>
			Ingresar en la sección de TIENDAREPUESTOS (Directorio)<br>
			<a href='http://vendorepuestos.com.ve/tiendarepuestos/all/1'>http://vendorepuestos.com.ve/tiendarepuestos/all/1</a><br>
			Iniciar sesión de acuerdo al Usuario y Clave registrado.<br><br>
			Algunos datos ya están registrados, pero se sugiere completar información que permanezca con los campos vacíos y que ha sido diseñada para  ofrecer información.<br><br>
			La cuenta posee el paquete activo, puedes comenzar a publicar inmediatamente visitando la sección Publicación de productos.<br><br>
			Recordamos que para ser parte del Directorio, debe poseer al menos una publicación en la TIENDAREPUESTOS.<br><br>
			Para información adicional contacte nuestra sección de Preguntas Frecuentes o a nuestro equipo de Soporte En Línea  vía Twitter @vendorepuestos<br><br>  
			Gracias por usar vendorepuestos.com.ve.<br><br>
			Saludos.";
			
			$send_mail = mail($to, $subject, $message, $headers);
		}
		$update = mysql_query("UPDATE tienda_virtual SET activo='$act' WHERE id='$id'");
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
	function activar(id,act)
	{
		window.location.href="admin_tiendas.php?sw=1&id="+ id+"&act="+act;	
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
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><a href="admin_tiendas_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados" align="left">
          <tr>
            <td class="tabla_titulo" nowrap="nowrap" align="center"> | <a href="admin_tiendas.php" class="textobold">Todos</a> |<br />
              |
              <?
            for ($i=97; $i<123; $i++) 
            {
            ?>
              <a href="admin_tiendas.php?letra=<? echo chr($i) ?>" class="textobold"><? echo chr($i) ?></a> |
              <?
            }
            ?></td>
          </tr>
        </table><br /><br />

        <!-- FINAL SUBMENU -->
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Tiendas Virtuales</td>
</tr>
<tr>
<td>
<?php 
if(isset($_GET["letra"]))
{
	$letra=$_GET["letra"];
	$sql = "SELECT * FROM tienda_virtual WHERE SUBSTRING(nombre_oficial,1,1)='$letra' OR SUBSTRING(razon_social,1,1)='$letra' ORDER BY id";
}	
else
	$sql = "SELECT * FROM tienda_virtual ORDER BY id";
$res = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="107">Razon Social</th>
    <th width="104" nowrap="nowrap">Nombre de la TR</th>
    <th width="87" nowrap="nowrap">Activar</th>
    <th width="87" nowrap="nowrap">Fecha Registro</th>
    <th width="20" nowrap="nowrap">Estado de Cuenta</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">&nbsp;</th>
    <th width="20" nowrap="nowrap">Productos</th>
  </tr>
  <?php while($resul = mysql_fetch_array($res)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["razon_social"]?></td>
    <td nowrap="nowrap"><?=$resul["nombre_oficial"]?></td>
    <td align="center" nowrap="nowrap"><input type="checkbox" name="activo" id="1" <? if($resul["activo"]=="1"){?>checked="checked"<? }?> onclick="activar(<?=$resul["id"]?>,<?=$resul["activo"]?>)" /></td>
    <td nowrap="nowrap"><?=$resul["fecha_activacion"]?></td>
    <td align="center" nowrap="nowrap"><a href="admin_estado_cuenta.php?t=2&idt=<?=$resul["id"]?>">ver</a></td>    
    <td nowrap="nowrap"><a href="admin_tiendas_editar.php?id=<?=$resul["id"]?>"><img src="imagenes/editar.png" alt="Modificar" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="javascript:eliminar(<?=$resul["id"]?>)"><img src="imagenes/eliminar.png" alt="Eliminar" width="20" height="20" border="0" /></a></td>
    <td nowrap="nowrap"><a href="admin_productos.php?t=2&id_tienda=<?=$resul["id"];?>"><img src="imagenes/ver.png" alt="Productos" width="20" height="20" border="0" /></a></td>
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