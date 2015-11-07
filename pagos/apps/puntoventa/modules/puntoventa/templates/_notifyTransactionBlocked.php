<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<img src="http://vendorepuestos.com.mx/imagenes/img_logo.jpg" width="487" height="70" border="0">
<h1 style="color:FF0000" align="left">Su pago no ha podido ser procesado</h1>
<p>
    Se ha superado el limite de intentos con errores permitidos por el sistema
    del banco. Su orden de pago ha sido bloqueada.
</p>
<p>
    Deber&aacute; iniciar nuevamente el proceso de pago.
</p>
<p>
    No se le ha realizado ningun cargo a su tarjeta de credito.
</p>
<br>
<h2>Datos de la orden de pago</h2>
<ul>
    <li>%ELEM_TYPE%: %ELEM_ID%</li>
    <li>Numero de orden de pago: %ORDER_ID%</li>
    <li>Monto a pagar: %AMOUNT%</li>
</ul>
<p>
    Gracias por anunciar con nosotros.
</p>
<br>
<p>Cualquier consulta que desee realizar puede hacer a trav&eacute;s de los siguientes correos electr&oacute;nicos:</p>
<ul style="list-style-type: none; padding:0; margin:0;">
    <li>Administración <a href="mailto:administracion@vendorepuestos.com.mx">administracion@vendorepuestos.com.mx</a></li>
    <li>Centro de Seguridad <a href="mailto:centrodeseguridad@ventarepuestos.com.ve">centrodeseguridad@ventarepuestos.com.ve</a></li>
    <li>Otras solicitudes <a href="mailto:contacto@ventaderepuestos.com.ve">contacto@ventaderepuestos.com.ve</a></li>
</ul>
EOM
, array(
        "%ELEM_TYPE%" => strcasecmp($element_type,'product') == 0 ? 'Producto' : 'Tienda Virtual',
        "%ELEM_ID%"   => $element,
        "%ORDER_ID%"  => $order,
        "%AMOUNT%"    => (float)($amount/100),
    )
) ?>
