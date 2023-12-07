<?php

namespace App\Controller;

class AuthController {
    function login() {
        require_once("lib.php");
        
        if ($_SESSION["user_connected"]) {
            header("location: /");
        }
        
        if (!empty($_POST)) {
            $query = $pdo->prepare("SELECT *
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
                $_SESSION["message"] = "Bonjour et bienvenue sur mon site.";
    
                header("location: /");
                exit();
    
            } else {
                $_SESSION["message"] = "Email ou mot de passe invalide";
            }
        }

        require("../templates/login_form.php");
    }

    function logout() {
        $_SESSION["message"] = "Merci et à bientôt !";
        $_SESSION["user_connected"] = false;

        header("location: /");
    }
}