<?php

require_once dirname(__FILE__).'/../../../Feather/IObject.php';
require_once dirname(__FILE__).'/../../../Feather/Components/Autoloader.php';

class ObjectCollectionTestObject implements \Feather\IObject
{
    private $id;
    private $name;
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function __toString()
    {
        echo "Name: $name";
    }
}

class ObjectCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Feather\Components\Collections\ObjectCollection
     */
    protected $object;
    
    /**
     * @var \Feather\Components\Autoloader
     */
    protected $autoloader;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->autoloader = new \Feather\Components\Autoloader();
        $this->autoloader->register();
        
        $this->object = new \Feather\Components\Collections\ObjectCollection;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    public function testAdd()
    {
        $obj = new ObjectCollectionTestObject(1, 'TestAddObject');
        $this->assertInstanceOf(
            '\Feather\Components\Collections\ObjectCollection',
            $this->object->add($obj)
        );
    }
    
    public function testRemove()
    {
        $obj = new ObjectCollectionTestObject(1, 'TestRemoveObject');
        $this->object->add($obj);
        $this->object->remove($obj);
        $this->assertFalse($this->object->contains($obj));
    }
    
    public function testContains()
    {
        $obj = new ObjectCollectionTestObject(1, 'TestContainsObject');
        $this->object->add($obj);
        $this->assertTrue($this->object->contains($obj));
    }
    
    public function testClear()
    {
        $obj1 = new ObjectCollectionTestObject(1, 'TestClearObject1');
        $obj2 = new ObjectCollectionTestObject(2, 'TestClearObject2');
        $this->object->addFromArray(array($obj1, $obj2));
        $this->object->clear();
        $this->assertEquals(0, $this->object->count());
    }
    
    public function testFindwithAnd()
    {
        $obj1 = new ObjectCollectionTestObject(1, 'One');
        $obj2 = new ObjectCollectionTestObject(2, 'Two');
        $obj3 = new ObjectCollectionTestObject(3, 'Three');
        $this->object->addFromArray(array($obj1, $obj2, $obj3));
        
        $search1 = new \Feather\Components\Collections\CollectionQuery('and');
        $search1->add('id', 1)->add('name', 'One');
        $this->assertEquals(1, count($this->object->find($search1)));
        
        $search2 = new \Feather\Components\Collections\CollectionQuery('and');
        $search2->add('id', 1)->add('name', 'Two');
        $this->assertEquals(0, count($this->object->find($search2)));
    }
    
    public function testFindwithOr()
    {
        $obj1 = new ObjectCollectionTestObject(1, 'One');
        $obj2 = new ObjectCollectionTestObject(2, 'Two');
        $obj3 = new ObjectCollectionTestObject(3, 'Three');
        $this->object->addFromArray(array($obj1, $obj2, $obj3));
        
        $search1 = new \Feather\Components\Collections\CollectionQuery('or');
        $search1->add('id', 1)->add('name', 'One');
        $this->assertEquals(1, count($this->object->find($search1)));
        
        $search2 = new \Feather\Components\Collections\CollectionQuery('or');
        $search2->add('id', 1)->add('name', 'Two');
        $this->assertEquals(2, count($this->object->find($search2)));
    }
}