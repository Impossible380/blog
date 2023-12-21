<?php

namespace App\Model\Entity;

class Article {
    public $id;
    public $title;
    public $content;
    public $author_id;
    public $date;
    /* public $firstname;
    public $lastname; */

    function fromSQL($row) {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->author_id = $row['author_id'];
        $this->date = $row['date'];
        /* $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname']; */
    }
}