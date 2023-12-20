<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Contact</h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <form action="/contact" method="post" class="row gy-4">
                <div class="form-example">
                    <label for="firstname">Prénom : </label>
                    <input type="text" name="firstname" id="firstname" class="form-control" required />
                </div>
                <div class="form-example">
                    <label for="lastname">Nom : </label>
                    <input type="text" name="lastname" id="lastname" class="form-control" required />
                </div>
                <div class="form-example">
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" class="form-control" required />
                </div>
                <div class="form-example">
                    <label for="message">Message : </label>
                    <textarea name="message" id="message" class="form-control" rows="5" cols="33"></textarea>
                </div>
                <div class="form-example">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Contact"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>