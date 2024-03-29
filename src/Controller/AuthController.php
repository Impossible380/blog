<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\ConditionRepository;
use App\Model\Repository\UserRepository;

class AuthController
{
    function register()
    {
        if ($_SESSION["user_connected"]) {
            header("location: /");
            exit();
        }

        if (!empty($_POST)) {
            $user = new User();
            $user->firstname = $_POST['firstname'];
            $user->lastname = $_POST['lastname'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user = UserRepository::insert($user);

            $_SESSION["user"] = $user;
            $_SESSION["user_connected"] = true;

            if ($_SESSION["user"]->status === 'accepted') {
                $_SESSION["message"] = [
                    "type" => "info",
                    "text" => "Bonjour et bienvenue sur Parker Press."
                ];
            } else if ($_SESSION["user"]->status === 'waiting') {
                $_SESSION["message"] = [
                    "type" => "info",
                    "text" => "En attente de validation ou de rejet."
                ];
            }

            header("location: /");
            exit();
        }

        require("../templates/register.php");
    }

    function login()
    {
        if ($_SESSION["user_connected"]) {
            header("location: /");
            exit();
        }

        if (!empty($_POST)) {
            $user = UserRepository::findOneByEmail($_POST["email"], true);

            if (!$user || !password_verify($_POST["password"], $user->password)) {
                $_SESSION["message"] = [
                    "type" => "danger",
                    "text" => "Email ou mot de passe invalide."
                ];

                require("../templates/login.php");
                return;
            }

            $_SESSION["user"] = $user;
            $_SESSION["user_connected"] = true;

            if ($_SESSION["user"]->status === 'accepted') {
                $_SESSION["message"] = [
                    "type" => "info",
                    "text" => "Bonjour et bienvenue sur Parker Press."
                ];
            } else if ($_SESSION["user"]->status === 'waiting') {
                $_SESSION["message"] = [
                    "type" => "info",
                    "text" => "En attente de validation ou de rejet."
                ];
            }

            header("location: /");
            exit();
        }

        require("../templates/login.php");
    }

    function logout()
    {
        if ($_SESSION["user_connected"]) {
            $_SESSION["message"] = [
                "type" => "info",
                "text" => "Merci d'être venu sur Parker Press et à bientôt !"
            ];

            $_SESSION["user_connected"] = false;
            $_SESSION["user"] = null;
        }

        header("location: /");
        exit();
    }

    function farewell($id) // "Farewell" signifie "Adieu" en anglais
    {
        ConditionRepository::userConnected();

        /// récuperer le user dans la bdd grace à l'id $_GET['id']

        $user = UserRepository::findOneById($id);

        if ($user->id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas autorisé à modifier ou à supprimer les informations des autres comptes."
            ];

            header("location: /admin/users");
            exit();

        } else if ($user->id === "1") {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous ne pouvez pas supprimer votre compte car vous êtes l'administrateur du site."
            ];

            header("location: /admin/users");
            exit();
        }

        $count_articles = ArticleRepository::countByUser($id);
        $count_comments = CommentRepository::countByUser($id);

        if ($count_articles === 0 && $count_comments === 0) {
            UserRepository::delete($id);

            if ($_SESSION["user_connected"]) {
                $_SESSION["message"] = [
                    "type" => "info",
                    "text" => "Merci d'être venu sur Parker Press et bonne continuation !"
                ];

                $_SESSION["user_connected"] = false;
                $_SESSION["user"] = null;
            }

            header("location: /");
            exit();
            
        } else {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous ne pouvez pas supprimer votre compte car vous avez encore $count_articles article(s) et $count_comments commentaire(s)."
            ];

            header("location: /admin/users");
            exit();
        }
    }
}
