<?php

/**
 * Tarifas form base class.
 *
 * @method Tarifas getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTarifasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'total_bs'           => new sfWidgetFormInputText(),
      'cantidad_productos' => new sfWidgetFormInputText(),
      'habilitar'          => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'duracion_dias'      => new sfWidgetFormInputText(),
      'tipo'               => new sfWidgetFormChoice(array('choices' => array('tienda' => 'tienda', 'persona' => 'persona'))),
      'condicion_desde'    => new sfWidgetFormInputText(),
      'condicion_hasta'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 255)),
      'total_bs'           => new sfValidatorNumber(),
      'cantidad_productos' => new sfValidatorInteger(),
      'habilitar'          => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'duracion_dias'      => new sfValidatorInteger(),
      'tipo'               => new sfValidatorChoice(array('choices' => array(0 => 'tienda', 1 => 'persona'))),
      'condicion_desde'    => new sfValidatorInteger(array('required' => false)),
      'condicion_hasta'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tarifas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tarifas';
  }

}
