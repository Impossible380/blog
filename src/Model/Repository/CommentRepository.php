<?php

namespace App\Model\Repository;

use App\Model\Entity\Comment;
use App\Service\Database;

class CommentRepository
{
    static function getBasicSelectQuery()
    {
        return "SELECT
                    `comments`.`id`, `comments`.`content`, `comments`.`date`, `comments`.`article_id`, `comments`.`author_id`, `comments`.`status`,
                    `articles`.`title`,
                    `users`.`firstname`, `users`.`lastname`
                FROM
                    `comments`
                JOIN `users` ON `comments`.`author_id` = `users`.`id`
                JOIN `articles` ON `comments`.`article_id` = `articles`.`id`";
    }

    static function countByArticle(int $article_id):int {
        $query = Database::get()->prepare("SELECT
                                                COUNT(*) AS `article_comment_number`,
                                                'test' AS `Test`
                                            FROM
                                                `comments`
                                            WHERE
                                                `comments`.`article_id` = :article_id");
        
        $query->execute([
            ":article_id" => $article_id
        ]);
        
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        return intval($result['article_comment_number']); // nombre de commentaires de l'article n° $article_id
    }

    static function countByUser(int $user_id):int {
        $query = Database::get()->prepare("SELECT
                                                COUNT(*) AS `user_comment_number`,
                                                'test' AS `Test`
                                            FROM
                                                `comments`
                                            WHERE
                                                `comments`.`author_id` = :user_id");
        
        $query->execute([
            ":user_id" => $user_id
        ]);
        
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        return intval($result['user_comment_number']); // nombre de commentaires de l'utilisateur n° $user_id
    }

    static function findAll()
    {
        $query = Database::get()->query(self::getBasicSelectQuery());

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $comments = array_map(function ($row) {
            $comment = new Comment();
            $comment->fromSQL($row);
            return $comment;
        }, $result);

        return $comments;
    }

    static function findAllOfArticle(int $article_id)
    {
        $query = Database::get()->prepare(self::getBasicSelectQuery() . "
                                            WHERE `comments`.`article_id` = :article_id
                                            AND `comments`.`status` = 'accepted'");

        // $query = Database::get()->query("SELECT
        //                                     *
        //                                 FROM
        //                                     `articles`");

        $query->execute([
            ":article_id" => $article_id
        ]);

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $comments = array_map(function ($row) {
            $comment = new Comment();
            $comment->fromSQL($row);
            return $comment;
        }, $result);

        return $comments;
    }

    static function findOneById(int $id)
    {
        $query = Database::get()->prepare(self::getBasicSelectQuery() . "
                                            WHERE
                                                `comments`.`id` = :id");

        $query->execute([":id" => $id]);

        $row = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $comment = new Comment();
        $comment->fromSQL($row);

        return $comment;
    }

    static function validate($id)
    {
        $query = Database::get()->prepare("UPDATE `comments`
                                            SET `comments`.`status` = 'accepted'
                                            WHERE `id` = :id");

        $query->execute([
            ":id" => $id
        ]);
    }

    static function reject($id)
    {
        $query = Database::get()->prepare("UPDATE `comments`
                                            SET `comments`.`status` = 'rejected'
                                            WHERE `id` = :id");

        $query->execute([
            ":id" => $id
        ]);
    }

    static function insert(Comment $comment)
    {
        $query = Database::get()->prepare("INSERT INTO `comments`(`content`, `date`, `article_id`, `author_id`)
                                            VALUES(:content, :date, :article_id, :author_id)");

        $query->execute([
            ":content" => $comment->content,
            ":date" => $comment->date,
            ":article_id" => $comment->article_id,
            ":author_id" => $comment->author_id,
        ]);
    }

    static function delete(int $id)
    {
        $query = Database::get()->prepare("DELETE
                                            FROM
                                                `comments`
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $id
        ]);
    }
}