<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Détails de l'article</h1>

    <?php dump($article); ?>

    <?php $title = "Détails de l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require('../templates/base.php'); ?>