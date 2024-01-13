<?php

use App\Controller\ArticleController;
use App\Controller\AuthController;
use App\Controller\CommentController;
use App\Controller\ContactController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Service\Database;

Database::init();

    $url = $_SERVER['REQUEST_URI'];

    // Début ArticleController
    if ($url === '/admin/articles') {
        $controller = new ArticleController();
        $controller->list();
        exit();
    }

    if (1 === preg_match('/^\/articles\/(?<id>\d+)$/', $url, $matches)) {
        $controller = new ArticleController();
        $controller->details($matches["id"]);
        exit();
    }

    if ($url === '/admin/articles/insert') {
        $controller = new ArticleController();
        $controller->insert();
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/update$/', $url, $matches)) {
        $controller = new ArticleController();
        $controller->update($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/delete$/', $url, $matches)) { 
        $controller = new ArticleController();
        $controller->delete($matches["id"]);
        exit();
    }
    // Fin ArticleController

    // Début AuthController    
    if ($url === '/register') {
        $controller = new AuthController();
        $controller->register();
        exit();
    }

    if ($url === '/login') { 
        $controller = new AuthController();
        $controller->login();
        exit();
    }

    if ($url === '/logout') { 
        $controller = new AuthController();
        $controller->logout();
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)\/delete$/', $url, $matches)) { 
        $controller = new AuthController();
        $controller->farewell($matches["id"]); // "Farewell" signifie "Adieu" en anglais
        exit();
    }
    // Fin AuthController

    // Début CommentController
    if ($url === '/admin/comments') {
        $controller = new CommentController();
        $controller->list();
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<article_id>\d+)\/comments\/(?<comment_id>\d+)\/validate$/', $url, $matches)) { 
        $controller = new CommentController();
        $controller->validate($matches["article_id"], $matches["comment_id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<article_id>\d+)\/comments\/(?<comment_id>\d+)\/reject$/', $url, $matches)) { 
        $controller = new CommentController();
        $controller->reject($matches["article_id"], $matches["comment_id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/comment\/insert$/', $url, $matches)) {
        $controller = new CommentController();
        $controller->insert($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/comments\/(?<id>\d+)\/delete$/', $url, $matches)) {
        $controller = new CommentController();
        $controller->delete($matches["id"]);
        exit();
    }
    // Fin CommentController

    // Début ContactController
    if ($url === '/contact') {
        $controller = new ContactController();
        $controller->contact();
        exit();
    }
    // Fin ContactController

    // Début HomeController
    if ($url === '/') { 
        $controller = new HomeController();
        $controller->home();
        exit();
    }
    // Fin HomeController

    // Début UserController
    if ($url === '/admin/users') {
        $controller = new UserController();
        $controller->list();
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)\/validate$/', $url, $matches)) { 
        $controller = new UserController();
        $controller->validate($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)\/reject$/', $url, $matches)) { 
        $controller = new UserController();
        $controller->reject($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)$/', $url, $matches)) {
        $controller = new UserController();
        $controller->parameters($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)\/update$/', $url, $matches)) {
        $controller = new UserController();
        $controller->update($matches["id"]);
        exit();
    }
    // Fin UserController

    echo 'url not found';