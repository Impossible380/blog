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
                            <th class="border-2 border-secondary p-2">date</th>
                            <th class="border-2 border-secondary p-2">prénom</th>
                            <th class="border-2 border-secondary p-2">nom</th>
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
                                    <?= $article->date; ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= null /* $article->firstname; */ ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <?= null /* $article->lastname; */ ?>
                                </td>
                                <td class="border-2 border-secondary p-2">
                                    <a href="/admin/articles/<?= $article->id; ?>/update">
                                        Modifier
                                    </a>
                                    <a href="/admin/articles/<?= $article->id; ?>/delete">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-end">
                                <a href="/admin/articles/insert">Ajouter</a>
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