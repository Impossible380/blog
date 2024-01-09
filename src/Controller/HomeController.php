<?php

namespace App\Controller;

use App\Model\Repository\ArticleRepository;

class HomeController {
    function home() {
        $articles = ArticleRepository::findLatest();

        require("../templates/home.php");
    }
}