<?php

namespace Feather\Data\Connections
{
    interface IDataConnector
    {
        public static function getConnection();
        
        public function query($query);
        public function execute($query);
		
		// perhaps this will change, but i think Connectors MUST be transactional
		public function commit();
		public function rollback();
    }
}