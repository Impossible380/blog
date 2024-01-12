<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">En attente de réponse</h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <p>Merci de patientez avant de savoir si vous avez été admis ou rejeté.</p>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "En attente de réponse"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require('../templates/base.php'); ?>