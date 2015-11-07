<?php

/**
 * PaymentOrder form.
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PaymentOrderForm extends BasePaymentOrderForm {

    public function configure() {
        /**
         * Los valores de las claves del arreglo a continuación representan los identificadores
         * utilizados por e-SiTef para cada proveedor.
         *  * 1 => Visa
         *  * 2 => MasterCard
         */
        $tipos_tdc = array(
                '1' => '<img src="'.sfConfig::get('app_serverhost', false).'/imagenes/icon_tdc_visa" alt="Visa"/>',
                '2' => '<img src="'.sfConfig::get('app_serverhost', false).'/imagenes/icon_tdc_mastercard" alt="MasterCard"/>'
            );
        
        $this->widgetSchema['card_expiry_date']     = new sfWidgetFormCCExpirationDate(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Ingrese la fecha de vencimiento de su tarjeta'));
        $this->widgetSchema['card_security_code']   = new sfWidgetFormInputText(array(),array('maxlength' => 5,'data-bvalidator' => 'digit,minlength[3],maxlength[5],required','data-bvalidator-msg' => 'Ingrese el c&oacute;digo de seguridad de su tarjeta'));
        $this->widgetSchema['authorizer_id']        = new sfWidgetFormSelectRadio(array('choices' => $tipos_tdc, 'class' => 'tipo-tdc-list'),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido'));
        $this->widgetSchema['customer_id']          = new sfWidgetFormInput(array(),array('maxlength' => 8,'data-bvalidator' => 'required','data-bvalidator-msg' => 'Campo requerido'));
        $this->widgetSchema['card_number']          = new sfWidgetFormInput(array(),array('maxlength' => 19,'data-bvalidator' => 'digit,minlength[12],maxlength[19],required','data-bvalidator-msg' => 'Ingrese el n&uacute;mero de su tarjeta, debe contener m&iacute;nimo 12 digitos y m&aacute;ximo 19'));
        $this->widgetSchema['transaction_status']   = new sfWidgetFormInputHidden();
        $this->widgetSchema['response_code']        = new sfWidgetFormInputHidden();
        $this->widgetSchema['customer_email']       = new sfWidgetFormInputHidden();
        $this->widgetSchema['amount']               = new sfWidgetFormInputHidden();
        $this->widgetSchema['order_id']             = new sfWidgetFormInputHidden();
        $this->widgetSchema['order_status']         = new sfWidgetFormInputHidden();
        $this->widgetSchema['merchant_usn']         = new sfWidgetFormInputHidden();
        $this->widgetSchema['nit']                  = new sfWidgetFormInputHidden();
        $this->widgetSchema['customer_receipt']     = new sfWidgetFormInputHidden();
        $this->widgetSchema['merchant_receipt']     = new sfWidgetFormInputHidden();
        $this->widgetSchema['acquirer']             = new sfWidgetFormInputHidden();
        $this->widgetSchema['authorization_number'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['esitef_usn']           = new sfWidgetFormInputHidden();
        $this->widgetSchema['host_usn']             = new sfWidgetFormInputHidden();
        $this->widgetSchema['message']              = new sfWidgetFormInputHidden();
    
        $this->validatorSchema['card_expiry_date']     = new sfValidatorCCExpirationDate(array('date_output' => 'my'));
        $this->validatorSchema['card_security_code']   = new sfValidatorRegex(array('max_length' => 5, 'pattern' => '/^\d+$/'), array('invalid' => 'C&oacute;digo de seguridad inv&aacute;lido'));
        $this->validatorSchema['amount']               = new sfValidatorInteger(array('min' => 1), array('min' => 'El monto a pagar debe ser mayor o igual a 1 centimo'));
        $this->validatorSchema['response_code']        = new sfValidatorInteger(array('min' => 0, 'required' => false), array('min' => 'El c&oacute;digo de respuesta de e-SiTef debe ser mayor o igual a 0'));
        $this->validatorSchema['order_id']             = new sfValidatorString(array('max_length' => 20));
        $this->validatorSchema['merchant_usn']         = new sfValidatorString(array('max_length' => 12));
        $this->validatorSchema['customer_id']          = new sfValidatorRegex(array('max_length' => 8, 'pattern' => '/^\d+$/'), array('invalid' => 'Numero de cedula inv&aacute;lido, ingrese solo digitos'));
        $this->validatorSchema['customer_email']       = new sfValidatorEmail(array(), array('invalid' => 'Direcci&oacute;n de correo electr&oacute;nico inv&aacute;lida'));
        $this->validatorSchema['card_number']          = new sfValidatorRegex(array('min_length' => 12, 'max_length' => 19, 'pattern' => '/^\d+$/'), array('invalid' => 'N&uacute;mero de tarjeta inv&aacute;lido', 'min_length' => 'debe contener al menos 12 digitos', 'max_length' => 'contener m&aacute;ximo 19 digitos'));
        $this->validatorSchema['nit']                  = new sfValidatorString(array('max_length' => 64, 'required' => false));
        $this->validatorSchema['customer_receipt']     = new sfValidatorString(array('max_length' => 4000, 'required' => false));
        $this->validatorSchema['merchant_receipt']     = new sfValidatorString(array('max_length' => 4000, 'required' => false));
        $this->validatorSchema['authorizer_id']        = new sfValidatorChoice(array('choices' => array_keys($tipos_tdc)), array());
        $this->validatorSchema['acquirer']             = new sfValidatorString(array('max_length' => 50, 'required' => false));
        $this->validatorSchema['authorization_number'] = new sfValidatorString(array('max_length' => 6, 'required' => false));
        $this->validatorSchema['esitef_usn']           = new sfValidatorString(array('max_length' => 15, 'required' => false));
        $this->validatorSchema['host_usn']             = new sfValidatorString(array('max_length' => 15, 'required' => false));
    }

}
