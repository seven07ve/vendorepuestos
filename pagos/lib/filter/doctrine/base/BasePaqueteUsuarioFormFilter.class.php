<?php

/**
 * PaqueteUsuario filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePaqueteUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_paquete'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_usuario'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'usuario_tienda'   => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => '1', 2 => '2'))),
      'fecha_activacion' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'estado'           => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
      'monto'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_paquete'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_usuario'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'usuario_tienda'   => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => '1', 2 => '2'))),
      'fecha_activacion' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'estado'           => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
      'monto'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('paquete_usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaqueteUsuario';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_paquete'       => 'Number',
      'id_usuario'       => 'Number',
      'usuario_tienda'   => 'Enum',
      'fecha_activacion' => 'Date',
      'estado'           => 'Enum',
      'monto'            => 'Number',
    );
  }
}
