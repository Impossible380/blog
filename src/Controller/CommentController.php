<?php

namespace App\Controller;

use App\Model\Entity\Comment;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\ConditionRepository;

class CommentController
{
    function list()
    {
        ConditionRepository::userConnected();
        
        $comments = CommentRepository::findAll();

        require("../templates/comment_list.php");
    }

    function validate($article_id, $comment_id)
    {
        ConditionRepository::userConnected();

        $article = ArticleRepository::findOneById($article_id);

        if ($article->author_id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'avez pas le droit de valider ou de rejeter un
                            commentaire sur un article dont vous n'êtes pas l'auteur."
            ];

            header("location: /admin/comments");
            exit();
        }

        CommentRepository::validate($comment_id);

        $_SESSION["message"] = [
            "type" => "success",
            "text" => "Commentaire validé."
        ];

        header("location: /admin/comments");
        exit();
    }

    function reject($article_id, $comment_id)
    {
        ConditionRepository::userConnected();

        $article = ArticleRepository::findOneById($article_id);

        if ($article->author_id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'avez pas le droit de valider ou de rejeter un
                            commentaire sur un article dont vous n'êtes pas l'auteur."
            ];

            header("location: /admin/comments");
            exit();
        }

        CommentRepository::reject($comment_id);

        $_SESSION["message"] = [
            "type" => "danger",
            "text" => "Commentaire rejeté."
        ];

        CommentRepository::delete($comment_id);

        header("location: /admin/comments");
        exit();
    }
    
    function insert(int $article_id)
    {
        ConditionRepository::userConnected();
        
        if (empty($_POST) || empty($_POST["content"])) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous devez saisir un commentaire."
            ];

            header("location: /articles/$article_id");
            exit();
        }

        $comment = new Comment();
        $comment->content = $_POST['content'];
        $comment->date = date("y-m-d H:i:s");
        $comment->article_id = $article_id;
        $comment->author_id = $_SESSION["user"]->id;

        CommentRepository::insert($comment);

        header("location: /articles/$article_id");
        exit();
    }

    function delete($id)
    {
        ConditionRepository::userConnected();

        /// récuperer l'article dans la bdd grace à l'id $_GET['id']

        $comment = CommentRepository::findOneById($id);

        if ($comment->author_id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'auteur de ce commentaire."
            ];

            header("location: /articles/$comment->article_id");
            exit();
        }

        CommentRepository::delete($id);
        
        $_SESSION["message"] = [
            "type" => "success",
            "text" => "Le commentaire qui a comme id '" . $comment->id . "' a bien été supprimé."
        ];

        header("location: /articles/$comment->article_id");
        exit();
    }
}