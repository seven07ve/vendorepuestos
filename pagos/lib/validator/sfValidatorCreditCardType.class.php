<?php

/**
 * Description of epValidatorTag
 *
 * @author Jacobo Martínez
 */
class sfValidatorCreditCardType extends sfValidatorBase {
    
    protected $_authorizer = array(
            'visa' => '1',
            'mastercard' => '2',
        );
    
    protected $_ccregex = array(
        'visa' => '/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/',
        'mastercard' => '/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/',
        'discover' => '/^6011-?\d{4}-?\d{4}-?\d{4}$/',
        'amex' => '/^3[4,7]\d{13}$/',
        'diners' => '/^3[0,6,8]\d{12}$/',
        'bankcard' => '/^5610-?\d{4}-?\d{4}-?\d{4}$/',
        'jcb' => '/^[3088|3096|3112|3158|3337|3528]\d{12}$/',
        'enroute' => '/^[2014|2149]\d{11}$/',
        'switch' => '/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/'
    );

    public function configure($options = array(), $messages = array()) {
        $this->addOption('cc_type_field', 'tipo_tdc');
        $this->addOption('cc_number_field', 'tdc');
        $this->addOption('throw_global_error', true);

        $this->setMessage('invalid', 'El n&uacute;mero de tarjeta no corresponde al tipo de tarjeta indicado');
    }

    protected function doClean($values) {
        $cct = isset($values[$this->getOption('cc_type_field')]) ? $values[$this->getOption('cc_type_field')] : '';

        $ccn = isset($values[$this->getOption('cc_number_field')]) ? $values[$this->getOption('cc_number_field')] : '';
        
        if (!$cct || !$ccn) {
            if ($this->getOption('throw_global_error')) {
                throw new sfValidatorError($this, 'invalid');
            } else {
                throw new sfValidatorErrorSchema($this, array($this->getOption('cc_number_field') => new sfValidatorError($this, 'invalid')));
            }
        }

        if (!$this->_isValidCreditCard($ccn, $cct)) {
            if ($this->getOption('throw_global_error')) {
                throw new sfValidatorError($this, 'invalid');
            } else {
                throw new sfValidatorErrorSchema($this, array($this->getOption('cc_number_field') => new sfValidatorError($this, 'invalid')));
            }
        }
        
        return $values;
    }
    
    protected function _isValidCreditCard($ccnum, $type) {
        if (@preg_match($this->_ccregex[strtolower(trim($type))], $ccnum) == 0) {
            return false;
        }

        return true;
    }
}
