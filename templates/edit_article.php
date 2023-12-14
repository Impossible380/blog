<?php ob_start(); ?>

    <h1>Modifier l'article</h1>

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
            <input type="submit" value="Valider" row="3" />
        </div>
    </form>

    <?php $title = "Modifier l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>