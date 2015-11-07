<?php

/**
 * Usuario form base class.
 *
 * @method Usuario getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'telefono1'        => new sfWidgetFormInputText(),
      'telefono2'        => new sfWidgetFormInputText(),
      'pin'              => new sfWidgetFormInputText(),
      'cedula'           => new sfWidgetFormInputText(),
      'nombre'           => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'horario'          => new sfWidgetFormInputText(),
      'id_estado'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'), 'add_empty' => false)),
      'id_ciudad'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudad'), 'add_empty' => false)),
      'datos_pago'       => new sfWidgetFormInputText(),
      'datos_envio'      => new sfWidgetFormInputText(),
      'datos_banco'      => new sfWidgetFormInputText(),
      'fecha_activacion' => new sfWidgetFormDateTime(),
      'certificado'      => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'activo'           => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'telefono1'        => new sfValidatorString(array('max_length' => 50)),
      'telefono2'        => new sfValidatorString(array('max_length' => 50)),
      'pin'              => new sfValidatorString(array('max_length' => 10)),
      'cedula'           => new sfValidatorString(array('max_length' => 15)),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'email'            => new sfValidatorString(array('max_length' => 255)),
      'horario'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_estado'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'))),
      'id_ciudad'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudad'))),
      'datos_pago'       => new sfValidatorString(array('max_length' => 100)),
      'datos_envio'      => new sfValidatorString(array('max_length' => 100)),
      'datos_banco'      => new sfValidatorString(array('max_length' => 100)),
      'fecha_activacion' => new sfValidatorDateTime(),
      'certificado'      => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'activo'           => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}
