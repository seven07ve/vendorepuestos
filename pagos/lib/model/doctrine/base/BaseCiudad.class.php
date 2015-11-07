<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ciudad', 'doctrine');

/**
 * BaseCiudad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_estado
 * @property string $nombre
 * @property Doctrine_Collection $Productos
 * @property Doctrine_Collection $Usuarios
 * 
 * @method integer             getId()        Returns the current record's "id" value
 * @method integer             getIdEstado()  Returns the current record's "id_estado" value
 * @method string              getNombre()    Returns the current record's "nombre" value
 * @method Doctrine_Collection getProductos() Returns the current record's "Productos" collection
 * @method Doctrine_Collection getUsuarios()  Returns the current record's "Usuarios" collection
 * @method Ciudad              setId()        Sets the current record's "id" value
 * @method Ciudad              setIdEstado()  Sets the current record's "id_estado" value
 * @method Ciudad              setNombre()    Sets the current record's "nombre" value
 * @method Ciudad              setProductos() Sets the current record's "Productos" collection
 * @method Ciudad              setUsuarios()  Sets the current record's "Usuarios" collection
 * 
 * @package    ptoventavr
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCiudad extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ciudad');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_estado', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Productos', array(
             'local' => 'id',
             'foreign' => 'id_ciudad'));

        $this->hasMany('Usuario as Usuarios', array(
             'local' => 'id',
             'foreign' => 'id_ciudad'));
    }
}