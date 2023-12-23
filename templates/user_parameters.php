<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Paramètres du compte</h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <?php dump($user); ?>

            <a class="btn btn-primary" href="/admin/users/<?= $user->id; ?>/update" role="button">
                Modifier le compte
            </a>
            <a class="btn btn-primary ms-5" href="/admin/users/<?= $user->id; ?>/delete" role="button">
                Supprimer le compte
            </a>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Paramètres du compte"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>