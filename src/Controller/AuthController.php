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
                "text" => "Bonjour et bienvenue sur Parker Press pour votre première."
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
                    "text" => "Bonjour et bienvenue sur Parker Press pour votre retour."
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

    function farewell($id) // "Farewell" signifie "Adieu" en anglais
    {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();
        }

        /// récuperer l'article dans la bdd grace à l'id $_GET['id']

        $query = Database::get()->prepare("SELECT `users`.`id`, `firstname`, `lastname`, `email`
                                            FROM `users`
                                            WHERE `id` = :id");

        $query->execute([
            ":id" => $id,
        ]);

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if ($user["id"] !== $_SESSION["user"]["id"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas autorisé à modifier ou à supprimer les informations des autres comptes."
            ];

            header("location: /admin/users");
            exit();
        }

        $query = Database::get()->prepare("DELETE
                                            FROM `users`
                                            WHERE `id` = :id;
                                            ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL;
                                            ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");

        $query->execute([
            ":id" => $id
        ]);

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if ($_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "info",
                "text" => "Merci d'être venu sur Parker Press, et bonne continuation !"
            ];

            $_SESSION["user_connected"] = false;
        }

        header("location: /");
        exit();
    }
}