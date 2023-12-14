<?php ob_start(); ?>

    <h1>Contact</h1>

    <form action="" method="post" class="form-example">
        <div class="form-example">
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" id="firstname" required />
        </div>
        <div class="form-example">
            <label for="lastname">Nom : </label>
            <input type="text" name="lastname" id="lastname" required />
        </div>
        <div class="form-example">
            <label for="email">Email : </label>
            <input type="email" name="email" id="email" required />
        </div>
        <div class="form-example">
            <label for="message">Message : </label>
            <textarea name="message" id="message" rows="5" cols="33"></textarea>
        </div>
        <div class="form-example">
            <input type="submit" value="Valider" row="3" />
        </div>
    </form>

    <?php $title = "Contact"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>