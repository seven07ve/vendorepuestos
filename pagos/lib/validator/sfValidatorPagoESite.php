<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sfValidatorPagoESite
 *
 * @author Jacobo Martinez
 */
class sfValidatorPagoESite extends sfValidatorBase {
    
    protected $_apiConection = null;
    
    public function __construct($options = array(), $messages = array()) {
        parent::__construct($options, $messages);
        
        $this->_apiConection = new eSitefApi();
    }

    public function configure($options = array(), $messages = array()) {
        $this->addOption('cc_type_field', 'tipo_tdc');
        $this->addOption('cc_number_field', 'tdc');
        $this->addOption('throw_global_error', false);

        $this->setMessage('invalid', 'El n&uacute;mero de tarjeta de credito es inv&aacute;lido');
        $this->addMessage('server_error', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
        $this->addMessage('server_timeout_error', 'Error de conexi&oacute;n con el servidor del banco, intente nuevamente m&aacute;s tarde');
    }

    protected function doClean($values) {
        $result = $this->_apiConection->eSitefTest($values);
        
        if ($result['timeout']) {
            throw new sfValidatorError($this, 'server_timeout_error');
        }
        
//        if ($this->getOption('throw_global_error')) {
//            throw new sfValidatorError($this, 'invalid');
//        } else {
//            throw new sfValidatorErrorSchema($this, array($this->getOption('cc_number_field') => new sfValidatorError($this, 'invalid')));
//        }
        
        return $values;
    }
    
    protected function _isValidCreditCard($ccnum, $type) {
        if (@preg_match($this->_ccregex[strtolower(trim($type))], $ccnum) == 0) {
            return false;
        }

        return true;
    }
}