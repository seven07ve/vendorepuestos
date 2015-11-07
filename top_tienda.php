<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=$color_contenido?>" style="color:<?=$color_titulo?>; border: 1px solid #D3D3D3;">
    <tr>
      <td rowspan="4"><a href="/tr/<?=limpiar_cadena($carpeta)?>/<?=$id?>/0/0/1"><img src="/<?=$carpeta?>/<?=$vt["logo"]?>" height="80" hspace="8" border="0" align="left" class="imagel" /></a></td>
      <td width="33" rowspan="4" align="right" valign="top"><strong><img src="/imagenes/icon_tr.jpg" width="33" height="25" /></strong></td>
      <td width="541" height="21" align="left" bgcolor="<?=$color_fondo;?>">&nbsp;<strong>
      <?=$vt["nombre_oficial"]?> 
      <?//=$vt["direccion"];?></strong></td>
      <td width="70" align="right" bgcolor="<?=$color_fondo;?>"><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f298c86025fe604"></script>
    	<div class="addthis_toolbox addthis_default_style">
					<a class="addthis_button_facebook" style="cursor:pointer" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?=limpiar_cadena(datos_tienda($id,"nombre_oficial"))?>"></a>
                    <a class="addthis_button_twitter" style="cursor:pointer" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?=limpiar_cadena(datos_tienda($id,"nombre_oficial"))?>"></a>
                    <a class="addthis_button_email" style="cursor:pointer" addthis:url="http://vendorepuestos.com.ve<?=$_SERVER['REDIRECT_URL'];?>" addthis:title="<?=limpiar_cadena(datos_tienda($id,"nombre_oficial"))?>"></a></div></td>
    </tr>
    <tr>
      <td colspan="2"><div id="linea_division"></div></td>
    </tr>
    <tr>
      <td colspan="2" align="justify"><b>Mantenido por:</b>
<?=$vt["persona_mantenimiento"]?> -  Telf <?=$vt["telefono_mantenimiento"]?> - <a href="mailto:<?=$vt["email_mantenimiento"];?>"><img src="/imagenes/icono_email.png" width="23" height="15" border="0" /></a><br /><?=$vt["descripcion"]?></td>
    </tr>
  </table>