<?php

/**
 * Submenu2 form base class.
 *
 * @method Submenu2 getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSubmenu2Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_categoria' => new sfWidgetFormInputText(),
      'id_menu'      => new sfWidgetFormInputText(),
      'id_submenu'   => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'orden'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_categoria' => new sfValidatorInteger(),
      'id_menu'      => new sfValidatorInteger(),
      'id_submenu'   => new sfValidatorInteger(),
      'nombre'       => new sfValidatorString(array('max_length' => 255)),
      'orden'        => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('submenu2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Submenu2';
  }

}
