<?php
    include_once(dirname(__FILE__) . "\PDOFactory.php");
    include_once(dirname(__FILE__) . "\SQLCommands.php");

    class SQLProxy implements SQLCommands {
        private SQLCommands $sqlCommands;

        public function __construct($sqlCommands, DBData $dbData) {
            if (isset($sqlCommands)) {
                $this->sqlCommands = $sqlCommands;
            } else {
                if (isset($dbData)) {
                    $this->sqlCommands = new PDOFactory($dbData->getServerName(), $dbData->getUserName(), $dbData->getPassword(), $dbData->getDBName());
                } else {
                    trigger_error("dbData has not been set", E_WARNING);
                }
            }
        }

        function runQuery($SQLQuery, $params): bool {
            return $this->sqlCommands->runQuery($SQLQuery, $params);
        }

        function count($SQLQuery, $params): int {
            return $this->sqlCommands->count($SQLQuery, $params);
        }

        function columnExist($SQLQuery, $params): bool {
            return $this->sqlCommands->columnExist($SQLQuery, $params);
        }

        function returnTable($SQLQuery, $params): array {
            return $this->sqlCommands->returnTable($SQLQuery, $params);
        }
    }