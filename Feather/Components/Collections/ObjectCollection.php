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
    class ObjectCollection implements \Feather\Components\Collections\IObjectCollection, \Iterator
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
            if (($item instanceof \Feather\IObject) && $this->contains($item))
            {
                $this->_removeByHash(spl_object_hash($item));
            }
            elseif (is_array($item))
            {
                if (count($item) > 1)
                {
                    // each array item is an object
                    if (key($item) != spl_object_hash(current($item)))
                    {
                        foreach ($item as $key => $obj)
                        {
                            $this->_removeByHash(spl_object_hash($obj));
                        }
                    }
                }
                else
                {
                    // key is hash, value is object
                    foreach ($item as $key => $obj)
                    {
                        $this->_removeByHash($key);
                    }
                }
            }
            else
            {
                if (!is_array($item) && !($item instanceof \Feather\IObject))
                {
                    // assume just the hash was passed
                    $this->_removeByHash($item);
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
            $this->_collection = array();
        }
        
        public function contains($search)
        {
            return array_key_exists(spl_object_hash($search), $this->_collection);
        }
        
        public function find(\Feather\Components\Collections\CollectionQuery $search)
        {
            $matches = array();

            foreach ($this->_collection as $obj)
            {
                $test = false;
                
                if ($search->getType() === 'and')
                {
                    while ($search->getQuery())
                    {
                        $key = 'get' . $search->getKey();
                        if ($obj->$key() === $search->getValue())
                        {
                            $test = true;
                            continue;
                        }
                        
                        $test = false;
                        break;
                    }
                    
                    if ($test)
                    {
                        $matches[] = $obj;
                    }
                    
                    $search->resetQuery();
                }
                
                if ($search->getType() === 'or')
                {
                    while ($search->getQuery())
                    {
                        $key = 'get' . $search->getKey();
                        if ($obj->$key() === $search->getValue())
                        {
                            $test = true;
                            break;
                        }
                        
                        continue;
                    }
                    
                    if ($test)
                    {
                        $matches[] = $obj;
                    }
                    
                    $search->resetQuery();
                }
            }
            
            return $matches;
        }
        
        public function first()
        {
            
        }
        
        public function last()
        {
            
        }
        
        public function dump()
        {
            
        }
        
        /**
         * Implementing the SPL Iterator pattern for further compatibility
         */
        
        public function count()
        {
            return count($this->_collection);
        }

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