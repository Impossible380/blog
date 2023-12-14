<?php

namespace App\Controller;

use App\Service\Database;

class UserController {
    function list() {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté.</p>";
            header("location: /login");
            exit();
        }
                                
        $query = Database::get()->query("SELECT `users`.`id`, `firstname`, `lastname`, `email`
                                        FROM `users`");

        $users = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        require("../templates/user_list.php");
    }

    function parameters($id) {
        $query = Database::get()->prepare("SELECT `firstname`, `lastname`
                                            FROM `users`
                                            WHERE `id` = :id");

        $query->execute([":id" => $id]);
        
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        require("../templates/user_details.php");
    }

    function new() {
        if ($_SESSION["user_connected"]) {
            header("location: /");
            exit();
        }
        
        if (!empty($_POST)) {
            Database::get()->exec("INSERT INTO users(firstname, lastname, email, password)
                                    VALUES(\"". $_POST["firstname"] ."\", \"". $_POST["lastname"] ."\", \"". $_SESSION["email"] ."\", \"". $_SESSION["password"] ."\")");

            $_SESSION["user_connected"] = true;
            $_SESSION["message"] = "<p class='text-info'>Bonjour et bienvenue sur Parker Press.</p>";

            header("location: /");
            exit();
        }

        require("../templates/new_user.php");
    }

    function edit($id) {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté.</p>";
            header("location: /login");
            exit();
        }

        /// récuperer l'article dans la bdd grace à l'id $_GET['id']

        $query = Database::get()->prepare("SELECT *
                                            FROM articles
                                            WHERE id = :id");

        $query->execute([
            ":id" => $id,
        ]);
        
        $article = $query->fetch(\PDO::FETCH_ASSOC);

        if ($article["author_id"] !== $_SESSION["user"]["id"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté sur ce compte.</p>";

            header("location: /admin/users");
            exit();
        }

        if (!empty($_POST)) {
            Database::get()->exec("UPDATE articles
                                    SET title = \"". $_POST["title"] ."\",
                                        content = \"". $_POST["content"] ."\"
                                    WHERE id = \"". $id ."\"");
                        
            $_SESSION["message"] = "<p class='text-success'>L'article qui a comme id
                                    '". $id ."', comme titre '". $_POST["title"] ."'
                                    (anciennement '". $article["title"] ."') et comme
                                    contenu '". $_POST["content"] ."' (anciennement
                                    '". $article["content"] ."') a bien été modifié.</p>";
                        
            header("location: /admin/users");
            exit();
        }

        require("../templates/edit_user.php");
    }

    function delete($id) {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté.</p>";

            header("location: /login");
            exit();
        }

        /// récuperer l'article dans la bdd grace à l'id $_GET['id']

        $query = Database::get()->prepare("SELECT *
                                            FROM articles
                                            WHERE id = :id");

        $query->execute([
            ":id" => $id,
        ]);
        
        $article = $query->fetch(\PDO::FETCH_ASSOC);

        if ($article["author_id"] !== $_SESSION["user"]["id"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté sur ce compte.</p>";

            header("location: /admin/users");
            exit();
        }

        Database::get()->exec("DELETE
                                FROM articles
                                WHERE id = \"". $id ."\";
                                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL;
                                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");
        
        $_SESSION["message"] = "<p class='text-success'>L'article qui a comme id
                                '". $id ."' a bien été supprimé.</p>";
        
        header("location: /admin/users");
        exit();
    }
}