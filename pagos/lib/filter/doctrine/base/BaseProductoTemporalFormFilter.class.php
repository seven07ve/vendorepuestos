<?php

/**
 * ProductoTemporal filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoTemporalFormFilter extends ProductosFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['productos_id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['productos_id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['producto_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true));
    $this->validatorSchema['producto_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('producto_temporal_filters[%s]');
  }

  public function getModelName()
  {
    return 'ProductoTemporal';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'productos_id' => 'Number',
      'producto_id' => 'ForeignKey',
    ));
  }
}
