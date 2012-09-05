<?php

require_once dirname(__FILE__).'/../Feather/Feather.php';
require_once dirname(__FILE__).'/../Feather/Components/Autoloader.php';

class AutoloaderTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var type \Feather\Components\Autoloader
     */
    private $_autoloader;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
		\Feather\Feather::setupEnv();
        $this->_autoloader = new \Feather\Components\Autoloader();
        $this->_autoloader->register();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        spl_autoload_unregister('\Feather\App\Autoloader::Autoload');
    }

    public function testAutoloadFunction()
    {
        $this->assertEquals(
            dirname(dirname(__FILE__)) . DS.'Feather'.DS.'Components'.DS.'Collections'.DS.'BasicCollection.php',
            $this->_autoloader->autoload('\\Feather\\Components\\Collections\\BasicCollection')
        );
    }
    
    public function testClassAutoload()
    {
        //spl_autoload_register('\Feather\App\Autoloader::Autoload');
        $coll = new \Feather\Components\Collections\BasicCollection;
        $this->assertInstanceOf('\Feather\Components\Collections\BasicCollection', $coll);
    }
}