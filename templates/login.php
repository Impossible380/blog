<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Connexion</h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <form action="/login" method="post" class="row gy-4">
                <div class="form-example">
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" class="form-control" required />
                </div>
                <div class="form-example">
                    <label for="password">Mot de passe : </label>
                    <input type="password" name="password" id="password" class="form-control" required />
                </div>
                <div class="form-example">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Connexion"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>