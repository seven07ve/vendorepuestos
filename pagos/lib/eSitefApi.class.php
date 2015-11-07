<?php

/**
 * Description of eSitefApi
 *
 * @author jacobo
 */
// Cargar la libreria nusoap
require_once(sfConfig::get('sf_lib_dir') . '/vendor/nusoap/nusoap.php');

class eSitefApi {

    /**
     * Dirección del servidor de prueba: https://esitef-homologacao.softwareexpress.com.br/e-sitef/Payment2?wsdl 
     * Dirección del servidor de producción: https://esitef.softwareexpress.com.br/e-sitef/Payment2?wsdl
     * Dirección de prueba nuestra: http://174.129.205.100/esite.php
     */
    protected $eSitefClient;
    protected $eSitefProxy;
    protected $cH;
    protected $eSitefCredentials = '';
    protected $eSitefURL = 'http://174.129.205.100/esite.php';

    public function __construct() {
//        $this->eSitefClient = new nusoap_client($this->eSitefURL);
//        $this->eSitefProxy = $this->eSitefClient->getProxy();
    }

//    public function eSitefTest($params) {
//        $client = new nusoap_client("https://esitef-homologacao.softwareexpress.com.br/esitef/Payment2?wsdl", true);
//        $err = $client->getError();
//        if ($err) {
//            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
//            echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
//            exit();
//        }
//        $transactionRequest = array('transactionRequest' => array
//                (
//                'amount' => '1012',
//                'extraField' => 'bonus',
//                'merchantId' => 'TESTSTORE',
//                'merchantUSN' => '19949576',
//                'orderId' => '19949576'
//                ));
//        $payment = $client->getProxy();
//        $transactionResponse = $payment->beginTransaction($transactionRequest);
//        $nit = $transactionResponse['transactionResponse']['nit'];
//        $paymentRequest = array('paymentRequest' => array
//                (
//                'authorizerId' => '1',
//                'autoConfirmation' => 'true',
//                'cardExpiryDate' => '0912',
//                'cardNumber' => '4000000000000044',
//                'cardSecurityCode' => '256',
//                'customerId' => 'TEST',
//                'extraField' => 'bonus',
//                'installmentType' => '1',
//                'installments' => '1',
//                'nit' => $nit
//                ));
//        $result = $payment->doPayment($paymentRequest);
//        if ($client->fault) {
//            echo '<h2>Fault</h2><pre>';
//            print_r($result);
//            echo '</pre>';
//        } else {
//            $err = $client->getError();
//            if ($err) {
//                echo '<h2>Error</h2><pre>' . $err . '</pre>';
//            } else {
//                echo '<h2>Result</h2><pre>';
//                print_r($result['paymentResponse']);
//                echo '</pre>';
//            }
//        }
//    }
    
//    public function __construct() {}
//    
    public function eSitefTest($values)
    {
        $this->newSession();
        
        curl_setopt($this->cH, CURLOPT_POSTFIELDS, 
            $this->eSitefCredentials
            . '&user=' . 'test'
        );
        
        $result = curl_exec($this->cH);
        
        $response = array();
        $response['timeout'] = false;
        
        if (curl_errno($this->cH) == 28) {
            $response['timeout'] = true;
            return $response;
        }
        
        list($header, $body) = explode("\r\n\r\n", $result, 2);
        
        $pp = strip_tags( $body );
        
        $response = array_merge($response, json_decode($pp, true));
        
        $response['header'] = curl_getinfo($this->cH, CURLINFO_HTTP_CODE);
        
        curl_close($this->cH);
        
        return $response;
    }
    
    protected function newSession() {
        $this->cH = curl_init();
        curl_setopt($this->cH, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->cH, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->cH, CURLOPT_HEADER, 1);
        curl_setopt($this->cH, CURLOPT_POST, 1);
        curl_setopt($this->cH, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->cH, CURLOPT_TIMEOUT, rand(2, 10));
        curl_setopt($this->cH, CURLOPT_URL, $this->eSitefURL);
    }
}

?>
