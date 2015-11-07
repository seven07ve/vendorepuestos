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
                                <td><?php echo 'Bs. '.(((float) $order->getAmount())/100)?></td>
                            </tr>
                            <tr class="facturacion-datos">
                                <th class="vr-table-cell"><label>N&uacute;mero de Art&iacute;culo:</label></td>
                                <td><?php echo str_pad($order->getElementId(), 12, "0", STR_PAD_LEFT)?></td>
                            </tr>
                            <tr class="facturacion-datos">
                                <th class="vr-table-cell"><label>N&uacute;mero de Orden de Pago:</label></td>
                                <td><?php echo str_pad($order->getOrderId(), 12, "0", STR_PAD_LEFT)?></td>
                            </tr>
                        </table>
                        <div class="blue subtitulo_seccion" align="center">
                            Completa los datos en l&iacute;nea para realizar tu pago
                        </div>
                        <form id="pago-form" action="<?php echo url_for('procesarpago',$order) ?>" 
                              method="post" enctype="multipart/form-data" autocomplete="off">
                            <table class="vr-table box-round" width="800" align="center" cellpadding="0" cellspacing="6">
                                <tr align="right">
                                    <td colspan="2" align="left" class="blue gray-gradient vr-table-header">Datos del Pago</td>
                                </tr>
                                <?php if ($sf_user->hasFlash('error')): ?>
                                    <tr class="flash_error" style="font-size:1.25em;font-weight:bold;background:red;color:#FFFFFF">
                                        <td colspan="2"><?php echo $sf_user->getFlash('error') ?></td>
                                    </tr>
                                <?php endif ?>
                                <tr>
                                    <td colspan="2">
                                        <?php echo $form->renderGlobalErrors() ?>
                                    </td>
                                </tr>
                                <?php echo sfOutputEscaper::unescape($form['authorizer_id']->renderRow()) ?>
                                <?php echo $form['customer_name']->renderRow() ?>
                                <?php echo $form['customer_id']->renderRow() ?>
                                <?php echo $form['card_number']->renderRow() ?>
                                <?php echo $form['card_security_code']->renderRow() ?>
                                <?php echo $form['card_expiry_date']->renderRow() ?>
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
    var submitted = false;
    window.onbeforeunload = function() {
        if(!submitted) {
            return 'No ha terminado el pago, seguro que desea cerrar la ventana';
        }
    };
    window.onunload = function() {
        if(!submitted) {
            window.opener.location.href = 'https://pagos.vendorepuestos.com.ve/nofinalizo';

            if ( window.opener.progressWindow ) {
                window.opener.progressWindow.close();
            }
        }
    };
    
    $( document ).idle({
        onIdle: function(){
            alert( 'Se ha detectado una inactividad de 3 minutos, se cerrara esta ventana' );
            
            window.onbeforeunload = true;

            var session = <?php echo isset($_SESSION["userid"]) ? 1 : 0 ?>

            if ( session === 1 ) {
                window.opener.location.href = 'https://vendorepuestos.com.ve/salirTR';
            }
            else {
                window.opener.location.href = 'https://pagos.vendorepuestos.com.ve/nofinalizo';
            }

            window.open('','_self').close();
        },
        // 3 minutos de inactividad
        idle: 180000
    });
    
    document.onkeydown = showDown;

    function showDown(evt) { 
        evt = (evt)? evt : ((event)? event : null); 
            if (evt) { 
                if (event.keyCode == 8 && (event.srcElement.type!= "text" && event.srcElement.type!= "textarea" && event.srcElement.type!= "password")) { 
                // When backspace is pressed but not in form element 
                    cancelKey(evt); 
                } else if (event.keyCode == 116) { 
                    // When F5 is pressed 
                    cancelKey(evt); 
                } else if (event.keyCode == 122) { 
                    // When F11 is pressed 
                    cancelKey(evt); 
                } else if (event.ctrlKey && (event.keyCode == 78 || event.keyCode == 82)) { 
                    // When ctrl is pressed with R or N 
                    cancelKey(evt); 
                } else if (event.altKey && event.keyCode==37 ) { 
                    // stop Alt left cursor 
                    return false; 
                } 
            } 
    }

    function cancelKey(evt) { 
        alert('Funcion no permitida');
        if (evt.preventDefault) { 
            evt.preventDefault(); 
            return false; 
        } else { 
            evt.keyCode = 0; 
            evt.returnValue = false; 
        } 
    }
    $(document).ready(function(){
        $('#pago-form').bValidator();
        $('.submit').click(function(event){
            event.preventDefault();
            $('input[type="submit"]').attr('disabled','disabled');
            if($('#pago-form').data('bValidator').validate()){
                submitted = true;
                $('body').addClass('loading');
                $('#pago-form').submit();
            }
            else {
                $('input[type="submit"]').removeAttr('disabled');
                return false;
            }
        });      
    })
</script>