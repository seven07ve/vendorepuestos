<? 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
if(@$_GET["buscar"]==1)
{
	echo "<select name='id_ciudad' class='form'>";
	if($_GET["menu"]==0) 
		echo "<option value='0'>Seleccione</option>";
	$sql_submenu=mysql_query("SELECT * FROM ciudad WHERE id_estado='".$_GET["menu"]."'");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		echo "<option value='".$resul_submenu["id"]."'";
		if($_GET["submenu"]==$resul_submenu["id"]) echo " selected";
		echo ">".utf8_encode($resul_submenu["nombre"])."</option>";	
	}	
	echo "</select>";
	return;
}

$id = $_GET['id'];	
$sql = "SELECT * FROM tienda_virtual WHERE id=$id";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);

$datos_pago = explode(",",$resul["datos_pago"]);
$datos_envio = explode(",",$resul["datos_envio"]);
$datos_banco = explode(",",$resul["datos_banco"]);

$carpeta = limpiar_cadena($resul["razon_social"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
function validar(formy)
{
	if(formy.id_paquete.value==0)
	{
		alert("Debe seleccionar un Paquete/Tarifa");
		formy.id_paquete.focus();
		return false;
	}
	if(formy.razon_social.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.razon_social.focus();
		return false;
	}
	if(formy.rif.value=="")
	{
		alert("Debe ingresar el RIF");
		formy.rif.focus();
		return false;
	}	
	numero = formy.rif.value;
	if (!/([J|V|G][-][?1234567890]*)+$/.test(numero))
	{
		alert("El RIF es invalido");
		formy.rif.focus();
		return false;
	}
	if(formy.telefono1.value=="")
	{
		alert("Debe ingresar un Telefono");
		formy.telefono1.focus();
		return false;
	}
	numero = formy.telefono1.value;
	if (!/([?1234567890])+$/.test(numero))
	{
		alert("El Telefono1 es invalido");
		formy.telefono1.focus();
		return false;
	}
	if(formy.id_estado.value==0)
	{
		alert("Debe seleccionar un Estado");
		formy.id_estado.focus();
		return false;
	}
	if(formy.id_ciudad.value==0)
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudad.focus();
		return false;
	}
	if(formy.direccion.value=="")
	{
		alert("Debe ingresar una Direccion");
		formy.direccion.focus();
		return false;
	}
	if(formy.descripcion.value=="")
	{
		alert("Debe ingresar una Descripcion");
		formy.descripcion.focus();
		return false;
	}
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		formy.email.focus();
		return false;
	}
	if(formy.usuario.value=="")
	{
		alert("Debe ingresar un Usuario");
		formy.usuario.focus();
		return false;
	}
	if(formy.contrasena.value.length<6 || formy.contrasena.value.length>8)
	{
		alert("Debe ingresar una contraseña entre 6 y 8 caracteres");
		formy.contrasena.focus();
		return false;
	}
	if(formy.confirmacion.value=="" || formy.contrasena.value!=formy.confirmacion.value)
	{
		alert("Debe ingresar la confirmación de la contraseña valida");
		formy.confirmacion.focus();
		return false;
	}
	return true;
}
function cargar_submenu(menu,submenu)
{
	new Ajax.Request("admin_tiendas_editar.php?buscar=1&menu="+menu+"&submenu="+submenu,{
	method: 'get',
	onSuccess: function(transport) {
		$('submenu').update(transport.responseText);
	}
	});
}
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=400,left = 212,top = 184');");
}

</script>
</head>
<body>
<? include("includes/header.php");?>
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
            <td><a href="admin_tiendas.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="admin_tiendas_agregar.php"><img src="imagenes/agregar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_tiendas.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validar(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
  <td colspan="2" class="tabla_titulo">Editar Usuario</td>
</tr>
<tr>
  <td rowspan="2" class="desc">Logo:</td>
  <td class="campo"><? if($resul["logo"]!=""){ ?><img src="../<?=$carpeta?>/<?=$resul["logo"]?>" height="50" /><? }?></td>
</tr>
<tr>
  <td class="campo"><input name="file" type="file" class="form" /></td>
</tr>
<tr>
  <td rowspan="2" class="desc">Foto Tienda1:</td>
  <td class="campo"><? if($resul["foto1"]!=""){  ?>
    <img src="../<?=$carpeta?>/<?=$resul["foto1"]?>" height="50" />
    <? }?></td>
</tr>
<tr>
  <td class="campo"><input name="file2" type="file" class="form" /></td>
</tr>
<tr>
  <td rowspan="2" class="desc">Foto Tienda2:</td>
  <td class="campo"><? if($resul["foto2"]!=""){  ?>
    <img src="../<?=$carpeta?>/<?=$resul["foto2"]?>" height="50" />
    <? }?></td>
</tr>
<tr>
  <td class="campo"><input name="file3" type="file" class="form" /></td>
</tr>
<tr>
  <td rowspan="2" class="desc">Foto Tienda3:</td>
  <td class="campo"><? if($resul["foto3"]!=""){  ?>
    <img src="../<?=$carpeta?>/<?=$resul["foto3"]?>" height="50" />
    <? }?></td>
</tr>
<tr>
  <td class="campo"><input name="file4" type="file" class="form" /></td>
</tr>
<tr>
  <td class="desc">Razon Social:</td>
  <td class="textobold"><?=$resul["razon_social"];?>
    <input type="hidden" name="razon_social" value="<?=$resul["razon_social"];?>" /></td>
</tr>
<tr>
  <td class="desc">Nombre Oficial:</td>
  <td class="campo"><input name="nombre_oficial" type="text" class="form" size="50" value="<?=$resul["nombre_oficial"];?>" /></td>
</tr>

<tr>
  <td class="desc">RIF: </td>
  <td class="campo"><input name="rif" type="text" class="form" value="<?=$resul["rif"];?>" size="20" maxlength="15"/> 
    (ej. J-000000)</td>
</tr>
<tr>
  <td class="desc">Telefono1:</td>
  <td class="campo"><input name="telefono1" type="text" class="form" size="50" value="<?=$resul["telefono1"];?>" /></td>
</tr>
<tr>
  <td class="desc">Telefono2:</td>
  <td class="campo"><input name="telefono2" type="text" class="form" size="50" value="<?=$resul["telefono2"];?>" /></td>
</tr>
<tr>
  <td class="desc">Pin BB:</td>
  <td class="campo"><input name="pin" type="text" class="form" size="50" value="<?=$resul["pin"];?>" /></td>
</tr>
<tr>
  <td class="desc">Estado:</td>
  <td class="campo"><select class="form" name="id_estado" onchange="cargar_submenu(this.value,0);">
   <option value="0">Seleccione</option>
    <?php 
	$sql_menu=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?>
    <option value="<?=$menu["id"]?>" <? if($menu["id"]==$resul["id_estado"]){?>selected="selected"<? }?>><?=$menu["nombre"]?>
    </option>
    <?php 
	}?>
  </select></td>
</tr>
<tr>
  <td class="desc">Ciudad:</td>
  <td class="campo" id="submenu"><select class="form" name="id_ciudad">
    <option value="0">Seleccione</option>
  </select></td>
</tr>
<script>cargar_submenu('<?=$resul["id_estado"]?>','0');</script>
<tr>
  <td class="desc">Direccion:</td>
  <td class="campo"><input name="direccion" type="text" class="form" size="50" value="<?=$resul["direccion"]?>" /></td>
</tr>
<tr>
  <td class="desc">Google Maps:</td>
  <td class="campo">Latitud: 
     <input name="latitud" type="text" class="form" size="10" value="<?=$resul["latitud"];?>" />
    Longitud:
      <input name="longitud" type="text" class="form" size="10" value="<?=$resul["longitud"];?>" />
    </td>
</tr>
<tr>
  <td class="desc">Pagina Web:</td>
  <td class="campo"><input name="pagina_web" type="text" class="form" size="50" value="<?=$resul["pagina_web"]?>" /></td>
</tr>
<tr>
  <td class="desc">Descripcion:</td>
  <td class="campo"><textarea name="descripcion" cols="45" rows="5" class="form"><?=$resul["descripcion"];?></textarea></td>
</tr>
<tr>
  <td class="desc">Horario de Atenci&oacute;n:</td>
  <td valign="top" class="campo"><textarea name="horario" cols="45" rows="5" class="form"><?=$resul["horario"]?></textarea>
    *</td>
</tr>
<tr>
                <td class="desc">Datos para Pagos:</td>
                <td class="campo"><? 
  $ver_datos_pago = mysql_query("SELECT * FROM medio_pago ORDER BY nombre ASC");
  while($vdp = mysql_fetch_array($ver_datos_pago))
  {?>
                  <input type="checkbox" name="datos_pago[]" value="<?=$vdp["id"]?>" <? if(in_array($vdp["id"],$datos_pago)){?> checked="checked"<? }?>/>
                  <?=$vdp["nombre"]?>
                  <br />
                  <? }?></td>
              </tr>
              <tr>
                <td class="desc">Datos para Envios:</td>
                <td class="campo"><? 
  $ver_datos_envio = mysql_query("SELECT * FROM medio_envio ORDER BY nombre ASC");
  while($vde = mysql_fetch_array($ver_datos_envio))
  {?>
                  <input type="checkbox" name="datos_envio[]" value="<?=$vde["id"]?>" <? if(in_array($vde["id"],$datos_envio)){?> checked="checked"<? }?>/>
                  <?=$vde["nombre"]?>
                  <br />
                  <? }?></td>
              </tr>
              <tr>
                <td class="desc">Bancos para pagos:</td>
                <td class="campo"><? 
  $ver_datos_banco = mysql_query("SELECT * FROM banco ORDER BY nombre ASC");
  while($vdb = mysql_fetch_array($ver_datos_banco))
  {?>
                  <input type="checkbox" name="datos_banco[]" value="<?=$vdb["id"]?>" <? if(in_array($vdb["id"],$datos_banco)){?> checked="checked"<? }?>/>
                  <?=$vdb["nombre"]?>
                  <br />
                  <? }?></td>
              </tr>
<tr>
  <td class="desc">Email Tienda:</td>
  <td class="campo"><input name="email" type="text" class="form" size="50" value="<?=$resul["email"];?>" /></td>
</tr>
<tr>
  <td class="desc">Color Letra:</td>
  <td class="campo">#
    <input name="color_titulo" type="text" size="33" maxlength="6" value="<?=$resul["color_titulo"];?>"/>
    &nbsp;<a href="javascript:popUp('color_reference.php?target=titulo')" class="texto11">Seleccionar color</a></td>
</tr>
<tr>
  <td class="desc">Color Fondo Titulos:</td>
  <td class="campo">#
    <input name="color_fondo" type="text" size="33" maxlength="6" value="<?=$resul["color_fondo"];?>"/>
&nbsp;<a href="javascript:popUp('color_reference.php?target=fondo')" class="texto11">Seleccionar color</a></td>
</tr>
<tr>
  <td class="desc">Color Fondo Contenido:</td>
  <td class="campo">#
    <input name="color_contenido" type="text" size="33" maxlength="6" value="<?=$resul["color_contenido"]?>"/>
    &nbsp;<a href="javascript:popUp('color_reference.php?target=contenido')" class="texto11">Seleccionar color</a></td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="desc">Datos Persona Mantenimiento:</td>
  <td bgcolor="#e1e1e1" class="campo"><input name="persona_mantenimiento" type="text" class="form" size="50" value="<?=$resul["persona_mantenimiento"]?>"/></td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="desc">Telf. Persona Mantenimiento:</td>
  <td bgcolor="#e1e1e1" class="campo"><input name="telefono_mantenimiento" type="text" class="form" size="50" value="<?=$resul["telefono_mantenimiento"];?>" /></td>
</tr>
<tr>
  <td bgcolor="#e1e1e1" class="desc">Email Persona Mantenimiento:</td>
  <td bgcolor="#e1e1e1" class="campo"><input name="email_mantenimiento" type="text" class="form" size="50" value="<?=$resul["email_mantenimiento"];?>" /></td>
</tr>
<tr>
  <td bgcolor="#cccccc" class="desc">Usuario:</td>
  <td bgcolor="#cccccc" class="campo"><input name="usuario" type="text" class="form" size="50" value="<?=$resul["usuario"];?>" /></td>
</tr>
<tr>
  <td bgcolor="#cccccc" class="desc">Contrase&ntilde;a:</td>
  <td bgcolor="#cccccc" class="campo"><input name="contrasena" type="password" class="form" size="50" maxlength="8" value="<?=$resul["clave"];?>" /></td>
</tr>
<tr>
  <td bgcolor="#cccccc" class="desc">Confirmar Contrase&ntilde;a:</td>
  <td bgcolor="#cccccc" class="campo"><input name="confirmacion" type="password" class="form" size="50" maxlength="8" value="<?=$resul["clave"];?>" /></td>
</tr>
<script>cargar_submenu2('<?=$resul["id_submenu"]?>','<?=$resul["id_submenu2"]?>');</script>
<tr>
  <td colspan="2" class="tabla_botones">
  <input type="hidden" name="id" value="<?=$resul["id"]?>"/>
  <input type="hidden" name="editar" value="1"/>
  <input type="image" src="imagenes/guardar.png" name="editar" id="editar" value="Enviar" /></td>
  </tr>
</table>               
          </form>
          <br />
          <br />          
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