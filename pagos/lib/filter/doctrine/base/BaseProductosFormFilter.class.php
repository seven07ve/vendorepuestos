<?php

/**
 * Productos filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subtitulo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto1'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto2'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto3'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_estado'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estado'), 'add_empty' => true)),
      'id_ciudad'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ciudad'), 'add_empty' => true)),
      'condicion'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'precio'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vence'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_categoria'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_menu'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_submenu'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_submenu2'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_paquete_usuario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'usuario_tienda'     => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => '1', 2 => '2'))),
      'id_usuario_tienda'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'fecha_publicacion'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'visitas'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ultima_visita'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'oferta_dia'         => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
      'salt'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'titulo'             => new sfValidatorPass(array('required' => false)),
      'subtitulo'          => new sfValidatorPass(array('required' => false)),
      'foto1'              => new sfValidatorPass(array('required' => false)),
      'foto2'              => new sfValidatorPass(array('required' => false)),
      'foto3'              => new sfValidatorPass(array('required' => false)),
      'descripcion'        => new sfValidatorPass(array('required' => false)),
      'id_estado'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estado'), 'column' => 'id')),
      'id_ciudad'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ciudad'), 'column' => 'id')),
      'condicion'          => new sfValidatorPass(array('required' => false)),
      'precio'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vence'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_categoria'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_menu'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_submenu'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_submenu2'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_paquete_usuario' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'usuario_tienda'     => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => '1', 2 => '2'))),
      'id_usuario_tienda'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'fecha_publicacion'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'visitas'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ultima_visita'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'oferta_dia'         => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
      'salt'               => new sfValidatorPass(array('required' => false)),
      'password'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('productos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Productos';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'titulo'             => 'Text',
      'subtitulo'          => 'Text',
      'foto1'              => 'Text',
      'foto2'              => 'Text',
      'foto3'              => 'Text',
      'descripcion'        => 'Text',
      'id_estado'          => 'ForeignKey',
      'id_ciudad'          => 'ForeignKey',
      'condicion'          => 'Text',
      'precio'             => 'Number',
      'vence'              => 'Date',
      'id_categoria'       => 'Number',
      'id_menu'            => 'Number',
      'id_submenu'         => 'Number',
      'id_submenu2'        => 'Number',
      'id_paquete_usuario' => 'Number',
      'usuario_tienda'     => 'Enum',
      'id_usuario_tienda'  => 'ForeignKey',
      'fecha_publicacion'  => 'Date',
      'visitas'            => 'Number',
      'ultima_visita'      => 'Date',
      'oferta_dia'         => 'Enum',
      'salt'               => 'Text',
      'password'           => 'Text',
    );
  }
}
