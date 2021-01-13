<?php

/* 
 * PDO DATABASE CLASS
 * - CONNECT TO DATABASE
 * - CREATE PREPARED STATEMENTS
 * - BIND VALUES
 * - RETURN VALUES
 * */

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // CREATE NEW PDO INSTANCE
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //PREPARE STATEMENT WITH QUERY
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //BIND VALUES

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    //EXECUTE THE PREAPRE STATEMENT
    public function execute()
    {
        return $this->stmt->execute();
    }


    //GET THE RESULT SET AS ARRAY OF OBJECTS
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //GET SINGLE RECORD AS OBJECT
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //GET COUNT
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
