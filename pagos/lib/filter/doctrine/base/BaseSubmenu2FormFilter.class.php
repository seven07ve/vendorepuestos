<?php

/**
 * Submenu2 filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSubmenu2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_categoria' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_menu'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_submenu'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_categoria' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_menu'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_submenu'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'orden'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('submenu2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Submenu2';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_categoria' => 'Number',
      'id_menu'      => 'Number',
      'id_submenu'   => 'Number',
      'nombre'       => 'Text',
      'orden'        => 'Number',
    );
  }
}
