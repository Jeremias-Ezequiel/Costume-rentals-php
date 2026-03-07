<?php

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'Abcdef2020';
    private $dbname = 'OmonteJeremiasFinal';

    private static $instance = '';
    private $con;

    public function __construct()
    {
        $this->con = null;

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->con = new PDO($dsn, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'There is an error with the database: ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === 'null') {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getCon()
    {
        return  $this->con;
    }
}
