<?php

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\ContactController;
use App\Controller\ArticleController;
use App\Controller\UserController;
use App\Service\Database;

Database::init();

    $url = $_SERVER['REQUEST_URI'];

    // Début HomeController
    if ($url === '/') { 
        $controller = new HomeController();
        $controller->home();
        exit();
    }
    // Fin HomeController

    // Début ContactController
    if ($url === '/contact') {
        $controller = new ContactController();
        $controller->contact();
        exit();
    }
    // Fin ContactController

    // Début AuthController
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
    // Fin AuthController

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

    if ($url === '/admin/articles/new') {
        $controller = new ArticleController();
        $controller->new();
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/edit$/', $url, $matches)) {
        $controller = new ArticleController();
        $controller->edit($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/articles\/(?<id>\d+)\/delete$/', $url, $matches)) { 
        $controller = new ArticleController();
        $controller->delete($matches["id"]);
        exit();
    }
    // Fin ArticleController

    // Début UserController
    if ($url === '/admin/users') {
        $controller = new UserController();
        $controller->list();
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)$/', $url, $matches)) {
        $controller = new UserController();
        $controller->parameters($matches["id"]);
        exit();
    }
    
    if ($url === '/users/new') {
        $controller = new UserController();
        $controller->new();
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)\/edit$/', $url, $matches)) {
        $controller = new UserController();
        $controller->edit($matches["id"]);
        exit();
    }

    if (1 === preg_match('/^\/admin\/users\/(?<id>\d+)\/delete$/', $url, $matches)) { 
        $controller = new UserController();
        $controller->delete($matches["id"]);
        exit();
    }
    // Fin UserController

    /* if (isset($_GET["user_action"]) && $_GET["user_action"] === "logout") {
        $_SESSION["message"] = "Merci et à bientôt !";
        $_SESSION["user_connected"] = false;
    } */

    echo 'url not found';