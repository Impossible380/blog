<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\ConditionRepository;
use App\Model\Repository\UserRepository;

class ArticleController
{
    function list()
    {
        ConditionRepository::userConnected();

        $articles = ArticleRepository::findAll();

        require("../templates/article_list.php");
    }

    function details($id)
    {
        $article = ArticleRepository::findOneById($id);

        $comments = CommentRepository::findAllOfArticle($id);

        $user = UserRepository::findOneById($article->author_id);

        require("../templates/article_details.php");
    }

    function insert()
    {
        ConditionRepository::userConnected();

        if (!empty($_POST)) {
            $article = new Article();
            $article->title = $_POST['title'];
            $article->content = $_POST['content'];
            $article->author_id = $_SESSION['user']->id;
            $article->creation_date = date("y-m-d H:i:s");
            $article->last_update = date("y-m-d H:i:s");

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
        ConditionRepository::userConnected();

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
            $article->id = $ancient_article->id;
            $article->title = $_POST["title"];
            $article->content = $_POST["content"];
            $article->last_update = date("y-m-d H:i:s");

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
        ConditionRepository::userConnected();

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

        $count_comments = CommentRepository::countByArticle($id);

        if ($count_comments === 0) {
            ArticleRepository::delete($id);
            
            $_SESSION["message"] = [
                "type" => "success",
                "text" => "L'article qui a comme id '" . $article->id . "' a bien été supprimé."
            ];
    
            header("location: /admin/articles");
            exit();
        }

        else {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous ne pouvez pas supprimer cet article car il a encore $count_comments commentaire(s)."
            ];

            header("location: /admin/articles");
            exit();
        }
    }
}