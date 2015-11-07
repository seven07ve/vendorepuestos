<?php

/**
 * Usuario form.
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm {

    public function configure() {
        
        $this->widgetSchema['cedula'] = new sfWidgetFormInputText(array(), array('data-bvalidator' => 'validateregex,required','data-bvalidator-msg' => 'Indique su documento de indentidad en formato V-000000'));
        $this->validatorSchema['cedula'] = new sfValidatorRegex(array('pattern' => '/^(V|J)-[0-9]+$/'), array('required' => 'Campo Obligatorio', 'invalid' => 'Indique su documento de indentidad en formato V-000000'));
        
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array(),array('data-bvalidator' => 'email,required','data-bvalidator-msg' => 'Indique su correo electr&oacute;nico, ejemplo: correo@mail.com'));
        $this->validatorSchema['email'] = new sfValidatorEmail(array(),array('required' => 'Campo Obligatorio', 'invalid' => 'Indique su email en formato correo@ejemplo.com'));
        
//        $this->widgetSchema['email_confirm'] = new sfWidgetFormInputText(array(),array('data-bvalidator' => 'email,required','data-bvalidator-msg' => 'Indique su correo electr&oacute;nico, ejemplo: correo@mail.com'));
//        $this->validatorSchema['email_confirm'] = new sfValidatorEmail(array(),array('required' => 'Campo Obligatorio', 'invalid' => 'Indique su email en formato correo@ejemplo.com'));
        
        $this->widgetSchema['id_estado'] = new sfWidgetFormDoctrineChoice(
                array('model' => $this->getRelatedModelName('Estado'), 'table_method' => 'getAlphabeticOrderQuery','add_empty' => true),
                array('id' => 'usuario_estado')
            );
        $this->validatorSchema['id_estado']->setMessage('required','Campo Obligatorio');
        $this->validatorSchema['id_estado']->setMessage('invalid','Identificador de Estado desconocido');
        
        $this->widgetSchema['id_ciudad'] = new sfWidgetFormDoctrineChoice(
                array('model' => $this->getRelatedModelName('Ciudad'), 'query' => Doctrine::getTable('Ciudad')->getByEstadoQuery($this->getObject()->getIdEstado()),'add_empty' => true),
                array('id' => 'usuario_ciudad')
            );
        $this->validatorSchema['id_ciudad']->setMessage('required','Campo Obligatorio');
        $this->validatorSchema['id_ciudad']->setMessage('invalid','Identificador de Ciudad desconocido');
        
        $this->widgetSchema['datos_pago'] = new sfWidgetFormDoctrineChoice(array('model' => 'MedioPago', 'add_empty' => false, 'multiple' => true, 'expanded' => true));
        $this->validatorSchema['datos_pago'] = new sfValidatorDoctrineChoice(array('model' => 'MedioPago', 'multiple' => true, 'required' => false));
        
        $this->widgetSchema['datos_envio'] = new sfWidgetFormDoctrineChoice(array('model' => 'MedioEnvio', 'add_empty' => false, 'multiple' => true, 'expanded' => true));
        $this->validatorSchema['datos_envio'] = new sfValidatorDoctrineChoice(array('model' => 'MedioEnvio', 'multiple' => true, 'required' => false));
        
        $this->widgetSchema['datos_banco'] = new sfWidgetFormDoctrineChoice(array('model' => 'Banco', 'add_empty' => false, 'multiple' => true, 'expanded' => true));
        $this->validatorSchema['datos_banco'] = new sfValidatorDoctrineChoice(array('model' => 'Banco', 'multiple' => true, 'required' => false));
        
        $this->widgetSchema->moveField('nombre', sfWidgetFormSchema::FIRST);
        
        $this->widgetSchema->moveField('cedula', sfWidgetFormSchema::AFTER, 'nombre');
        
        $this->widgetSchema->moveField('id_estado', sfWidgetFormSchema::AFTER, 'pin');
        
        $this->widgetSchema->moveField('id_ciudad', sfWidgetFormSchema::AFTER, 'id_estado');
        
        //$this->widgetSchema->moveField('email_confirm', sfWidgetFormSchema::AFTER, 'email');
        
        $this->widgetSchema->setLabels(array(
            'id_estado'     => 'Estado',
            'id_ciudad'     => 'Ciudad',
            'cedula'        => 'Documento de Identidad',
            'telefono1'     => 'Tel&eacute;fono 1',
            'telefono2'     => 'Tel&eacute;fono 2',
            'pin'           => 'Pin BB',
            'horario'       => 'Horario de Atenci&oacute;n al P&uacute;blico',
        ));
        
//        $postValidator = $this->validatorSchema->getPostValidator();
//
//        $postValidators = $this->getPostValidators();
//
//        if ($postValidator) {
//            $postValidators[] = $postValidator;
//        }
//
//        $this->validatorSchema->setPostValidator(new sfValidatorAnd($postValidators));
    }
    
    public function getPostValidators() {
        $validators = array();
        
        $validators[] = new sfValidatorSchemaCompare('email_confirm', sfValidatorSchemaCompare::EQUAL, 'email', array(), array('invalid' => 'Los emails no coinciden.'));
        
        return $validators;
    }
}
