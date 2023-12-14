<?php ob_start(); ?>

    <h1>Liste des utilisateurs</h1>

    <table>
        <thead class="text-center">
            <tr>
                <th class="table_cell">id</th>
                <th class="table_cell">firstname</th>
                <th class="table_cell">lastname</th>
                <th class="table_cell">email</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($users as $user) { ?>
                <tr>
                    <td class="table_cell text-center">
                        <?php echo $user["id"]; ?>
                    </td>
                    <td class="table_cell">
                        <?php echo $user["firstname"]; ?>
                    </td>
                    <td class="table_cell">
                        <?php echo $user["lastname"]; ?>
                    </td>
                    <td class="table_cell">
                        <?php echo $user["email"]; ?>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <?php $title = "Liste des utilisateurs"; ?>

<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>