<?php
require_once('nusoap/lib/nusoap.php');
$client = new nusoap_client("https://esitef-homologacao.softwareexpress.com.br/e-sitef/Payment2?wsdl", true);
$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
exit();
}
$transactionRequest = array('transactionRequest' => array
(
'amount' => '1012',
'extraField' => 'bonus',
'merchantId' => 'TESTSTORE',
'merchantUSN' => '19949576',
'orderId' => '19949576'
));
$payment = $client->getProxy();
$transactionResponse = $payment->beginTransaction($transactionRequest);
$nit = $transactionResponse['transactionResponse']['nit'];
$paymentRequest = array('paymentRequest' => array
(
'authorizerId' => '1',
'autoConfirmation' => 'true',
'cardExpiryDate' => '0912',
'cardNumber' => '4000000000000044',
'cardSecurityCode' => '256',
'customerId' => 'TEST',
'extraField' => 'bonus',
'installmentType' => '1',
'installments' => '1',
'nit' => $nit
));
$result = $payment->doPayment($paymentRequest);
if ($client->fault) {
echo '<h2>Fault</h2><pre>';
print_r($result);
echo '</pre>';
} else {
$err = $client->getError();
if ($err) {
echo '<h2>Error</h2><pre>' . $err . '</pre>';
} else {
echo '<h2>Result</h2><pre>';
print_r($result['paymentResponse']);
echo '</pre>';
}
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($payment->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($payment->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
?>