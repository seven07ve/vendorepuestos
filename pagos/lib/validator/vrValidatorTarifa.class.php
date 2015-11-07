<?php
/**
 * Description of vrValidatorTarifa
 *
 * @author Jacobo Martinez
 */
class vrValidatorTarifa extends sfValidatorBase {
    public function configure($options = array(), $messages = array()) {
        $this->addOption('precio_field', 'precio');
        $this->addOption('tarifa_field', 'id_paquete_usuario');
        $this->addOption('throw_global_error', true);
    }

    protected function doClean($values) {
        $precio = isset($values[$this->getOption('precio_field')]) ? $values[$this->getOption('precio_field')] : '';
        
        if (!$precio) {
            throw new sfValidatorError($this, 'invalid');
        }
        
        if (!$tarifa = $this->obtenerTarifa($precio)) {
            if ($this->getOption('throw_global_error')) {
                throw new sfValidatorError($this, 'invalid_precio');
            } else {
                throw new sfValidatorErrorSchema($this, array($this->getOption('precio_field') => new sfValidatorError($this, 'invalid_precio')));
            }
        }
        
        return array_merge($values, array($this->getOption('tarifa_field') => $tarifa->getId()));
    }
    
    protected function obtenerTarifa($precio) {
        return Doctrine::getTable('Tarifas')->retrieveByPrecioAndTipo($precio,'persona');
    }
}