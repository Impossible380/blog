<?php
    require_once("lib.php");

    if (!empty($_POST)) {
        $pdo->exec("INSERT INTO articles(title, content, author_id)
                    VALUES(\"". $_POST["title"] ."\", \"". $_POST["content"] ."\", 1)");
                    
        $_SESSION["message"] = "L'article qui a comme titre '". $_POST["title"] ."'
        et comme contenu '". $_POST["content"] ."' a bien été ajouté.";
        
        header("location: articles_list.php");
        exit(0);
    }
?>


<?php ob_start(); ?>

    <h1>Ajouter article</h1>

    <form action="" method="post" class="form-example">
        <div class="form-example">
            <label for="title">Titre : </label>
            <input type="text" name="title" id="title" required />
        </div>
        <div class="form-example">
            <label for="content">Contenu : </label>
            <textarea name="content" id="content" rows="5" cols="33" required></textarea>
        </div>
        <div class="form-example">
            <input type="submit" value="Subscribe!" row="3" />
        </div>
    </form>

    <?php $title = "Ajouter un article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("templates/base.php"); ?>