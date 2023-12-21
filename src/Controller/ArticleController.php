<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\ConditionRepository;
use App\Service\Database;

class ArticleController
{
    function list()
    {
        // ConditionRepository::userConnected();

        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();
        }

        $articles = ArticleRepository::findAll();

        require("../templates/article_list.php");
    }

    function details($id)
    {
        $article = ArticleRepository::findOneById($id);

        require("../templates/article_details.php");
    }

    function insert()
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
            $article = new Article();
            $article->content = $_POST['title'];
            $article->title = $_POST['content'];
            $article->author_id = $_SESSION['user']->id;
            $article->date = date("y-m-d");

            ArticleRepository::insert($article);

            $_SESSION["message"] = [
                "type" => "success",
                "text" => "L'article qui a comme titre '" . $article->title . "' et comme
                            contenu '" . $article->content . "' a bien été ajouté."
            ];

            $_SESSION["color_message"] = "success";

            header("location: /admin/articles");
            exit();
        }

        require("../templates/article_insert.php");
    }

    function update($id)
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

        $article = ArticleRepository::findOneById($id);

        if ($article->author_id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'auteur de cet article."
            ];

            header("location: /admin/articles");
            exit();
        }

        if (!empty($_POST)) {
            $ancient_article = $article;

            $article = new Article();
            $article->id = $id;
            $article->title = $_POST["title"];
            $article->content = $_POST["content"];

            ArticleRepository::update($article);

            $_SESSION["message"] = [
                "type" => "success",
                "text" => "L'article qui a comme id '" . $article->id . "', comme titre
                            '" . $article->title . "' (anciennement
                            '" . $ancient_article->title . "') et comme contenu
                            '" . $article->content . "' (anciennement
                            '" . $ancient_article->content . "') a bien été modifié."
            ];

            header("location: /admin/articles");
            exit();
        }

        require("../templates/article_update.php");
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

        $article = ArticleRepository::findOneById($id);

        if ($article->author_id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'auteur de cet article."
            ];

            header("location: /admin/articles");
            exit();
        }

        ArticleRepository::delete($id);
        
        $_SESSION["message"] = [
            "type" => "success",
            "text" => "L'article qui a comme id '" . $article->id . "' a bien été supprimé."
        ];

        header("location: /admin/articles");
        exit();
    }
}
