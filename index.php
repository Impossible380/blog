<?php

require_once('vendor/autoload.php');

use App\Controller\HomeController;

if($url === '/login') {
    $controller = new AuthentificationController();
    $controller->login();
} elseif($url === '/logout') {
    $controller = new AuthentificationController();
    $controller->logout();
} elseif($url === '/') {
    $controller = new HomeController();
    $controller->home();
}

?>