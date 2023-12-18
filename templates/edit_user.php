<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Modifier le compte</h1>

    <form action="/admin/users/<?= $user['id'] ?>/edit" method="post" class="form-example">
        <div class="form-example">
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" id="firstname" value="<?= $user['firstname'] ?>" required />
        </div>
        <div class="form-example">
            <label for="lastname">Nom : </label>
            <input type="text" name="lastname" id="lastname" value="<?= $user['lastname'] ?>" required />
        </div>
        <div class="form-example">
            <label for="email">Email : </label>
            <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required />
        </div>
        <div class="form-example">
            <label for="email">Mot de passe : </label>
            <input type="password" name="password" id="password" value="<?= $user['password'] ?>" required />
        </div>
        <div class="form-example">
            <input type="submit" value="Valider" row="3" />
        </div>
    </form>

    <?php $title = "Modifier le compte"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>