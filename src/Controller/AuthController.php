<?php

namespace App\Controller;

use App\Service\Database;

class AuthController
{
    function register()
    {
        if ($_SESSION["user_connected"]) {
            header("location: /");
            exit();
        }

        if (!empty($_POST)) {
            $query = Database::get()->prepare("INSERT INTO users(firstname, lastname, email, password)
                                    VALUES(:firstname, :lastname, :email, :password)");
            $query->execute([
                ":firstname" => $_POST['firstname'],
                ":lastname" => $_POST['lastname'],
                ":email" => $_POST['email'],
                ":password" => $_POST['password'],
            ]);

            $query = Database::get()->prepare("SELECT * FROM users WHERE email = :email");

            $query->execute([
                ":email" => $_POST['email'],
            ]);

            $user = $query->fetch(\PDO::FETCH_ASSOC);

            $_SESSION["user"] = $user;
            $_SESSION["user_connected"] = true;
            $_SESSION["message"] = [
                "type" => "info",
                "text" => "Bonjour et bienvenue sur Parker Press."
            ];

            header("location: /");
            exit();
        }

        require("../templates/register.php");
    }

    function login()
    {
        if ($_SESSION["user_connected"]) {
            header("location: /");
            exit();
        }

        if (!empty($_POST)) {
            $query = Database::get()->prepare("SELECT *
                                                FROM users
                                                WHERE email = :email AND password = :password");

            $query->execute([
                ":email" => $_POST["email"],
                ":password" => $_POST["password"]
            ]);

            $user = $query->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION["user"] = $user;
                $_SESSION["user_connected"] = true;
                $_SESSION["message"] = [
                    "type" => "info",
                    "text" => "Bonjour et bienvenue sur Parker Press."
                ];

                header("location: /");
                exit();
            } else {
                $_SESSION["message"] = [
                    "type" => "danger",
                    "text" => "Email ou mot de passe invalide."
                ];
            }
        }

        require("../templates/login.php");
    }

    function logout()
    {
        if ($_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "info",
                "text" => "Merci d'être venu sur Parker Press et à bientôt !"
            ];
            $_SESSION["user_connected"] = false;
        }

        header("location: /");
        exit();
    }
}
