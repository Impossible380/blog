<?php ob_start(); ?>

    <p>L'article qui a comme id '<?php echo $id; ?>' a bien été supprimé.</p>

    <?php $title = "Supprimer un article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>