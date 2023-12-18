<?php

namespace App\Controller;

use App\Service\Database;

class ArticleController
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

        $query = Database::get()->query("SELECT
                                            `articles`.`id`,
                                            `title`,
                                            `content`,
                                            `users`.`firstname`,
                                            `users`.`lastname`
                                        FROM
                                            `articles`
                                        JOIN `users` ON `author_id` = `users`.`id`");

        $articles = $query->fetchAll(\PDO::FETCH_ASSOC);

        require("../templates/article_list.php");
    }

    function details($id)
    {
        $query = Database::get()->prepare("SELECT *
                                            FROM articles
                                            WHERE id = :id");

        $query->execute([":id" => $id]);

        $article = $query->fetch(\PDO::FETCH_ASSOC);

        require("../templates/article_details.php");
    }

    function new()
    {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();
        }

        if (!empty($_POST)) {
            $query = Database::get()->prepare("INSERT INTO articles(title, content, author_id)
                                                VALUES(:title, :content, :author_id)");

            $query->execute([
                ":title" => $_POST["title"],
                ":content" => $_POST["content"],
                ":author_id" => $_SESSION["user"]["id"]
            ]);

            $article = $query->fetch(\PDO::FETCH_ASSOC);


            $_SESSION["message"] = [
                "type" => "success",
                "text" => "L'article qui a comme titre '" . $_POST["title"] . "' et comme
                            contenu '" . $_POST["content"] . "' a bien été ajouté."
            ];

            $_SESSION["color_message"] = "success";

            header("location: /admin/articles");
            exit();
        }

        require("../templates/new_article.php");
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

        $query = Database::get()->prepare("SELECT
                                                *
                                            FROM
                                                articles
                                            WHERE
                                                id = :id");

        $query->execute([
            ":id" => $id,
        ]);

        $article = $query->fetch(\PDO::FETCH_ASSOC);

        if ($article["author_id"] !== $_SESSION["user"]["id"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'auteur de cet article."
            ];

            header("location: /admin/articles");
            exit();
        }

        if (!empty($_POST)) {
            $query = Database::get()->prepare("UPDATE
                                                    articles
                                                SET
                                                    title = :title,
                                                    content = :content
                                                WHERE
                                                    id = :id");

            $query->execute([
                ":id" => $id,
                ":title" => $_POST["title"],
                ":content" => $_POST["content"]
            ]);

            $_SESSION["message"] = [
                "type" => "success",
                "text" => "L'article qui a comme id '" . $id . "', comme titre
                            '" . $_POST["title"] . "' (anciennement
                            '" . $article["title"] . "') et comme contenu
                            '" . $_POST["content"] . "' (anciennement
                            '" . $article["content"] . "') a bien été modifié."
            ];
    
            $article = $query->fetch(\PDO::FETCH_ASSOC);

            header("location: /admin/articles");
            exit();
        }

        require("../templates/edit_article.php");
    }

    function delete($id)
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

        $query = Database::get()->prepare("SELECT
                                                *
                                            FROM
                                                articles
                                            WHERE
                                                id = :id");

        $query->execute([
            ":id" => $id,
        ]);

        $article = $query->fetch(\PDO::FETCH_ASSOC);

        if ($article["author_id"] !== $_SESSION["user"]["id"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'auteur de cet article."
            ];

            header("location: /admin/articles");
            exit();
        }

        $query = Database::get()->prepare("DELETE
                                            FROM
                                                `articles`
                                            WHERE
                                                `id` = :id;
                                            ALTER TABLE
                                                `articles` CHANGE `id` `id` INT(11) NOT NULL;
                                            ALTER TABLE
                                                `articles` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");

        $query->execute([
            ":id" => $id,
        ]);

        $article = $query->fetch(\PDO::FETCH_ASSOC);
        
        $_SESSION["message"] = [
            "type" => "success",
            "text" => "L'article qui a comme id '" . $id . "' a bien été supprimé."
        ];

        header("location: /admin/articles");
        exit();
    }
}
