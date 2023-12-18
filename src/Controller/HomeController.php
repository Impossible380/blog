<?php

namespace App\Controller;

use App\Service\Database;

class HomeController {
    function home() {
        $query = Database::get()->query("SELECT
                                            `articles`.`id`,
                                            `title`,
                                            `content`,
                                            `users`.`firstname`,
                                            `users`.`lastname`
                                        FROM
                                            `articles`
                                        JOIN `users` ON `author_id` = `users`.`id`
                                        ORDER BY
                                            `articles`.`id`
                                        DESC
                                        LIMIT 4");

        $latest_articles = $query->fetchAll(\PDO::FETCH_ASSOC);

        require("../templates/home.php");
    }
}