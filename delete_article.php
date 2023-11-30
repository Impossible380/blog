<?php
    require_once("lib.php");
    $id = $_GET["id"];

    $query = $pdo->prepare("SELECT *
                                FROM articles
                                WHERE id = :id");

    $query->execute([":id" => $_GET["id"]]);
    
    $article = $query->fetch(\PDO::FETCH_ASSOC);

    $pdo->exec("DELETE FROM articles WHERE id = \"". $id ."\";
                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL;
                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");
    
    $_SESSION["message"] = "L'article qui a comme id '". $id ."' a bien été
    supprimé.";
    
    header("location: articles_list.php");
    exit(0);
?>


<?php ob_start(); ?>

    <p>L'article qui a comme id '<?php echo $id; ?>' a bien été supprimé.</p>

    <?php $title = "Supprimer un article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("templates/base.php"); ?>