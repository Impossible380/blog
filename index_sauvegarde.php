<?php
    require_once("lib.php");

    if (isset($_GET["user_action"]) && $_GET["user_action"] === "log_out") {
        $_SESSION["user_connected"] = false;
    }

require('templates/home.php');

?>


