<?php
    session_start();

    if (empty($_SESSION["user_connected"])) {
        $_SESSION["user_connected"] = false;
    }
    
    
    function dump($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }