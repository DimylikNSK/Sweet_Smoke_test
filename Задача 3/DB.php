<?php

include_once './db.config.php';

class DB
{
    protected static $_instance;
    protected $_pdo;

    private function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'test';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->_pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$_instance === null)
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone() {}

    public function __call($method, $args) {
        return call_user_func_array(array($this->_pdo, $method), $args);
    }
}