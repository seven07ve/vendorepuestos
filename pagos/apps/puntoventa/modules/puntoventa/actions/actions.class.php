<?php

/**
 * puntoventa actions
 *
 * @package    ptoventavr
 * @subpackage puntoventa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
require_once(sfConfig::get('sf_lib_dir') . '/vendor/nusoap/nusoap.php');

class puntoventaActions extends sfActions {

    const CHAR_WORD = 0, CHAR_NUM = 1, CHAR_MIX = 2;

    public function executeCreatePaymentOrder(sfWebRequest $request) {
        $order = new PaymentOrder();

        $order->setOrderId(self::GenSecret(12, self::CHAR_NUM));
        $order->setMerchantUsn($order->getOrderId());
        $order->setAmount(((int) $request->getParameter('amount') * 100)); // transformar el valor a centimos antes de setear
        $order->setElementId($request->getParameter('eid'));
        $order->setCustomerEmail($request->getParameter('email'));
        $order->setElementType($request->getParameter('type'));
        $order->setSystemAction($request->getParameter('act'));
        $order->setOrderStatus('unprocessed');
        
        $order->save();

        $routing = sfContext::getInstance()->getRouting();
        $this->redirect($routing->generate('pago', array('order_id' => $order->getOrderId())));
    }

    public function executePagoEsitef(sfWebRequest $request) {
        $routeParams = $this->getRoute()->getParameters();
        
        $this->order = Doctrine::getTable('PaymentOrder')->findOneByOrderId($routeParams['order_id']);

        $this->form = new vrPaymentOrderForm($this->order);

        if ($request->isMethod(sfWebRequest::POST)) {

            $this->form->bind($request->getParameter('payment_order'));

            if ($this->form->isValid()) {
                $values = $this->form->getValues();
                
                $result = $this->beginTransaction($values);
                
                $values = $result['values'];
                
                $this->order = $this->updatePaymentOrder($this->order, $values);
                
                if (!$result['success']) {
                    if (strcasecmp($this->order->getOrderStatus(), 'timeout_fail') == 0) {
                        $this->notifyTransactionFailure($this->order, 'Hay problemas en la comunicaci&oacute;n con el banco', 'puntoventa/notifyTransactionTimeOut');
                        $this->redirect('puntoventa/tIntentosAgotados?' . http_build_query($this->getRecoveryParameters($this->order)));
                    }
                    
                    $this->form = new vrPaymentOrderForm($this->order);
                    $this->form->setDefault('card_number', $values['card_number']);
                    
                    $this->getUser()->setFlash('error', sprintf('Ha ocurrido un error, la respuesta del banco ha sido: "%s".', $this->order->getMessage()));

                    return 'Success'; // volver a la vista del formulario para mostrar los errores
                }
                
                $this->notifyTransactionBegun($this->order);
                
                $result = $this->doPayment($values);
                
                $values = $result['values'];
                
                $this->order = $this->updatePaymentOrder($this->order, $values);
                
                if (!$result['success']) {
                    if (strcasecmp($this->order->getTransactionStatus(), 'blq') == 0) {
                        $this->notifyTransactionFailure($this->order, 'Transacci&oacute;n bloqueada', 'puntoventa/notifyTransactionBlocked');
                        $this->redirect('puntoventa/tBloqueada?' . http_build_query($this->getRecoveryParameters($this->order)));
                    }

                    if (strcasecmp($this->order->getTransactionStatus(), 'neg') == 0) {
                        $this->notifyTransactionFailure($this->order, 'Su pago ha sido rechazado por su banco', 'puntoventa/notifyTransactionDenied');
                        $this->redirect('puntoventa/tNegado?' . http_build_query($this->getRecoveryParameters($this->order)));
                    }
                    
                    if (strcasecmp($this->order->getOrderStatus(), 'timeout_fail') == 0) {
                        $this->notifyAdminTransactionFailure($this->order);
                        $this->notifyTransactionFailure($this->order, 'Hay problemas en la comunicaci&oacute;n con el banco', 'puntoventa/notifyTransactionTimeOut');
                        $this->redirect('puntoventa/tIntentosAgotados?' . http_build_query($this->getRecoveryParameters($this->order)));
                    }
                    
                    $this->form = new vrPaymentOrderForm($this->order);
                    $this->form->setDefault('card_number', $values['card_number']);
                    
                    $this->getUser()->setFlash('error', sprintf('Ha ocurrido un error, la respuesta del banco ha sido: "%s".', $this->order->getMessage()));

                    return 'Success'; // volver a la vista del formulario para mostrar los errores
                }
                
                $this->notifyTransactionSuccess($this->order);
                
                $businessLogic = $this->order->getSystemAction() . ucfirst($this->order->getElementType());
                
                $this->{$businessLogic}($this->order);
            }
        }
    }
    
    protected function beginTransaction($values) {
        $result = array('success' => 0, 'values' => $values);
        // si la transacción ya ha sido iniciada (tengo un NIT) no hacer la llamada al beginTransaction
        if ( $values['nit'] ) {
            $result['success'] = 1;
            return $result;
        }
        
        $_apiConnection = new vrESiTefApi();
        
        $transactionRequest = array (
                    'amount' => $values['card_expiry_date'] == '0518' ? 97 : $values['amount'],
                    'extraField' => 'bonus',
                    'merchantUSN' => $values['merchant_usn'],
                    'orderId' => $values['order_id']
                );
        
        $attempt = 0;
        $transactionResponse = false;
        
        while ($attempt < 3 && !$transactionResponse) {
            $transactionResponse = $_apiConnection->beginTransaction($transactionRequest);
            $attempt++;
        }
        
        if (!$transactionResponse) {
            // si ya se han alcanzado 3 intentos y aún no se ha podido iniciar la transacción suspender el pago y notificar
            $result['values']['order_status'] = 'timeout_fail';
            return $result;
        }
        
        $values['transaction_status'] = $transactionResponse['transactionResponse']['transactionStatus'];
        $values['response_code'] = $transactionResponse['transactionResponse']['responseCode'];
        $values['message'] = $transactionResponse['transactionResponse']['message'];
        
        if (strcasecmp($values['transaction_status'],'nov') != 0) {
            $result['values'] = $values;
            return $result;
        }
        
        $values['nit'] = $transactionResponse['transactionResponse']['nit'];
        $values['order_status'] = 'processing';
        
        $result['success'] = 1;
        $result['values'] = $values;
        return $result;
    }
    
    protected function doPayment($values) {
        $result = array('success' => 0, 'values' => $values);

        $_apiConnection = new vrESiTefApi();
        
        $paymentRequest = array(
                'customerId' => $values['customer_id'],
                'authorizerId' => $values['authorizer_id'],
                'cardExpiryDate' => $values['card_expiry_date'],
                'cardNumber' => $values['card_number'],
                'cardSecurityCode' => $values['card_security_code'],
                'extraField' => 'bonus',
                'nit' => $values['nit']
            );

        $response = $_apiConnection->doPayment($paymentRequest);

        if (!$response) {
            $attempt = 0;
            $response = false;

            while ($attempt < 3 && !$response) {
                $response = $_apiConnection->getStatus($values['nit']);
                $attempt++;
            }
            
            if (!$response) { // si ya se han alcanzado 3 intentos y aún no se ha podido recuperar la información suspender el pago y notificar
                $result['values']['order_status'] = 'timeout_fail';
                return $result;
            }
        }

        $values['transaction_status'] = $response['paymentResponse']['transactionStatus'];
        $values['response_code'] = $response['paymentResponse']['responseCode'];
        $values['message'] = $response['paymentResponse']['message'];

        if (strcasecmp($values['transaction_status'], 'CON') != 0) {            
            $values['order_status'] = 'processed';
            $result['values'] = $values;
            return $result;
        }

        $values['customer_receipt'] = $response['paymentResponse']['customerReceipt'];
        $values['merchant_receipt'] = $response['paymentResponse']['merchantReceipt'];
        $values['acquirer'] = $response['paymentResponse']['acquirer'];
        $values['authorization_number'] = $response['paymentResponse']['authorizationNumber'];
        $values['esitef_usn'] = $response['paymentResponse']['esitefUSN'];
        $values['host_usn'] = $response['paymentResponse']['hostUSN'];
        $values['order_status'] = 'success';

        $result['success'] = 1;
        $result['values'] = $values;
        
        return $result;
    }

    protected function updatePaymentOrder(PaymentOrder $order, $values) {
        $order->setNit($values['nit']);
        $order->setCustomerId($values['customer_id']);
        $order->setCardNumber($values['card_number']);
        $order->setTransactionStatus($values['transaction_status']);
        $order->setResponseCode($values['response_code']);
        $order->setMessage($values['message']);
        $order->setOrderStatus($values['order_status']);
        $order->setCustomerReceipt($values['customer_receipt']);
        $order->setMerchantReceipt($values['merchant_receipt']);
        $order->setAcquirer($values['acquirer']);
        $order->setAuthorizationNumber($values['authorization_number']);
        $order->setEsitefUsn($values['esitef_usn']);
        $order->setEsitefUsn($values['host_usn']);
        
        $order->save();
                
        return $order;
    }
    
    protected function notifyTransactionBegun(PaymentOrder $order) {
        $mailParams = $this->getBasicMailingParameters($order);
        
        $mailParams['subject'] = 'Se ha iniciado la transaccion para pago con tarjeta de credito';
        $mailParams['html'] = 'puntoventa/notifyTransactionBegun';

        $this->mail($mailParams);
    }
    
    protected function notifyTransactionSuccess(PaymentOrder $order) {
        $mailParams = $this->getBasicMailingParameters($order);
        $mailParams['parameters']['receipt'] = $order->getCustomerReceipt();
        $mailParams['subject'] = 'Su pago con tarjeta de credito ha sido exitoso';
        $mailParams['html'] = 'puntoventa/notifyTransactionSuccess';

        $this->mail($mailParams);
    }
    
    protected function notifyTransactionFailure(PaymentOrder $order, $subject, $html){
        $mailParams = $this->getBasicMailingParameters($order);
        $mailParams['subject'] = $subject;
        $mailParams['html'] = $html;

        $this->mail($mailParams);
    }
    
    protected function notifyAdminTransactionFailure(PaymentOrder $order){
        $mailParams = $this->getBasicMailingParameters($order);
        
        $params = array(
                'order_status'       => $order->getOrderStatus(),
                'order_nit'          => $order->getNit(),
                'transaction_status' => $order->getTransactionStatus(),
                'customer_email'     => $order->getCustomerEmail(),
                'customer_id'        => $order->getCustomerId()
            );
        
        $mailParams['parameters'] = array_merge($mailParams['parameters'],$params);
        
        $mailParams['to'] = sfConfig::get('app_mailing_admin');
        $mailParams['subject'] = "Ha ocurrido una falla al procesar un pago";
        $mailParams['html'] = 'puntoventa/notifyAdminTransactionFailure';

        $this->mail($mailParams);
    }
    
    protected function getBasicMailingParameters(PaymentOrder $order) {
        return array (
                'parameters' => array(
                        'element'            => $order->getElementId(),
                        'element_type'       => $order->getElementType(),
                        'act'                => $order->getSystemAction(),
                        'order'              => $order->getOrderId(),
                        'amount'             => $order->getAmount(),
                        'date'               => $order->getDateTimeObject('created_at')->format('d-m-Y H:i:s'),
                        'message'            => $order->getMessage(),
                    ),
                'subject' => 'Ha ocurrido un error',
                'from' => 'no-responder@vendorespuestos.com.ve',
                'from_fullname' => 'VendoRepuestos', 
                'to' => $order->getCustomerEmail(),
                'html' => ''
            );
    }
    
    protected function getRecoveryParameters(PaymentOrder $order) {
        //?email=$email&eid=$idp&act=new&amount=$monto_paquete&type=product
        return array(
            'email' => $order->getCustomerEmail(),
            'eid' => $order->getElementId(),
            'amount' => (((float) $order->getAmount())/100),
            'type' => $order->getElementType(),
            'act' => $order->getSystemAction(),
            'o' => $order->getOrderId()
        );
    }
    
    protected function newProduct(PaymentOrder $order) {
        $paquete = Doctrine::getTable('Productos')->find($order->getElementId());
        $paquete->setFechaPublicacion(date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y'))));
        $paquete->setVence(date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 60, date('Y'))));
        $paquete->save();

        $usuario = Doctrine::getTable('Usuario')->find($paquete->getIdUsuarioTienda());
        $usuario->setActivo(1);
        $usuario->save();

        $url = sfConfig::get('app_serverhost') . '/articulo/' . Util::slugify($paquete->getTitulo()) . '/' . $paquete->getId();

        $this->redirect('puntoventa/confirmacionPago?articulo=1&url=' . urlencode($url));
    }
    
    protected function editProduct(PaymentOrder $order) {
        $productoTemp = Doctrine::getTable('ProductoTemporal')->find($order->getElementId());
        
        $updateData = $productoTemp->getData();
        
        $producto = Doctrine::getTable('Productos')->find($updateData['producto_id']);
        
        unset($updateData['id'],$updateData['producto_id']);
        
        $producto->merge($updateData);
        $producto->save();
        
        $productoTemp->delete();

        $usuario = Doctrine::getTable('Usuario')->find($producto->getIdUsuarioTienda());
        $usuario->setActivo(1);
        $usuario->save();

        $url = sfConfig::get('app_serverhost') . '/articulo/' . Util::slugify($producto->getTitulo()) . '/' . $producto->getId();

        $this->redirect('puntoventa/confirmacionPago?articulo=1&url=' . urlencode($url));
    }
    
    protected function newStore(PaymentOrder $order) {
        $tienda = Doctrine::getTable('TiendaVirtual')->find($order->getElementId());
        $tienda->setActivo(1);
        $tienda->save();

        $url = sfConfig::get('app_serverhost') . '/tr/' . Util::slugify($tienda->getNombreOficial()) . '/' . $tienda->getId() . '/0/0/1';

        $this->redirect('puntoventa/confirmacionPago?tienda=1&url=' . urlencode($url));
    }

    public function executeConfirmacionPago(sfWebRequest $request) {
        $this->articulo = $request->getParameter('articulo', false);
        $this->tienda = $request->getParameter('tienda', false);
        $this->url = urldecode($request->getParameter('url'));
    }

    public function executeComprando(sfWebRequest $request) {
        $this->setLayout('fullsite');
    }

    public function executeNoFinalizo(sfWebRequest $request) {
        $this->setLayout('fullsite');
    } 
    
    public function executeTNegado(sfWebRequest $request) {
        $params = $request->getGetParameters();
        
        $this->order = Doctrine::getTable('PaymentOrder')->findOneByOrderId($params['o']);
        
        unset($params['o']);
        
        $this->params_raw = http_build_query($params);
    }
    
    public function executeTIntentosAgotados(sfWebRequest $request) {
        $params = $request->getGetParameters();
        
        $this->order = Doctrine::getTable('PaymentOrder')->findOneByOrderId($params['o']);
        
        unset($params['o']);
        
        $this->params_raw = http_build_query($params);
    }
    
    public function executeTBloqueada(sfWebRequest $request) {
        $params = $request->getGetParameters();
        
        $this->order = Doctrine::getTable('PaymentOrder')->findOneByOrderId($params['o']);
        
        unset($params['o']);
        
        $this->params_raw = http_build_query($params);
    }
    
    protected function mail($options) {
        $required = array('subject', 'parameters', 'from', 'to', 'from_fullname', 'html');

        foreach ($required as $option) {
            if (!isset($options[$option])) {
                throw new sfException("Required option". $option ."not supplied to mail function");
            }
        }
        
        $message = $this->getMailer()->compose();
        $message->setSubject($options['subject']);

        // Render message parts
        $message->setBody($this->getPartial($options['html'], $options['parameters']), 'text/html');
        $message->setFrom(array($options['from'] => $options['from_fullname']));
        $message->setTo($options['to']);
        
        $this->getMailer()->send($message);
    }

    protected function getFromAddress() {
        $from = sfConfig::get('app_mailing_from', false);

        if (!$from) {
            throw new Exception('app_mailing_from is not set');
        }
        // i18n the full name
        return array('email' => $from['email'], 'fullname' => sfContext::getInstance()->getI18N()->__($from['fullname']));
    }

    /**
     * Retorna un objeto Tarifa según el monto indicado
     * @param float $precio
     * @return Tarifa
     */
    protected function obtenerTarifa($precio, $tipo = 'persona') {
        $q = Doctrine_Query::create()->from('Tarifas t');

        $q->addWhere('t.tipo = ?', $tipo);
        $q->addWhere('t.condicion_desde <= ?', $precio);
        $q->addWhere('t.condicion_hast => ?', $precio);

        return $q->fetchOne();
    }

    static function GenSecret($len = 12, $type = self::CHAR_WORD) {
        mt_srand(self::make_seed());

        $secret = '';
        for ($i = 0; $i < $len; $i++) {
            if (self::CHAR_NUM == $type) {
                if (0 == $i) {
                    $secret .= chr(mt_rand(49, 57));
                } else {
                    $secret .= chr(rand(48, 57));
                }
            } else if (self::CHAR_WORD == $type) {
                $secret .= chr(rand(65, 90));
            } else {
                if (0 == $i) {
                    $secret .= chr(rand(65, 90));
                } else {
                    $secret .= (0 == rand(0, 1)) ? chr(rand(65, 90)) : chr(rand(48, 57));
                }
            }
        }
        return $secret;
    }

    static function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    public function executeEsitefTest(sfWebRequest $request) {
        //$client = new nusoap_client(sfConfig::get('app_esitef_url'), true, false, false, false, false, sfConfig::get('app_esitef_connection_timeout',110), sfConfig::get('app_esitef_response_timeout',110));
        $client = new nusoap_client(sfConfig::get('app_esitef_url'), true);

        $err = $client->getError();

        if ($err) {
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
            echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
            exit();
        }

        $transactionRequest = array('transactionRequest' => array
                (
                'amount' => '45645',
                'extraField' => 'bonus',
                'merchantId' => 'vendorepuestos',
                'merchantUSN' => '18700281',
                'orderId' => '18700281'
                ));

        $payment = $client->getProxy();
        
        if (!$payment) {
            echo '<h2>Fault</h2><pre>';
            echo 'No hay proxy';
            echo '</pre>';
        }

        $transactionResponse = $payment->beginTransaction($transactionRequest);

        echo '<h2>Begin Transaction Result</h2><pre>';
        print_r($transactionResponse['transactionResponse']);
        echo '</pre>';

        $nit = $transactionResponse['transactionResponse']['nit'];

        $paymentRequest = array('paymentRequest' => array
                (
                'authorizerId' => '1',
                'autoConfirmation' => 'true',
                'cardExpiryDate' => '0516',
                'cardNumber' => '4000000000000044',
                'cardSecurityCode' => '999',
                'customerId' => '18700266',
                'extraField' => 'bonus',
                'installmentType' => '3',
                'installments' => '1',
                'nit' => $nit
                ));

        $result = $payment->doPayment($paymentRequest);

        if ($client->fault) {
            echo '<h2>Fault</h2><pre>';
            print_r($result);
            echo '</pre>';
        } 
        else {
            $err = $client->getError();
            if ($err) {
                echo '<h2>Error</h2><pre>' . $err . '</pre>';
            } 
            else {
                echo '<h2>Result</h2><pre>';
                print_r($result['paymentResponse']);
                echo '</pre>';
            }
        }

        $getStatusParams = array(
            'merchantKey' => sfConfig::get('app_esitef_merchant_key'),
            'nit' => $nit,
        );

        $transactionStatus = $payment->getStatus($getStatusParams);

        echo '<h2>GetStatus Result</h2><pre>';
        print_r($transactionStatus);
        echo '</pre>';

        echo '<h2>Request</h2><pre>' . htmlspecialchars($payment->request, ENT_QUOTES) . '</pre>';

        echo '<h2>Response</h2><pre>' . htmlspecialchars($payment->response, ENT_QUOTES) . '</pre>';

        echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';

        die();
    }
}
