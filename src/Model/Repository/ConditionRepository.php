<?php

namespace App\Model\Repository;

class ConditionRepository
{
    static function userConnected()
    {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();

        } else if ($_SESSION["user"]->status !== 'accepted') {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'avez pas encore été admis."
            ];

            header("location: /");
            exit();
        }
    }
}