<?php

namespace App;

class DB {

    static function connect() 
    {
        $dsn = 'mysql:host=localhost;dbname=employees';
        $user = 'root';
        $pass = '';

        try {
            $pdo = new \PDO($dsn, $user, $pass);
        } catch (\PDOException $e) {
            exit('DB Error:' . $e->getMessage());
        }

        return $pdo;
    }
}