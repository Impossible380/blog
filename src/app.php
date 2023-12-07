<?php

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\ArticleController;

    $url = $_SERVER['REQUEST_URI'];

    if ($url === '/') { 
        $controller = new HomeController();
        $controller->home();
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

    if ($url === '/articles') { 
        $controller = new ArticleController();
        $controller->list();
        exit(0);
    }

    if ($url === '/articles/details') { 
        $controller = new ArticleController();
        $controller->details();
        exit(0);
    }

    if ($url === '/articles/new') {
        $controller = new ArticleController();
        $controller->new();
        exit(0);
    }

    if ($url === '/articles/edit') { 
        $controller = new ArticleController();
        $controller->edit();
        exit(0);
    }

    if ($url === '/articles/delete') { 
        $controller = new ArticleController();
        $controller->delete();
        exit(0);
    }

    if (isset($_GET["user_action"]) && $_GET["user_action"] === "log_out") {
        $_SESSION["message"] = "Merci et à bientôt !";
        $_SESSION["user_connected"] = false;
    }
?>