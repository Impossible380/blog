<?php
    require_once("lib.php");

    $id = $_GET["id"];
    $author_id = $_GET["author_id"];

    if (!$_SESSION["user_connected"]) {
        $_SESSION["message"] = "Vous n'êtes pas connecté.";
        header("location: log_in.php");
        exit();

    } else if ($author_id !== $_SESSION["user"]["id"]) {
        $_SESSION["message"] = "Vous n'êtes pas l'auteur de cet article.";
        header("location: articles_list.php");
        exit();
    }

    /// récuperer l'article dans la bdd grace à l'id $_GET['id']

    $query = $pdo->prepare("SELECT *
                                FROM articles
                                WHERE id = :id");

    $query->execute([
        ":id" => $id,
    ]);
    
    $article = $query->fetch(\PDO::FETCH_ASSOC);

    $pdo->exec("DELETE FROM articles WHERE id = \"". $id ."\";
                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL;
                ALTER TABLE `articles` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");
    
    $_SESSION["message"] = "L'article qui a comme id '". $id ."' a bien été
    supprimé.";
    
    header("location: articles_list.php");
    exit();
?>


<?php ob_start(); ?>

    <p>L'article qui a comme id '<?php echo $id; ?>' a bien été supprimé.</p>

    <?php $title = "Supprimer un article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("templates/base.php"); ?>