<?php

namespace Feather\Components\Collections
{
    interface IBasicCollection
    {
        public function add($key, $value);
        public function remove($key);
        public function clear();
        public function contains($key);
        public function get($key);
        public function first();
        public function last();
        
        //public function find(array $parms);
        
        //public function __toString();
    }
}