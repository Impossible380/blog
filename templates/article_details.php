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
                <h2 class="mb-4">Commentaires</h2>

                <?php foreach($comments as $comment) { ?>
                    <p>De <?= $comment->user->firstname ?> <?= $comment->user->lastname ?> le <?= $comment->date ?></p>
                    <p><?= $comment->content ?></p>
                <?php } ?>

            </div>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Détails de l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require('../templates/base.php'); ?>