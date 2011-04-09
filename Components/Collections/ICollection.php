<?php

namespace Feather\Components\Collections
{
    use Feather\App\Domain;
    
    interface ICollection
    {
        public function add(\Feather\App\Domain\IObject $obj, $data = null);
        public function remove(\Feather\App\Domain\IObject $obj);
        public function clear();
        public function contains(\Feather\App\Domain\IObject $obj);
        
        //public function find(array $parms);
        
        //public function __toString();
    }
}