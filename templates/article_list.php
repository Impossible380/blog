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
                        <?php echo $article["id"]; ?>
                    </td>
                    <td class="border-2 border-secondary p-2">
                        <a href="/articles/<?php echo $article["id"]; ?>">
                            <?php echo $article["title"]; ?>
                        </a>
                    </td>
                    <td class="border-2 border-secondary p-2">
                        <?php echo $article["content"]; ?>
                    </td>
                    <td class="border-2 border-secondary p-2">
                        <?php echo $article["firstname"]; ?>
                    </td>
                    <td class="border-2 border-secondary p-2">
                        <?php echo $article["lastname"]; ?>
                    </td>
                    <td class="border-2 border-secondary p-2">
                        <a href="/admin/articles/<?= $article["id"]; ?>/edit">
                            Modifier
                        </a>
                        <a href="/admin/articles/<?= $article["id"]; ?>/delete">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <a href="/admin/articles/new">Ajouter</a>

    <?php $title = "Liste des articles"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>