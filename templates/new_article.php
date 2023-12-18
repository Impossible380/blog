<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Nouvel article</h1>

    <form action="/admin/articles/new" method="post" class="form-example">
        <div class="form-example">
            <label for="title">Titre : </label>
            <input type="text" name="title" id="title" required />
        </div>
        <div class="form-example">
            <label for="content">Contenu : </label>
            <textarea name="content" id="content" rows="5" cols="33" required></textarea>
        </div>
        <div class="form-example">
            <input type="submit" value="Valider" row="3" />
        </div>
    </form>

    <?php $title = "Nouvel article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>