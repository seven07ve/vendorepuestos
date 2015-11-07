<?php

/**
 * Usuario form.
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vrEmbeddedUsuarioForm extends UsuarioForm {

    public function configure() {
        parent::configure();
       
        unset($this['id'],$this['fecha_activacion'],$this['certificado'],$this['activo']);
        
        $this->widgetSchema['datos_pago'] = new sfWidgetFormDoctrineChoice(array('model' => 'MedioPago', 'add_empty' => false, 'multiple' => true, 'expanded' => true, 'renderer_class' => 'sfWidgetFormSelectCheckboxFromString'));
        $this->validatorSchema['datos_pago'] = new sfValidatorDoctrineChoiceToString(array('model' => 'MedioPago', 'multiple' => true));
        
        $this->widgetSchema['datos_envio'] = new sfWidgetFormDoctrineChoice(array('model' => 'MedioPago', 'add_empty' => false, 'multiple' => true, 'expanded' => true, 'renderer_class' => 'sfWidgetFormSelectCheckboxFromString'));
        $this->validatorSchema['datos_envio'] = new sfValidatorDoctrineChoiceToString(array('model' => 'MedioEnvio', 'multiple' => true));
        
        $this->widgetSchema['datos_banco'] = new sfWidgetFormDoctrineChoice(array('model' => 'MedioPago', 'add_empty' => false, 'multiple' => true, 'expanded' => true, 'renderer_class' => 'sfWidgetFormSelectCheckboxFromString'));
        $this->validatorSchema['datos_banco'] = new sfValidatorDoctrineChoiceToString(array('model' => 'Banco', 'multiple' => true));
        
        $this->validatorSchema['telefono2']->setOption('required',false);
        $this->validatorSchema['pin']->setOption('required',false);
    }
}