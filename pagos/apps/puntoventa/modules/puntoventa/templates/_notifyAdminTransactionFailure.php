<?php use_helper('I18N', 'Url') ?>
<?php echo __(<<<EOM
<img src="https://vendorepuestos.com.ve/imagenes/img_logo.jpg" width="487" height="70" border="0">
<h1 style="color:FF0000" align="left">Ha ocurrido un fallo al intentar procesar un pago</h1>
<h2>Datos de la orden de pago</h2>
<ul>
    <li>C&eacute;dula del usuario: %CUSTOMER_ID%</li>
    <li>Correo del usuario: %CUSTOMER_EMAIL%</li>
    <li>%ELEM_TYPE%: %ELEM_ID%</li>
    <li>Acci&oacute;n: %ACT%</li>
    <li>Numero de orden de pago: %ORDER_ID%</li>
    <li>Estado de la orden: %ORDER_STATUS%</li>
    <li>Estado de la transacci&oacute;n: %TRANSACTION_STATUS%</li>
    <li>NIT de la transacci&oacute;n: %NIT%</li>
    <li>Monto a pagar: %AMOUNT%</li>
</ul>
<p>
    Por favor, contactar a este usuario a la brevedad posible
</p>
EOM
, array(
        "%CUSTOMER_ID%"         => $customer_id,
        "%CUSTOMER_EMAIL%"      => $customer_email,
        "%ELEM_TYPE%"           => strcasecmp($element_type,'product') == 0 ? 'Producto' : 'Tienda Virtual',
        "%ELEM_ID%"             => $element,
        "%ACT%"                 => $act,
        "%ORDER_ID%"            => $order,
        "%ORDER_STATUS%"        => $order_status,
        "%NIT%"                 => $order_nit,
        "%TRANSACTION_STATUS%"  => $order_nit,
        "%AMOUNT%"              => (float)($amount/100)
    )
) ?>
