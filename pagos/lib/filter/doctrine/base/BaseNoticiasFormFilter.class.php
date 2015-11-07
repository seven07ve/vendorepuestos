<?php

/**
 * Noticias filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNoticiasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sumario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'texto'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'link'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'titulo'  => new sfValidatorPass(array('required' => false)),
      'sumario' => new sfValidatorPass(array('required' => false)),
      'texto'   => new sfValidatorPass(array('required' => false)),
      'foto'    => new sfValidatorPass(array('required' => false)),
      'link'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('noticias_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Noticias';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'titulo'  => 'Text',
      'sumario' => 'Text',
      'texto'   => 'Text',
      'foto'    => 'Text',
      'link'    => 'Text',
    );
  }
}
