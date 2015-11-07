<?php

/**
 * Description of vrPaymentOrderForm
 *
 * @author Jacobo
 */
class vrPaymentOrderForm_1 extends PaymentOrderForm {

    public function configure() {
        parent::configure();

        unset(
            $this['element_id'], $this['element_type'], $this['system_action'],  $this['costumer_email'], $this['created_at'], $this['updated_at']
        );
        
        $this->widgetSchema['attempt'] = new sfWidgetFormInputHidden();
        
        $this->widgetSchema->setLabels(array(
            'authorizer_id' => 'Tipo de Trajeta',
            'card_number' => 'N&uacute;mero de Tarjeta',
            'card_expiry_date' => 'Fecha de Vencimiento',
            'card_security_code' => 'C&oacute;digo de seguridad',
            'customer_id' => 'Cedula de Identidad'
        ));
        
        $this->widgetSchema->setNameFormat('payment_order[%s]');
        
        $this->validatorSchema['attempt'] = new sfValidatorInteger(array('min' => 1));
        
        $this->validatorSchema->setPostValidator(
                new sfValidatorAnd(array(
                    new sfValidatorDoctrineUnique(array('model' => 'PaymentOrder', 'column' => array('order_id'))),
                    new sfValidatorDoctrineUnique(array('model' => 'PaymentOrder', 'column' => array('merchant_usn'))),
                    new sfValidatorPagoESiTefBeginTransaction(),
                    new sfValidatorPagoESiTefDoPayment()
                ))
        );
    }
    
}
