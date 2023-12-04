<?php
    session_start();

    if (empty($_SESSION["user_connected"])) {
        $_SESSION["user_connected"] = false;
    }
    
    $host = "localhost";
    $db = "blog";
    $user = "root";
    $password = "root";

    $pdo = new \PDO("mysql:host=$host;dbname=$db", $user, $password);

    function dump($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }