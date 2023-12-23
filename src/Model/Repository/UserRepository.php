<?php

namespace App\Model\Repository;

use App\Model\Entity\User;
use App\Service\Database;

class UserRepository
{
    static function getBasicSelectQuery(bool $needsPassword = false)
    {
        return "SELECT
                    `users`.`id`,
                    `users`.`firstname`,
                    `users`.`lastname`,
                    `users`.`email`,
                    ". ($needsPassword ? "`users`.`password`" : "NULL") ." AS password
                FROM
                    `users`";
    }

    static function findAll()
    {
        $query = Database::get()->query(self::getBasicSelectQuery());

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        $users = array_map(function ($row) {
            $user = new User();
            $user->fromSQL($row);
            return $user;
        }, $result);

        return $users;
    }

    static function findOneById(int $id)
    {
        $query = Database::get()->prepare(self::getBasicSelectQuery() ."
                                            WHERE
                                                `id` = :id");

        $query->execute([":id" => $id]);

        $row = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->fromSQL($row);

        return $user;
    }

    static function findOneByEmail(string $email, bool $needsPassword)
    {
        $query = Database::get()->prepare(self::getBasicSelectQuery($needsPassword) ."
                                            WHERE
                                                `email` = :email");

        $query->execute([":email" => $email]);

        $row = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->fromSQL($row);

        return $user;
    }

    static function insert(User $user)
    {
        $query = Database::get()->prepare("INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`)
                                            VALUES(:firstname, :lastname, :email, :password)");

        $query->execute([
            ":firstname" => $user->firstname,
            ":lastname" => $user->lastname,
            ":email" => $user->email,
            ":password" => $user->password
        ]);

        return UserRepository::findOneByEmail($user->email);
    }

    static function update(User $user)
    {
        $query = Database::get()->prepare("UPDATE
                                                `users`
                                            SET
                                                `firstname` = :firstname,
                                                `lastname` = :lastname,
                                                `email` = :email,
                                                `password` = :password
                                            WHERE
                                                `id` = :id");

        $query->execute([
            ":id" => $user->id,
            ":firstname" => $user->firstname,
            ":lastname" => $user->lastname,
            ":email" => $user->email,
            ":password" => $user->password
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