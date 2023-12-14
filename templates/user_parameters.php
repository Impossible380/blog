<?php ob_start(); ?>

    <h1>Paramètres du compte</h1>

    <a href="/admin/users/<?= $user["id"]; ?>/edit">
        Modifier le compte
    </a>
    <a href="/admin/users/<?= $user["id"]; ?>/delete">
        Supprimer le compte
    </a>

    <?php $title = "Paramètres du compte"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>