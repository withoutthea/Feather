<?php

namespace Feather\Components\Request
{
    class ServerParameters extends ParameterCollection
    {
        public function __construct(array $params)
        {
            parent::__construct($params);
        }
    }
}