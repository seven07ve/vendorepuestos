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
<div>El Cliente Premium o Cliente Premium Certificado puede ser una persona natural o jur�dica  que desea publicar uno o m�s art�culos.  La duraci�n de una publicaci�n es por 90 d�as y el pago es calculado de acuerdo al rango de precio. (ej. 1 art�culo con un precio de venta de Bs 9.000 tendr� un costo de publicaci�n de Bs  90, seg�n la tabla abajo descrita) 
<br /><br /></div>
<div><a href="/vendeTR/">Vende Tu Art�culo</a><br /></div>
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
            <div>El cliente TIENDAREPUESTOS, es una persona natural o jur�dica que publica art�culos masivamente. Cada paquete de publicaciones est� compuesto por 50 art�culos con una duraci�n de 30 d�as.<br /><br /> </div>
<div><a href="/tiendarepuestos/all/1/">�Quieres una TIENDAREPUESTOS?</a></div>
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
      <div>Conociendo la modalidad entre Clientes Premium y Cliente TIENDAREPUESTOS sugerimos analizar cual es la opci�n mas beneficiosa como cliente.<br />
        <br /> 
 
Cada publicaci�n consta de los siguientes elementos:<br /><br />
<ul>
<li>T�tulo: El mismo tendr� una capacidad de 75 caracteres, el cual podr� establecerlo  seg�n el criterio deseado.</li>
<li>Subt�tulo: Con una longitud similar, ser� parte de la publicaci�n del art�culo.</li>
<li>Fotograf�as: Cada publicaci�n puede contener desde 1 hasta 3 im�genes, las cuales deben reflejar la condici�n real del producto en venta. </li>
<li>Descripci�n: El Cliente podr� hacer uso de esta secci�n para detallar libremente las caracter�scticas del art�culo. Se acepta dentro de la misma cualquier tipo de informaci�n , exceptuando contenidos no aptos con las buenas costumbres ni aquellos que por razones de ley, no este permitido. </li>
<li>Informaci�n de Contacto: A trav�s del registro, el cliente colocar� la informaci�n por el medio del cual desea ser contactado, la cual se har� visible tanto en la Ventana de Descripci�n del Producto, como en los Datos de la Empresa, para el caso de la TIENDAREPUESTOS.</li>
<li>Medios de Pago: El cliente podr� sugerir los medios de pago que prefiere, donde tambi�n podr� seleccionar las instituciones financieras de su preferencia.</li>
<li>Medios de Env�o: El Cliente podr� seleccionar el medio de env�o mas conveniente e inclusive la opci�n de retirar personalmente.</li>
<li>Redes Sociales: Cada vendedor o comprador podr� compartir los art�culos publicados a trav�s de las redes sociales. </li>
</ul>
Dentro de los <a href="/terminos_condiciones/">T�rminos y Condiciones</a>, se contempla que El Cliente puede editar la publicaci�n de un art�culo, en la secci�n Vende tu Articulo o en el m�dulo interno de TIENDAREPUESTOS. El costo de publicaci�n se modificar� para Clientes Premium s�lo si el mismo ha sido elevado a un Rango de Precio mas elevado. Vendorepuestos.com.ve no har� cr�dito alguno por modificaciones a Rangos de Precio Inferior.<br /><br />

<a href="/inicio/">Vendorepuestos.com.ve</a> alistar� los art�culos de acuerdo al rango de precio, siendo el de mayor rango de precio, el primero en mostrarse en el listado de productos.

</div>

    </td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
