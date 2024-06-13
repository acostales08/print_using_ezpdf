<?php

class DatabaseMutation
{
    static $host = "localhost";
    static $username = "root";
    static $pass = "";
    static $db_name = "fetcherdb";
    static $helper;
    static $statement;
}

class Database
{
    public function connect()
    {
        try {
            $connectionString = "mysql:host=" . DatabaseMutation::$host . ";dbname=" . DatabaseMutation::$db_name;
            DatabaseMutation::$helper = new PDO($connectionString, DatabaseMutation::$username, DatabaseMutation::$pass);
            DatabaseMutation::$helper->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return DatabaseMutation::$helper;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function php_prepare($sql)
    {
        return DatabaseMutation::$statement = $this->connect()->prepare($sql);
    }

    public function php_dynamic_handler($params, $values, $types = null)
    {
        if (is_null($types)) {
            switch ($types) {
                case 1:
                    $types = PDO::PARAM_INT;
                    break;
                case 2:
                    $types = PDO::PARAM_BOOL;
                    break;
                default:
                    $types = PDO::PARAM_STR;
                    break;
            }
        }
        return DatabaseMutation::$statement->bindParam($params, $values, $types);
    }

    public function php_execute()
    {
        return DatabaseMutation::$statement->execute();
    }

    public function php_fetchAll()
    {
        return DatabaseMutation::$statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function php_fetch()
    {
        return DatabaseMutation::$statement->fetch(PDO::FETCH_ASSOC);
    }


    public function php_rowCount()
    {
        return DatabaseMutation::$statement->rowCount() > 0;
    }
}
