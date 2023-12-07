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
                <?php
                    if ($_SESSION["user_connected"]) {
                        echo '<li class="user_infos">'. $_SESSION['user']['firstname']
                            .' '. $_SESSION['user']['lastname'] .'</li>';
                    }
                ?>
                <li>
                    <?php if ($_SESSION["user_connected"]) { ?>
                        <a href="/logout">Se déconnecter</a>
                    <?php } else { ?>
                        <a href="/login">Se connecter</a>
                    <?php } ?>
                </li>
                <li>
                    <a href="/">Accueil</a>
                </li>
                <li>
                    <a href="/articles">Liste des blogs posts</a>
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