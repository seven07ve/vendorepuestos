<?php
include("conexion.php");
session_start();
include("funciones.php");
$idp=$_GET["idp"];

//actualizar visitas
$visitas = mysql_query("UPDATE productos SET visitas=visitas+1 WHERE id='$idp'");
$ultima_visitas = mysql_query("UPDATE productos SET ultima_visita=CURRENT_TIMESTAMP() WHERE id='$idp'");

$ver_detalle_producto = mysql_query("SELECT * FROM productos WHERE id='$idp'");

if(mysql_num_rows($ver_detalle_producto)==0){
    echo '<script language="javascript">alert("Publicacion No existe"); window.location="/inicio/";</script>';
}
$detail = mysql_fetch_array($ver_detalle_producto);

if($detail["usuario_tienda"]==1){
    $carpeta_productos = "productos";

    $ver_datos_vendedor = mysql_query("SELECT * FROM usuario WHERE id='".$detail["id_usuario_tienda"]."'");
    $vdv = mysql_fetch_array($ver_datos_vendedor);
    $nombre_vendedor= $vdv["nombre"];
    $telefono_vendedor = $vdv["telefono1"];
    $telefono_vendedor2 = $vdv["telefono2"];
    $pin = $vdv["pin"];
    $email_vendedor = $vdv["email"];
    $horario_vendedor = $vdv["horario"];
    $certificado = $vdv["certificado"];
}
elseif($detail["usuario_tienda"]==2){
    $carpeta_productos = cual_nombre_carpeta($detail["id_usuario_tienda"])."/productos";
    $ver_datos_vendedor = mysql_query("SELECT * FROM tienda_virtual WHERE id='".$detail["id_usuario_tienda"]."'");
    $vdv = mysql_fetch_array($ver_datos_vendedor);
    $nombre_vendedor= $vdv["persona_mantenimiento"];
    $telefono_vendedor = $vdv["telefono1"];
    $telefono_vendedor2 = $vdv["telefono2"];
    $pin = $vdv["pin"];
    $email_vendedor = $vdv["email"];
    $horario_vendedor = $vdv["horario"];
    $nombretr = $vdv["nombre_oficial"];
}
	/*perguntas al vendedor*/
		$lista_preg = mysql_query("SELECT * FROM preguntas WHERE id_producto='$idp' ORDER BY id_preg DESC");
	$tot_preg = mysql_num_rows($lista_preg);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#Style {
visibility:block;
}
#Style2 {
visibility:hidden;
}
#Style3 {
visibility:hidden;
}
</style>
<!--carrusel-->
<!-- <script type="text/javascript" src="/lib/jquery-1.4.2.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="/lib/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="/js/preguntas.js"></script>
<link rel="stylesheet" type="text/css" href="/lib/skin.css" />
<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});

</script>
<script language="Javascript">
<!--
function ShowPicture(id,id2,id3,source)
{
document.getElementById(''+id+'').style.visibility = "visible"
document.getElementById(''+id2+'').style.visibility = "hidden"
document.getElementById(''+id3+'').style.visibility = "hidden"
}
//-->
</script>
</head>
<body>
<?php include("includes/header_detalle.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <div class="titulo_ruta" style="height:30px; padding-top:20px; float:left; width:760px;">
      <a href="/inicio/" class="titulo_ruta">vendorepuestos.com.ve</a> >
      <a href="/vista_nivel2/<?=limpiar_cadena(cual_categoria($detail["id_categoria"]));?>/<?=$detail["id_categoria"]?>/" class="titulo_ruta"><?=cual_categoria($detail["id_categoria"]);?></a> >
      <a href="/vista_nivel3/<?=limpiar_cadena(cual_menu($detail["id_menu"]))?>/<?=$detail["id_categoria"]?>/<?=$detail["id_menu"]?>/0/0/1/" class="titulo_ruta"><?=cual_menu($detail["id_menu"])?></a> <? if($detail["id_submenu"]!=0){ echo " > ";?>
      <a href="/vista_nivel3/<?=limpiar_cadena(cual_submenu($detail["id_submenu"]))?>/<?=$detail["id_categoria"]?>/<?=$detail["id_menu"]?>/<?=$detail["id_submenu"]?>/0/1/" class="titulo_ruta"><?=cual_submenu($detail["id_submenu"])?></a><? }?> <? if($detail["id_submenu2"]!=0){ echo " > ";?>
      <a href="/vista_nivel4/<?=limpiar_cadena(cual_submenu2($detail["id_submenu2"]))?>/<?=$detail["id_categoria"]?>/<?=$detail["id_menu"];?>/<?=$detail["id_submenu"]?>/<?=$detail["id_submenu2"];?>/1/" class="titulo_ruta"><?=cual_submenu2($detail["id_submenu2"]); }?></a></div>
      <div style="height:30px; padding-top:20px; float:left; width:200px;" align="right">Art&iacute;culo # <?=numero_articulo($detail["id"]);?>  <a href="/centro_seguridad/<?=numero_articulo($detail["id"]);?>" class="bluep">Reportar</a><br />&iquest;Est&aacute; vendido? <a href="/notificaTR/<?=numero_articulo($detail["id"]);?>" class="bluep">Av&iacute;sanos</a></div>
      <div style="clear:both;"><span  class="titulo_categoria"><?=ucfirst(strtolower($detail["titulo"]))?></span><br />
         <?=$detail["subtitulo"]?><br /></div>
      <div style="clear:both;">
          <table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="350" valign="top">
                <div style="width:320; height:400; float:left; padding:10px;">
                  <div style="width:80; height:60; float:left; padding:10px;"><? if($detail["foto1"]!=""){?><a href="#" onMouseOver="ShowPicture('Style','Style2','Style3')" onMouseOut="ShowPicture('Style','Style2','Style3')"><img src="/<?=$carpeta_productos?>/<?=$detail["foto1"];?>" width="80" height="60" border="0" align="left" class="imagen"/></a><? }?></div>
                <div style="width:80; height:60; float:left; padding:10px;"><? if($detail["foto2"]!=""){?><a href="#" onMouseOver="ShowPicture('Style2','Style1','Style3')" onMouseOut="ShowPicture('Style','Style2','Style3')"><img src="/<?=$carpeta_productos?>/<?=$detail["foto2"];?>" width="80" height="60" border="0" align="left" class="imagen"/></a><? }?></div>
                <div style="width:106; height:80; float:left; padding:10px;"><? if($detail["foto3"]!=""){?><a href="#" onMouseOver="ShowPicture('Style3','Style2','Style1')" onMouseOut="ShowPicture('Style','Style2','Style3')"><img src="/<?=$carpeta_productos?>/<?=$detail["foto3"];?>" width="80" height="60" border="0" align="left" class="imagen"/></a><? }?></div>
                <div style="width:320; height:240; clear:both; position:initial;" id="Style"><? if($detail["foto1"]!=""){?><img src="/<?=$carpeta_productos?>/<?=$detail["foto1"];?>" width="320" height="240" border="0" align="left"/><? }?></div>
                <div style="width:320; height:240; clear:both; position:absolute" id="Style2"><? if($detail["foto2"]!=""){?><img src="/<?=$carpeta_productos?>/<?=$detail["foto2"];?>" width="320" height="240" border="0" align="left"/><? }?></div>
                <div style="width:320; height:240; clear:both; position:absolute" id="Style3"><? if($detail["foto3"]!=""){?><img src="/<?=$carpeta_productos?>/<?=$detail["foto3"];?>" width="320" height="240" border="0" align="left"/><? }?></div>
                  </div>
            </td>
              <td valign="top">
              <div style="width:610px; height:400px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px; float:left;">
               <div class="addthis_toolbox addthis_default_style">
                <a class="addthis_button_facebook_like"  fb:like:count="true" fb:like:layout="button_count" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?php echo $detail["titulo"]; ?>" fb:like:send="true"></a></div>
                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f298c86025fe604"></script><br /><br />
                <span class="red">Bs.
                <?=$detail["precio"];?>
                </span><br /><br />
                El vendedor identificado en este anuncio es el &uacute;nico responsable de los datos y procedencia del art&iacute;culo. Vendorepuestos.com.ve no vende este art&iacute;culo, no fija su precio y no participa en niguna negociaci&oacute;n, solo se encarga de su publicaci&oacute;n.<br /><br />
                <div style="background:#D3D3D3; padding:10px;">
                <?=$detail["condicion"]?> <br />
                <?=cual_estado($detail["id_estado"])?> / <?=cual_ciudad($detail["id_ciudad"])?><br />
                Finaliza el: <?=date("d-m-Y",strtotime($detail["vence"]))?><br />
                </div>
                <div style="width:250px; padding:10px; border-right-width:thin; border-right-color:#D3D3D3; border-right-style:solid; margin-top:10px; float:left">
                <span class="blue">Contacta al vendedor</span><br />
                 - <?=$telefono_vendedor?> <a href="mailto:<?=$email_vendedor?>"><img src="/imagenes/icono_email.png" width="23" height="15" hspace="10" border="0" align="right" /></a><br />
                  <? if($telefono_vendedor2!="") {?>- <?=$telefono_vendedor2?><br /><? }?><br />
                  <? if($pin!="") {?><span class="blue">Pin</span><br />
                 - <?=$pin?><br /><? }?><br />
                 <span class="blue">Comparte este artículo</span><br />
                 <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook" style="cursor:pointer" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?php echo $detail["titulo"]; ?>"></a>
                    <a class="addthis_button_twitter" style="cursor:pointer" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?php echo $detail["titulo"]; ?>"></a>
                    <a class="addthis_button_email" style="cursor:pointer" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?php echo $detail["titulo"]; ?>"></a></div>
              </div>
              <div style="width:250px; padding:10px; margin-top:10px; float:left">
              <? if($horario_vendedor!=""){?><span class="blue"><strong>Horario:</strong></span><br /><?=$horario_vendedor?><br /><? }?><br />
              <? if($detail["usuario_tienda"]=="2"){?><a href="/<?=limpiar_cadena($nombretr)?>/<?=$detail["id_usuario_tienda"]?>/0/0/1" style="float: right; margin-top: -30px; margin-right: -80px;"><img src="/imagenes/icon_tr_grande.jpg" width="66" height="50" border="0" /></a><br />
                      <div class="blue" style="float:right; margin-top:-20px;">visite <?=$nombretr?></div>
              <? }
              elseif($detail["usuario_tienda"]=="1")
              {
                  if($certificado=="1")
                  {?>
                      <img src="/imagenes/icon_cliente_premium_gde.png" width="65" height="74" border="0" /><br />
                      VENDEDOR<br />CERTIFICADO
              <? }
              }?>
              </div>
              </div></td>
            </tr>
            <tr>
              <td colspan="2">
              <div style="width:460px; height:auto; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px; float:left;"><span class="titulo_seccion">Pagos</span> <div id="linea_division"></div>
              <?
              $datos_pago = explode(",",$vdv["datos_pago"]);
              $ver_datos_pago = mysql_query("SELECT * FROM medio_pago ORDER BY nombre ASC");
              while($vdp = mysql_fetch_array($ver_datos_pago))
              {
                  if(in_array($vdp["id"],$datos_pago)) echo "- ".$vdp["nombre"]."<br />";
              }?>
               </div>
              <div style="width:470px; height:auto; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 10px; padding:8px; float:left;"><span class="titulo_seccion">Envios</span> <div id="linea_division"></div>
              <?
              $datos_envio = explode(",",$vdv["datos_envio"]);
              $ver_datos_envio = mysql_query("SELECT * FROM medio_envio ORDER BY nombre ASC");
              while($vde = mysql_fetch_array($ver_datos_envio))
              {
                  if(in_array($vde["id"],$datos_envio)) echo "- ".$vde["nombre"]."<br />";
              }?></div></td>
            </tr>
            <tr>
              <td colspan="2">
              <?
                 if($vdv["datos_banco"]!="")
                 {
              ?>
              <div style="width:960px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px;"><span class="titulo_seccion">Bancos</span> <div id="linea_division"></div>
              <?
                 $datos_banco = explode(",",$vdv["datos_banco"]);
                 $ver_datos_banco = mysql_query("SELECT * FROM banco ORDER BY nombre ASC");
                 while($vdb = mysql_fetch_array($ver_datos_banco))
                  {
                       if(in_array($vdb["id"],$datos_banco))
                          {
                              if($vdb["logo"]!="") echo "<img src=\"/logos_bancos/".$vdb["logo"]."\" height=\"40\" hspace=\"0\" vspace=\"5\"/> ";
                              else echo $vdb["nombre"];
                          }
                  }?>
                </div>
                <? }?>
              <div style="width:960px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px;"><span class="titulo_seccion">Descripcion</span>
                <div id="linea_division"></div>
              <?=$detail["descripcion"];?></div>
           <table width="61" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><span class="titulo_categoria" style="clear:both;">Visitas</span></td>
          </tr>
          <tr>
            <td height="23" align="center" class="red" style="background-image:url(/imagenes/box_numero_detalle.jpg); background-repeat:no-repeat;"><?=$detail["visitas"];?></td>
          </tr>
          <tr>
            <td height="10" align="center">&nbsp;</td>
          </tr>
           </table>
          </td>
               </tr>
            <tr>
              <td colspan="2"><div style="width:960px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="4%"><img src="/imagenes/icono_seguro.jpg" width="30" height="30" hspace="5" vspace="5" /></td>
                    <td width="54%"><span class="titulo_seccion">Consejos para comprar seguro</span></td>
                    <td width="42%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>- Contacta al vendedor preferiblemente por nuestra sección, colocando tu correo eletrónico.<br /><br />
                    - No pagues con servicios de Pago Anónimo como Western Unión.<br /><br />
                    - Por tu seguridad no ingreses datos de contacto en tu pregunta.<br /><br />
</td>
                    <td>- Realiza todas las preguntas necesarias antes de adquirir el artículo.<br /><br />
- Usa medios de envío seguro y asegura el envío.<br /><br /></td>
                  </tr>
                </table>
              </div></td>
            </tr>
        <tr>
            <td colspan="2">
            <!--CONTACTA AL VENDEDOR-->
            <div class="cont-contac">
                <div class="contact-img">
                    <img src="/imagenes/ico-preguntas.jpg" width="30" height="30" hspace="5" vspace="5" />
                </div>
                <div class="contact-text">
                    <span class="titulo_seccion">Contacta al vendedor</span>
                </div>
                <div class="cont-form">
                    <form action="" method="post" name="form-consulta" id="form-consulta">
                       <input id="id-prod" name="id-prod" type="hidden" value="<?php echo $idp ?>">
                        <input id="email" name="email" type="text" class="form" size="50" autocomplete="off" placeholder="Correo Electrónico" />
                        <span id="msjmail"></span>
                        <textarea name="consulta" id="consulta" class="form" placeholder="Preguntale al vendedor"></textarea>
                        <span id="msjconsulta"></span>
                        <input type="button" class="form" id="preguntar" name="preguntar" value="Preguntar" style="margin-top:5px;"/><img src="/imagenes/cargando3.gif" id="mini-cargando" class="mini-loading" /><span style="margin-left:5px;">No uses lenguaje vulgar. Por tu seguridad no ingreses datos de contacto en tu pregunta.</span>
                    </form>

                </div>
<?php
if($tot_preg > 0){
		/*cont preguntas y respuestas*/
		echo '<div id="cont-preg-resp" class="cont-preg-resp">';
	while($row=mysql_fetch_array($lista_preg)){
		/*pregunta*/
		echo '<div class="preg">
                		<img src="/imagenes/ico-pregunta.jpg" width="20" height="20" hspace="5"/>
						'.$row["pregunta"].'
                	</div>';
		/*revisa si hay respuesta*/
		if ($row["status"] == 2){
				$respuesta = mysql_query("SELECT * FROM respuestas WHERE id_resp='".$row["id_resp"]."'");
				$cont_resp = mysql_fetch_array($respuesta);
			/*respuesta*/
				echo '<div class="resp">
                		<img src="/imagenes/ico-respuesta.jpg" width="20" height="20" hspace="5"/>'.$cont_resp["respuesta"].'
                	</div>';
		}
	}
	echo '</div>';
}
?>
			<br clear="all" />
            </div>
            </td>
        </tr>
            <tr>
              <td colspan="2"><div style="width:960px; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 5px; padding:8px;">Vendorepuestos Venezuela C.A. desea contribuir en que vendedores y compradores tengan un espacio virtual de encuentro, eliminando intermediarios haciendo del comercio una actividad  eficaz y con mas beneficios. Vendorepuestos Venezuela C.A., sugiere que antes de realizar cualquier transacción, busque distintas opciones para adquirirlos a precios racionales. <a href="/inicio/" class="bluep">www.vendorepuestos.com.ve</a> solamente  ofrece la plataforma para la publicación de los productos, pero no es propietario, no estipula precios, no asigna usos ni interviene en ninguna fase de la oferta de los artículos aquí publicados. </div></td>
            </tr>
          </table>
      </div>
        <?
        $otros_productos = mysql_query("SELECT foto1, titulo, id, precio FROM productos WHERE id_usuario_tienda='".$detail["id_usuario_tienda"]."' && id!='$idp'  && vence>= NOW()");
        if(mysql_num_rows($otros_productos))
        {?>
        <div class="titulo_categoria" style="padding-bottom:10px;">Mas publicaciones del vendedor<br /></div>
        <div style="width:960px; height:220px">
    <ul id="mycarousel" class="jcarousel-skin-tango">
    <?
    while($op = mysql_fetch_array($otros_productos))
    {?>
    <li><div align="center"><a href="/articulo/<?=limpiar_cadena($op["titulo"]);?>/<?=$op["id"]?>/"><img src="/<?=$carpeta_productos?>/<?=$op["foto1"]?>" alt="" width="145" height="108" border="0" /></a></div><br />
      <span class="blue"><?=$op["titulo"];?></span><br />
      <span class="red">Bs.<?=$op["precio"]?></span></li>
     <? }?>
  </ul>
  </div>
  <? }?></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
