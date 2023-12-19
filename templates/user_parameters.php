<?php ob_start(); ?>

    <h1>Paramètres du compte</h1>

    <?php dump($user); ?>

    <a class="btn btn-primary" href="/admin/users/<?= $user->id; ?>/update" role="button">
        Modifier le compte
    </a>
    <a class="btn btn-primary ms-5" href="/admin/users/<?= $user->id; ?>/delete" role="button">
        Supprimer le compte
    </a>

    <?php $title = "Paramètres du compte"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>