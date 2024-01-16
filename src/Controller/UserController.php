<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Repository\ConditionRepository;
use App\Model\Repository\UserRepository;

class UserController
{
    function list()
    {
        ConditionRepository::userConnected();

        $users = UserRepository::findAll();

        require("../templates/user_list.php");
    }

    function validate($id)
    {
        ConditionRepository::userConnected();

        if ($_SESSION["user"]->id !== "1") {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'administrateur du site."
            ];

            header("location: /admin/users");
            exit();
        }

        UserRepository::validate($id);

        $_SESSION["message"] = [
            "type" => "success",
            "text" => "Utilisateur validé."
        ];

        header("location: /admin/users");
        exit();
    }

    function reject($id)
    {
        ConditionRepository::userConnected();

        if ($_SESSION["user"]->id !== "1") {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas l'administrateur du site."
            ];

            header("location: /admin/users");
            exit();
        }
        
        UserRepository::reject($id);

        $_SESSION["message"] = [
            "type" => "danger",
            "text" => "Utilisateur rejeté."
        ];

        UserRepository::delete($id);

        header("location: /admin/users");
        exit();
    }

    function parameters($id)
    {
        ConditionRepository::userConnected();

        $user = UserRepository::findOneById($id);

        if ($user->id !== $_SESSION["user"]->id) {
            $_SESSION["message"] = [
                "type" => "danger",
                "text" => "Vous n'êtes pas connecté sur ce compte."
            ];

            header("location: /admin/users");
            exit();
        }

        require("../templates/user_parameters.php");
    }

    function update($id)
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
        }

        if (!empty($_POST)) {
            $ancient_user = $user;

            $user = new User();
            $user->id = $ancient_user->id;
            $user->firstname = $_POST["firstname"];
            $user->lastname = $_POST["lastname"];
            $user->email = $_POST["email"];
            $user->status = $ancient_user->status;

            if (!empty($_POST['password'])) {
                $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            } else {
                $user->password = $_SESSION["user"]->password;
            }

            $_SESSION["user"] = $user;

            UserRepository::update($user);

            $_SESSION["message"] = [
                "type" => "success",
                "text" => "Le compte qui a comme id '" . $user->id . "', comme prénom
                            '" . $user->firstname . "' (anciennement
                            '" . $ancient_user->firstname . "'), comme nom
                            '" . $user->lastname . "' (anciennement
                            '" . $ancient_user->lastname . "') et comme nom
                            '" . $user->email . "' (anciennement
                            '" . $ancient_user->email . "') a bien été modifié."
            ];

            header("location: /admin/users");
            exit();
        }

        require("../templates/user_update.php");
    }
}