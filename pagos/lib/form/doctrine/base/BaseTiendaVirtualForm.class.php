<?php

/**
 * TiendaVirtual form base class.
 *
 * @method TiendaVirtual getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTiendaVirtualForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'usuario'                => new sfWidgetFormInputText(),
      'clave'                  => new sfWidgetFormInputText(),
      'rif'                    => new sfWidgetFormInputText(),
      'nombre_oficial'         => new sfWidgetFormInputText(),
      'razon_social'           => new sfWidgetFormInputText(),
      'telefono1'              => new sfWidgetFormInputText(),
      'telefono2'              => new sfWidgetFormInputText(),
      'pin'                    => new sfWidgetFormInputText(),
      'id_estado'              => new sfWidgetFormInputText(),
      'id_ciudad'              => new sfWidgetFormInputText(),
      'direccion'              => new sfWidgetFormInputText(),
      'latitud'                => new sfWidgetFormInputText(),
      'longitud'               => new sfWidgetFormInputText(),
      'logo'                   => new sfWidgetFormInputText(),
      'foto1'                  => new sfWidgetFormInputText(),
      'foto2'                  => new sfWidgetFormInputText(),
      'foto3'                  => new sfWidgetFormInputText(),
      'pagina_web'             => new sfWidgetFormInputText(),
      'facebook'               => new sfWidgetFormTextarea(),
      'twitter'                => new sfWidgetFormInputText(),
      'email'                  => new sfWidgetFormInputText(),
      'descripcion'            => new sfWidgetFormTextarea(),
      'horario'                => new sfWidgetFormTextarea(),
      'datos_pago'             => new sfWidgetFormInputText(),
      'datos_envio'            => new sfWidgetFormInputText(),
      'datos_banco'            => new sfWidgetFormInputText(),
      'color_titulo'           => new sfWidgetFormInputText(),
      'color_fondo'            => new sfWidgetFormInputText(),
      'color_contenido'        => new sfWidgetFormInputText(),
      'persona_mantenimiento'  => new sfWidgetFormInputText(),
      'telefono_mantenimiento' => new sfWidgetFormInputText(),
      'email_mantenimiento'    => new sfWidgetFormInputText(),
      'fecha_activacion'       => new sfWidgetFormDateTime(),
      'activo'                 => new sfWidgetFormChoice(array('choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'usuario'                => new sfValidatorString(array('max_length' => 20)),
      'clave'                  => new sfValidatorString(array('max_length' => 20)),
      'rif'                    => new sfValidatorString(array('max_length' => 20)),
      'nombre_oficial'         => new sfValidatorString(array('max_length' => 255)),
      'razon_social'           => new sfValidatorString(array('max_length' => 255)),
      'telefono1'              => new sfValidatorString(array('max_length' => 20)),
      'telefono2'              => new sfValidatorString(array('max_length' => 20)),
      'pin'                    => new sfValidatorString(array('max_length' => 10)),
      'id_estado'              => new sfValidatorInteger(),
      'id_ciudad'              => new sfValidatorInteger(),
      'direccion'              => new sfValidatorString(array('max_length' => 255)),
      'latitud'                => new sfValidatorString(array('max_length' => 25)),
      'longitud'               => new sfValidatorString(array('max_length' => 25)),
      'logo'                   => new sfValidatorString(array('max_length' => 100)),
      'foto1'                  => new sfValidatorString(array('max_length' => 100)),
      'foto2'                  => new sfValidatorString(array('max_length' => 100)),
      'foto3'                  => new sfValidatorString(array('max_length' => 100)),
      'pagina_web'             => new sfValidatorString(array('max_length' => 255)),
      'facebook'               => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'twitter'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'                  => new sfValidatorString(array('max_length' => 100)),
      'descripcion'            => new sfValidatorString(),
      'horario'                => new sfValidatorString(),
      'datos_pago'             => new sfValidatorString(array('max_length' => 100)),
      'datos_envio'            => new sfValidatorString(array('max_length' => 100)),
      'datos_banco'            => new sfValidatorString(array('max_length' => 100)),
      'color_titulo'           => new sfValidatorString(array('max_length' => 10)),
      'color_fondo'            => new sfValidatorString(array('max_length' => 10)),
      'color_contenido'        => new sfValidatorString(array('max_length' => 10)),
      'persona_mantenimiento'  => new sfValidatorString(array('max_length' => 100)),
      'telefono_mantenimiento' => new sfValidatorString(array('max_length' => 100)),
      'email_mantenimiento'    => new sfValidatorString(array('max_length' => 100)),
      'fecha_activacion'       => new sfValidatorDateTime(),
      'activo'                 => new sfValidatorChoice(array('choices' => array(0 => '0', 1 => '1'))),
    ));

    $this->widgetSchema->setNameFormat('tienda_virtual[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TiendaVirtual';
  }

}
