<?php

namespace App\Model\Repository;

use App\Model\Entity\Article;
use App\Service\Database;

class ArticleRepository
{
    static function findAll()
    {
        $query = Database::get()->query("SELECT
                                            *
                                        FROM
                                            `articles`
                                        JOIN `users` ON `articles`.`author_id` = `users`.`id`");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $articles = array_map(function ($row) {
            $article = new Article();
            $article->fromSQL($row);
            return $article;
        }, $result);

        return $articles;
    }

    static function findOneById(int $id)
    {
        $query = Database::get()->prepare("SELECT
                                                *
                                            FROM
                                                `articles`
                                            WHERE
                                                `id` = :id");

        $query->execute([":id" => $id]);

        $row = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $article = new Article();
        $article->fromSQL($row);

        return $article;
    }

    static function insert(Article $article)
    {
        $query = Database::get()->prepare("INSERT INTO `articles`(`title`, `content`, `author_id`)
                                            VALUES(:title, :content, :author_id)");

        $query->execute([
            ":title" => $article->title,
            ":content" => $article->content,
            ":author_id" => $article->author_id,
        ]);
    }

    static function update(Article $article)
    {
        $query = Database::get()->prepare("UPDATE
                                                `articles`
                                            SET
                                                `content` = :content,
                                                `title` = :title,
                                                `autohr_id` = :author_id
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $article->id,
            ":firstname" => $article->title,
            ":lastname" => $article->content,
            ":email" => $article->author_id
        ]);
    }

    static function delete(int $id)
    {
        $query = Database::get()->prepare("DELETE
                                            FROM
                                                `users`
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $id
        ]);
    }
}