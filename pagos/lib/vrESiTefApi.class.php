<?php

/**
 * Description of eSitefApi
 *
 * @author jacobo
 */
// Cargar la libreria nusoap
require_once(sfConfig::get('sf_lib_dir') . '/vendor/nusoap/nusoap.php');

class vrESiTefApi {

    /**
     * Dirección del servidor de prueba: https://esitef-homologacao.softwareexpress.com.br/e-sitef-hml/Payment2?wsdl 
     * Dirección del servidor de producción: https://esitef.softwareexpress.com.br/e-sitef/Payment2?wsdl
     * Dirección de prueba nuestra: http://174.129.205.100/esite.php
     */
    protected $eSiTefClient;
    protected $eSiTefProxy;
    protected $eSiTefMerchantId;

    public function __construct() {
        $this->eSiTefClient = new nusoap_client(sfConfig::get('app_esitef_url'), true, false, false, false, false, sfConfig::get('app_esitef_connection_timeout', 120), sfConfig::get('app_esitef_response_timeout', 120));

        $err = $this->eSiTefClient->getError();
        if ($err) {
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
            echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->eSiTefClient->getDebug(), ENT_QUOTES) . '</pre>';
            exit();
        }
        
        

        $this->eSiTefProxy = $this->eSiTefClient->getProxy();
        $this->eSiTefMerchantId = sfConfig::get('app_esitef_merchant_id');
    }

    public function beginTransaction(array $transactionParams) {
        set_time_limit(0);
        
        $transactionRequest['transactionRequest'] = $transactionParams;

        $transactionRequest['transactionRequest']['merchantId'] = $this->eSiTefMerchantId;

        if (!$this->eSiTefProxy) {
            return false;
        } 
        else {
            return $this->eSiTefProxy->beginTransaction($transactionRequest);
        }
    }

    public function doPayment(array $paymentParams) {
        set_time_limit(0);
        
        $paymentRequest['paymentRequest'] = array(
                'autoConfirmation' => 'true',
                'installmentType' => '4',
                'installments' => '1',
                'extraField' => 'bonus'
            );
        
        $paymentRequest['paymentRequest'] = array_merge($paymentParams, $paymentRequest['paymentRequest']);

        if (!$this->eSiTefProxy) {
            return false;
        } 
        else {
            return $this->eSiTefProxy->doPayment($paymentRequest);
        }
    }
    
    public function getStatus($nit) {
        set_time_limit(0);
        
        $params = array(
            'merchantKey' => sfConfig::get('app_esitef_merchant_key'),
            'nit'         => $nit
        );
        
        if (!$this->eSiTefProxy) {
            return false;
        } 
        else {
            return $this->eSiTefProxy->getStatus($params);
        }
    }

    public function getProxy() {
        return $this->eSiTefProxy;
    }

}

?>
