<?php

namespace App\Model\Entity;

class Article {
    public $id;
    public $title;
    public $content;
    public $author_id;

    function fromSQL($row) {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->author_id = $row['author_id'];
    }
}