<?php

/**
 * Tarifas filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTarifasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total_bs'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad_productos' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'habilitar'          => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
      'duracion_dias'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'tienda' => 'tienda', 'persona' => 'persona'))),
      'condicion_desde'    => new sfWidgetFormFilterInput(),
      'condicion_hasta'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'total_bs'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad_productos' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'habilitar'          => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
      'duracion_dias'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'               => new sfValidatorChoice(array('required' => false, 'choices' => array('tienda' => 'tienda', 'persona' => 'persona'))),
      'condicion_desde'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'condicion_hasta'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('tarifas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tarifas';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nombre'             => 'Text',
      'total_bs'           => 'Number',
      'cantidad_productos' => 'Number',
      'habilitar'          => 'Enum',
      'duracion_dias'      => 'Number',
      'tipo'               => 'Enum',
      'condicion_desde'    => 'Number',
      'condicion_hasta'    => 'Number',
    );
  }
}
