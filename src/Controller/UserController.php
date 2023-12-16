<?php

namespace App\Controller;

use App\Service\Database;

class UserController
{
    function list()
    {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();
        }

        $query = Database::get()->query("SELECT `users`.`id`, `firstname`, `lastname`, `email`
                                            FROM `users`");

        $users = $query->fetchAll(\PDO::FETCH_ASSOC);

        require("../templates/user_list.php");
    }

    function parameters($id)
    {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();
        }

        $query = Database::get()->prepare("SELECT `users`.`id`, `firstname`, `lastname`
                                            FROM `users`
                                            WHERE `id` = :id");

        $query->execute([":id" => $id]);

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if ($user["id"] !== $_SESSION["user"]["id"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté sur ce compte."
            ];

            header("location: /admin/users");
            exit();
        }

        require("../templates/user_parameters.php");
    }

    function edit($id)
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

        if (!empty($_POST)) {
            $query = Database::get()->prepare("UPDATE `users`
                                                SET `firstname` = :firstname,
                                                    `lastname` = :lastname,
                                                    `email` = :email,
                                                    `password` = :password
                                                WHERE `id` = :id");

            $query->execute([
                ":id" => $id,
                ":firstname" => $_POST["firstname"],
                ":lastname" => $_POST["lastname"],
                ":email" => $_POST["email"],
                ":password" => $_POST["password"],
            ]);

            $query = Database::get()->prepare("SELECT * FROM users WHERE email = :email");

            $query->execute([
                ":email" => $_POST['email'],
            ]);

            $_SESSION["message"] = [
                "type" => "success",
                "text" => "Le compte qui a comme id '" . $id . "', comme prénom
                            '" . $_POST["firstname"] . "' (anciennement
                            '" . $user["firstname"] . "') et comme nom
                            '" . $_POST["lastname"] . "' (anciennement
                            '" . $user["lastname"] . "') a bien été modifié."
            ];
    
            $user = $query->fetch(\PDO::FETCH_ASSOC);

            $_SESSION["user"] = $user;

            header("location: /admin/users");
            exit();
        }

        require("../templates/edit_user.php");
    }
}