<?php
/**
 * Description of eSiteForm
 *
 * @author Jacobo Martinez
 */
class eSiteForm extends BaseForm {
    public function configure() {
        parent::configure();
        
        $tipos_tdc = array(
                'visa' => '<img src="'.sfConfig::get('app_serverhost', false).'/imagenes/icon_tdc_visa" alt="Visa"/>',
                'mastercard' => '<img src="'.sfConfig::get('app_serverhost', false).'/imagenes/icon_tdc_mastercard" alt="MasterCard"/>'
            );
        
        $this->setWidgets(array(
            'email' => new sfWidgetFormInputHidden(array(),array('data-bvalidator' => 'email,required','data-bvalidator-msg' => 'Direcci&oacute;n de correo electrónico inv&aacute;lida.')),
            'monto' => new sfWidgetFormInputHidden(array(),array('data-bvalidator' => 'number,required','data-bvalidator-msg' => 'Monto inv&aacute;lido.')),
            'paquete' => new sfWidgetFormInputHidden(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Numero de paquete inv&aacute;lido.')),
            'tipo_tdc' => new sfWidgetFormSelectRadio(array('choices' => $tipos_tdc, 'class' => 'tipo-tdc-list'),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido')),
            'tdc' => new sfWidgetFormInput(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido')),
            'vence' => new sfWidgetFormCCExpirationDate(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido')),
            'banco' => new sfWidgetFormInput(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido')),
            'cedula' => new sfWidgetFormInput(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido')),
        ));
        
        $this->widgetSchema->setLabels(array(
            'tipo_tdc' => 'Tipo de Trajeta',
            'tdc' => 'N&uacute;mero de Tarjeta',
            'vence' => 'Fecha de Vencimiento',
            'banco' => 'Banco Emisor',
            'cedula' => 'Cedula de Identidad'
        ));
        
        $this->widgetSchema->setNameFormat('datospago[%s]');
        $this->widgetSchema->setFormFormatterName('table');
        
        $this->setValidators(array(
            'email' => new sfValidatorEmail(array(), array()),
            'monto' => new sfValidatorNumber(array(), array()),
            'paquete' => new sfValidatorDoctrineChoice(array('model' => 'Productos'), array()),
            'tipo_tdc' => new sfValidatorChoice(array('choices' => array_keys($tipos_tdc)), array()),
            'tdc' => new sfValidatorCreditCardNumber(array(), array('invalid' => 'N&uacute;mero de tarjeta inv&aacute;lido')),
            'vence' => new sfValidatorCCExpirationDate(),
            'banco' => new sfValidatorString(array(), array()),
            'cedula' => new sfValidatorString(array(), array()),
        ));
        
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorCreditCardType(),
            new sfValidatorPagoESite(),
        )));
    }
}

?>
