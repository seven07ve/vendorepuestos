<?php
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
if(@$_GET["buscar"]==2)
{
	echo "<select name='id_ciudadp' class='form'>";
	if($_GET["ciu"]==0) 
		echo "<option value='0'>Seleccione</option>";
	$sql_submenu=mysql_query("SELECT * FROM ciudad WHERE id_estado='".$_GET["edo"]."'");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		echo "<option value='".$resul_submenu["id"]."'";
		if($_GET["ciu"]==$resul_submenu["id"]) echo " selected";
		echo ">".utf8_encode($resul_submenu["nombre"])."</option>";	
	}	
	echo "</select>";
	return;
}
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
if(formy.nombre.value=="")
	{
		alert("Debe ingresar el nombre");
		formy.nombre.focus();
		return false;
	}
	if(formy.cedula.value=="")
	{
		alert("Debe ingresar el Nro. de Documento de Identidad");
		formy.cedula.focus();
		return false;
	}	
	numero = formy.cedula.value;
	if (!/([J|V|G|E][-][?1234567890]*)+$/.test(numero))
	{
		alert("El Nro. de Documento de Identidad es invalido");
		formy.cedula.focus();
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
	if(formy.id_estadop.value==0)
	{
		alert("Debe seleccionar un Estado");
		formy.id_estadop.focus();
		return false;
	}
	if(formy.id_ciudadp.value==0)
	{
		alert("Debe seleccionar una Ciudad");
		formy.id_ciudadp.focus();
		return false;
	}
	if((formy.email.value.indexOf ('@', 0) == -1) || (formy.email.value.indexOf ('.', 0) == -1) ||(formy.email.value.length < 5))
	{ 
    	alert("Debe escribir una dirección de e-mail valida");     
		formy.email.focus();
		return false;
	}
}
function cargar_ciudadp(edo,ciu)
{
	new Ajax.Request("vende.php?buscar=2&edo="+edo+"&ciu="+ciu,{
	method: 'get',
	onSuccess: function(transport) {
		$('ciup').update(transport.responseText);
	}
	});
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
            <td><a href="admin_clientes.php"><img src="imagenes/cancelar_big.png" width="100" height="50" border="0" /></a></td>
          </tr>
        </table>

        <!-- FINAL SUBMENU -->
        
		<form action="admin_clientes.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validar(this);">
		  <table border="0" cellpadding="0" cellspacing="0" class="tabla_resultados" style="border-radius: 10px;border: 1px solid #D3D3D3;">
		    <tr>
                <td colspan="2" class="tabla_titulo">Clientes Premium</td>
              </tr>
              <tr>
                <td width="216" class="desc">Nombre:</td>
                <td width="464" class="campo"><input name="nombre" type="text" class="form" size="50" />
                  *</td>
              </tr>
              <tr>
                <td class="desc">Documento de Identidad:</td>
                <td class="campo"><input name="cedula" type="text" class="form" size="50" />
                  (ej. V-0000)*</td>
              </tr>
              <tr>
                <td class="desc">Tel&eacute;fono1:</td>
                <td class="campo"><input name="telefono1" type="text" class="form" size="50" />
                  *</td>
              </tr>
              <tr>
                <td class="desc">Tel&eacute;fono2:</td>
                <td class="campo"><input name="telefono2" type="text" class="form" size="50" /></td>
              </tr>
              <tr>
                <td class="desc">Pin BB:</td>
                <td class="campo"><input name="pin" type="text" class="form" size="50" /></td>
              </tr>
              <tr>
                <td class="desc">Estado:</td>
                <td class="campo"><select class="form" name="id_estadop" onchange="cargar_ciudadp(this.value,0);">
                  <option value="0">Seleccione</option>
                  <?php 
	$sql_menu=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
	while($menu=mysql_fetch_array($sql_menu))
	{
	?>
                  <option value="<?=$menu["id"]?>">
                    <?=$menu["nombre"]?>
                    </option>
                  <?php 
	}?>
                </select>
                  *</td>
              </tr>
              <tr>
                <td class="desc">Ciudad:</td>
                <td class="campo" id="ciup"><select class="form" name="id_ciudadp">
                  <option value="0">Seleccione</option>
                </select>
                  *</td>
              </tr>
              <script>cargar_submenu('<?=$id_menu[0]?>','0');</script>
              <tr>
                <td class="desc">Email:</td>
                <td class="campo"><input name="email" type="text" class="form" size="50" />
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
		      <td colspan="2" class="tabla_botones">
		        <input type="hidden" name="guardar" value="1"/>
		        <input type="image" src="imagenes/agregar.png" name="guardar" id="guardar" value="Enviar" /></td>
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