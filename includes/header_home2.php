<? if($_GET['logout']=="si"){
   session_unset(); session_destroy();
   	echo "<script language=javascript>window.location=\"index.php\";</script>";
}?>
<script language="javascript">
function validar_buscar(forma)
{
	/*if(forma.palabra.value=="")
	{
		alert("Debe ingresar la palabra o frase a buscar");
		forma.palabra.focus();
		return false;
	}*/
	forma.action="resultado.php";
	return true;
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

<div id="top"><div id="t1"><img src="imagenes/box_dere_top.png" width="6" height="21" /></div>
<div id="t2"><a href="#">Vende tu Art&iacute;culo</a> | <a href="tarifas.php">Tarifas</a>  | <a href="directorio.php">Tiendarepuestos</a></div>
<div id="t3"><img src="imagenes/box_izq_top.png" width="6" height="21" /></div></div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="353" height="25" align="right"><table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="508" rowspan="2" align="center"><a href="index.php"><img src="imagenes/img_logo.jpg" width="487" height="70" vspace="10" border="0" /></a></td>
    <td width="99" rowspan="2"><a href="http://www.vendorepuestos.blogspot.com/" target="_blank"><img src="imagenes/img_car.jpg" width="85" height="56" vspace="8" border="0" /></a></td>
    <td style="padding-right:15px" width="353" height="25" align="right" class="red">&nbsp; </td>
  </tr>
  <tr>
    <td style="padding-right:15px;" ><table border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="padding-top:3px;" class="corners"><!--<a href="#"><img src="imagenes/btn_megusta.jpg" width="94" height="28" border="0" /></a>-->  <a href="http://www.twitter/"><img src="imagenes/btn_twitter.jpg" width="27" height="28" border="0" /></a>  <a href="#"><img src="imagenes/btn_face.jpg" border="0" /></a>  <a href="http://www.facebook.com/"><img src="imagenes/btn_youtube.jpg" width="28" height="28" border="0" /></a>  <a href="http://www.vendorepuestos.blogspot.com/" target="_blank"><img src="imagenes/btn_blog.jpg" alt="" width="28" height="28" border="0" /></a>  <!--<a href="#"><img src="imagenes/btn_google.jpg" width="43" height="28" border="0" /></a>--></div></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td height="35" colspan="3" background="imagenes/bg_busca.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <form method="post" onsubmit="return validar_buscar(this);" name="form_bus" id="form_bus">
      <tr>
        <td width="33%" align="right"><select name="categoria_buscar" class="formt2">
          <option value="0">Todas las categor&iacute;as...</option>
          <? $ver_cat = mysql_query("SELECT * FROM categoria ORDER BY id"); while($vc=mysql_fetch_array($ver_cat)){?>
          <option value="<?=$vc["id"]?>"><?=$vc["nombre"];?></option>
          <? }?>
        </select></td>
        <td width="58%" align="right"><input name="palabra" type="text" class="formt"value="" /></td>
        <td width="9%"><input name="button" type="image" id="button" value="Submit" src="imagenes/btn_busca_dere.jpg" /></td>
      </tr>
      </form>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><img src="imagenes/div_botonera.jpg" width="960" height="5" /></td>
  </tr>
  <tr>
    <td height="25" colspan="3" background="imagenes/bg_botonera.jpg" class="menu"  ><!--onmouseout="MM_showHideLayers('submenu','','hide')"-->
    <? 
	$i= 0;
	$ancho = array("-201","190","148","65","270","250");
	$left = array("0","-8","85","160","190","325");
	$ver_cat = mysql_query("SELECT * FROM categoria ORDER BY id"); 
	while($vc=mysql_fetch_array($ver_cat))
	{
		$i++;
		if($vc["presentacion"]==2) $link = "_full"; else $link = "";
		?>
    	<div id="submenu<?=$vc["id"]?>" style="background-color: #FFFFFF;  border-color: #CCCCCC; border-style: solid;   border-width: 1px;  margin-top: 15px; margin-left:<?=$left[$i]?>px; padding: 1px 1px 1px 10px;   position: absolute; visibility: hidden;" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide'); MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')">
		<div  style=" border-color:#CCC; border-width:1px; border-style:solid; border-bottom-width:0px; position:absolute; background-color:#FFF; margin-top:-20px; width:<?=$ancho[$i]-10;?>px;  padding:2px; margin-left: <?=$left[$i]?>px;" onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')">
<a href="nivel_2<?=$link?>.php?idc=<?=$vc["id"]?>" onclick="MM_showHideLayers('submenu<?=$vc["id"]?>','','show');" onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')"><?=strtoupper($vc["nombre"]);?></a></div>

<table border="0" cellpadding="0" cellspacing="8" onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')"><tbody><tr>
<?
		$sw=0;
		$ver_menu = mysql_query("SELECT * FROM menu WHERE id_categoria='".$vc["id"]."' ORDER BY orden ASC");
		while($vm = mysql_fetch_array($ver_menu))
        {
			$sw+=1;
			if($sw!=3){?>
        	<td><a href="nivel_3.php?idc=<?=$vc["id"]?>&idm=<?=$vm["id"]?>&idsm=0" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($vc["id"],$vm["id"],0,0);?>)</td>
			<?
			}else{
			?>
       		<td><a href="nivel_3.php?idc=<?=$vc["id"]?>&idm=<?=$vm["id"]?>&idsm=0" class="bluep"><?=$vm["nombre"]?></a> (<?=cuantos_productos_categoria($vc["id"],$vm["id"],0,0);?>)</td></tr><?  
			$sw = 0;
			}
		}
		?>
        </tbody>
        </table>
       </div>
	<div style="width:<?=$ancho[$i]?>px; float:left"><a href="nivel_2.php?idc=<?=$vc["id"]?>" class="link"  onmouseover="MM_showHideLayers('submenu<?=$vc["id"]?>','','show')" onmouseout="MM_showHideLayers('submenu<?=$vc["id"]?>','','hide')"><?=strtoupper($vc["nombre"]);?></a> | </div>  <? }?></td>
  </tr>
  <tr>
    <td height="10" colspan="3" align="right" class="red"></td>
  </tr>
</table>  
</td>
  </tr>
</table>
