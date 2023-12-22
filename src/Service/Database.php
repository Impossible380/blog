<?php

namespace App\Service;

class Database {

    private static $pdo;

    static function init() {
        $host = "localhost";
        $db = "blog";
        $user = "root";
        $password = "root";

        self::$pdo = new \PDO("mysql:host=$host;dbname=$db", $user, $password, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    static function get() {
        return self::$pdo;
    }
}