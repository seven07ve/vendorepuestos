<?php

/**
 * ProductoEspejo form base class.
 *
 * @method ProductoEspejo getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductoEspejoForm extends ProductosForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('producto_espejo[%s]');
  }

  public function getModelName()
  {
    return 'ProductoEspejo';
  }

}
