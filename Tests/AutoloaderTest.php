<?php

require_once dirname(__FILE__).'/../App/Feather.php';
require_once dirname(__FILE__).'/../App/Autoloader.php';

class AutoloaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testAutoloadFunction()
    {
        $this->assertEquals(
            dirname(dirname(__FILE__)) . '\\Components\\Collections\\Collection.php',
            \Feather\App\Autoloader::Autoload('\\Feather\\Components\\Collections\\Collection')
        );
    }
    
    public function testClassAutoload()
    {
        spl_autoload_register('\Feather\App\Autoloader::Autoload');
        $coll = new \Feather\Components\Collections\Collection;
        $this->assertType('\Feather\Components\Collections\Collection', $coll);
    }
}