<?php
/**
 * Description of eSiteForm
 *
 * @author Jacobo Martinez
 */
class eSiteFormTienda extends eSiteForm {
    public function configure() {
        parent::configure();
        
        unset($this['paquete']);
        
        $this->widgetSchema['tienda'] = new sfWidgetFormInputHidden(array(),array('data-bvalidator' => 'required','data-bvalidator-msg' => 'Numero de paquete inv&aacute;lido.'));        
        $this->validatorSchema['tienda'] = new sfValidatorDoctrineChoice(array('model' => 'TiendaVirtual'), array());
    }
}

?>
