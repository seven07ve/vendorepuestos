<?php
/**
 * Description of validatorUsuarioProducto
 *
 * @author Jacobo Martinez
 */
class validatorUsuarioProducto extends sfValidatorBase {
    public function configure($options = array(), $messages = array()) {
        $this->addOption('cedula_field', 'cedula');
        $this->addOption('producto_field', 'producto');
        $this->addOption('throw_global_error', true);

        $this->setMessage('invalid', 'No se ha encontrado un art&iacute;culo con los parametros indicados');
        $this->addMessage('invalid_producto', 'No se ha encontrado un art&iacute;culo con el identificador indicado');
        $this->addMessage('invalid_usuario', 'El producto no corresponde con el usuario para la cedula indicada');
    }

    protected function doClean($values) {
        $cedula = isset($values[$this->getOption('cedula_field')]) ? $values[$this->getOption('cedula_field')] : '';

        $idProducto = isset($values[$this->getOption('producto_field')]) ? $values[$this->getOption('producto_field')] : '';
        
        if (!$cedula || !$idProducto) {
            if ($this->getOption('throw_global_error')) {
                throw new sfValidatorError($this, 'invalid');
            } else {
                throw new sfValidatorErrorSchema($this, array($this->getOption('cedula_field') => new sfValidatorError($this, 'invalid')));
            }
        }
        
        if (!$producto = Doctrine::getTable('Productos')->findOneById($idProducto)) {
            if ($this->getOption('throw_global_error')) {
                throw new sfValidatorError($this, 'invalid_producto');
            } else {
                throw new sfValidatorErrorSchema($this, array($this->getOption('producto_field') => new sfValidatorError($this, 'invalid_producto')));
            }
        }
        
        if (!$this->productoCorrespondeUsuario($producto, $cedula)) {
            if ($this->getOption('throw_global_error')) {
                throw new sfValidatorError($this, 'invalid_usuario');
            } else {
                throw new sfValidatorErrorSchema($this, array($this->getOption('cedula_field') => new sfValidatorError($this, 'invalid_usuario')));
            }
        }
        
        return array_merge($values, array('prod' => $producto));
    }
    
    protected function productoCorrespondeUsuario(Productos $producto, $cedula) {
        $usuario = Doctrine::getTable('Usuario')->findOneById($producto->getIdUsuarioTienda());
        
        if (strcasecmp($usuario->getCedula(), $cedula) == 0) {
            return true;
        }
        
        return false;
    }
}