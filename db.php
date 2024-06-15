<?php

class Database
{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "rest_api_db";
    public $conn;
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            return "Connection error:" . $exception->getMessage();
        }
        return $this->conn;
    }
}