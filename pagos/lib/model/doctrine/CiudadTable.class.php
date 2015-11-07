<?php

/**
 * CiudadTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CiudadTable extends Doctrine_Table {
    
    public function addByEstadoQuery($estadoId, Doctrine_Query $q = null) {
        if (is_null($q)) {
            $q = Doctrine_Query::create()->from('Ciudad c');
        }
        
        $alias = $q->getRootAlias();
        
        $q->addWhere($alias.'.id_estado = ?', $estadoId);
        
        return $q;
    }
    
    public function addAlphabeticOrderByNombreQuery(Doctrine_Query $q = null) {
        if (is_null($q)) {
            $q = Doctrine_Query::create()->from('Ciudad c');
        }
        
        $alias = $q->getRootAlias();
        
        $q->addOrderBy($alias.'.nombre ASC');
        
        return $q;
    }
    
    public function getByEstadoQuery($estadoId) {
        $q = $this->addByEstadoQuery($estadoId,$this->addAlphabeticOrderByNombreQuery());
        
        return $q;
    }
    
    public function retrieveByEstado($estadoId) {
        return $this->getByEstadoQuery($estadoId)->execute();
    }

    /**
     * Returns an instance of this class.
     *
     * @return object CiudadTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Ciudad');
    }

}