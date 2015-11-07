<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Color', 'doctrine');

/**
 * BaseColor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * 
 * @method integer getId()     Returns the current record's "id" value
 * @method string  getNombre() Returns the current record's "nombre" value
 * @method Color   setId()     Sets the current record's "id" value
 * @method Color   setNombre() Sets the current record's "nombre" value
 * 
 * @package    ptoventavr
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseColor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('color');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 500, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 500,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}