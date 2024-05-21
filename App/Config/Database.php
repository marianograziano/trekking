<?php

namespace App\Config;

class Database {
    private $host = "db";
    private $db_name = "dbname";  // Asegúrate de cambiar 'dbname' por el nombre real de tu base de datos
    private $username = "root";
    private $password = "test";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            $this->conn = new \PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $exception) {
            throw new \Exception("Connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
