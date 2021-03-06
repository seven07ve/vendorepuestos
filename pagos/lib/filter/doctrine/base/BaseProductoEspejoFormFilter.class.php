<?php

/**
 * ProductoEspejo filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoEspejoFormFilter extends ProductosFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('producto_espejo_filters[%s]');
  }

  public function getModelName()
  {
    return 'ProductoEspejo';
  }
}
