<?php

/**
 * Here's how it should work:
 *
 * Route("/#^[^admin]*$#/*, array('controller' => 'home')) -> match anything that's not /admin
 * Route("/{controller}/{action}/*", array('controller' => 'home', 'action' => 'index'), array('controller' => '#^[A-Za-z]*$#') -> matches all where controller is only letters
 * Route("/post/{id}", array('controller' => 'posts', 'action' => 'view'), array('id' => '#^[0-9]*$#')) -> matches /post/(any number, no letters)
 *
 */
namespace Feather\Components\Routing
{
    class Route {

        protected $url;
        protected $mapping;
        protected $constraints;

        /**
         * Constructor
         *
         * @param string $url A string representing the URL in the correct format.
         * @param array $mappings Array containing the Controller, Action, and Parameter mappings.
         * @param array $constraints Array that limits the values in the URL to certain values, such as int, date, etc.
         */
        public function __construct($url, array $mappings = array(), array $constraints = array())
        {
            $this->setUrl($url);
            $this->setMapping($mappings);
            $this->setConstraints($constraints);
        }

        /**
         * Set the URL that is being matched.
         *
         * @param string $url A string representing the URL in the correct format.
         * @return Route The current Route instance.
         */
        public function setUrl($url)
        {
            // url must start and end with '/'
            if('/' !== $url[0]) $url = '/' . $url;

            // url should not end with '/'
            if('/' === substr($url, -1)) $url = substr($url, 0, -1);

            $this->url = $url;

            return $this;
        }

        /**
         * Get the URL for this Route.
         *
         * @return string The URL for this Route.
         */
        public function getUrl()
        {
            // this will always be set
            return $this->url;
        }

        /**
         * Set the mapping to be used for the Router.
         *
         * @param array $mapping Array containing the Controller, Action, and Parameter mappings.
         * @return Route
         */
        public function setMapping($mapping)
        {
            $this->mapping = array_merge(array(
                'controller' => 'home',
                'action'	 => 'index'
            ), $mapping);

            return $this;
        }

        public function getMapping()
        {
            return $this->mapping;
        }

        public function setMap($map, $value)
        {
            $this->mapping[$map] = $value;

            return $this;
        }

        public function getMap($key)
        {
            return isset($this->mapping[$key]) ? $this->mapping[$key] : null;
        }

        public function setConstraints($constraints)
        {
            // make sure the regex conforms
            foreach($constraints as $match => $regex)
            {
                // cannot start with ^
                if('^' === $regex[0]) $regex = substr($regex, 1);
                // cannot end with $
                if('$' === substr($regex, -1)) $regex = substr($regex, 0, -1);

                // overwrite to ensure proper regex value
                $constraints[$match] = $regex;
            }

            $this->constraints = array_merge(array(
                'id' => '[0-9]*',
                'day' => '([Mm]on(day)?|[Tt](ue(sday)?|hu(rsday)?)|[Ww]ed(nesday)?|[Ff]ri(day)?|[Ss](at(urday)?|un(day)?))',
                'month' => '([Jj](an(uary)?|un(e)?|ul(y)?)|[Ff]eb(ruary)?|[Mm](ar(ch)?|ay)|[Aa](pr(il)?|ug(ust)?)|[Ss]ep(tember)?|[Oo]ct(ober)?|[Nn]ov(ember)?|[Dd]ec(ember)?)',
                'year' => '[0-9]{4}'
                // @TODO -> Add more items here (YYYY-MM-dd, for instance)
            ), $constraints);
        }
    }
}