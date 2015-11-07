<table width="960" border="0" align="center" cellpadding="10" cellspacing="0">
    <tr>
        <td valign="top">
            <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                <tr>
                    <td height="150">
                        <div class="titulo_seccion" align="center" style="height:40px;">
                            Informaci&oacute;n sobre pago
                        </div>
                        <div class="titulo_seccion" align="center">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/error_mark_icon.png"
                                     width="75px" height="75px" alt="Check"/>
                            <div style="margin:10px">Pago negado por el banco.</div>
                            <div style="margin:10px">A continuaci&oacute;n el mensaje que ha retornado el banco:</div>
                            <div style="margin:10px">"<?php echo $order->getMessage(); ?>"</div>
                            <div style="margin:10px">Si desea volver a intentar por favor haga click 
                                <a href="<?php echo url_for('crear_orden_pago') . '?' . $params_raw ?>">aqu&iacute;</a>
                            </div> 
                            <div style="font-size: 80%">En caso de alguna duda comun&iacute;quese con vendoadmin@vendorepuestos.com.ve.</div> 
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>