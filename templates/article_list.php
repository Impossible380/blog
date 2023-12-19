<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Liste des articles</h1>

    <table>
        <thead class="text-center">
            <tr>
                <th class="border-2 border-secondary p-2">id</th>
                <th class="border-2 border-secondary p-2">title</th>
                <th class="border-2 border-secondary p-2">content</th>
                <th class="border-2 border-secondary p-2">firstname</th>
                <th class="border-2 border-secondary p-2">lastname</th>
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
                        <?= $user->firstname; ?>
                    </td>
                    <td class="border-2 border-secondary p-2">
                        <?= $user->lastname; ?>
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
    </table>

    <a href="/admin/articles/insert">Ajouter</a>

    <?php $title = "Liste des articles"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>