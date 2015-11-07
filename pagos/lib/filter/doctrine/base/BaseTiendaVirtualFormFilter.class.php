<?php

/**
 * TiendaVirtual filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTiendaVirtualFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clave'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rif'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre_oficial'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'razon_social'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono1'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono2'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pin'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_estado'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_ciudad'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'latitud'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'longitud'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logo'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto1'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto2'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto3'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pagina_web'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'facebook'               => new sfWidgetFormFilterInput(),
      'twitter'                => new sfWidgetFormFilterInput(),
      'email'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'horario'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datos_pago'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datos_envio'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datos_banco'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color_titulo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color_fondo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'color_contenido'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'persona_mantenimiento'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono_mantenimiento' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email_mantenimiento'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_activacion'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'activo'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => '0', 1 => '1'))),
    ));

    $this->setValidators(array(
      'usuario'                => new sfValidatorPass(array('required' => false)),
      'clave'                  => new sfValidatorPass(array('required' => false)),
      'rif'                    => new sfValidatorPass(array('required' => false)),
      'nombre_oficial'         => new sfValidatorPass(array('required' => false)),
      'razon_social'           => new sfValidatorPass(array('required' => false)),
      'telefono1'              => new sfValidatorPass(array('required' => false)),
      'telefono2'              => new sfValidatorPass(array('required' => false)),
      'pin'                    => new sfValidatorPass(array('required' => false)),
      'id_estado'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_ciudad'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'direccion'              => new sfValidatorPass(array('required' => false)),
      'latitud'                => new sfValidatorPass(array('required' => false)),
      'longitud'               => new sfValidatorPass(array('required' => false)),
      'logo'                   => new sfValidatorPass(array('required' => false)),
      'foto1'                  => new sfValidatorPass(array('required' => false)),
      'foto2'                  => new sfValidatorPass(array('required' => false)),
      'foto3'                  => new sfValidatorPass(array('required' => false)),
      'pagina_web'             => new sfValidatorPass(array('required' => false)),
      'facebook'               => new sfValidatorPass(array('required' => false)),
      'twitter'                => new sfValidatorPass(array('required' => false)),
      'email'                  => new sfValidatorPass(array('required' => false)),
      'descripcion'            => new sfValidatorPass(array('required' => false)),
      'horario'                => new sfValidatorPass(array('required' => false)),
      'datos_pago'             => new sfValidatorPass(array('required' => false)),
      'datos_envio'            => new sfValidatorPass(array('required' => false)),
      'datos_banco'            => new sfValidatorPass(array('required' => false)),
      'color_titulo'           => new sfValidatorPass(array('required' => false)),
      'color_fondo'            => new sfValidatorPass(array('required' => false)),
      'color_contenido'        => new sfValidatorPass(array('required' => false)),
      'persona_mantenimiento'  => new sfValidatorPass(array('required' => false)),
      'telefono_mantenimiento' => new sfValidatorPass(array('required' => false)),
      'email_mantenimiento'    => new sfValidatorPass(array('required' => false)),
      'fecha_activacion'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'activo'                 => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->widgetSchema->setNameFormat('tienda_virtual_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TiendaVirtual';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'usuario'                => 'Text',
      'clave'                  => 'Text',
      'rif'                    => 'Text',
      'nombre_oficial'         => 'Text',
      'razon_social'           => 'Text',
      'telefono1'              => 'Text',
      'telefono2'              => 'Text',
      'pin'                    => 'Text',
      'id_estado'              => 'Number',
      'id_ciudad'              => 'Number',
      'direccion'              => 'Text',
      'latitud'                => 'Text',
      'longitud'               => 'Text',
      'logo'                   => 'Text',
      'foto1'                  => 'Text',
      'foto2'                  => 'Text',
      'foto3'                  => 'Text',
      'pagina_web'             => 'Text',
      'facebook'               => 'Text',
      'twitter'                => 'Text',
      'email'                  => 'Text',
      'descripcion'            => 'Text',
      'horario'                => 'Text',
      'datos_pago'             => 'Text',
      'datos_envio'            => 'Text',
      'datos_banco'            => 'Text',
      'color_titulo'           => 'Text',
      'color_fondo'            => 'Text',
      'color_contenido'        => 'Text',
      'persona_mantenimiento'  => 'Text',
      'telefono_mantenimiento' => 'Text',
      'email_mantenimiento'    => 'Text',
      'fecha_activacion'       => 'Date',
      'activo'                 => 'Enum',
    );
  }
}
