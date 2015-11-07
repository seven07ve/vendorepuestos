<script language="javascript">
function validar_buscar(forma)
{
	cadena = forma.palabra.value;
	if(cadena!="")
	{
		cadena = cadena.replace(/À|Á|Â|Ã|Ä|Å|à|á|â|ã|ä|å|Ò|Ó|Ô|Õ|Ö|Ø|ò|ó|ô|õ|ö|ø|È|É|Ê|Ë|è|é|ê|ë|Ç|ç|Ì|Í|Î|Ï|ì|í|î|ï|Ù|Ú|Û|Ü|ù|ú|û|ü|ÿ|Ñ|ñ|\.|\/|\#/, '-');
		cadena = cadena.replace(/ /gi, '-');
		forma.action="/buscar/"+forma.categoria_buscar.value+"/"+cadena+"/0/1";
		return true;
	}
	else
	{
		forma.action="/buscar/"+forma.categoria_buscar.value+"/todos/0/1";
		return true;
	}
}
</script>
<script type="text/javascript">
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
</script>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="353" height="25" align="right"><table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="508" rowspan="2" align="center"><a href="/inicio/"><img src="/imagenes/img_logo.jpg" width="487" height="70" vspace="10" border="0" /></a></td>
    <td width="99" rowspan="2">&nbsp;</td>
    <td style="padding-right:15px" width="353" height="25" align="right" class="bluep"><?//=salutacion()?></td>
  </tr>
  <tr>
    <td style="padding-right:15px;" ><table border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="padding-top:3px;" class="corners"><!--<a href="#"><img src="/imagenes/btn_megusta.jpg" width="94" height="28" border="0" /></a>-->  <a href="http://twitter.com/#!/vendorepuestos" target="_blank"><img src="/imagenes/btn_twitter.jpg" width="27" height="28" border="0" /></a>  <a href="http://www.facebook.com/vendorepuestos" target="_blank"><img src="/imagenes/btn_face.jpg" border="0" /></a>  <a href="http://www.youtube.com/watch?v=S3WMoIznznI" target="_blank"><img src="/imagenes/btn_youtube.jpg" width="28" height="28" border="0" /></a>  <a href="http://www.vendorepuestos.blogspot.com/" target="_blank"><img src="/imagenes/btn_blog.jpg" alt="" width="28" height="28" border="0" /></a>  <!--<a href="#"><img src="/imagenes/btn_google.jpg" width="43" height="28" border="0" /></a>--></div></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td height="35" colspan="3" background="/imagenes/bg_busca.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <form method="post" onsubmit="return validar_buscar(this);" name="form_bus" id="form_bus">
      <tr>
        <td width="33%" align="right"><select name="categoria_buscar" class="formt2">
          <option value="0">Todas las categor&iacute;as...</option>
          <? $ver_cat = mysql_query("SELECT * FROM categoria ORDER BY id"); while($vc=mysql_fetch_array($ver_cat)){?>
          <option value="<?=$vc["id"]?>"><?=$vc["nombre"];?></option>
          <? }?>
        </select></td>
        <td width="58%" align="right"><input name="palabra" type="text" class="formt"value="" /></td>
        <td width="9%"><input name="button" type="image" id="button" value="Submit" src="/imagenes/btn_busca_dere.jpg" /></td>
      </tr>
      </form>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><img src="/imagenes/div_botonera.jpg" width="960" height="5" /></td>
  </tr>
  <tr>
      <td height="25" colspan="3" background="/imagenes/bg_botonera.jpg" class="menu"  ><!--onmouseout="MM_showHideLayers('submenu','','hide')"-->
    <? 
	$i= 0;
	$ancho = array("-201","190","148","65","270","250");
	$left = array("0","-8","85","160","190","325");
	$ver_cat = mysql_query("SELECT * FROM categoria ORDER BY id"); 
	while($vc=mysql_fetch_array($ver_cat))
	{
		$i++;
		?>
    	<div id="submenu<?=$vc["id"]?>" style="background-color: #FFFFFF;  border-color: #CCCCCC; border-style: solid;   border-width: 1px;  margin-top: 15px; margin-left:<?=$left[$i]?>px; padding: 1px 1px 1px 10px;   position: absolute; visibility: hidden;" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide'); MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')">
		<div  style=" border-color:#CCC; border-width:1px; border-style:solid; border-bottom-width:0px; position:absolute; background-color:#FFF; margin-top:-20px; width:<?=$ancho[$i]-10;?>px;  padding:2px; margin-left: <?=$left[$i]?>px;" onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')">
<a href="/vista_nivel2<?=$link?>/<?=limpiar_cadena($vc["nombre"])?>/<?=$vc["id"]?>/" onclick="MM_showHideLayers('submenu<?=$vc["id"]?>','','show');" onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')"><?=strtoupper($vc["nombre"]);?></a></div>

<table border="0" cellpadding="0" cellspacing="8" onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')"><tbody><tr>
<?
		$sw=0;
		$ver_menu = mysql_query("SELECT * FROM menu WHERE id_categoria='".$vc["id"]."' ORDER BY orden ASC");
		while($vm = mysql_fetch_array($ver_menu))
        {
			$sw+=1;
			if($sw!=3){?>
        	<td><a href="/vista_nivel3/<?=limpiar_cadena($vm["nombre"])?>/<?=$vc["id"]?>/<?=$vm["id"]?>/0/0/1/" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($vc["id"],$vm["id"],0,0);?>)</td>
			<?
			}else{
			?>
       		<td><a href="/vista_nivel3/<?=limpiar_cadena($vm["nombre"])?>/<?=$vc["id"]?>/<?=$vm["id"]?>/0/0/1/" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($vc["id"],$vm["id"],0,0);?>)</td></tr><?  
			$sw = 0;
			}
		}
		?>
        </tbody>
        </table>
       </div>
	<div style="width:<?=$ancho[$i]?>px; float:left"><a href="/vista_nivel2<?=$link?>/<?=limpiar_cadena($vc["nombre"])?>/<?=$vc["id"]?>/" class="link"  onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')"><?=strtoupper($vc["nombre"]);?></a> | </div>  <? }?></td>
  </tr>
  <tr>
    <td height="10" colspan="3" align="right" class="red"></td>
  </tr>
</table>  
</td>
  </tr>
</table>