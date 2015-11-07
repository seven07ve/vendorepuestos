<?php

/**
 * ProductoTemporal form base class.
 *
 * @method ProductoTemporal getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductoTemporalForm extends ProductosForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['productos_id'] = new sfWidgetFormInputText();
    $this->validatorSchema['productos_id'] = new sfValidatorInteger();

    $this->widgetSchema   ['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false));

    $this->widgetSchema->setNameFormat('producto_temporal[%s]');
  }

  public function getModelName()
  {
    return 'ProductoTemporal';
  }

}
