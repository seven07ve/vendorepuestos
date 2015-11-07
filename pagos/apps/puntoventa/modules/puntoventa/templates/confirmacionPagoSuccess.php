<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top">
            <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                <tr>
                    <td height="150">
                        <div class="titulo_seccion" align="center" style="height:40px;">
                            Confirmaci&oacute;n de Pago
                        </div>
                        <div class="titulo_seccion" align="center" style="height:110px;">
                            <img src="<?php echo sfConfig::get('app_serverhost') ?>/imagenes/check_mark_icon.jpg"
                                 width="75px" height="75px" alt="Check"/>
                            <p>
                                Tu pago ha sido realizado exitosamente
                            </p>
                        </div>
                        <div class="subtitulo_seccion" align="center" style="height:40px;">
                            <?php if ($articulo) : ?>
                                Haz clic <a class="opener" href="<?php echo $url ?>">aqu&iacute;</a> para ver tu art&iacute;culo:<br>
                                <a class="opener" href="<?php echo $url ?>"><?php echo $url ?></a>
                            <?php endif; ?>
                            <?php if ($tienda) : ?>
                                Haz clic <a class="opener" href="<?php echo $url ?>">aqu&iacute;</a> para ver tu tienda:<br>
                                <a class="opener" href="<?php echo $url ?>"><?php echo $url ?></a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<script type="text/javascript">
    
    $(document).ready(function(){ 
        window.onunload = function() {
            window.opener.location.href = $(".opener").attr('href');;

            if ( window.opener.progressWindow ) {
                window.opener.progressWindow.close()
            }
        };
        $(".opener").click(function(){
            window.opener.location.href = $(this).attr('href');

            if ( window.opener.progressWindow ) {
                window.opener.progressWindow.close()
            }
            window.close();
        });
    });
</script>