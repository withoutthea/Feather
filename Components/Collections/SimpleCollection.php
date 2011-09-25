<?php

namespace Feather\Components\Collections
{
    
    class SimpleCollection implements ISimpleCollection, \Iterator
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
        
        public function add($value)
        {
            $this->_collection[] = $value;
            $this->count++;
            
            return $this;
        }
        
        public function addFromArray(array $values)
        {
            if (count($values) > 0)
            {
                foreach ($values as $key => $val)
                {
                    $this->add($val);
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
        
        public function contains($value)
        {
            return in_array($value, $this->_collection);
        }
        
        public function get($key)
        {
            if (array_key_exists($key, $this->_collection))
            {
                return $this->_collection[$key];
            }
            
            return false;
        }
        
        public function first()
        {
            if ($this->count > 0)
            {
                return $this->_collection[0];
            }
            
            return false;
        }
        
        public function last()
        {
            if ($this->count > 0)
            {
                return $this->_collection[$this->count - 1];
            }
            
            return false;
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