<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<img src="http://vendorepuestos.com.mx/imagenes/img_logo.jpg" width="487" height="70" border="0">
<h1 style="color:#0139D1" align="left">Hemos recibido su pago</h1>
<p>
    Su pago ha sido procesado y autorizado por su banco
</p>
<h2>Datos de la orden de pago</h2>
<ul>
    <li>%ELEM_TYPE%: %ELEM_ID%</li>
    <li>Acci&oacute;n: %SYS_ACT%</li>
    <li>Numero de orden de pago: %ORDER_ID%</li>
    <li>Monto cancelado: Bs. %AMOUNT%</li>
    <li>Fecha de culminaci&oacute;n del proceso: %DATE%</li>
</ul>
<h2>Recibo emitido por su entidad bancaria:</h2>
<p>
    %RECEIPT%
</p>
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
        "%SYS_ACT%"   => strcasecmp($act,'new') == 0 ? 'Nuevo' : 'Modificaci&oacute;n',
        "%ORDER_ID%"  => $order,
        "%AMOUNT%"    => (float)($amount/100),
        "%DATE%"      => $date,
        "%RECEIPT%"   => $receipt
    )
) ?>
