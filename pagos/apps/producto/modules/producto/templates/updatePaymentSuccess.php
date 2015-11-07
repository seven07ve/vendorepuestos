<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top">
            <table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="112">
                        <a href="<?php echo sfConfig::get('app_serverhost') ?>/vendeTR/">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/login_btn_8_off.jpg" name="edo" width="112" height="20" border="0" id="edo" />
                        </a>
                    </td>
                    <td width="137">
                        <a href="<?php echo url_for('producto_search') ?>" >
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/login_btn_9_on.jpg" name="datos" width="137" height="20" border="0" id="datos" />
                        </a>
                    </td>
                    <td width="118">
                        <a href="<?php echo sfConfig::get('app_serverhost') ?>/notificaTR/0">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/login_btn_10_off.jpg" name="pub" width="118" height="20" border="0" id="pub" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td height="8" colspan="3" background="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/login_bg_bot.jpg"></td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3" align="center">
                        <span class="titulo_seccion">
                            Su modificaci&oacute;n se ha registrado Satisfactoriamente.
                        </span>
                        <br /><br />
                        <span class="titulo_seccion">
                            Para proceder a la publicaci&oacute;n, deber&aacute; efectuar el pago correspondiente a la diferencia por el aumento del precio de su publicaci&oacute;n. Informaci&oacute;n enviada a su correo electr&oacute;nico.
                        </span>
                        <br /><br />
                        <span class="red">
                            Deseo pagar por mi publicaci&oacute;n
                            <br />
                            Monto Bs.<?php echo $monto ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="<?php echo sfConfig::get('app_serverhost') ?>/centro_pagos/">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/boton_transferencia.png" width="220px" border="0" />
                        </a>
                    </td>
                    <td align="center">
                        <a id="launcher" onclick="openPOSWindow('<?php echo $url ?>'); return false;" href="#">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/boton_tarjeta.png" width="220px" border="0" />
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script type="text/javascript">
    function openPOSWindow(url){
        window.open(url,'Punto de pago','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=1000,height=700');
        window.location = "http://pagos.vendorepuestos.com.mx/comprando"
    } 
</script>