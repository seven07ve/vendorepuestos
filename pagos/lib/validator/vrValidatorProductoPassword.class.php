<?php

/**
 * Description of vrValidatorProductoPassword
 *
 * @author jacobomartinez
 */
class vrValidatorProductoPassword extends sfValidatorBase {

    public function configure($options = array(), $messages = array()) {
        $this->addOption('id_field', 'id');
        $this->addOption('password_field', 'password');
        $this->addOption('throw_global_error', false);

        $this->setMessage('invalid', 'La contrase&ntilde;a es inv&aacute;lida.');
    }

    protected function doClean($values) {
        $productoId = isset($values[$this->getOption('id_field')]) ? $values[$this->getOption('id_field')] : '';
        $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';

        // don't allow to sign in with an empty producto
        if ($productoId) {
            $producto = $this->getTable()->findOneById($productoId);
            
            // producto exists?
            if ($producto) {
                // password is ok?
                if ($producto->checkPassword($password)) {
                    return array_merge($values, array('producto' => $producto));
                }
            }
        }

        if ($this->getOption('throw_global_error')) {
            throw new sfValidatorError($this, 'invalid');
        }

        throw new sfValidatorErrorSchema($this, array($this->getOption('password_field') => new sfValidatorError($this, 'invalid')));
    }

    protected function getTable() {
        return Doctrine::getTable('Productos');
    }

}