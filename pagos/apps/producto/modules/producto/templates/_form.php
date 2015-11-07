<form id="producto-form" 
    action="<?php echo $form->getObject()->isNew() ? url_for('producto_create') : url_for('producto_update', $form->getObject()) ?>" 
    method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <tr>
        <td valign="top">
            <table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <?php echo $form->renderHiddenFields() ?>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr align="right">
                        <td colspan="4" align="left" class="blue">Datos del Vendedor</td>
                    </tr>
                    <?php foreach ($form['usuario'] as $key => $field) : ?>
                        <?php echo $field->renderRow() ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table width="800" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
                <tbody>
                    <tr align="right">
                        <td colspan="4" align="left" class="blue">Datos del Art&iacute;culo</td>
                    </tr>
                    <?php echo $form->renderGlobalErrors() ?>
                    <tr>
                        <?php echo $form['titulo']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['subtitulo']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['descripcion']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['foto1']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['foto2']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['foto3']->renderRow() ?>
                    </tr>
                    <tr>
                        <td colspan="2"><b><i>Nota: Las fotograf&iacute;as no son propiedad de vendorepuesto.com.ve</i></b></td>
                    </tr>
                    <tr>
                        <?php echo $form['id_estado']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['id_ciudad']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['condicion']->renderRow() ?>
                    </tr>
                    <tr>
                        <?php echo $form['precio']->renderRow() ?>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="submit" type="submit" value="Modificar" /></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</form>
<script type="text/javascript">
    function validateregex(str) {
        alert('ESTE ES EL STRING: '+str);
        var regx = /^(V|J)-[0-9]+$/;
        return false;
        //return str.match(regx); 
    }
    
    $(document).ready(function(){
        $('#usuario_estado').change(function(){
            $.getJSON('<?php echo url_for('populate_cities') ?>',{value: $(this).val(), ajax: 'true'}, function(jsonData){
                var options = '';
                for (var i = 0; i < jsonData.length; i++) {
                    options += '<option value="' + jsonData[i].optionValue + '">' + jsonData[i].optionDisplay + '</option>';
                }
                $("#usuario_ciudad").html(options);
            })
        })
        $('#producto_estado').change(function(){
            $.getJSON('<?php echo url_for('populate_cities') ?>',{value: $(this).val(), ajax: 'true'}, function(jsonData){
                var options = '';
                for (var i = 0; i < jsonData.length; i++) {
                    options += '<option value="' + jsonData[i].optionValue + '">' + jsonData[i].optionDisplay + '</option>';
                }
                $("#producto_ciudad").html(options);
            })
        })
        
        $('#producto-form').bValidator();
        $('.submit').click(function(event){
            event.preventDefault();
            $('input[type="submit"]').attr('disabled','disabled');
            if($('#producto-form').data('bValidator').validate()){
                $('#producto-form').submit();
            }
            else {
                $('input[type="submit"]').removeAttr('disabled');
                return false;
            }
        });      
    })
</script>