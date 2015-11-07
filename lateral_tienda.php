<!--buscador-->
<script type="text/javascript">
function validar_buscar_tienda(forma)
{
	if(forma.palabra_tienda.value=="")
	{
		alert("Debe ingresar la palabra o frase a buscar");
		forma.palabra_tienda.focus();
		return false;
	}
	cadena = forma.palabra_tienda.value; 
	cadena = cadena.replace(/À|Á|Â|Ã|Ä|Å|à|á|â|ã|ä|å|Ò|Ó|Ô|Õ|Ö|Ø|ò|ó|ô|õ|ö|ø|È|É|Ê|Ë|è|é|ê|ë|Ç|ç|Ì|Í|Î|Ï|ì|í|î|ï|Ù|Ú|Û|Ü|ù|ú|û|ü|ÿ|Ñ|ñ|\.|\/|\#/, '-');
	cadena = cadena.replace(/ /gi, '-');
	forma.action="/tr_resultado/<?=$carpeta?>/<?=$id?>/"+cadena+"/0/0/1/";
	return true;
}
</script>
<div style="border:1px solid #D3D3D3;">
<div class="titcat_tienda" style="background-color:<?=$color_fondo?>; color:<?=$color_titulo?>">BUSCAR EN LA TIENDA</div><div id="linea_division_tienda"></div>
    <table width="240" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$color_contenido;?>">
  <form method="post" onsubmit="return validar_buscar_tienda(this);" name="form_bust" id="form_bust">
  <tr>
    <td height="10" colspan="2" align="right" valign="top"></td>
    </tr>
  <tr>
    <td align="right" valign="top"><input name="palabra_tienda" id="palabra_tienda" type="text" class="formtienda" size="20" /></td>
    <td align="left"><input name="" type="image" src="/imagenes/btn_buscartienda.jpg" /></td>
  </tr>
  </form>
</table>
<div style="background-color:<?=$color_contenido?>; height:20px;"></div>
</div>
<br />
<!-- Categorias-->
<div style="border:1px solid #D3D3D3;">
    <div class="titcat_tienda" style="background-color:<?=$color_fondo?>; color:<?=$color_titulo?>">CATEGORIAS</div><div id="linea_division_tienda"></div>
    
    <div style="width:237px; background-color:<?=$color_contenido;?>; color:<?=$color_titulo?>; padding-left:3px;"><div style="height:10px;"></div><?=categorias_activas_tienda($id,limpiar_cadena($vt["razon_social"]));?></div>
    <div style="background-color:<?=$color_contenido?>; height:20px;"></div>
</div>
<br />
<!-- ubicacion--> 
<div style="border:1px solid #D3D3D3;">   
    <div class="titcat_tienda" style="background-color:<?=$color_fondo?>; color:<?=$color_titulo?>">UBICACION</div><div id="linea_division_tienda"></div>
    <div style="width:237px; background-color:<?=$color_contenido;?>; color:<?=$color_titulo?>; padding-left:3px;"><div style="height:10px;"></div><?=ubicacion_activas_tienda($id,limpiar_cadena($vt["razon_social"]));?></div>
    <div style="background-color:<?=$color_contenido?>; height:20px;"></div>
</div>
<br />
<!-- datos del vendedor-->
<div style="border:1px solid #D3D3D3;"> 
    <div class="titcat_tienda" style="background-color:<?=$color_fondo?>; color:<?=$color_titulo?>">DATOS DEL VENDEDOR</div><div id="linea_division_tienda"></div>
    <div style="width:237px; background-color:<?=$color_contenido;?>; color:<?=$color_titulo?>; padding-left:3px;">
    <div style="height:10px;"></div>
    <b>Raz&oacute;n social: </b><?=$vt["razon_social"];?><br />
    <b>RIF:</b><?=$vt["rif"];?><br />
    <b>Estado:</b><?=cual_estado($vt["id_estado"]);?><br />
    <b>Ciudad:</b><?=cual_ciudad($vt["id_ciudad"]);?><br />
    <b>Web:</b><a href="http://<?=$vt["pagina_web"]?>" target="_blank">visitar</a><br />
    <!--<b>Facebook:</b><a href="<?=$vt["facebook"]?>" target="_blank">visitar</a><br />
    <b>Twitter:</b><a href="<?=$vt["twitetr"]?>" target="_blank">visitar</a><br />-->
    <b>Email:</b><a href="mailto:<?=$vt["email"];?>">contactar</a><br />
    <b>Horario:</b> <?=$vt["horario"];?></div>
    <div style="background-color:<?=$color_contenido?>; height:20px;"></div>
</div>
<br />
<!-- fotos tienda-->
<div style="border:1px solid #D3D3D3;"> 
    <div class="titcat_tienda" style="background-color:<?=$color_fondo?>; color:<?=$color_titulo?>">FOTOS DE LA TIENDA</div><div id="linea_division_tienda"></div>
      <table width="240" border="0" cellspacing="6" cellpadding="0" bgcolor="<?=$color_contenido;?>">
        <tr>
          <td valign="top">
          <ul id="mycarousel" class="jcarousel-skin-tango">
          	<? if($vt["foto1"]!=""){?><li><a href="#"><img src="/<?=$carpeta?>/<?=$vt["foto1"]?>" width="135" height="101" class="imgult" /></a></li><? }?>
            <? if($vt["foto2"]!=""){?><li><a href="#"><img src="/<?=$carpeta?>/<?=$vt["foto2"]?>" width="135" height="101" class="imgult" /></a></li><? }?>
            <? if($vt["foto3"]!=""){?><li><a href="#"><img src="/<?=$carpeta?>/<?=$vt["foto3"]?>" width="135" height="101" class="imgult" /></a></li><? }?>
          </ul></td>
          </tr>
      </table>
    <div style="background-color:<?=$color_contenido?>; height:20px;"></div>
</div>
<br />
<!--ubicacion tienda-->
<div style="border:1px solid #D3D3D3;"> 
    <div class="titcat_tienda" style="background-color:<?=$color_fondo?>; color:<?=$color_titulo?>">DONDE ESTA UBICADO</div><div id="linea_division_tienda"></div>
    <div style="width:240px; background-color:<?=$color_contenido;?>; color:<?=$color_titulo?>;" align="center"><a href="<? if($vt["latitud"]!="") echo $vt["latitud"]; else echo "http://maps.google.co.ve/";?>" target="_blank"><img src="/imagenes/img_ej_map.jpg" width="136" height="100" /><br /> ver en google maps</a></div>
    <div style="background-color:<?=$color_contenido?>; height:20px;"></div>
</div>