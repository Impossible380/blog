<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Liste des articles</h1>
    
    <!-- Début SECTION -->
    <section>

        <div class="container">
            <div class="row">

                <table>
                    <thead class="text-center">
                        <tr>
                            <th class="border-2 border-secondary p-2">id</th>
                            <th class="border-2 border-secondary p-2">titre</th>
                            <th class="border-2 border-secondary p-2">contenu</th>
                            <th class="border-2 border-secondary p-2">date de création</th>
                            <th class="border-2 border-secondary p-2">dernière modification</th>
                            <th class="border-2 border-secondary p-2">auteur</th>
                            <th class="border-2 border-secondary p-2">options</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($articles as $article) { ?>
                            <tr>
                                <td class="border-2 border-secondary p-2 text-center">
                                    <?= $article->id; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <a href="/articles/<?= $article->id; ?>">
                                        <?= $article->title; ?>
                                    </a>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $article->content; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $article->creation_date; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $article->last_update; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= $article->user->firstname; ?>
                                    <?= $article->user->lastname; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <a class="text-secondary" href="/admin/articles/<?= $article->id; ?>/update">
                                        Modifier</a>
                                    /
                                    <a class="text-danger" href="/admin/articles/<?= $article->id; ?>/delete">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-end">
                                <a class="text-success" href="/admin/articles/insert">Ajouter</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>

    </section>
    <!-- Fin SECTION -->

    <?php $title = "Liste des articles"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>