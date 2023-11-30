<?php
    require_once("lib.php");
    $id = $_GET["id"];

    /// récuperer l'article dans la bdd grace à l'id $_GET['id']

    $query = $pdo->prepare("SELECT *
                                FROM articles
                                WHERE id = :id");

    $query->execute([":id" => $id]);
    
    $article = $query->fetch(\PDO::FETCH_ASSOC);

    if (!empty($_POST)) {
        $pdo->exec("UPDATE articles
                    SET title = \"". $_POST["title"] ."\",
                        content = \"". $_POST["content"] ."\"
                    WHERE id = \"". $id ."\"");
                    
        $_SESSION["message"] = "L'article qui a comme id '". $id ."', comme titre
        '". $_POST["title"] ."' (anciennement '". $article["title"] ."') et comme contenu
        '". $_POST["content"] ."' (anciennement '". $article["content"] ."') a bien été
        modifié.";
                    
        header("location: articles_list.php");
        exit(0);
    }
?>


<?php ob_start(); ?>

    <h1>Modifier article</h1>

    <form action="" method="post" class="form-example">
        <div class="form-example">
            <label for="title">Titre : </label>
            <input type="text" name="title" id="title" value="<?= $article['title'] ?>" required />
        </div>
        <div class="form-example">
            <label for="content">Contenu : </label>
            <textarea name="content" id="content" rows="5" cols="33" required><?= $article['content'] ?></textarea>
        </div>
        <div class="form-example">
            <input type="submit" value="Subscribe!" row="3" />
        </div>
    </form>

    <?php $title = "Modifier un article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("templates/base.php"); ?>