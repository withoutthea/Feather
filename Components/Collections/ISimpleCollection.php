<?php

namespace Feather\Components\Collections
{
    interface ISimpleCollection
    {
        public function add($value);
        public function remove($key);
        public function clear();
        public function contains($value);
        public function get($key);
        public function first();
        public function last();
    }
}