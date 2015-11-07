<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top">
            <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                <tr>
                    <td height="150">
                        <div class="titulo_seccion" align="center" style="height:40px;">
                            Pago con Tarjeta de Credito
                        </div>
                        <table id="facturacion" class="vr-table box-round" width="800" align="center" cellpadding="0" cellspacing="6">
                            <tr align="right">
                                <th colspan="2" align="left" class="blue gray-gradient vr-table-header">Datos de facturaci&oacute;n</th>
                            </tr>
                            <tr class="facturacion-datos">
                                <th class="vr-table-cell"><label>Monto:</label></td>
                                <td><?php echo 'Bs. '.$monto?></td>
                            </tr>
                            <tr class="facturacion-datos">
                                <th class="vr-table-cell"><label>N&uacute;mero de Art&iacute;culo:</label></td>
                                <td><?php echo str_pad($paquete, 9, "0", STR_PAD_LEFT)?></td>
                            </tr>
                        </table>
                        <div class="blue subtitulo_seccion" align="center">
                            Completa los datos en l&iacute;nea para realizar tu pago
                        </div>
                        <form id="pago-form" action="<?php echo url_for('procesarpago') ?>" method="post" enctype="multipart/form-data">
                            <table class="vr-table box-round" width="800" align="center" cellpadding="0" cellspacing="6">
                                <tr align="right">
                                    <td colspan="2" align="left" class="blue gray-gradient vr-table-header">Datos del Pago</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <?php echo $form->renderGlobalErrors() ?>
                                    </td>
                                </tr>
                                <?php echo sfOutputEscaper::unescape($form['tipo_tdc']->renderRow()) ?>
                                <?php echo $form['vence']->renderRow() ?>
                                <?php echo $form['tdc']->renderRow() ?>
                                <?php echo $form['banco']->renderRow() ?>
                                <?php echo $form['cedula']->renderRow() ?>
                                <?php echo $form->renderHiddenFields() ?>
                                <tr>
                                    <td colspan="2"><input class="submit" type="submit" value="Pagar"></td> 
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
        $('#pago-form').bValidator();
        $('.submit').click(function(event){
            event.preventDefault();
            if($('#pago-form').data('bValidator').validate()){
                $('#pago-form').submit();
            }
            else {
                return false;
            }
        });      
    })
</script>