<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Liste des utilisateurs</h1>
    
    <!-- Début SECTION -->
    <section>

        <div class="container">
            <div class="row justify-content-center">

                <table class="w-25">
                    <thead class="text-center">
                        <tr>
                            <th class="border-2 border-secondary p-2">id</th>
                            <th class="border-2 border-secondary p-2">prénom</th>
                            <th class="border-2 border-secondary p-2">nom</th>
                            <th class="border-2 border-secondary p-2">email</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($users as $user) { ?>
                            <tr>
                                <td class="border-2 border-secondary p-2 text-center">
                                    <?php echo $user->id; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?php echo $user->firstname; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?php echo $user->lastname; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?php echo $user->email; ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                
            </div>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Liste des utilisateurs"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>