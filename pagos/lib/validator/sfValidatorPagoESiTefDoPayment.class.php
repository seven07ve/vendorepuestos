<?php

/**
 * Description of sfValidatorPagoESiTef
 *
 * @author Jacobo Martinez
 */
class sfValidatorPagoESiTefDoPayment extends sfValidatorBase {

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

        $this->addMessage('server_error', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
        $this->addMessage('server_timeout_error', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
        $this->addMessage('server_timeout_error_max_attemps', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');

        $this->addMessage('response_status_inv', 'No se ha podido realizar la transacci&oacute;n por errores en los datos provistos, por favor verifique la informaci&oacute;n.');
        $this->addMessage('response_status_neg', 'La transacci&oacute;n ha sido rechazada por el banco');
        $this->addMessage('response_status_blq', 'La transacci&oacute;n ha sido bloqueada por haber superado el limite de intentos fallidos');
        $this->addMessage('response_status_err', 'Ha ocurrido un error de comunicaci&oacute;n, intente nuevamente');

        $this->addMessage('response_code_1', 'Petici&oacute;n de pago incorrecta.');
        $this->addMessage('response_code_2', 'Identificador de transacci&oacute;n inv&aacute;lido.');
        $this->addMessage('response_code_3', 'Identificador de transacci&oacute;n inv&aacute;lido.');
        $this->addMessage('response_code_4', 'Identificador de autorizador inv&aacute;lido.');
        $this->addMessage('response_code_5', 'Identificador de autorizador inv&aacute;lido.');
        $this->addMessage('response_code_6', 'Valor de autoconfirmaci&oacute;n no indicado.');
        $this->addMessage('response_code_7', 'La fecha de expiraci&oacute;n de la tarjeta es inv&aacute;lida');
        $this->addMessage('response_code_8', 'La fecha de expiraci&oacute;n de la tarjeta es inv&aacute;lida');
        $this->addMessage('response_code_9', 'Lo sentimos, su tarjeta ya ha expirado, contacte a su banco');
        $this->addMessage('response_code_10', 'La fecha de expiraci&oacute;n de la tarjeta es inv&aacute;lida');
        $this->addMessage('response_code_11', 'La fecha de expiraci&oacute;n de la tarjeta es inv&aacute;lida');
        $this->addMessage('response_code_12', 'El n&uacute;mero de tarjeta s&oacute;lo debe contener digitos, sin espacios u otro caracter.');
        $this->addMessage('response_code_13', 'El n&uacute;mero de tarjeta s&oacute;lo debe contener digitos, sin espacios u otro caracter.');
        $this->addMessage('response_code_14', 'El n&uacute;mero de tarjeta es inv&aacute;lido, verifiquelo he intente nuevamente.');
        $this->addMessage('response_code_15', 'El n&uacute;mero de tarjeta es inv&aacute;lido, corrijalo he intente nuevamente.');
        $this->addMessage('response_code_16', 'El c&oacute;digo de seguridad de la tarjeta es inv&aacute;lido.');
        $this->addMessage('response_code_17', 'El c&oacute;digo de seguridad de la tarjeta es inv&aacute;lido.');
        $this->addMessage('response_code_20', 'La cedula s&oacute;lo debe contener digitos, sin espacios u otro caracter.');
        $this->addMessage('response_code_30', 'Por definir');
        $this->addMessage('response_code_255', 'Lo sentimos, su tarjeta ha sido rechazada por el banco.');
    }

    protected function doClean($values) {
        if (!$order = $this->getPaymentOrder($values['order_id'])) {
            throw new sfValidatorError($this, 'invalid_order');
        }

        // si no hay NIT no llamar al api
        if (!$values['nit']) {
            throw new sfValidatorError($this, 'invalid_nit');
        }

        $this->_apiConnection = new vrESiTefApi();

        if (strcasecmp($order->getOrderStatus(), 'timeout') == 0) {
            $response = $this->_apiConnection->getStatus($values['nit']);
        } else {
            $paymentRequest = array(
                'customerId' => $values['customer_id'],
                'authorizerId' => $values['authorizer_id'],
                'cardExpiryDate' => $values['card_expiry_date'],
                'cardNumber' => $values['card_number'],
                'cardSecurityCode' => $values['card_security_code'],
                'extraField' => 'bonus',
                'nit' => $values['nit']
            );

            $response = $this->_apiConnection->doPayment($paymentRequest);
        }

        if (!$response) {
            // si ya se ha alcanzado 3 intentos y aún no se ha podido iniciar la transacción suspender el pago y notificar
            if ($values['attempt'] >= 3) {
                $order->setOrderStatus('timeout_fail');
                $order->save();

                throw new sfValidatorError($this, 'server_timeout_error_max_attemps');
            }

            $order->setOrderStatus('timeout');
            $order->save();

            throw new sfValidatorError($this, 'server_timeout_error');
        }

        $values['transaction_status'] = $response['paymentResponse']['transactionStatus'];
        $values['response_code'] = $response['paymentResponse']['responseCode'];
        $values['message'] = $response['paymentResponse']['message'];

        if (strcasecmp($response['paymentResponse']['transactionStatus'], 'CON') != 0) {
            $this->updatePaymentOrder($values);
            
            if (strcasecmp($response['paymentResponse']['transactionStatus'], 'INV') != 0) {
                $this->throwResponseCodeError($response['paymentResponse']['responseCode']);
            }

//            if ($response['paymentResponse']['responseCode'] > 0) {
//                $this->throwResponseCodeError($response['paymentResponse']['responseCode']);
//            }

            $this->throwResponseStatusError($response['paymentResponse']['transactionStatus']);
        }

        $values['customer_receipt'] = $response['paymentResponse']['customerReceipt'];
        $values['merchant_receipt'] = $response['paymentResponse']['merchantReceipt'];
        $values['acquirer'] = $response['paymentResponse']['acquirer'];
        $values['authorization_number'] = $response['paymentResponse']['authorizationNumber'];
        $values['esitef_usn'] = $response['paymentResponse']['esitefUSN'];
        $values['host_usn'] = $response['paymentResponse']['hostUSN'];
        $values['order_status'] = 'success';

        $order = $this->updatePaymentOrder($values);
        $this->notifyTransactionSuccess($order);

        $values['attempt'] = 1;

        return $values;
    }

    protected function updatePaymentOrder($values) {
        $order = $this->getPaymentOrder($values['order_id']);

        $order->setTransactionStatus($values['transaction_status']);
        $order->setResponseCode($values['response_code']);
        $order->setMessage($values['message']);
        $order->setOrderStatus($values['order_status']);

        $order->save();

        return $order;
    }

    protected function notifyTransactionSuccess(PaymentOrder $order) {
        $mailer = sfContext::getInstance()->getMailer();

        $message = $mailer->compose();
        $message->setSubject('Su pago con tarjeta de credito ha sido exitoso');

        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        // Render message parts
        $message->setBody(get_partial(
                        'puntoventa/notifyTransactionSuccess', array(
                    'element' => $order->getElementId(),
                    'element_type' => $order->getElementType(),
                    'act' => $order->getSystemAction(),
                    'order' => $order->getOrderId(),
                    'amount' => $order->getAmount(),
                    'date' => $order->getDateTimeObject('updated_at')->format('d-m-Y H:i:s'),
                        )
                ), 'text/html'
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
        if ($this->getMessage('response_code_' . $code)) {
            throw new sfValidatorError($this, 'response_code_' . $code);
        } else {
            throw new sfValidatorError($this, 'server_error');
        }
    }

    protected function throwResponseStatusError($status) {
        if ($this->getMessage('response_status_' . strtolower($status))) {
            throw new sfValidatorError($this, 'response_status_' . strtolower($status));
        } else {
            throw new sfValidatorError($this, 'server_error');
        }
    }

}