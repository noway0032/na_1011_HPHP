<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Uzenet', 'forumconn');

/**
 * BaseUzenet
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $uzenetid
 * @property integer $userid
 * @property string $szoveg
 * @property timestamp $datum
 * @property User $User
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUzenet extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('uzenet');
        $this->hasColumn('uzenetid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('userid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('szoveg', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('datum', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'userid',
             'foreign' => 'userid'));
    }
}