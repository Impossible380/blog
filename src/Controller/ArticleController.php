<?php

namespace App\Controller;

use App\Service\Database;

class ArticleController {
    function list() {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté.</p>";
            header("location: /login");
            exit();
        }
        
        /* $query = $pdo->query("SELECT *, `users`.`firstname`, `users`.`lastname`
                                FROM `articles`
                                JOIN `users`
                                ON `author_id` = `users`.`id`"); */
                                
        $query = Database::get()->query("SELECT `articles`.`id`, `title`, `content`, `author_id`,
                                                `users`.`firstname`, `users`.`lastname`
                                        FROM `articles`
                                        JOIN `users`
                                        ON `author_id` = `users`.`id`");

        $articles = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        require("../templates/article_list.php");
    }

    function details($id) {
        $query = Database::get()->prepare("SELECT *
                                            FROM articles
                                            WHERE id = :id");

        $query->execute([":id" => $id]);
        
        $article = $query->fetch(\PDO::FETCH_ASSOC);

        require("../templates/article_details.php");
    }

    function new() {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas connecté.</p>";
            header("location: /login");
            exit();
        }
        
        if (!empty($_POST)) {
            Database::get()->exec("INSERT INTO articles(title, content, author_id)
                                    VALUES(\"". $_POST["title"] ."\", \"". $_POST["content"] ."\", \"". $_SESSION["user"]["id"] ."\")");
                        
            $_SESSION["message"] = "<p class='text-success'>L'article qui a comme titre
                                    '". $_POST["title"] ."' et comme contenu
                                    '". $_POST["content"] ."' a bien été ajouté.</p>";

            $_SESSION["color_message"] = "success";
            
            header("location: /admin/articles");
            exit();
        }

        require("../templates/new_form.php");
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
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas l'auteur de cet
                                    article.</p>";

            header("location: /admin/articles");
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
                        
            header("location: /admin/articles");
            exit();
        }

        require("../templates/edit_form.php");
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
            $_SESSION["message"] = "<p class='text-danger'>Vous n'êtes pas l'auteur de cet
                                    article.</p>";

            header("location: /admin/articles");
            exit();
        }

        Database::get()->exec("DELETE
                                FROM articles
                                WHERE id = \"". $id ."\";
                                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL;
                                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");
        
        $_SESSION["message"] = "<p class='text-success'>L'article qui a comme id
                                '". $id ."' a bien été supprimé.</p>";
        
        header("location: /admin/articles");
        exit();
    }
}