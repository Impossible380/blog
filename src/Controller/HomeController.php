<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Repository\ArticleRepository;
use App\Service\Database;

class HomeController {
    function home() {
        $latest_articles = ArticleRepository::findLatest();

        require("../templates/home.php");
    }
}