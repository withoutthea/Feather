<?php

namespace Feather\Components\Collections
{
    interface IBasicCollection extends ICollection
    {
        public function get($key = null);
    }
}