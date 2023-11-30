<?php
    require_once("lib.php");
    $id = $_GET["id"];
    
    $query = $pdo->prepare("SELECT *
                            FROM articles
                            WHERE id = :id");

    $query->execute([":id" => $id]);
    
    $article = $query->fetch(\PDO::FETCH_ASSOC);
?>


<?php ob_start(); ?>

    <h1>Article détail</h1>

    <?php dump($article); ?>

    <?php $title = "Détails de l'article"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require('templates/base.php'); ?>