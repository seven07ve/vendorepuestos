<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of searchProductoForm
 *
 * @author Jacobo Martinez
 */
class searchProductoForm extends BaseForm {
    public function configure() {
        parent::configure();
        
        $this->setWidgets(array(
            'cedula' => new sfWidgetFormInput(array(),array('data-bvalidator' => 'validateregex,required','data-bvalidator-msg' => 'Indique su cedula de indentidad en formato V-000000')),
            'producto' => new sfWidgetFormInput(array(),array('data-bvalidator' => 'digit','data-bvalidator-msg' => 'Indique el identificador del producto, s&oacute;lo d&iacute;gitos')),
        ));
        
        $this->widgetSchema->setLabels(array(
            'cedula' => 'Cedula de Identidad',
            'producto' => 'N&uacute;mero de art&iacute;culo',
        ));
        
        $this->widgetSchema->setNameFormat('buscaproducto[%s]');
        $this->widgetSchema->setFormFormatterName('table');
        
        $this->setValidators(array(
            'cedula' => new sfValidatorRegex(array('pattern' => '/^(V|J)-[0-9]+$/')),
            'producto' => new sfValidatorDoctrineChoice(array('model' => 'Productos','required' => false)),
        ));
        
        //$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(new validatorUsuarioProducto())));
    }
}

?>
