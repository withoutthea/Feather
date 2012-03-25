<?php

namespace Feather\Components\Collections
{
    interface IObjectCollection extends \Feather\Components\Collections\IGenericObjectCollection
    {
        public function find(\Feather\Components\Collections\CollectionQuery $search);
        public function first();
        public function last();
    }
}