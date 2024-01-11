<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Liste des commentaires</h1>
    
    <!-- Début SECTION -->
    <section>

        <div class="container">
            <div class="row">

                <table>
                    <thead class="text-center">
                        <tr>
                            <th class="border-2 border-secondary p-2">id</th>
                            <th class="border-2 border-secondary p-2">contenu</th>
                            <th class="border-2 border-secondary p-2">date</th>
                            <th class="border-2 border-secondary p-2">prénom</th>
                            <th class="border-2 border-secondary p-2">nom</th>
                            <th class="border-2 border-secondary p-2">statut</th>
                            <th class="border-2 border-secondary p-2">options</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($comments as $comment) { ?>
                            <tr>
                                <td class="border-2 border-secondary p-2 text-center">
                                    <?= $comment->id; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $comment->content; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $comment->date; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $comment->user->firstname; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $comment->user->lastname; ?>
                                </td>

                                <?php if ($comment->status === 'accepted') {
                                    $text_color = 'success';
                                } else if ($comment->status === 'waiting') {
                                    $text_color = 'secondary';
                                } else {
                                    $text_color = 'danger';
                                } ?>

                                <td class="border-2 border-secondary p-2 text-<?= $text_color ?>">
                                    <?= $comment->status; ?>
                                </td>
                                <td class="border-2 border-secondary p-2 justify-content-between">
                                    <?php if ($comment->status === 'waiting') { ?>
                                        <a class="text-success" href="/admin/comments/<?= $comment->id; ?>/validate">
                                            Valider</a>
                                        /
                                        <a class="text-danger" href="/admin/comments/<?= $comment->id; ?>/reject">
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

    <?php $title = "Liste des articles"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>