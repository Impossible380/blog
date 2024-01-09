<?php

namespace App\Model\Repository;

use App\Model\Entity\Comment;
use App\Service\Database;

class CommentRepository
{
    static function getBasicSelectQuery()
    {
        return "SELECT
                    `comments`.`id`, `comments`.`content`, `comments`.`article_id`, `comments`.`author_id`, `comments`.`date`, `comments`.`status`,
                    `articles`.`title`,
                    `users`.`firstname`, `users`.`lastname`, `users`.`email`, `users`.`password`
                FROM
                    `comments`
                JOIN `users` ON `comments`.`author_id` = `users`.`id`
                JOIN `articles` ON `comments`.`article_id` = `articles`.`id`";
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

    static function findWaiting()
    {
        $query = Database::get()->query(self::getBasicSelectQuery() . "
                                        WHERE `comments`.`status` = 'waiting'");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $comments = array_map(function ($row) {
            $comment = new Comment();
            $comment->fromSQL($row);
            return $comment;
        }, $result);

        return $comments;
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
        $query = Database::get()->prepare("INSERT INTO `comments`(`content`, `article_id`, `author_id`, `date`)
                                            VALUES(:content, :article_id, :author_id, :date)");

        $query->execute([
            ":content" => $comment->content,
            ":article_id" => $comment->article_id,
            ":author_id" => $comment->author_id,
            ":date" => $comment->date,
        ]);
    }

    static function update(Comment $comment)
    {
        $query = Database::get()->prepare("UPDATE
                                                `comments`
                                            SET
                                                `content` = :content
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $comment->id,
            ":content" => $comment->content,
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
