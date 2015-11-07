<?php

/**
 * Productos2401 filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductos2401FormFilter extends BaseFormFilterDoctrine
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
      'id_estado'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_ciudad'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'condicion'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'precio'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vence'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_categoria'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_menu'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_submenu'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_submenu2'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_paquete_usuario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'usuario_tienda'     => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => '1', 2 => '2'))),
      'id_usuario_tienda'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_publicacion'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'visitas'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'oferta_dia'         => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
    ));

    $this->setValidators(array(
      'titulo'             => new sfValidatorPass(array('required' => false)),
      'subtitulo'          => new sfValidatorPass(array('required' => false)),
      'foto1'              => new sfValidatorPass(array('required' => false)),
      'foto2'              => new sfValidatorPass(array('required' => false)),
      'foto3'              => new sfValidatorPass(array('required' => false)),
      'descripcion'        => new sfValidatorPass(array('required' => false)),
      'id_estado'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_ciudad'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'condicion'          => new sfValidatorPass(array('required' => false)),
      'precio'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vence'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_categoria'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_menu'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_submenu'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_submenu2'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_paquete_usuario' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'usuario_tienda'     => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => '1', 2 => '2'))),
      'id_usuario_tienda'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_publicacion'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'visitas'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'oferta_dia'         => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->widgetSchema->setNameFormat('productos2401_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Productos2401';
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
      'id_estado'          => 'Number',
      'id_ciudad'          => 'Number',
      'condicion'          => 'Text',
      'precio'             => 'Number',
      'vence'              => 'Date',
      'id_categoria'       => 'Number',
      'id_menu'            => 'Number',
      'id_submenu'         => 'Number',
      'id_submenu2'        => 'Number',
      'id_paquete_usuario' => 'Number',
      'usuario_tienda'     => 'Enum',
      'id_usuario_tienda'  => 'Number',
      'fecha_publicacion'  => 'Date',
      'visitas'            => 'Number',
      'oferta_dia'         => 'Enum',
    );
  }
}
