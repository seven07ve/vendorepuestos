<?php

/**
 * Description of vrProductoPasswordForm
 *
 * @author jacobomartinez
 */
class vrProductoPasswordForm extends BaseForm {

    public function setup() {
        $producto = $this->getOption('producto');
        
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden,
            'password' => new sfWidgetFormInputPassword(array('type' => 'password'),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Indique su contrase&ntilde;a')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($producto->getId()), 'empty_value' => $producto->getId())),
            'password' => new sfValidatorString(),
        ));

        $this->widgetSchema['password']->setLabel('Contrase&ntilde;a');

        $this->validatorSchema->setPostValidator(new vrValidatorProductoPassword());

        $this->widgetSchema->setNameFormat('producto[%s]');
    }

}

?>
