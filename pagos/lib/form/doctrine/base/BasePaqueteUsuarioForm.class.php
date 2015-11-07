<?php

/**
 * PaqueteUsuario form base class.
 *
 * @method PaqueteUsuario getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePaqueteUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_paquete'       => new sfWidgetFormInputText(),
      'id_usuario'       => new sfWidgetFormInputText(),
      'usuario_tienda'   => new sfWidgetFormChoice(array('choices' => array(1 => '1', 2 => '2'))),
      'fecha_activacion' => new sfWidgetFormDateTime(),
      'estado'           => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'monto'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_paquete'       => new sfValidatorInteger(),
      'id_usuario'       => new sfValidatorInteger(),
      'usuario_tienda'   => new sfValidatorChoice(array('choices' => array(0 => '1', 1 => '2'))),
      'fecha_activacion' => new sfValidatorDateTime(),
      'estado'           => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'monto'            => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('paquete_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaqueteUsuario';
  }

}
