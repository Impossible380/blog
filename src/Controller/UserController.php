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
            $user->firstname = $_POST["firstname"];
            $user->lastname = $_POST["lastname"];
            $user->email = $_POST["email"];

            if (!empty($_POST['password'])) {
                $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            } else {
                $user->password = $ancient_user->password;
            }

            UserRepository::update($user);

            $_SESSION["message"] = [
                "type" => "success",
                "text" => "Le compte qui a comme id '" . $user->id . "', comme prénom
                            '" . $user->firstname . "' (anciennement
                            '" . $ancient_user->firstname . "') et comme nom
                            '" . $user->lastname . "' (anciennement
                            '" . $ancient_user->lastname . "') a bien été modifié."
            ];

            $_SESSION['user'] = $user;

            header("location: /admin/users");
            exit();
        }

        require("../templates/user_update.php");
    }
}