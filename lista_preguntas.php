<? 
include("conexion.php");
session_start();
include("funciones.php");

if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }
$id = $_SESSION["userid"];
$ver_tienda = mysql_query("SELECT * FROM tienda_virtual WHERE id='$id'");
$vt = mysql_fetch_array($ver_tienda);
$carpeta = limpiar_cadena($vt["razon_social"]);
$nombretr = limpiar_cadena($vt["nombre_oficial"]);

/*perguntas al vendedor*/
	$_pagi_sql = "SELECT * FROM productos, preguntas WHERE productos.id_usuario_tienda = $id AND preguntas.id_producto=productos.id AND preguntas.status < 2 ORDER BY preguntas.id_preg DESC";
	$_pagi_cuantos= 10;
	include("paginar6.inc.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/over-text/sample.css" />
	<script type="text/javascript" src="/over-text/jquery.js"></script>
	<script type="text/javascript" src="/over-text/captify.tiny.js"></script>
	<!--para las respuestas-->
	<!--<script type="text/javascript" src="/js/preguntas.js"></script>-->
	<script type="text/javascript" src="/js/respuestas.js" ></script>
	<script type="text/javascript">
	$(function(){
		$('img.captify').captify({});
	});
	</script>
  <!-- validar busqueda -->
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
function activar_oferta(id)
{
		window.location.href="/articulos_oferta/<?=$carpeta?>/1/"+id;	
}
</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<body>
<?php include("includes/header_home.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
          <td height="30" colspan="4" class="titulo_ruta"><?=$nombretr?> > Mi Cuenta > Productos Activos</td>
          <td align="right" colspan="3"><? 
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
          <td width="143"><a href="/datos_vendedor/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_3_off.jpg" name="datos" width="143" height="20" border="0" /></a></td>
          <td width="192"><a href="/publicaciones/<?=limpiar_cadena($nombretr)?>"><img src="/imagenes/login_btn_4_off.jpg" name="pub" width="192" height="20" border="0" /></a></td>
          <td width="141"><a href="/articulos_activos/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_5_off.jpg" name="act" width="141" height="20" border="0" /></a></td>
          <td width="171"><a href="/articulos_finalizados/<?=limpiar_cadena($nombretr)?>/1"><img src="/imagenes/login_btn_6_off.jpg" name="fin" width="171" height="20" border="0" /></a></td>
        </tr>
        
      </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="625" colspan="3" valign="top">
       <table width="100%" border="0" align="right" cellpadding="3" cellspacing="0">
  <tr>
	<?php echo preguntasLista($_SESSION["userid"]); ?>
    <td colspan="4"  class="titulo_seccion" style="text-align:right;"></td>
    </tr>
  <tr height="25" background="/imagenes/bg_botonera.jpg" class="menu">
    <td width="154" class="link">FOTO</td>
    <td width="210" class="link">DESCRIPCI&Oacute;N</td>
    <td width="550">PREGUNTA</td>
  </tr>
    </table>
      <div class="titulo_categoria" style="padding-bottom:10px; clear:both;"></div>
      <?
	$cont = 1;
	while($vpt = mysql_fetch_array($_pagi_result))
	{
			$carpeta_productos = cual_nombre_carpeta($_SESSION["userid"])."/productos";
    ?>
		<div id="producto<?php echo $cont; ?>" style="width:960px; height:auto; border-radius: 10px;border: 1px solid #D3D3D3; margin:0 0 5px 0; padding:8px;">
        <div style="width:360px; float:left;">
          <a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>"><img src="/<?=$carpeta_productos?>/<?=$vpt["foto1"]?>" width="125" height="88" hspace="5" vspace="5" border="0" align="left" /></a><span class="blue"><a href="/articulo/<?=limpiar_cadena($vpt["titulo"])?>/<?=$vpt["id"]?>" class="blue"><?=$vpt["titulo"]?></a></span><br />
          <?php echo $vpt["subtitulo"].'<br>Precio: '.$vpt["precio"]; ?></div>
          <!--pregunta-->
        <div style="width:600px; float:left;">
			<div id="cont-preg-resp<?php echo $cont; ?>" class="cont-preg-resp">
				<div class="preg">
                		<img src="/imagenes/ico-pregunta.jpg" width="20" height="20" hspace="5"/>
						<?php echo $vpt["pregunta"]; ?>
                	</div>
			</div>
			<!--boton respuesta-->
			<input type="button" id="btnresp_<?php echo $cont; ?>" class="form" value="Responder" style="float:right; margin-right: 10px;">
			<!--formulario para responder-->
			<div id="cont-form<?php echo $cont; ?>" class="cont-form" style="display:none;">
				<form action="" method="post" name="form-consulta" id="form-consulta">
					<input id="id-prod<?php echo $cont; ?>" name="id-prod<?php echo $cont; ?>" type="hidden" value="<?php echo $vpt["id_producto"] ?>">
					<input id="id-preg<?php echo $cont; ?>" name="id-preg<?php echo $cont; ?>" type="hidden" value="<?php echo $vpt["id_preg"] ?>">
					<input id="email<?php echo $cont; ?>" name="email<?php echo $cont; ?>" type="hidden" value="<?php echo $vpt["email"] ?>">
					<textarea name="respuesta<?php echo $cont; ?>" id="respuesta<?php echo $cont; ?>" class="form" placeholder="Responder la pregunta"></textarea>
					<span id="msjrespuesta<?php echo $cont; ?>"></span>
					<input type="button" class="form" id="responder_<?php echo $cont; ?>" name="responder_<?php echo $cont; ?>" value="Responder" style="margin-top:5px;"/><img src="/imagenes/cargando3.gif" id="mini-cargando<?php echo $cont; ?>" class="mini-loading" /><span style="margin-left:5px;">No uses lenguaje vulgar. Por tu seguridad no ingreses datos personales en tu respuesta.</span>
				</form>
			</div>
        </div><br clear="all">
        </div>
      <?php
		$cont++;
		}
		?>
    </td>
  </tr>
  <tr>
    <td valign="top" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e1e1e1">
      <form name="form_pag" action="" method="post">
        <tr>
          <td width="200" class="pag">P&aacute;g <?=$_pagi_actual;?> de <?=$_pagi_totalPags?></td>
          <td align="center" class="pag"><?=$_pagi_navegacion?></td>
          <td width="100" align="right">Ir a la p&aacute;gina:&nbsp;</td>
          <td width="50" align="right"><input name="pg" type="text" class="formpag" size="3" /></td>
          <td width="30" align="right"><input name="input" type="image" src="/imagenes/btn_ir.jpg" /></td>
          </tr>
        </form>
</table></td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
<script>
/*	$(document).ready(function() {
		$("input").click(function(event) {

		});
	});*/
</script>
</body>
</html>
