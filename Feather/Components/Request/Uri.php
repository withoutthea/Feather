<?php

namespace Feather\Components\Request
{
    class Uri implements \Iterator, \Countable
    {
        public $count = 0;
        
        private $_segments = array();
        private $_id = 0;
        
        public function __construct(array $segments = null)
        {
            if (null != $segments)
            {
                $this->addSegments($segments);
            }
        }
        
        public function addSegment($segment)
        {
            $this->_segments[] = $segment;
            
            return $this;
        }
        
        public function addSegments(array $segments, $overwrite = false)
        {
            if (!$overwrite)
            {
                foreach ($segments as $segment)
                    $this->addSegment($segment);
                
                return $this;
            }
            
            $this->_segments = $segments;
            
            return $this;
        }
        
        public function full()
        {
            return '/' . implode('/', $this->_segments);
        }
        
        /**
         * SPL Iterator pattern
         */

        public function current()
        {
            return $this->_segments[$this->_id];
        }

        public function key()
        {
            return $this->_id;
        }

        public function next()
        {
            ++$this->_id;
        }

        public function rewind()
        {
            $this->_id = 0;
        }
        
        public function valid()
        {
            return (isset($this->_segments[$this->_id]));
        }
        
        /**
         * SPL Countable pattern
         */
        
        public function count()
        {
            return count($this->_segments);
        }
    }
}