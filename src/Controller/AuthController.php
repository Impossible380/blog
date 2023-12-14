<?php

namespace App\Controller;

use App\Service\Database;

class AuthController {
    function login() {
        if ($_SESSION["user_connected"]) {
            header("location: /");
            exit();
        }
        
        if (!empty($_POST)) {
            $query = Database::get()->prepare("SELECT *
                                                FROM users
                                                WHERE email = :email AND password = :password");
    
            $query->execute([
                ":email" => $_POST["email"],
                ":password" => $_POST["password"]
            ]);
            
            $user = $query->fetch(\PDO::FETCH_ASSOC);
            
            if ($user) {
                $_SESSION["user"] = $user;
                $_SESSION["user_connected"] = true;
                $_SESSION["message"] = "<p class='text-info'>Bonjour et bienvenue sur Parker Press.</p>";
    
                header("location: /");
                exit();
    
            } else {
                $_SESSION["message"] = "<p class='text-danger'>Email ou mot de passe invalide</p>";
            }
        }

        require("../templates/login.php");
    }

    function logout() {
        if ($_SESSION["user_connected"]) {
            $_SESSION["message"] = "<p class='text-info'>Merci d'être venu sur Parker Press et à bientôt !</p>";
            $_SESSION["user_connected"] = false;
        }

        header("location: /");
        exit();
    }
}