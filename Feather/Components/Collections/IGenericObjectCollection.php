<?php

namespace Feather\Components\Collections
{
    /**
     * This cannot extend the ICollection interface, as PHP will not allow interfaces to be
     * overridden in any regard, even on further inheritance.  Since we need to require the
     * data in the collection to be an object, we are starting a new interface.
     */
    interface IGenericObjectCollection
    {
        public function add(\Feather\IObject $obj, $hash = null);
        public function remove($item);
        public function clear();
        public function contains($search);
        public function dump();
    }
}