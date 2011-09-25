<?php

require_once dirname(__FILE__) . '/../../../Components/Routing/Matcher.php';
require_once dirname(__FILE__) . '/../../../Components/Routing/Route.php';
require_once dirname(__FILE__) . '/../../../Components/Request/Uri.php';

/**
 * Test class for Matcher.
 * Generated by PHPUnit on 2011-07-11 at 00:03:33.
 */
class MatcherTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Matcher
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new \Feather\Components\Routing\Matcher;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function testSingleRegexUri()
    {
        $uri = new \Feather\Components\Request\Uri(explode('/', 'post/id/56'));
        $route = new \Feather\Components\Routing\Route('/post/id/#^[0-9]*$#');
        $this->assertTrue($this->object->setRoute($route)->match($uri));
    }

    public function testSingleConstraintUri()
    {
        $uri = new \Feather\Components\Request\Uri(explode('/', 'post/id/56'));
        $route = new \Feather\Components\Routing\Route('/post/id/{id}');
        $this->assertTrue($this->object->setRoute($route)->match($uri));
    }
    
    public function testSingleWildcardUri()
    {
        $uri = new \Feather\Components\Request\Uri(explode('/', 'post/id/56'));
        $route = new \Feather\Components\Routing\Route('/*');
        $this->assertTrue($this->object->setRoute($route)->match($uri));
    }
    
    public function testLongWildcardUri()
    {
        $uri = new \Feather\Components\Request\Uri(explode('/', 'post/id/56'));
        $route = new \Feather\Components\Routing\Route('/post/id/*');
        $this->assertTrue($this->object->setRoute($route)->match($uri));
    }
    
    public function testConstraintWithRegexUri()
    {
        $uri = new \Feather\Components\Request\Uri(explode('/', 'post/id/56'));
        $route = new \Feather\Components\Routing\Route('/#^post$#/id/{id}');
        $this->assertTrue($this->object->setRoute($route)->match($uri));
    }
    
    public function testConstraintWithRegexAndWildcardUri()
    {
        $uri = new \Feather\Components\Request\Uri(explode('/', 'post/author/12/date/Monday/extra/parameter'));
        $route = new \Feather\Components\Routing\Route('/post/author/#^[0-9]*$#/date/{day}/*');
        $this->assertTrue($this->object->setRoute($route)->match($uri));
    }
}

?>
