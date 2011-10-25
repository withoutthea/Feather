<?php

namespace Feather\Components\Collections
{
    interface IObjectCollection extends IGenericObjectCollection
    {
        public function find(array $search);
    }
}