<? 
include("conexion.php");
session_start();
include("funciones.php");
if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }
$nombretr = cual_nombre_oficial($_SESSION["userid"]);

if($_POST['editar']){
  $id = $_POST["id"];
  $razon_social = $_POST["razon_social"];
  $telefono1 = $_POST["telefono1"];
  $telefono2 = $_POST["telefono2"];
  $id_estado = $_POST["id_estado"];
  $id_ciudad = $_POST["id_ciudad"];
  $direccion = $_POST["direccion"];
  $latitud = $_POST["latitud"];
  $longitud = $_POST["longitud"];
  $pagina_web = $_POST["pagina_web"];
  $facebook = $_POST["facebook"];
  $twitter = $_POST["twitter"];
  $email = $_POST["email"];
  $descripcion = $_POST["descripcion"];
  $horario = $_POST["horario"];
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];
  $nombre_oficial = $_POST["nombre_oficial"];
  $color_fondo = $_POST["color_fondo"];
  $color_titulo = $_POST["color_titulo"];
  $color_contenido = $_POST["color_contenido"];
  $persona_mantenimiento = $_POST["persona_mantenimiento"];
  $telefono_mantenimiento = $_POST["telefono_mantenimiento"];
  $email_mantenimiento = $_POST["email_mantenimiento"];
  $pin = $_POST["pin"];
  
  $update = "UPDATE tienda_virtual SET usuario='$usuario', clave='$contrasena', nombre_oficial='$nombre_oficial', telefono2='$telefono2', pin='$pin', id_estado='$id_estado', id_ciudad='$id_ciudad', direccion='$direccion', latitud='$latitud', longitud='$longitud', pagina_web='$pagina_web', facebook='$facebook', twitter='$twitter', email='$email', descripcion='$descripcion', horario='$horario',color_titulo='$color_titulo',color_fondo='$color_fondo', color_contenido='$color_contenido',persona_mantenimiento='$persona_mantenimiento',telefono_mantenimiento='$telefono_mantenimiento',email_mantenimiento='$email_mantenimiento' WHERE id='$id'";
  $actualizar=mysql_query($update);
  //crear carpeta 
  $carpeta = limpiar_cadena($razon_social);
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
  }?>
<!-- <script language="javascript">
alert("Datos Actualizados con exito!"); window.location="cuenta.php";
</script>
-->
<? }

//if($_SESSION["usertipo"]==1) $sql = "SELECT * FROM usuario WHERE id=$id";elseif($_SESSION["usertipo"]==2)
$sql = "SELECT * FROM tienda_virtual WHERE id=$_SESSION[userid]";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);

$carpeta = limpiar_cadena($resul["razon_social"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/prototype.js"></script>
<style type="text/css">
.image-upload{
  display: inline;
  margin-left: 20px;
}
.image-upload > input{
    display: none;
}
.image-upload img{
  opacity:0.7;
}
.image-upload img:hover{
  opacity:1;
}
</style>
<script type="text/javascript">
function validar(formy)
{
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
  if(formy.descripcion.value=="" || formy.descripcion.value.lenght>300)
  {
    alert("Debe ingresar una Descripcion no mayor a 300 caracteres");
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
function cargar_ciudad(menu,submenu)
{
  new Ajax.Request("/admini/funciones_ajax.php?buscar=10&edo="+menu+"&ciu="+submenu,{
  method: 'get',
  onSuccess: function(transport) {
    $('ciu').update(transport.responseText);
  }
  });
}
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=400,left = 212,top = 184');");
}
</script>
<script type="text/javascript">
function cambiar(elemId){
  var img = document.getElementById(elemId);
  img.src = "http://vendorepuestos.com.ve/imagenes/camera-ok.png";
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
          <td height="30" colspan="4" class="titulo_ruta">
            <?=$nombretr?>> Mi Cuenta > Mi TR</td>
          <td align="right" colspan="3">
            <? 
      if($_SESSION["userid"]!="") 
      {
                echo " <span class=\"blue\">
            Hola ".strtoupper(cual_usuario($_SESSION["userid"],$_SESSION["usertipo"]))."
          </span>
          ";?>
             |
          <a href="/salirTR/" class="red" target="_self">Salir</a>
          <? }?></td>
      </tr>
      <tr>
        <td width="70">
          <a href="/bienvenidoTR/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/btn_resumen_off.jpg" name="mitr" width="70" height="21" border="0" id="mitr" /></a>
        </td>
        <td width="43">
          <a href="/mitr/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_1_on.jpg" name="mitr" width="43" height="20" border="0" /></a>
        </td>
        <td width="131">
          <a href="/estado_cuenta/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_2_off.jpg" name="edo" width="131" height="20" border="0" /></a>
        </td>
        <td width="143">
          <a href="/datos_vendedor/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a>
        </td>
        <td width="192">
          <a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a>
        </td>
        <td width="141">
          <a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a>
        </td>
        <td width="171">
          <a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a>
        </td>
      </tr>
      <tr>
        <td height="8" colspan="6" background="/imagenes/login_bg_bot.jpg"></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td valign="top">
    <form action="/mitr/<?=$carpeta?>
      " method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar(this);">
      <table width="700" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td colspan="3" class="blue">
            <? if($_SESSION["usertipo"]==1) echo "Cliente PRemium"; elseif($_SESSION["usertipo"]==2) echo "Mi Tienda Repuestos";?></td>
        </tr>
        <tr>
          <td width="219" class="desc">Razon Social:</td>
          <td colspan="2" class="blue">
            <?=$resul["razon_social"];?>
            <input type="hidden" name="razon_social" value="<?=$resul["razon_social"];?>"/></td>
        </tr>
        <tr>
          <td>Logo:</td>
          <td class="campo">
            <?php
            if($resul["logo"]!=""){
              echo '<img src="/'.$carpeta.'/'.$resul["logo"].'" height="50" />';
            }
            ?>
            </td>
            <td>
            <div class="image-upload">
              <label for="file-input">
                Cambiar: <img id="subir1" src="../../imagenes/camera.png"/>
              </label>
              <input id="file-input" name="file" type="file" class="form" onchange="cambiar('subir1');" />
            </div>
            </td>
        </tr>
        <tr>
          <td colspan="1" class="desc">Fotos de la Tienda:</td>
          <td class="campo">
            <?php
            if($resul["foto1"]!=""){
              echo '<img src="/'.$carpeta.'/'.$resul["foto1"].'" height="50" />';
            }
            ?>
            </td>
            <td>
            <div class="image-upload">
              <label for="file-input2">
                Cambiar: <img id="subir2" src="../../imagenes/camera.png"/>
              </label>
              <input id="file-input2" name="file2" type="file" class="form" onchange="cambiar('subir2');" />
            </div>
            </td>
        </tr>
        <tr>
          <td class="desc"></td>
          <td class="campo">
            <?php 
            if($resul["foto2"]!=""){
              echo '<img src="/'.$carpeta.'/'.$resul["foto2"].'" height="50" />';
            }
            ?>
            </td>
            <td>
            <div class="image-upload">
              <label for="file-input3">
                Cambiar: <img id="subir3" src="../../imagenes/camera.png"/>
              </label>
              <input id="file-input3" name="file3" type="file" class="form" onchange="cambiar('subir3');" />
            </div>
            </td>
        </tr>
        <tr>
          <td class="desc"></td>
          <td class="campo">
            <?php
            if($resul["foto3"]!=""){
              echo '<img src="/'.$carpeta.'/'.$resul["foto3"].'" height="50" />';
            }
            ?>
            </td>
            <td>
            <div class="image-upload">
              <label for="file-input4">
                Cambiar: <img id="subir4" src="../../imagenes/camera.png"/>
              </label>
              <input id="file-input4" name="file4" type="file" class="form" onchange="cambiar('subir4');"/>
            </div>
            </td>
        </tr>
        <tr>
          <td class="desc">Nombre de la TR:</td>
          <td colspan="2" class="campo">
            <input name="nombre_oficial" type="text" class="form" value="<?=$resul["nombre_oficial"];?>" size="50" maxlength="35" /></td>
        </tr>

        <tr>
          <td class="desc">RIF:</td>
          <td colspan="2" class="blue">
            <?=$resul["rif"];?></td>
        </tr>
        <tr>
          <td class="desc">Telefono1:</td>
          <td colspan="2" class="blue">
            <?=$resul["telefono1"];?></td>
        </tr>
        <tr>
          <td class="desc">Telefono2:</td>
          <td colspan="2" class="campo">
            <input name="telefono2" type="text" class="form" size="50" value="<?=$resul["telefono2"];?>" /></td>
        </tr>
        <tr>
          <td class="desc">Pin BB:</td>
          <td colspan="2" class="campo">
            <input name="pin" type="text" class="form" size="50" value="<?=$resul["pin"];?>"/></td>
        </tr>
        <tr>
          <td class="desc">Estado:</td>
          <td colspan="2" class="campo">
            <select class="form" name="id_estado" onChange="cargar_ciudad(this.value,0);">
              <option value="0">Seleccione</option>
              <?php 
  $sql_menu=mysql_query("SELECT * FROM estado ORDER BY nombre ASC");
  while($menu=mysql_fetch_array($sql_menu))
  {
  ?>
              <option value="<?=$menu["id"]?>
                "
                <? if($menu["id"]==$resul["id_estado"]){?>
                selected="selected"
                <? }?>
                >
                <?=$menu["nombre"]?></option>
              <?php 
  }?></select>
          </td>
        </tr>
        <tr>
          <td class="desc">Ciudad:</td>
          <td colspan="2" class="campo" id="ciu">
            <select class="form" name="id_ciudad">
              <option value="0">Seleccione</option>
            </select>
          </td>
        </tr>
        <script>cargar_ciudad('<?=$resul["id_estado"]?>','<?=$resul["id_ciudad"]?>');</script>
        <tr>
          <td class="desc">Direccion:</td>
          <td colspan="2" class="campo">
            <input name="direccion" type="text" class="form" size="50" value="<?=$resul["direccion"]?>" /></td>
        </tr>
        <tr>
          <td class="desc">Google Maps (Link):</td>
          <td colspan="2" class="campo">
            <input name="latitud" type="text" class="form" size="50" value="<?=$resul["latitud"];?>
            " />
            <!-- Longitud:
      <input name="longitud" type="text" class="form" size="10" value="<?=$resul["longitud"];?>" />--></td>
        </tr>
        <tr>
          <td class="desc">Pagina Web:</td>
          <td colspan="2" class="campo">
            <span class="blue">http://</span>
            <input name="pagina_web" type="text" class="form" size="42" value="<?=$resul["pagina_web"]?>" /></td>
        </tr>
        <tr>
          <td class="desc">Twitter:</td>
          <td colspan="2" class="campo">
            <input name="pagina_web2" type="text" class="form" size="50" value="<?=$resul["twitter"]?>" /></td>
        </tr>
        <tr>
          <td class="desc">Facebook:</td>
          <td colspan="2" class="campo">
            <input name="pagina_web3" type="text" class="form" size="50" value="<?=$resul["facebook"]?>" /></td>
        </tr>
        <tr>
          <td class="desc">Descripcion:</td>
          <td colspan="2" class="campo">
            <textarea name="descripcion" cols="45" rows="5" class="form" style="height:100px;">
              <?=$resul["descripcion"];?></textarea>
          </td>
        </tr>
        <tr>
          <td class="desc">Horario:</td>
          <td colspan="2" class="campo">
            <textarea name="horario" cols="45" rows="5" class="form" style="height:100px;">
              <?=$resul["horario"];?></textarea>
          </td>
        </tr>
        <tr>
          <td class="desc">Email Tienda:</td>
          <td colspan="2" class="campo">
            <input name="email" type="text" class="form" size="50" value="<?=$resul["email"];?>" /></td>
        </tr>
        <tr>
          <td class="desc">Color Letra:</td>
          <td class="campo">
            <input type="color" id="colorpicker" name="color_titulo" value="<?=$resul["color_titulo"]; ?>">
            </td>
        </tr>
        <tr>
          <td class="desc">Color Fondo Titulos:</td>
          <td class="campo">
            <input type="color" id="colorpicker" name="color_fondo" value="<?=$resul["color_fondo"]; ?>">
            </td>
        </tr>
        <tr>
          <td class="desc">Color Fondo Contenido:</td>
          <td class="campo">
            <input type="color" id="colorpicker" name="color_contenido" value="<?=$resul["color_contenido"]; ?>">
          </td>
        </tr>
        <tr>
          <td class="desc">Datos Persona Mantenimiento:</td>
          <td colspan="2" class="campo">
            <input name="persona_mantenimiento" type="text" class="form" size="50" value="<?=$resul["persona_mantenimiento"]?>"/></td>
        </tr>
        <tr>
          <td class="desc">Telf. Persona Mantenimiento:</td>
          <td colspan="2" class="campo">
            <input name="telefono_mantenimiento" type="text" class="form" size="50" value="<?=$resul["telefono_mantenimiento"];?>" /></td>
        </tr>
        <tr>
          <td class="desc">Email Persona Mantenimiento:</td>
          <td colspan="2" class="campo">
            <input name="email_mantenimiento" type="text" class="form" size="50" value="<?=$resul["email_mantenimiento"];?>" /></td>
        </tr>
        <tr>
          <td bgcolor="#e1e1e1" class="desc">Usuario:</td>
          <td colspan="2" bgcolor="#e1e1e1" class="campo">
            <input name="usuario" type="text" class="form" size="50" value="<?=$resul["usuario"];?>" /></td>
        </tr>
        <tr>
          <td bgcolor="#e1e1e1" class="desc">Contrase&ntilde;a:</td>
          <td colspan="2" bgcolor="#e1e1e1" class="campo">
            <input name="contrasena" type="password" class="form" size="50" maxlength="8" value="<?=$resul["clave"];?>" /></td>
        </tr>
        <tr>
          <td bgcolor="#e1e1e1" class="desc">Confirmar Contrase&ntilde;a:</td>
          <td colspan="2" bgcolor="#e1e1e1" class="campo">
            <input name="confirmacion" type="password" class="form" size="50" maxlength="8" value="<?=$resul["clave"];?>" /></td>
        </tr>
        <tr>
          <td colspan="3" align="right" class="tabla_botones">
            <input type="hidden" name="id" value="<?=$resul["id"]?>
            "/>
            <input type="hidden" name="editar" value="1"/>
            <input type="image" src="/imagenes/btn_send.jpg" name="editar" id="editar" value="Enviar" />
          </td>
        </tr>
      </table>
    </form>
  </td>
</tr>
</table>
<?php include("includes/footer.php"); ?></body>
</html>