<?php

require_once dirname(dirname(__FILE__)).'/../App/Feather.php';

class SeparatorConstantsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        // @TODO -> Why isn't this unsetting?
        //\FeatherWorks\App\Feather::setupEnv();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    // don't need to test DIRECTORY_SEPARATOR, as it's a PHP value
    public function testShortDirectorySeparatorConstantFunction()
    {
        $this->assertEquals(
            '\\',
            DS
        );
    }
    
    // don't need to test PATH_SEPARATOR, as it's a PHP value
    public function testShortPathSeparatorConstantFunction()
    {
        $this->assertEquals(
            ';',
            PS
        );
    }
    
    public function testLongAppPathConstantFunction()
    {
        $this->assertEquals(
            dirname(dirname(dirname(__FILE__))),
            APP_PATH
        );
    }
    
    public function testShortAppPathConstantFunction()
    {
        $this->assertEquals(
            dirname(dirname(dirname(__FILE__))),
            AP
        );
    }
}