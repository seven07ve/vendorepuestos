<?php

/**
 * Description of sfValidatorDoctrineChoiceToString
 *
 * @author Jacobo Martinez
 */
class sfValidatorDoctrineChoiceToString extends sfValidatorDoctrineChoice {

    protected function configure($options = array(), $messages = array()) {
        parent::configure();
    }
    
    protected function doClean($value) {
        $value = parent::doClean($value);
        
        if (!is_array($value)) {
            $value = array($value);
        }
        
        return implode(',', $value);
    }
}