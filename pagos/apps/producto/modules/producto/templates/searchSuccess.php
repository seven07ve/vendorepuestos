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
                            Buscar Art&iacute;culos Activos
                        </div>
                        <form id="search-form" action="<?php echo url_for('producto_search') ?>" method="post" enctype="multipart/form-data">
                            <table class="vr-table box-round" width="800" align="center" cellpadding="0" cellspacing="6">
                                <tr align="right">
                                    <td colspan="2" align="left" class="blue gray-gradient vr-table-header">Buscar Producto</td>
                                </tr>
                                <?php echo $form ?>
                                <tr>
                                    <td colspan="2"><input class="submit" type="submit" value="Buscar"></td> 
                                </tr>
                            </table>
                        </form> 
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php if (isset($productos) && $productos->count()) :?>
        <tr>
            <td valign="top" style="padding-top:15px">
                <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                    <tr>
                        <td>
                            <div class="titulo_seccion" align="center" style="height:30px">
                                Art&iacute;culos Encontrados
                            </div> 
                        </td>
                    </tr>
                    <?php foreach ($productos as $key => $producto) : ?>
                        <tr class="product-list-item">
                            <td>
                                <table width="100%" style="text-align:left">
                                    <tbody>
                                        <tr>
                                            <td rowspan="2" class="product-list-image">
                                                <a class="box-round">
                                                    <img src="<?php echo sfConfig::get('app_serverhost')?>/productos/<?php echo $producto->getFoto1() ?>" alt="test" width="145" height="108" border="0" class="captify" style="border: 0px none; margin: 0px;">
                                                </a>                                              
                                            </td>
                                            <th colspan="4" style="font-size:1.5em"><?php echo $producto->getTitulo() ?></th>
                                        </tr>
                                        <tr>
                                            <td>Fecha de publicaci&oacute;n: <?php echo $producto->getDateTimeObject('fecha_publicacion')->format('d/m/Y') ?></td>
                                            <td>Fecha de vencimiento: <?php echo $producto->getDateTimeObject('vence')->format('d/m/Y') ?></td>
                                            <td>Precio: <?php echo $producto->getPrecio() ?></td>
                                            <td><a href="<?php echo url_for('producto_password',$producto) ?>">Modificar Art&iacute;culo</a></td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    <?php endif; ?>
</table>
<script type="text/javascript">
    function validateregex(str) {
        var regx = /^(V|J)-[0-9]+$/;
        return str.match(regx); 
    }
    
    $(document).ready(function(){
        $('#search-form').bValidator();
        $('.submit').click(function(event){
            event.preventDefault();
            $('input[type="submit"]').attr('disabled','disabled');
            if($('#search-form').data('bValidator').validate()){
                $('#search-form').submit();
            }
            else {
                $('input[type="submit"]').removeAttr('disabled');
                return false;
            }
        });      
    })
</script>