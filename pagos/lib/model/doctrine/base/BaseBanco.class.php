<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Banco', 'doctrine');

/**
 * BaseBanco
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $logo
 * 
 * @method integer getId()     Returns the current record's "id" value
 * @method string  getNombre() Returns the current record's "nombre" value
 * @method string  getLogo()   Returns the current record's "logo" value
 * @method Banco   setId()     Sets the current record's "id" value
 * @method Banco   setNombre() Sets the current record's "nombre" value
 * @method Banco   setLogo()   Sets the current record's "logo" value
 * 
 * @package    ptoventavr
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBanco extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('banco');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('logo', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}