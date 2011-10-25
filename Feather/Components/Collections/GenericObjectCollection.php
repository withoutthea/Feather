<?php

namespace Feather\Components\Collections
{
    
    class GenericObjectCollection extends \SplObjectStorage implements IGenericObjectCollection, \Iterator
    {
        public function __construct(array $objects = null)
        {
            if (!empty($objects))
            {
                $this->addFromArray($objects);
            }
        }
        
        public function add(\Feather\IObject $obj, $hash = null)
        {
            $this->attach($obj, $hash);
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
            if (!($item instanceof \Feather\IObject))
                // throw new CannotRemoveNonObjectFromObjectCollectionException();
                
            if ($this->contains($item))
            {
                $this->detach($item);
            }
            
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
            if (!($search instanceof \Feahter\IObject))
                return false;
                
            return parent::contains($search);
        }
    }
}