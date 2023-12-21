<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Modifier le compte</h1>

    <!-- Début SECTION -->
    <section>

        <div class="container">
            <form action="/admin/users/<?= $id; ?>/update" method="post" class="row gy-4">
                <div class="form-example">
                    <label for="firstname">Prénom : </label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="<?php $user->firstname; ?>" required />
                </div>
                <div class="form-example">
                    <label for="lastname">Nom : </label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="<?php $user->lastname; ?>" required />
                </div>
                <div class="form-example">
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php $user->email; ?>" required />
                </div>
                <div class="form-example">
                    <label for="password">Mot de passe : </label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php $user->password; ?>" required />
                </div>
                <div class="form-example">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Modifier le compte"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>