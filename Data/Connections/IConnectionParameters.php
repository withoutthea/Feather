<?php

namespace Feather\Data\Connections
{
    interface IConnectionParameters
    {
        public function setHost($host);
        public function getHost();
        public function setPort($port);
        public function getPort();
        public function setUsername($username);
        public function getUsername();
        public function setPassword($password);
        public function getPassword();
        public function setDatabase($database);
        public function getDatabase();
    }
}