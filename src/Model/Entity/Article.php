<?php

namespace App\Model\Entity;

class Article
{
    public $id;
    public $title;
    public $content;
    public $creation_date;
    public $last_update;
    public $author_id;
    
    public User $user;

    function fromSQL($row)
    {
        // article
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->creation_date = $row['creation_date'];
        $this->last_update = $row['last_update'];
        $this->author_id = $row['author_id'];

        // user
        $this->user = new User();
        $user_data = $row;
        $user_data["id"] = $row['author_id'];
        $this->user->fromSQL($user_data);
    }
}
