<?php

namespace App\Controller;

class ArticleController {

    function list() {
           /* $query = $pdo->query("SELECT * FROM articles;"); */
    $query = $pdo->query("SELECT `articles`.`id`, `title`, `content`, `author_id`,
    `users`.`firstname`, `users`.`lastname`
        FROM `articles`
        JOIN `users`
        ON `author_id` = `users`.`id`");

        $articles = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        require("../templates/article_list.php");
    }

    function new() {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = "Vous n'êtes pas connecté.";
            header("location: /login");
            exit();
        }
    
        if (!empty($_POST)) {
            $pdo->exec("INSERT INTO articles(title, content, author_id)
                        VALUES(\"". $_POST["title"] ."\", \"". $_POST["content"] ."\", \"". $_SESSION["user"]["id"] ."\")");
                        
            $_SESSION["message"] = "L'article qui a comme titre '". $_POST["title"] ."'
            et comme contenu '". $_POST["content"] ."' a bien été ajouté.";
            
            header("location: /articles");
            exit();
        }

        require("../templates/new_form.php");
    }
}