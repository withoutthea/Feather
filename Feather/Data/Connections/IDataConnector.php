<?php

namespace Feather\Data\Connections
{
    interface IDataConnector
    {
        public static function getConnection();
        
        public function query($query);
        public function execute($query);
		
		// perhaps this will change, but i think Connectors MUST be transactional
        public function beginTransaction();
        public function endTransaction();   // is this needed?  set mysqli->autocommit(true)
		public function commit();
		public function rollback();
    }
}