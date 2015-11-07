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
                            Ingrese su contrase&ntilde;a para modificar el art&iacute;culo:
                            <br>
                            "<?php echo $producto->getTitulo() ?>"
                        </div>
                        <form id="authentication-form" action="<?php echo url_for('producto_password',$producto) ?>" method="post" enctype="multipart/form-data">
                            <table class="vr-table box-round" width="800" align="center" cellpadding="0" cellspacing="6">
                                <tr align="right">
                                    <td colspan="2" align="left" class="blue gray-gradient vr-table-header">Contrase&ntilde;a de modficaci&oacute;n</td>
                                </tr>
                                <?php echo $form ?>
                                <tr>
                                    <td colspan="2"><input class="submit" type="submit" value="Verificar"></td> 
                                </tr>
                            </table>
                        </form> 
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script type="text/javascript">    
    $(document).ready(function(){
        $('#authentication-form').bValidator();
        $('.submit').click(function(event){
            event.preventDefault();
            $('input[type="submit"]').attr('disabled','disabled');
            if($('#authentication-form').data('bValidator').validate()){
                $('#authentication-form').submit();
            }
            else {
                $('input[type="submit"]').removeAttr('disabled');
                return false;
            }
        });      
    })
</script>