<?php

namespace Feather\Components\Request
{
    class ServerParameters extends ParameterCollection
    {
        public function __construct(array $params)
        {
            // $vars = $_SERVER
            parent::__construct($params);
        }
    }
}