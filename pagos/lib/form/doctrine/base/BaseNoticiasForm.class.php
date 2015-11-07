<?php

/**
 * Noticias form base class.
 *
 * @method Noticias getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNoticiasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'titulo'  => new sfWidgetFormInputText(),
      'sumario' => new sfWidgetFormTextarea(),
      'texto'   => new sfWidgetFormTextarea(),
      'foto'    => new sfWidgetFormInputText(),
      'link'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'  => new sfValidatorString(array('max_length' => 255)),
      'sumario' => new sfValidatorString(),
      'texto'   => new sfValidatorString(),
      'foto'    => new sfValidatorString(array('max_length' => 100)),
      'link'    => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('noticias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Noticias';
  }

}
