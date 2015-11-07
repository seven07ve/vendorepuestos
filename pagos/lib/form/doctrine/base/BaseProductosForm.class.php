<?php

/**
 * Productos form base class.
 *
 * @method Productos getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'titulo'             => new sfWidgetFormInputText(),
      'subtitulo'          => new sfWidgetFormInputText(),
      'foto1'              => new sfWidgetFormInputText(),
      'foto2'              => new sfWidgetFormInputText(),
      'foto3'              => new sfWidgetFormInputText(),
      'descripcion'        => new sfWidgetFormTextarea(),
      'id_estado'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'), 'add_empty' => false)),
      'id_ciudad'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudad'), 'add_empty' => false)),
      'condicion'          => new sfWidgetFormInputText(),
      'precio'             => new sfWidgetFormInputText(),
      'vence'              => new sfWidgetFormDate(),
      'id_categoria'       => new sfWidgetFormInputText(),
      'id_menu'            => new sfWidgetFormInputText(),
      'id_submenu'         => new sfWidgetFormInputText(),
      'id_submenu2'        => new sfWidgetFormInputText(),
      'id_paquete_usuario' => new sfWidgetFormInputText(),
      'usuario_tienda'     => new sfWidgetFormChoice(array('choices' => array(1 => '1', 2 => '2'))),
      'id_usuario_tienda'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'fecha_publicacion'  => new sfWidgetFormDateTime(),
      'visitas'            => new sfWidgetFormInputText(),
      'ultima_visita'      => new sfWidgetFormDateTime(),
      'oferta_dia'         => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'salt'               => new sfWidgetFormInputText(),
      'password'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'             => new sfValidatorString(array('max_length' => 255)),
      'subtitulo'          => new sfValidatorString(array('max_length' => 255)),
      'foto1'              => new sfValidatorString(array('max_length' => 100)),
      'foto2'              => new sfValidatorString(array('max_length' => 100)),
      'foto3'              => new sfValidatorString(array('max_length' => 100)),
      'descripcion'        => new sfValidatorString(),
      'id_estado'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'))),
      'id_ciudad'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudad'))),
      'condicion'          => new sfValidatorString(array('max_length' => 16)),
      'precio'             => new sfValidatorNumber(),
      'vence'              => new sfValidatorDate(),
      'id_categoria'       => new sfValidatorInteger(),
      'id_menu'            => new sfValidatorInteger(),
      'id_submenu'         => new sfValidatorInteger(),
      'id_submenu2'        => new sfValidatorInteger(),
      'id_paquete_usuario' => new sfValidatorInteger(),
      'usuario_tienda'     => new sfValidatorChoice(array('choices' => array(0 => '1', 1 => '2'))),
      'id_usuario_tienda'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'fecha_publicacion'  => new sfValidatorDateTime(),
      'visitas'            => new sfValidatorInteger(),
      'ultima_visita'      => new sfValidatorDateTime(array('required' => false)),
      'oferta_dia'         => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'))),
      'salt'               => new sfValidatorString(array('max_length' => 255)),
      'password'           => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('productos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Productos';
  }

}
