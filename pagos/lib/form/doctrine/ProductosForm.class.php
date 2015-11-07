<?php

/**
 * Productos form.
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductosForm extends BaseProductosForm {
    public function configure() {
        unset(
            $this['vence'],$this['fecha_publicacion'],$this['visitas'],$this['ultima_visita'],
            $this['id_categoria'],$this['id_menu'],$this['id_submenu'],$this['id_submenu2'],
            $this['usuario_tienda'], $this['id_usuario_tienda'], $this['oferta_dia'], $this['salt'],
            $this['password']
        );
        
        $this->widgetSchema['id_paquete_usuario'] = new sfWidgetFormInputHidden();
        
        $this->validatorSchema['subtitulo']->setOption('required',false);
        
        $this->widgetSchema['descripcion'] = new sfWidgetFormTextareaTinyMCE();
        
        $options = array('nuevo' => 'Nuevo', 'remanufacturado' => 'Remanufacturado', 'usado' => 'Usado');
        
        $this->widgetSchema['condicion'] = new sfWidgetFormChoice(array('choices' => $options));
        
        $this->validatorSchema['condicion'] = new sfValidatorChoice(array('choices' => array_keys($options)));
        
        $this->validatorSchema['precio']->setOption('min',0);
        $this->validatorSchema['precio']->setMessage('min','El precio debe ser mayor que 0');
        $this->validatorSchema['precio']->setMessage('invalid', '"%value%" no es un n&uacute;mero.');
        
        $this->widgetSchema['foto1'] = new sfWidgetFormInputFileEditable(array(
                'is_image' => true,
                'file_src' => sfConfig::get('app_serverhost').'/productos/'.$this->getObject()->getFoto1(),
                'with_delete' => false,
                'edit_mode'   => !$this->getObject()->isNew()
            ));

        $this->validatorSchema['foto1'] = new sfValidatorFile(array(
                    'required' => false,
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_root_dir').'/../productos',
                ));
        
        $this->widgetSchema['foto2'] = new sfWidgetFormInputFileEditable(array(
                'is_image' => true,
                'file_src' => sfConfig::get('app_serverhost').'/productos/'.$this->getObject()->getFoto2(),
                'with_delete' => false,
                'edit_mode'   => !$this->getObject()->isNew()
            ));

        $this->validatorSchema['foto2'] = new sfValidatorFile(array(
                    'required' => false,
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_root_dir').'/../productos',
                ));
        
        $this->widgetSchema['foto3'] = new sfWidgetFormInputFileEditable(array(
                'is_image' => true,
                'file_src' => sfConfig::get('app_serverhost').'/productos/'.$this->getObject()->getFoto3(),
                'with_delete' => false,
                'edit_mode'   => !$this->getObject()->isNew()
            ));

        $this->validatorSchema['foto3'] = new sfValidatorFile(array(
                    'required' => false,
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_root_dir').'/../productos',
                ));
        
        $this->widgetSchema['id_estado'] = new sfWidgetFormDoctrineChoice(
                array('model' => $this->getRelatedModelName('Estado'), 'table_method' => 'getAlphabeticOrderQuery','add_empty' => false), 
                array('id' => 'producto_estado')
            );
        $this->widgetSchema['id_ciudad'] = new sfWidgetFormDoctrineChoice(
                array('model' => $this->getRelatedModelName('Ciudad'), 'query' => Doctrine::getTable('Ciudad')->getByEstadoQuery($this->getObject()->getIdEstado()),'add_empty' => false),
                array('id' => 'producto_ciudad')
            );
        
        $this->widgetSchema->moveField('id_estado', sfWidgetFormSchema::AFTER, 'descripcion');
        $this->widgetSchema->moveField('id_ciudad', sfWidgetFormSchema::AFTER, 'id_estado');
        
        $this->widgetSchema->setLabels(array(
            'descripcion' => 'Descripci&oacute;n',
            'condicion' => 'Condici&oacute;n',
            'id_estado' => 'Estado de ubicaci&oacute;n',
            'id_ciudad' => 'Ciudad de ubicaci&oacute;n',
        ));
        
        $this->embedRelation('Usuario AS usuario', 'vrEmbeddedUsuarioForm');
        
        $this->validatorSchema->setPostValidator(new vrValidatorTarifa());
    }
}