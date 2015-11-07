<?php

/**
 * Usuario filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'telefono1'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono2'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pin'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cedula'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'horario'          => new sfWidgetFormFilterInput(),
      'id_estado'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'), 'add_empty' => true)),
      'id_ciudad'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudad'), 'add_empty' => true)),
      'datos_pago'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datos_envio'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datos_banco'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_activacion' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'certificado'      => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
      'activo'           => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
    ));

    $this->setValidators(array(
      'telefono1'        => new sfValidatorPass(array('required' => false)),
      'telefono2'        => new sfValidatorPass(array('required' => false)),
      'pin'              => new sfValidatorPass(array('required' => false)),
      'cedula'           => new sfValidatorPass(array('required' => false)),
      'nombre'           => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'horario'          => new sfValidatorPass(array('required' => false)),
      'id_estado'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estado'), 'column' => 'id')),
      'id_ciudad'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudad'), 'column' => 'id')),
      'datos_pago'       => new sfValidatorPass(array('required' => false)),
      'datos_envio'      => new sfValidatorPass(array('required' => false)),
      'datos_banco'      => new sfValidatorPass(array('required' => false)),
      'fecha_activacion' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'certificado'      => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
      'activo'           => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->widgetSchema->setNameFormat('usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'telefono1'        => 'Text',
      'telefono2'        => 'Text',
      'pin'              => 'Text',
      'cedula'           => 'Text',
      'nombre'           => 'Text',
      'email'            => 'Text',
      'horario'          => 'Text',
      'id_estado'        => 'ForeignKey',
      'id_ciudad'        => 'ForeignKey',
      'datos_pago'       => 'Text',
      'datos_envio'      => 'Text',
      'datos_banco'      => 'Text',
      'fecha_activacion' => 'Date',
      'certificado'      => 'Enum',
      'activo'           => 'Enum',
    );
  }
}
