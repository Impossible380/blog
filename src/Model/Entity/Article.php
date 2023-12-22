<?php

namespace App\Model\Entity;

class Article
{
    public $id;
    public $title;
    public $content;
    public $author_id;
    public $date;
    public User $user;

    function fromSQL($row)
    {
        // article
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->author_id = $row['author_id'];
        $this->date = $row['date'];

        // user
        $this->user = new User();
        $user_data = $row;
        $user_data["id"] = $row['author_id'];
        $this->user->fromSQL($user_data);
    }
}
