<?php
include("conexion.php");
include("funciones.php");
date_default_timezone_set('America/Caracas');
//busca todos los usuarios y toma su id
$res_pri = mysql_query("SELECT * FROM tienda_virtual");
//echo mysql_num_rows($id);
while($fila = mysql_fetch_array($res_pri)){
  $id = $fila["id"];
  //extrae la info  de tienda virtual de ese usuario
  $ver_tienda = mysql_query("SELECT * FROM tienda_virtual WHERE id='$id'");
  $vt = mysql_fetch_array($ver_tienda);
  $email = $vt["email"];
  $carpeta = limpiar_cadena($vt["razon_social"]);
  $carpeta_productos = cual_nombre_carpeta($id)."/productos";
  $nombretr = limpiar_cadena($vt["nombre_oficial"]);
  //busca los  productos para contarlos
  $bus_prod_vencer = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence>='".date("Y-m-j")."' && vence<='".date("Y-m-j", strtotime("+2 day"))."' ORDER BY fecha_publicacion DESC";
  $res = mysql_query($bus_prod_vencer);
  $tot_vencen = mysql_num_rows($res);
  //si hay productos por vencer
  if ($tot_vencen  > 0){
    $msj_part1 = '<div style="width:750px; font-family:\'Oswald\', sans-serif; background-color:#E4E4E3; padding:25px; color:#262626;"><img src="www.vendorepuestos.com.ve/imagenes/cabecera-peq.jpg" width="750" height="112" alt=""/>
  <div style="width:100%; font-size:20px; padding:30px 0px;">
<div style="text-align:center;  font-weight:bold;"><span style="color:#69A02A;">vendorepuestos.com.ve</span><br>Le informa que los siguientes productos de '.$nombretr.' están próximos a vencer.<br>Le invitamos a renovar los mismos. <a href="http://vendorepuestos.com.ve/iniciar_sesion/">Renovar</a>
<br><br>
</div>
<table width="100%" border="0" align="right" cellpadding="3" cellspacing="0" style="font-size:12px;">
  <tr height="25" style="background: url(http://vendorepuestos.com.ve/imagenes/bg_botonera.jpg);" class="menu">
    <td width="154" class="link">FOTO</td>
    <td width="210" class="link">DESCRIPCIÓN</td>
    <td width="110">PRECIO</td>
    <td width="110">VISITAS</td>
    <td width="110">ARTICULO #</td>
    <td width="110">VENCE</td>
  </tr>
</table><br>';
    //busca los productos por vencer
    $prod_vencer = "SELECT * FROM productos WHERE usuario_tienda='2' && id_usuario_tienda='$id' && vence>='".date("Y-m-j")."' && vence<='".date("Y-m-j", strtotime("+2 day"))."' ORDER BY fecha_publicacion DESC";
    $result = mysql_query($prod_vencer);
    while($vpt = mysql_fetch_array($result)){
      $productos_venc = '<div style="width:98%; height:110px; font-size:13px; border-radius: 10px; border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px;">
        <div style="width:320px; float:left;">
          <a href="http://vendorepuestos.com.ve/articulo/'.limpiar_cadena($vpt["titulo"]).'/'.$vpt["id"].'">
            <img src="http://vendorepuestos.com.ve/'.$carpeta_productos.'/'.$vpt["foto1"].'" width="125" height="88" hspace="5" vspace="5" border="0" align="left" />
          </a>
          <span style="color: #69A02A;">
            <a href="http://vendorepuestos.com.ve/articulo/'.limpiar_cadena($vpt["titulo"]).'/'.$vpt["id"].'" style="color: #69A02A;">'.$vpt["titulo"].'</a>
            </span><br />'.$vpt["subtitulo"].'
    </div>
        <div class="red" style="width:120px; float:left;">'.$vpt["precio"].'</div>
        <div class="gris" style="width:120px; float:left;">'.$vpt["visitas"].'</div>
        <div class="gris" style="width:120px; float:left;">'.numero_articulo($vpt["id"]).'</div>
        <div class="gris" style="width:120px; float:left;">'.$vpt["vence"].'<br />'.utf8_encode(cual_estado($vpt["id_estado"])).'</div>
      </div>';
      echo $productos_venc = $productos_venc;
    }
    //email al cliente
    echo $to = $email;
    $subject = "Productos a vencer";
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\n";
    $headers .= "X-Priority: 1\n";
    $headers .= "From: administracion@vendorepuestos.com.ve\r\n";
    $message = $msj_part1.$productos_venc.'</div></div>';
    $send_mail = mail($to, $subject, $message, $headers);
  }
  else{
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Ejemplo de HTML5" />
  <meta name="keywords" content="HTML5, CSS3, Javascript" />
  <title>Página</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
</body>
</html>