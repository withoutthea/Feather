<?php

namespace Feather\Components\Collections
{
    interface ICollection
    {
        public function add($key, $val);
        public function remove($key);
        public function clear();
        public function contains($key);
        public function first();
        public function last();
        public function dump();
    }
}