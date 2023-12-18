<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Connexion</h1>

    <form action="" method="post" class="form-example">
        <div class="form-example">
            <label for="email">Email : </label>
            <input type="email" name="email" id="email" required />
        </div>
        <div class="form-example">
            <label for="email">Mot de passe : </label>
            <input type="password" name="password" id="password" required />
        </div>
        <div class="form-example">
            <input type="submit" value="Valider" row="3" />
        </div>
    </form>

    <?php $title = "Connexion"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>