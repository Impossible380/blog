<?php

namespace App\Model\Repository;

use App\Model\Entity\Article;
use App\Service\Database;

class ArticleRepository
{
    static function countByUser(int $user_id):int {
        $query = Database::get()->prepare("SELECT
                                                COUNT(*) AS `article_number`,
                                                'test' AS `Test`
                                            FROM
                                                `articles`
                                            WHERE
                                                `articles`.`author_id` = :user_id");
        
        $query->execute([
            ":user_id" => $user_id
        ]);
        
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        return intval($result['article_number']); // nombre d'articles de l'utilisateur n° $user_id
    }

    static function getBasicSelectQuery()
    {
        return "SELECT
                    `articles`.`id`, `articles`.`title`, `articles`.`content`, `articles`.`date`, `articles`.`author_id`, 
                    `users`.`firstname`, `users`.`lastname`, `users`.`email`, `users`.`password`, `users`.`status`
                FROM
                    `articles`
                JOIN `users` ON `articles`.`author_id` = `users`.`id`";
    }

    static function findAll()
    {
        $query = Database::get()->query(self::getBasicSelectQuery());

        // $query = Database::get()->query("SELECT
        //                                     *
        //                                 FROM
        //                                     `articles`");

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
        $query = Database::get()->query(self::getBasicSelectQuery() . "
                                        ORDER BY
                                            `articles`.`id`
                                        DESC
                                        LIMIT 4");

        // $query = Database::get()->query("SELECT
        //                                     *
        //                                 FROM
        //                                     `articles`
        //                                 ORDER BY
        //                                     `articles`.`id`
        //                                 DESC
        //                                 LIMIT 4");

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
        $query = Database::get()->prepare(self::getBasicSelectQuery() . "
                                            WHERE
                                                `articles`.`id` = :id");

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
                                                `title` = :title,
                                                `content` = :content
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
                                                `articles`
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $id
        ]);
    }
}
