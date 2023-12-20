<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Nouvel article</h1>

    <!-- <form action="/admin/articles/insert" method="post" class="form-example">
        <div class="form-example">
            <label for="title">Titre : </label>
            <input type="text" name="title" id="title" required />
        </div>
        <div class="form-example">
            <label for="content">Contenu : </label>
            <textarea name="content" id="content" rows="5" cols="33" required></textarea>
        </div>
        <div class="form-example">
            <input type="submit" value="Valider" row="3" />
        </div>
    </form> -->
    
    <!-- Début SECTION -->
    <section>

        <div class="container">
            <form action="/contact" method="post" class="row gy-4">
                <div class="form-example">
                    <label for="title">Titre : </label>
                    <input type="text" name="title" id="title" class="form-control" required />
                </div>
                <div class="form-example">
                    <label for="content">Contenu : </label>
                    <textarea name="content" id="content" rows="5" cols="33" class="form-control" required></textarea>
                </div>
                <div class="form-example">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Nouvel article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>