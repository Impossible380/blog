<?php ob_start(); ?>

    <table>
        <thead>
            <tr>
                <th class="table_cell">id</th>
                <th class="table_cell">title</th>
                <th class="table_cell">content</th>
                <th class="table_cell">author_id</th>
                <th class="table_cell">firstname</th>
                <th class="table_cell">lastname</th>
                <th class="table_cell">options</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($articles as $article) { ?>
                <tr>
                    <td class="table_cell">
                        <?php echo $article['id']; ?>
                    </td>
                    <td class="table_cell">
                        <a href="article_details.php?id=<?php echo $article['id']; ?>">
                            <?php echo $article['title']; ?>
                        </a>
                    </td>
                    <td class="table_cell">
                        <?php echo $article['content']; ?>
                    </td>
                    <td class="table_cell">
                        <?php echo $article['author_id']; ?>
                    </td>
                    <td class="table_cell">
                        <?php echo $article['firstname']; ?>
                    </td>
                    <td class="table_cell">
                        <?php echo $article['lastname']; ?>
                    </td>
                    <td class="table_cell">
                        <a href="modify_article.php?id=<?php echo $article['id']; ?>&author_id=<?php echo $article['author_id']; ?>">
                            Modifier
                        </a>
                        <a href="delete_article.php?id=<?php echo $article['id']; ?>&author_id=<?php echo $article['author_id']; ?>">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <a href="insert_article.php">Ajouter</a>

    <?php $title = "Liste des articles"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>