<?php
    require_once(dirname(__FILE__) . "\DBData.php");
    Class DBCredentials implements DBData {
        private string $servername = "localhost";
        private string $username = "root";
        private string $password = "";
        private string $dbname = "PHPProject";
        private mysqli $conn;

        function getServerName(): string {
            return $this->servername;
        }
        function getUserName(): string {
            return $this->username;
        }
        function getPassword(): string {
            return $this->password;
        }
        function getDBName(): string {
            return $this->dbname;
        }
        function getConn(): mysqli {
            return $this->conn;
        }
        function connect() {
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
            if (!($this->conn)) die("Connection failed: " . mysqli_connect_error());
        }
        function closeConnection() {
            mysqli_close($this->conn);
        }
    }
