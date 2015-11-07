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
            <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                <tr>
                    <td height="150">
                        <div class="titulo_seccion" align="center" style="height:40px;">
                            Confirmaci&oacute;n de Modificaci&oacute;n de Producto
                        </div>
                        <div class="titulo_seccion" align="center" style="height:110px;">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/check_mark_icon.jpg"
                                     width="75px" height="75px" alt="Check"/>
                            <p>
                                Tu producto ha sido modificado exitosamente
                            </p>
                        </div>
                        <div class="subtitulo_seccion" align="center" style="height:40px;">
                            Haz clic <a href="<?php echo $url ?>">aqu&iacute;</a> para ver tu producto:<br>
                            <a href="<?php echo $url ?>"><?php echo $url ?></a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>