<?php

namespace Feather\Components\Collections
{
    /**
     * While GenericObjectCollection uses the SplObjectStorage and is definitely fast, it
     * doesn't allow for searching for objects based on their properties and therefore you
     * cannot pull a specific object from it.  ObjectCollection attempts to fix that, at
     * the cost of some performance.  This implementation is inspired by .Net Framework's
     * List<T> object and LINQ queries.  No, it's not meant to be exactly that, but the
     * inspiration behind it is clearly there.
     */
    class ObjectCollection implements IObjectCollection, \Iterator
    {
        public $count = 0;
        
        private $_collection = array();
        private $_id = 0; // for iterating
        
        public function __construct(array $objects = null)
        {
            if (!empty($objects))
            {
                $this->addFromArray($objects);
            }
        }
        
        public function add(\Feather\IObject $obj, $hash = null)
        {
            if (null === $hash)
            {
                // calculate hash for object
                $hash = spl_object_hash($obj);
            }
            
            $this->_collection[$hash] = $obj;
            
            return $this;
        }
        
        public function addFromArray(array $objects)
        {
            if (count($objects) > 0)
            {
                foreach ($objects as $obj)
                {
                    $this->add($obj);
                }
            }
        }
        
        public function remove($item)
        {
            // if an instance of IObject is passed
            if (($item instanceof \Feather\IObject) && $this->contains($obj))
            {
                $this->_removeByHash(spl_object_hash($item));
            }
            elseif (is_array($item))
            {
                if (count($item) > 1)
                {
                    // assume each array item is an object
                }
                else
                {
                    // assume key is hash, value is object
                }
            }
            else
            {
                if (!is_array($item) && !($item instanceof \Feather\IObject))
                {
                    // assume just the hash was passed
                }
            }
            
            return $this;
        }
        
        private function _removeByHash($hash)
        {
            unset($this->_collection[$hash]);
            return $this;
        }
        
        public function clear()
        {
            $this->rewind();
            while ($this->count() > 0)
            {
                $this->detach($this->current());
                $this->rewind();
            }
        }
        
        public function contains($search)
        {
            if (!($search instanceof \Feather\IObject))
                return false;
                
            return parent::contains($search);
        }
        
        public function find($search)
        {
            
        }
        
        /**
         * Implementing the SPL Iterator pattern for further compatibility
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