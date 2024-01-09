<?php

namespace App\Controller;

use App\Model\Entity\Comment;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\ConditionRepository;

class CommentController
{
    function waiting_list()
    {
        $comments = CommentRepository::findWaiting();

        require("../templates/comment_waiting.php");
    }

    function validate($id)
    {
        CommentRepository::validate($id);

        $_SESSION["message"] = [
            "type" => "success",
            "text" => "Commentaire validé."
        ];

        header("location: /admin/comments");
        exit();
    }

    function reject($id)
    {
        CommentRepository::reject($id);

        $_SESSION["message"] = [
            "type" => "danger",
            "text" => "Commentaire rejeté."
        ];

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
        $comment->article_id = $article_id;
        $comment->author_id = $_SESSION["user"]->id;
        $comment->date = date("y-m-d H:i:s");

        CommentRepository::insert($comment);

        header("location: /articles/$article_id");
        exit();
    }
}