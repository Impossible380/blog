<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="style.css?<?=rand()?>">
    </head>

    <!-- Début BODY -->
    <body>

        <!-- Début HEADER -->
        <header>
            
            <img src="images/logo.jpg">
            <ul>
                <li>
                    <?php if ($_SESSION["user_connected"]) { ?>
                        <a href="index.php?user_action=log_out">Se déconnecter</a>
                    <?php } else { ?>
                        <a href="log_in.php">Se connecter</a>
                    <?php } ?>
                </li>
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="articles_list.php">Liste des blogs posts</a>
                </li>
            </ul>

        </header>
        <!-- Fin HEADER -->

        <!-- Début MAIN -->
        <main>

            <?php if(!empty($_SESSION["message"])) { ?>
                <p><?= $_SESSION["message"] ?></p>
                <?php $_SESSION["message"] = "" ?>
            <?php } ?>

            <?php echo $content; ?>
            
        </main>
        <!-- Fin MAIN -->

        <!-- Début FOOTER -->
        <footer>
            
            <img src="images/logo_facebook.png">
            <img src="images/logo_twitter.png">
            <img src="images/logo_instagram.png">

        </footer>
        <!-- Fin FOOTER -->

    </body>
    <!-- Fin BODY -->

</html>