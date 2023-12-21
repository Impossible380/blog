<?php

namespace App\Model\Repository;

use App\Model\Entity\Article;
use App\Service\Database;

class ArticleRepository
{
    static function findAll()
    {
        /* $query = Database::get()->query("SELECT
                                            `articles`.`id`, `title`, `content`, `date`, `author_id`, `users`.`firstname`, `users`.`lastname`
                                        FROM
                                            `articles`
                                        JOIN `users` ON `author_id` = `users`.`id`"); */

        $query = Database::get()->query("SELECT
                                            *
                                        FROM
                                            `articles`");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $articles = array_map(function ($row) {
            $article = new Article();
            $article->fromSQL($row);
            return $article;
        }, $result);

        return $articles;
    }
    
    static function findLatest()
    {
        /* $query = Database::get()->query("SELECT
                                            `articles`.`id`, `title`, `content`, `date`, `author_id`, `users`.`firstname`, `users`.`lastname`
                                        FROM
                                            `articles`
                                        JOIN `users` ON `author_id` = `users`.`id`
                                        ORDER BY
                                            `articles`.`id`
                                        DESC
                                        LIMIT 4"); */

        $query = Database::get()->query("SELECT
                                            *
                                        FROM
                                            `articles`
                                        ORDER BY
                                            `articles`.`id`
                                        DESC
                                        LIMIT 4");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $latest_articles = array_map(function ($row) {
            $article = new Article();
            $article->fromSQL($row);
            return $article;
        }, $result);

        return $latest_articles;
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
        $query = Database::get()->prepare("INSERT INTO `articles`(`title`, `content`, `author_id`, `date`)
                                            VALUES(:title, :content, :author_id, :date)");

        $query->execute([
            ":title" => $article->title,
            ":content" => $article->content,
            ":author_id" => $article->author_id,
            ":date" => $article->date,
        ]);
    }

    static function update(Article $article)
    {
        $query = Database::get()->prepare("UPDATE
                                                `articles`
                                            SET
                                                `content` = :content,
                                                `title` = :title,
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $article->id,
            ":title" => $article->title,
            ":content" => $article->content,
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