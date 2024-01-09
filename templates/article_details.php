<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5"><?= $article->title ?></h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <p class="text-primary">Créé le <?= $article->date ?></p>
            <p><?= $article->content ?></p>
            <p class="text-primary text-end">Ecrit par <?= $user->firstname ?> <?= $user->lastname ?></p>
        </div>

    </section>
    <!-- Fin SECTION -->

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <div class="row">

                <h2>Commentaires</h2>

                <form action="/admin/articles/<?= $id; ?>/comment/insert" method="post" class="row gy-4 mb-5">
                    <div class="form-example">
                        <label for="content">Commentez cet article : </label>
                        <textarea name="content" id="content" rows="5" cols="33" class="form-control" required></textarea>
                    </div>
                    <div class="form-example">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>

                <?php foreach($comments as $comment) { ?>

                    <div class="shadow rounded">
                        <p class="fw-bold">De <?= $comment->user->firstname ?> <?= $comment->user->lastname ?> le <?= $comment->date ?></p>
                        <p><?= $comment->content ?></p>
                    </div>

                <?php } ?>

            </div>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Détails de l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require('../templates/base.php'); ?>