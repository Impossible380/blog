<?php

namespace App\Controller;

use App\Model\Entity\Comment;
use App\Model\Repository\CommentRepository;

class CommentController
{
    function insert(int $article_id)
    {
        if (!$_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté."
            ];

            header("location: /login");
            exit();
        }
        
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
        $comment->article_id = $article_id;
        $comment->author_id = $_SESSION["user"]->id;
        $comment->date = date("y-m-d H:i:s");

        CommentRepository::insert($comment);

        header("location: /articles/$article_id");
        exit();
    }
}