<?php
    interface DBData {
        public function getServerName(): string;
        public function getUserName(): string;
        public function getPassword(): string;
        public function getDBName(): string;
    }