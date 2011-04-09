<?php

namespace Feather\Components\Collections
{
    
    use Feather\App\Domain;
    
    class Collection extends \SplObjectStorage implements ICollection
    {
        public function __construct(array $objects = null)
        {
            if (!empty($objects))
            {
                $this->addFromArray($objects);
            }
        }
        
        public function add(\Feather\App\Domain\IObject $obj, $data = null)
        {
            $this->attach($obj, $data);
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
        
        public function remove(\Feather\App\Domain\IObject $obj)
        {
            if ($this->contains($obj))
            {
                $this->detach($obj);
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
        
        public function contains(\Feather\App\Domain\IObject $obj)
        {
            return parent::contains($obj);
        }
    }
}