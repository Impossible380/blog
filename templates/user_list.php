<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Liste des utilisateurs</h1>
    
    <!-- Début SECTION -->
    <section>

        <div class="container">
            <div class="row justify-content-center">

                <table>
                    <thead class="text-center">
                        <tr>
                            <th class="border-2 border-secondary p-2">id</th>
                            <th class="border-2 border-secondary p-2">prénom</th>
                            <th class="border-2 border-secondary p-2">nom</th>
                            <th class="border-2 border-secondary p-2">email</th>
                            <th class="border-2 border-secondary p-2">statut</th>
                            <th class="border-2 border-secondary p-2">options</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($users as $user) { ?>
                            <tr>
                                <td class="border-2 border-secondary p-2 text-center">
                                    <?= $user->id; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $user->firstname; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $user->lastname; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $user->email; ?>
                                </td>

                                <?php if ($user->status === 'accepted') {
                                    $text_color = 'success';
                                } else if ($user->status === 'waiting') {
                                    $text_color = 'secondary';
                                } else {
                                    $text_color = 'danger';
                                } ?>

                                <td class="border-2 border-secondary p-2 text-<?= $text_color; ?>">
                                    <?= $user->status; ?>
                                </td>
                                <td class="border-2 border-secondary p-2 justify-content-between">
                                    <?php if ($user->status === 'waiting' && $_SESSION["user"]->id === "1") { ?>
                                        <a class="text-success" href="/admin/users/<?= $user->id; ?>/validate">
                                            Valider</a>
                                        /
                                        <a class="text-danger" href="/admin/users/<?= $user->id; ?>/reject">
                                            Rejeter
                                        </a>
                                    <?php } ?>
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