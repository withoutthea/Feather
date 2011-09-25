<?php

namespace Feather\Data\Connections
{
    interface IDataConnector
    {
        public static function getConnection();
        
        //public function connect($host, $user, $pass, $db);
        //public function disconnect();
        public function query($query);
        public function execute($query);
    }
}