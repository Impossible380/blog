<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="/style.css?<?= rand() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<!-- Début BODY -->

<body>

    <!-- Début HEADER -->
    <header class="py-5">

        <?php include("../templates/header.php"); ?>

    </header>
    <!-- Fin HEADER -->

    <!-- Début MAIN -->
    <main class="py-5">

        <?php if (!empty($_SESSION["message"])) { ?>
            <div class="container">
                <div class="alert alert-<?= $_SESSION["message"]["type"] ?>" role="alert">
                    <?= $_SESSION["message"]["text"] ?>
                </div>
            </div>
            <?php
                $_SESSION["message"] = null
            ?>
        <?php } ?>

        <?php echo $content; ?>

    </main>
    <!-- Fin MAIN -->

    <!-- Début FOOTER -->
    <footer class="bg-light p-2">

        <?php include("../templates/footer.php"); ?>

    </footer>
    <!-- Fin FOOTER -->

</body>
<!-- Fin BODY -->

<!-- Début SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Fin SCRIPT -->

</html>