<?php
    include_once(dirname(__FILE__) . "\SQLCommands.php");

    class PDOFactory implements SQLCommands {
        private PDO $dbh;

        /****
         * PDOFactory constructor.
         * @param $servername
         * @param $username
         * @param $password
         * @param $dbname
         ****/
        public function __construct(string $servername,string $username,string $password,string $dbname) {
            $temp = 'mysql:host=' . $servername . ';dbname=' . $dbname;
            $this->dbh = new PDO($temp, $username, $password);
        }

        /****
         * @param $SQLQuery
         * example: 'SELECT * FROM employees WHERE name = :name'
         * @param $params
         * example: $params['name']='value'
         * @return bool
         ****/
        function runQuery($SQLQuery, $params): bool {
            try {
                $this->run($SQLQuery, $params);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                return false;
            }
            return true;
        }

        /****
         * @param $SQLQuery
         * example: 'SELECT * FROM employees WHERE name = :name'
         * @param $params
         * example: $params['name']='value'
         * @return integer
         ****/
        function count($SQLQuery, $params): int {
            try {
                return $this->run($SQLQuery, $params)->rowCount();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
            }
            //error
            return -1;
        }

        /****
         * @param $SQLQuery
         * @param $params
         * @return bool
         ****/
        function columnExist($SQLQuery, $params): bool {
            if ($this->count($SQLQuery, $params) > 0) return true;
            return false;
        }

        /****
         * @param $SQLQuery
         * @param $params
         * @return PDOStatement
         ****/
        private function run($SQLQuery, $params): PDOStatement {
            $stmt = $this->dbh->prepare($SQLQuery);
            $stmt->execute($params);
            return $stmt;
        }

        /****
         * @param $SQLQuery
         * @param $params
         * @return array
         ****/
        function returnTable($SQLQuery, $params): array {
            return $this->run($SQLQuery, $params)->fetchAll(PDO::FETCH_ASSOC);
        }

        function close() {
            $dbh = null;
        }
    }