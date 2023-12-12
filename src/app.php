<?php

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\ContactController;
use App\Controller\ArticleController;
use App\Service\Database;

Database::init();

    $url = $_SERVER['REQUEST_URI'];

    if ($url === '/') { 
        $controller = new HomeController();
        $controller->home();
        exit(0);
    }

    if ($url === '/contact') {
        $controller = new ContactController();
        $controller->contact();
        exit(0);
    }

    if ($url === '/login') { 
        $controller = new AuthController();
        $controller->login();
        exit(0);
    }

    if ($url === '/logout') { 
        $controller = new AuthController();
        $controller->logout();
        exit(0);
    }

    if ($url === '/admin/articles') {
        $controller = new ArticleController();
        $controller->list();
        exit(0);
    }

    if (1 === preg_match('/^\/articles\/(?<id>\d+)$/', $url, $matches)) {
    // if ($url === '/articles/details') {
        $controller = new ArticleController();
        $controller->details($matches["id"]);
        exit(0);
    }

    if ($url === '/admin/articles/new') {
        $controller = new ArticleController();
        $controller->new();
        exit(0);
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/edit$/', $url, $matches)) {
    // if ($url === '/articles/edit') { 
        $controller = new ArticleController();
        $controller->edit($matches["id"]);
        exit(0);
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/delete$/', $url, $matches)) { 
        $controller = new ArticleController();
        $controller->delete($matches["id"]);
        exit(0);
    }

    /* if (isset($_GET["user_action"]) && $_GET["user_action"] === "logout") {
        $_SESSION["message"] = "Merci et à bientôt !";
        $_SESSION["user_connected"] = false;
    } */

    echo 'url not found';