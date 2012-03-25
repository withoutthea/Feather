<?php

require_once dirname(__FILE__).'/../App/Domain/IObject.php';
require_once dirname(__FILE__).'/../Components/Collections/ICollection.php';
require_once dirname(__FILE__).'/../Components/Collections/Collection.php';

class TestObject implements \Feather\App\Domain\IObject
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function __toString()
    {
        echo "Name: $name";
    }
}

class CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \FeatherWorks\Components\Collections\Collection
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Feather\Components\Collections\Collection;
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
        $obj = new TestObject('TestAddObject');
        $this->assertType(
            '\Feather\Components\Collections\Collection',
            $this->object->add($obj)
        );
    }
    
    public function testRemove()
    {
        $obj = new TestObject('TestRemoveObject');
        $this->object->add($obj);
        $this->object->remove($obj);
        $this->assertFalse($this->object->contains($obj));
    }
    
    public function testContains()
    {
        $obj = new TestObject('TestContainsObject');
        $this->object->add($obj);
        $this->assertTrue($this->object->contains($obj));
    }
    
    public function testClear()
    {
        $obj1 = new TestObject('TestClearObject1');
        $obj2 = new TestObject('TestClearObject2');
        $this->object->addFromArray(array($obj1, $obj2));
        $this->object->clear();
        $this->assertEquals(0, $this->object->count());
    }
}