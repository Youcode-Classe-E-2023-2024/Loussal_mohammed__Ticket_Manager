<?php

namespace database;

class Database
{
    private $dbName = DB_NAME;
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;

    private $dbh;
    private $error;

    public function __construct() {
        $dsn = 'mysql:host='. $this->dbHost .';dbname='. $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODO => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass);
        }catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}