<?php

/**
 * Description of sfValidatorPagoESiTef
 *
 * @author Jacobo Martinez
 */

class sfValidatorPagoESiTefBeginTransaction extends sfValidatorBase {
    protected $_apiConnection = null;
    protected $_paymentOrder = null;
    
    public function __construct($options = array(), $messages = array()) {
        parent::__construct($options, $messages);
    }

    public function configure($options = array(), $messages = array()) {
        $this->addOption('amount_field', 'amount');
        $this->addOption('merchant_usn_field', 'merchant_usn');
        $this->addOption('order_id_field', 'order_id');
        $this->addOption('throw_global_error', true);

        $this->setMessage('invalid', 'El n&uacute;mero de tarjeta de credito es inv&aacute;lido');
        $this->addMessage('server_error', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
        $this->addMessage('server_timeout_error', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
        $this->addMessage('server_timeout_error_max_attemps', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
        $this->addMessage('invalid_order', 'Identificador de orden de pago invalido');
        
        $this->addMessage('response_status_inv', 'No se ha podido iniciar la transacci&oacute;n por errores de comunicaci&oacute;n');
        
        $this->addMessage('response_code_1', 'Petici&oacute;n de pago incorrecta.');
        $this->addMessage('response_code_3', 'El identificador de transacci&oacute;n de la tienda es inv&aacute;lido.');
        $this->addMessage('response_code_4', 'El identificador de transacci&oacute;n de la tienda es inv&aacute;lido.');
        $this->addMessage('response_code_5', 'El identificador de la tienda inv&aacute;lido.');
        $this->addMessage('response_code_131', 'El valor de la transacción es nulo o negativo.');
        $this->addMessage('response_code_132', 'El identificador de transacci&oacute;n de la tienda es inv&aacute;lido.');
        $this->addMessage('response_code_133', 'El identificador de la orden de pago es inv&aacute;lido.');
        $this->addMessage('response_code_151', 'El identificador de la tienda inv&aacute;lido.');
        $this->addMessage('response_code_153', 'La tienda no esta activa para realizar transacciones en e-SiTef');
    }

    protected function doClean($values) {
        if ( !$order = $this->getPaymentOrder($values['order_id']) ) {
            throw new sfValidatorError($this, 'invalid_order');
        }
        
        // si la transacción ya ha sido iniciada no hacer la llamada al beginTransaction
        if ( strcasecmp($order->getTransactionStatus(), 'NOV') == 0 ) {
            return $values;
        }
        
        $this->_apiConnection = new vrESiTefApi();
        
        $transactionRequest = array (
                    'amount' => $values['amount'],
                    'extraField' => 'bonus',
                    'merchantUSN' => $values['merchant_usn'],
                    'orderId' => $values['order_id']
                );
        
        $transactionResponse = $this->_apiConnection->beginTransaction($transactionRequest);
        
        if (!$transactionResponse) {
            // si ya se han alcanzado 3 intentos y aún no se ha podido iniciar la transacción suspender el pago y notificar
            if ($values['attempt'] >= 3) {
                $order->setOrderStatus('timeout_fail');
                $order->save();
                
                throw new sfValidatorError($this, 'server_timeout_error_max_attemps');
            }
            
            $order->setOrderStatus('timeout');
            $order->save();
            
            throw new sfValidatorError($this, 'server_timeout_error');
        }
        
        $values['transaction_status'] = $transactionResponse['transactionResponse']['transactionStatus'];
        $values['response_code'] = $transactionResponse['transactionResponse']['responseCode'];
        $values['message'] = $transactionResponse['transactionResponse']['message'];
        
        if ($transactionResponse['transactionResponse']['responseCode'] > 0) {
            $this->updatePaymentOrder($values);
            $this->throwResponseCodeError($transactionResponse['transactionResponse']['responseCode']);
        }
        
        if (strcasecmp($transactionResponse['transactionResponse']['transactionStatus'],'NOV') != 0) {
            $this->updatePaymentOrder($values);
            $this->throwResponseStatusError($transactionResponse['transactionResponse']['transactionStatus']);
        }
        
        $values['nit'] = $transactionResponse['transactionResponse']['nit'];
        $values['order_status'] = 'processing';
        
        $order = $this->updatePaymentOrder($values);
        $this->notifyTransactionBegun($order);
        
        $values['attempt'] = 1;
        
        return $values;
    }
    
    protected function updatePaymentOrder($values) {
        $order = $this->getPaymentOrder($values['order_id']);
        
        $order->setNit($values['nit']);
        $order->setCustomerId($values['customer_id']);
        $order->setCardNumber($values['card_number']);
        $order->setTransactionStatus($values['transaction_status']);
        $order->setResponseCode($values['response_code']);
        $order->setMessage($values['message']);
        $order->setOrderStatus($values['order_status']);
        
        $order->save();
                
        return $order;
    }
    
    protected function notifyTransactionBegun(PaymentOrder $order) {
        $mailer = sfContext::getInstance()->getMailer();
        
        $message = $mailer->compose();
        $message->setSubject('Se ha iniciado la transaccion para pago con tarjeta de credito');
        
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
        
        // Render message parts
        $message->setBody(get_partial(
                    'puntoventa/notifyTransactionBegun', 
                    array(
                        'element'      => $order->getElementId(),
                        'element_type' => $order->getElementType(),
                        'order'        => $order->getOrderId(),
                        'amount'       => $order->getAmount(),
                        'date'         => $order->getDateTimeObject('created_at')->format('d-m-Y H:i:s'),
                    )
                ), 
                'text/html'
            );
        
        $message->setFrom(array('no-responder@vendorespuestos.com.mx' => 'VendoRepuestos'));
        
        $message->setTo($order->getCustomerEmail());
        
        $mailer->send($message);
    }

    protected function getPaymentOrder($order_id = false) {
        if (!$this->_paymentOrder) {
            if (!$order_id) {
                return false;
            }
            
            $this->_paymentOrder = $this->retrievePaymentOrder($order_id);
        }
        
        return $this->_paymentOrder;
    }

    protected function retrievePaymentOrder($order_id) {
        return Doctrine::getTable('PaymentOrder')->findOneByOrderId($order_id);
    }

    protected function throwResponseCodeError($code) {
        if ($this->getMessage('response_code_'.$code)) {
            throw new sfValidatorError($this, 'response_code_'.$code);
        }
        else {
            throw new sfValidatorError($this, 'server_error');
        }
    }
    
    protected function throwResponseStatusError($status) {
        if ($this->getMessage('response_status_'.strtolower($status))) {
            throw new sfValidatorError($this, 'response_status_'.strtolower($status));
        }
        else {
            throw new sfValidatorError($this, 'server_error');
        }
    }
}