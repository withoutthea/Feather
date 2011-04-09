<?php

namespace Feather\Components\Collections
{
    
    class BasicCollection implements IBasicCollection, \Iterator
    {
        public $count = 0;
        
        private $_collection = array();
        private $_id = 0; // for iterating
        
        public function __construct(array $values = null)
        {
            if (!empty($values))
            {
                $this->addFromArray($objects);
            }
            
            // reset iterator
            $this->rewind();
        }
        
        public function add($key, $value)
        {
            $this->_collection[$key] = $value;
            $this->count++;
            
            return $this;
        }
        
        public function addFromArray(array $values)
        {
            if (count($values) > 0)
            {
                foreach ($values as $key => $val)
                {
                    $this->add($key, $val);
                }
            }
        }
        
        public function remove($key)
        {
            // if there's no objects, do nothing
            if($this->count <= 0) {
                return null;
            }
            
            if ($this->contains($key))
            {
                unset($this->_collection[$key]);
            }
            
            return $this;
        }
        
        public function clear()
        {
            unset($this->_collection);
        }
        
        public function contains($key)
        {
            return isset($this->_collection[$key]);
        }
        
        /**
         *
         * Implementing the SPL Iterator pattern for further compatibility
         *
         */

        public function current()
        {
            return $this->_collection[$this->_id];
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
            return (isset($this->_collection[$this->_id]));
        }
    }
}