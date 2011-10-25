<?php

namespace Feather\Components\Routing
{
    /**
     * Here's how it should work:
     *
     * Route("/#^[^admin]*$#/*, array('controller' => 'home')) -> match anything that's not /admin
     * Route("/{controller}/{action}/*", array('controller' => 'home', 'action' => 'index'), array('controller' => '#^[A-Za-z]*$#') -> matches all where controller is only letters
     * Route("/post/{id}", array('controller' => 'posts', 'action' => 'view'), array('id' => '#^[0-9]*$#')) -> matches /post/(any number, no letters)
     *
     */
    class Matcher
    {
        /**
         *
         * @var \Feather\Components\Routing\RouteCollection
         */
        private $_routes;
        
        public function __construct($routes = null)
        {
            if ($routes instanceof \Feather\Components\Routing\RouteCollection)
            {
                $this->_initCollection($routes);
            }
            elseif ($routes instanceof \Feather\Components\Routing\Route)
            {
                $this->_initCollection()->addRoute($routes);
            }
            else
            {
                $this->_initCollection();
            }
            
            return $this;
        }
        
        private function _initCollection(\Feather\Components\Routing\RouteCollection $collection = null)
        {
			if (null === $collection)
			{
				$this->_routes = new \Feather\Components\Routing\RouteCollection();
			}
			else
			{
				$this->_routes = $collection;
			}
            
            return $this;
        }
        
        public function getRoute()
        {
            return $this->_route;
        }
        
        public function addRoute(\Feather\Components\Routing\Route $route)
        {
            $this->_routes->add($route);
            
            return $this;
        }
        
        /**
         * Match the given URI against the Route.
         * 
         * @param \Feather\Components\Request\Uri $uri The URI to match the route against
         */
        public function match(\Feather\Components\Request\Uri $uri)
        {
            // if there isn't a route set for this matcher, return false
            if (empty($this->_route))
            {
                return false;
            }
            
            foreach ($this->_routes as $route)
            {
                // if uri is longer than route, and route doesn't end with wildcard, return
                if (count($uri) > count($route)
                    && $route->getSegment('last') !== '*')
                    return false;

                // if the uri is shorter than the route ...
                if (count($uri) < count($route)
                    && $route->getSegment('last') !== '*')
                    return false;

                // cycle through and match
                $position = -1;
                foreach ($uri as $segment)
                {
                    $position++;

                    echo "route: " . $route->getSegment($position) . ' :: segment: ' . $segment;
                    if ($route->getSegment($position) == '*')
                        break;

                    if (preg_match($route->getSegment($position), $segment))
                        continue;

                    return false;
                }

                return true;
            }
            
            return false;
        }
    }
}