<?php

/**
 * producto actions.
 *
 * @package    ptoventavr
 * @subpackage producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productoActions extends sfActions {
    
    public function executePassword(sfWebRequest $request) {
        $this->producto = $this->getRoute()->getObject();
        
        $this->form = new vrProductoPasswordForm(array('id' => $this->producto->getId()), array('producto' => $this->producto));
        
        if ( $request->isMethod(sfRequest::POST) ) {
            $this->form->bind($request->getParameter('producto'));
            
            if ( $this->form->isValid() ) {
                $this->getUser()->addProductoToEditableList($this->producto);
                
                $routing = sfContext::getInstance()->getRouting();
                
                $this->redirect($routing->generate('producto_edit', array('id' => $this->producto->getId())));
            }
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $producto = $this->getRoute()->getObject();
        
        if (!$this->getUser()->canEdit($producto->getId())) {
            $routing = sfContext::getInstance()->getRouting();
            $this->redirect($routing->generate('producto_password', array('id' => $producto->getId())));
        }

        $this->form = new ProductosForm($producto);

        if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT)) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $formValues = $this->form->getValues();
                if ($producto->getPrecio() >= $formValues['precio']) {
                    $producto = $this->form->save();
                    $url = sfConfig::get('app_serverhost') . '/articulo/' . Util::slugify($producto->getTitulo()) . '/' . $producto->getId();
                    $this->redirect($this->generateUrl('producto_edition_succeded') . '?url=' . urlencode($url));
                }
                else {
                    $oldTarifa = $producto->getTarifa();
                    $newTarifa = Doctrine::getTable('Tarifas')->findOneBy('id',$formValues['id_paquete_usuario']);
                    
                    $data = array_merge($producto->getData(),$formValues);
                    $data['producto_id'] = $data['id'];
                    unset($data['id']);
                    
                    $temp = new ProductoTemporal();
                    $temp->merge($data);
                    $temp->save();
                    
                    $q = Doctrine_Query::create()->from('Productos p')
                            ->addSelect('p.id as producto, u.email as email')
                            ->leftJoin('p.Usuario u ON p.id_usuario_tienda = u.id')
                            ->andWhere('p.id = ?',$data['producto_id']);
                    
                    $result = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY_SHALLOW)->fetchOne();
                    
                    $monto = $newTarifa->getMonto() - $oldTarifa->getMonto();
                    
                    $params = "?email=".$result['email']."&eid=".$temp->getId()."&act=edit&amount=".$monto."&type=product";
                    
                    $url = 'http://pagos.vendorepuestos.com.mx/crear-orden-pago'.$params;
                    
                    $this->redirect($this->generateUrl('producto_update_payment') . '?url=' . urlencode($url) . '&monto=' . $monto);
                }
            }
        }
    }
    
    public function executeUpdatePayment(sfWebRequest $request) {
        $this->url = urldecode($request->getParameter('url'));
        $this->monto = $request->getParameter('monto');
    }

    public function executeSearch(sfWebRequest $request) {
        $this->form = new searchProductoForm();

        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $values = $this->form->getValues();

                $q = Doctrine_Query::create()->from('Productos p');
                $q->leftJoin('p.Usuario u ON p.id_usuario_tienda = u.id');
                $q->addWhere('u.activo = ?', 1);
                $q->addWhere('u.cedula = ?', $values['cedula']);

                if (array_key_exists('producto', $values) && $values['producto']) {
                    $q->addWhere('p.id = ?', $values['producto']);
                }

                $this->productos = $q->execute();
            }
        }
    }
    
    public function executeConfirmacionModificacion(sfWebRequest $request) {
        $this->articulo = $request->getParameter('producto', false);
        $this->tienda = $request->getParameter('tienda', false);
        $this->url = urldecode($request->getParameter('url'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $producto = $form->save();

            $url = sfConfig::get('app_serverhost') . '/articulo/' . Util::slugify($producto->getTitulo()) . '/' . $producto->getId();

            $this->redirect($this->generateUrl('producto_edition_succeded') . '?url=' . urlencode($url));
        }
    }

    public function executePopulateCities(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->getResponse()->setContentType('application/json');

        $cities = Doctrine::getTable('Ciudad')->retrieveByEstado($request->getParameter('value'));

        $data = array();

        foreach ($cities as $city) {
            $data[] = array('optionValue' => $city->getId(), 'optionDisplay' => $city->getNombre());
        }

        return $this->renderText(json_encode($data));
    }

}
