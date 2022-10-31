<?php

declare(strict_types=1);
require_once(__DIR__ . "./../../../env.php");

// class to connect to data base
class dataBase
{
    // private so that sub classes can't access
    private string $user;
    private string $host;
    private string $pwd;
    private string $name;

    // due to the use of a constructor all sub classes with a constructor need to call
    // parent::__construct();
    function __construct()
    {
        $this->host   = getenv('db-host');
        $this->user   = getenv('db-user');
        $this->pwd    = getenv('db-pwd');
        $this->name   = getenv('db-name');
    }

    // connect returns assoc arrays from a database
    public function connect()
    {
        try {
            $databaseSource = 'mysql:host=' . $this->host . ';dbname=' . $this->name;

            $pdo = new PDO(
                $databaseSource,
                $this->user,
                $this->pwd
            );
            $pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

            return $pdo;
        } catch (PDOException $e) {
            // could do sommething with the error
            echo "DB error: " .  $e->getMessage();
            exit();
        }
    }
}
