<?php ob_start(); ?>

    <h1>Article détail</h1>

    <?php dump($article); ?>

    <?php $title = "Détails de l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require('../templates/base.php'); ?>