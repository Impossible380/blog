<?php

namespace App\Model\Entity;

class Comment
{
    public $id;
    public $content;
    public $date;
    public $article_id;
    public $author_id;
    public $status;
    
    public Article $article;
    public User $user;

    function fromSQL($row)
    {
        // comment
        $this->id = $row['id'] ?? '';
        $this->content = $row['content'] ?? '';
        $this->date = $row['date'] ?? '';
        $this->article_id = $row['article_id'] ?? '';
        $this->author_id = $row['author_id'] ?? '';
        $this->status = $row['status'] ?? '';

        // article
        $this->article = new Article();
        $article_data = $row;
        $article_data["id"] = $row['article_id'];
        $article_data["author_id"] = $row['article_author_id'];
        $this->article->fromSQL($article_data);

        // user
        $this->user = new User();
        $user_data = $row;
        $user_data["id"] = $row['author_id'];
        $this->user->fromSQL($user_data);
    }
}
