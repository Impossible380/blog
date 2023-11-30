<?php
    if (empty($_SESSION["user_connected"])) {
        $_SESSION["user_connected"] = false;
    }
?>


<?php
    if ($_SESSION["user_connected"]) {
        header("location: index.php");
    }
?>


<?php
    require_once("lib.php");
    
    if (!empty($_POST)) {
        $query = $pdo->prepare("SELECT *
                                FROM users
                                WHERE email = :email AND password = :password");

        $query->execute([
            ":email" => $_POST["email"],
            ":password" => $_POST["password"]
        ]);
        
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        
        /* if (!empty($_POST)) { */
        if ($user) {
            $_SESSION["user"] = $user;
            $_SESSION["user_connected"] = true;
            $_SESSION["message"] = "Bonjour et bienvenue sur mon site.";

            header("location: index.php");
            exit(0);

        } else {
            $_SESSION["message"] = "Email ou mot de passe invalide";
        }
    }
?>


<?php ob_start(); ?>

    <form action="" method="post" class="form-example">
        <!-- <div class="form-example">
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" id="firstname" required />
        </div>
        <div class="form-example">
            <label for="lastname">Nom : </label>
            <input type="text" name="lastname" id="lastname" required />
        </div> -->
        <div class="form-example">
            <label for="email">Email : </label>
            <input type="email" name="email" id="email" required />
        </div>
        <div class="form-example">
            <label for="email">Mot de passe : </label>
            <input type="password" name="password" id="password" required />
        </div>
        <div class="form-example">
            <input type="submit" value="Subscribe!" row="3" />
        </div>
    </form>

    <?php $title = "Accueil"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("templates/base.php"); ?>