<? 
include("conexion.php");
session_start();
include("funciones.php");
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


if($_POST['editar']){
	$id = $_POST["id"];
	$telefono2 = $_POST["telefono2"];
	$email = $_POST["email"];
	$pin = $_POST["pin"];
	$horario = $_POST["horario"];
	$datos_pago = implode(",",$_POST["datos_pago"]);
	$datos_envio = implode(",",$_POST["datos_envio"]);
	$datos_banco = implode(",",$_POST["datos_banco"]);
	
	$update = mysql_query("UPDATE tienda_virtual SET telefono2='$telefono2', pin='$pin', email='$email',datos_pago='$datos_pago',datos_envio='$datos_envio', datos_banco='$datos_banco', horario='$horario' WHERE id='$id'") or die(mysql_error());
	?>
    <script language="javascript">alert("Datos Actualizados con exito!"); window.location="datos.php";</script>
<? }
$sql = "SELECT * FROM tienda_virtual WHERE id=$_SESSION[userid]";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);
$datos_pago = explode(",",$resul["datos_pago"]);
$datos_envio = explode(",",$resul["datos_envio"]);
$datos_banco = explode(",",$resul["datos_banco"]);
$carpeta = limpiar_cadena($resul["razon_social"]);
$nombretr =  $resul["nombre_oficial"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript">
function validar(formy)
{
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		formy.email.focus();
		return false;
	}

	return true;
}

</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" colspan="5" class="titulo_ruta"><?=$nombretr?> > Mi Cuenta > Datos del Vendedor</td>
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
          <td width="131"><a href="/estado_cuenta/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_2_off.jpg" name="edo" width="131" height="20" border="0" /></a></td>
          <td width="143"><a href="/datos_vendedor/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_3_on.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        <?php echo preguntas($_SESSION["userid"]); ?>
      </table>
    </td>
  </tr>
  <tr>
    <td valign="top"><form action="/datos_vendedor/<?=$carpeta?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar(this);">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
<tr>
<td colspan="2" class="blue">Datos del Vendedor</td>
</tr>
<tr>
  <td class="desc">Telefono1:</td>
  <td class="red"><?=$resul["telefono1"];?></td>
</tr>
<tr>
  <td class="desc">Telefono2:</td>
  <td class="campo"><input name="telefono2" type="text" class="form" size="50" value="<?=$resul["telefono2"];?>" /></td>
</tr>
<tr>
  <td class="desc">Pin BB:</td>
  <td class="campo"><input name="pin" type="text" class="form" size="50" value="<?=$resul["pin"];?>"/></td>
</tr>
<tr>
  <td class="desc">Email Tienda:</td>
  <td class="campo"><input name="email" type="text" class="form" size="50" value="<?=$resul["email"];?>" /></td>
</tr>
<tr>
  <td class="desc">Horario:</td>
  <td class="campo"><textarea name="horario" cols="45" rows="5" class="form"><?=$resul["horario"];?></textarea></td>
</tr>
<tr>
  <td class="desc">Datos para Pagos:</td>
  <td class="campo">
  <? 
  $ver_datos_pago = mysql_query("SELECT * FROM medio_pago ORDER BY nombre ASC");
  while($vdp = mysql_fetch_array($ver_datos_pago))
  {?>
    <input type="checkbox" name="datos_pago[]" value="<?=$vdp["id"]?>" <? if(in_array($vdp["id"],$datos_pago)){?> checked="checked"<? }?>/> <?=$vdp["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Datos para Envios:</td>
  <td class="campo">
  <? 
  $ver_datos_envio = mysql_query("SELECT * FROM medio_envio ORDER BY nombre ASC");
  while($vde = mysql_fetch_array($ver_datos_envio))
  {?>
    <input type="checkbox" name="datos_envio[]" value="<?=$vde["id"]?>" <? if(in_array($vde["id"],$datos_envio)){?> checked="checked"<? }?>/> <?=$vde["nombre"]?><br />
  <? }?></td>
</tr>
<tr>
  <td class="desc">Bancos para pagos:</td>
  <td class="campo">
    <? 
  $ver_datos_banco = mysql_query("SELECT * FROM banco ORDER BY nombre ASC");
  while($vdb = mysql_fetch_array($ver_datos_banco))
  {?>
    <input type="checkbox" name="datos_banco[]" value="<?=$vdb["id"]?>" <? if(in_array($vdb["id"],$datos_banco)){?> checked="checked"<? }?>/> <?=$vdb["nombre"]?><br />
    <? }?></td>
</tr>
<tr>
  <td colspan="2" align="right" class="tabla_botones">
    <input type="hidden" name="id" value="<?=$resul["id"]?>"/>
    <input type="hidden" name="editar" value="1"/>
    <input type="image" src="/imagenes/btn_send.jpg" name="editar" id="editar" value="Enviar" /></td>
</tr>
</table>               
    </form></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
