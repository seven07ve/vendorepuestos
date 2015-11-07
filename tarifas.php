<? 
include("conexion.php");
session_start();
include("funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <div class="titulo_categoria" style="height:30px;">Tarifas</div>
      <p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>
<!-- <div class="titulo_seccion" style="height:30px;">Cliente Premium</div>
<div>El Cliente Premium o Cliente Premium Certificado puede ser una persona natural o jurídica  que desea publicar uno o más artículos.  La duración de una publicación es por 90 días y el pago es calculado de acuerdo al rango de precio. (ej. 1 artículo con un precio de venta de Bs 9.000 tendrá un costo de publicación de Bs  90, según la tabla abajo descrita) 
<br /><br /></div>
<div><a href="/vendeTR/">Vende Tu Artículo</a><br /></div>
      <table width="50%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#333333">
              <tr class="gold">
                <td width="35%">Rango de Precio</td>
                <td width="16%">Costo (Bs.)</td>
                <td width="21%">Duraci&oacute;n (D&iacute;as)</td>
              </tr> 
        <?php
/*      $ver_tarifa = mysql_query("SELECT * FROM tarifas WHERE tipo='persona' ORDER BY total_bs ASC");
      while($vt = mysql_fetch_array($ver_tarifa))
          {
            */
?>
        <tr class="link">
                    <td bgcolor="#FFFFFF"><?=$vt["nombre"];?></td>
                    <td bgcolor="#FFFFFF"><?=$vt["total_bs"];?></td>
                    <td bgcolor="#FFFFFF"><?=$vt["duracion_dias"];?></td>
                  </tr>
                  <?php// }?>
                </table><p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p> -->
                <div class="titulo_seccion" style="height:30px;">Cliente TIENDAREPUESTOS</div>
            <div>El cliente TIENDAREPUESTOS, es una persona natural o jurídica que publica artículos masivamente. Cada paquete de publicaciones está compuesto por 50 artículos con una duración de 30 días.<br /><br /> </div>
<div><a href="/tiendarepuestos/all/1/">¿Quieres una TIENDAREPUESTOS?</a></div>
          <br /><br />
                <table width="50%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#333333">
              <tr class="gold">
                <td width="35%">Tarifa Plana</td>
                <td width="16%">Costo (Bs.)</td>
                <td width="28%">Art&iacute;culos</td>
                <td width="21%">Duraci&oacute;n (D&iacute;as)</td>
              </tr> 
  	<?
			$ver_tarifa = mysql_query("SELECT * FROM tarifas WHERE tipo='tienda' ORDER BY total_bs ASC");
			while($vt = mysql_fetch_array($ver_tarifa))
        	{?>
			  <tr class="link">
                    <td bgcolor="#FFFFFF"><?=$vt["nombre"];?></td>
                    <td bgcolor="#FFFFFF"><?=$vt["total_bs"];?></td>
                    <td bgcolor="#FFFFFF"><?=$vt["cantidad_productos"];?></td>
                    <td bgcolor="#FFFFFF"><?=$vt["duracion_dias"];?></td>
                  </tr>
                  <? }?>
      </table>
      <p><img src="/imagenes/div_bot.jpg" alt="" width="937" height="2" /></p>      
      <div>Conociendo la modalidad entre Clientes Premium y Cliente TIENDAREPUESTOS sugerimos analizar cual es la opción mas beneficiosa como cliente.<br />
        <br /> 
 
Cada publicación consta de los siguientes elementos:<br /><br />
<ul>
<li>Título: El mismo tendrá una capacidad de 75 caracteres, el cual podrá establecerlo  según el criterio deseado.</li>
<li>Subtítulo: Con una longitud similar, será parte de la publicación del artículo.</li>
<li>Fotografías: Cada publicación puede contener desde 1 hasta 3 imágenes, las cuales deben reflejar la condición real del producto en venta. </li>
<li>Descripción: El Cliente podrá hacer uso de esta sección para detallar libremente las caracteríscticas del artículo. Se acepta dentro de la misma cualquier tipo de información , exceptuando contenidos no aptos con las buenas costumbres ni aquellos que por razones de ley, no este permitido. </li>
<li>Información de Contacto: A través del registro, el cliente colocará la información por el medio del cual desea ser contactado, la cual se hará visible tanto en la Ventana de Descripción del Producto, como en los Datos de la Empresa, para el caso de la TIENDAREPUESTOS.</li>
<li>Medios de Pago: El cliente podrá sugerir los medios de pago que prefiere, donde también podrá seleccionar las instituciones financieras de su preferencia.</li>
<li>Medios de Envío: El Cliente podrá seleccionar el medio de envío mas conveniente e inclusive la opción de retirar personalmente.</li>
<li>Redes Sociales: Cada vendedor o comprador podrá compartir los artículos publicados a través de las redes sociales. </li>
</ul>
Dentro de los <a href="/terminos_condiciones/">Términos y Condiciones</a>, se contempla que El Cliente puede editar la publicación de un artículo, en la sección Vende tu Articulo o en el módulo interno de TIENDAREPUESTOS. El costo de publicación se modificará para Clientes Premium sólo si el mismo ha sido elevado a un Rango de Precio mas elevado. Vendorepuestos.com.ve no hará crédito alguno por modificaciones a Rangos de Precio Inferior.<br /><br />

<a href="/inicio/">Vendorepuestos.com.ve</a> alistará los artículos de acuerdo al rango de precio, siendo el de mayor rango de precio, el primero en mostrarse en el listado de productos.

</div>

    </td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
