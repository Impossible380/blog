<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Modifier l'article</h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <form action="/admin/articles/<?= $id; ?>/update" method="post" class="row gy-4">
                <div class="form-example">
                    <label for="title">Titre : </label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= $article->title; ?>" required />
                </div>
                <div class="form-example">
                    <label for="content">Contenu : </label>
                    <textarea name="content" id="content" rows="5" cols="33" class="form-control" required><?= $article->content; ?></textarea>
                </div>
                <div class="form-example">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Modifier l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>