<?php ob_start(); ?>

    <h1 class="fw-bold">Parker Press</h1>

    <!-- Début SECTION -->
    <section>

        <h2>Parker Press, à vous la liberté d'expression !</h2>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Accueil"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>