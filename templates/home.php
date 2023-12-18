<?php ob_start(); ?>

    <h1 class="text-center fw-bold mb-5">Parker Press</h1>

    <!-- Début SECTION -->
    <section>
        <div class="container">

            <!-- <h2>Parker Press, à vous la liberté d'expression !</h2> -->
            <p class="fs-4">Parker Press, à vous la liberté d'expression !</h2>
            <p>Avec Parker Press, écrivez des articles passionnants et bien d'autres !</p>

        </div>
    </section>
    <!-- Fin SECTION -->
    
    <!-- Début SECTION -->
    <section>
        <div class="container">
            <div class="row g-4">

                <?php foreach($latest_articles as $article) { ?>
                    
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100">
                            
                            <!-- <img src="..." class="card-img-top" alt="...">
                            <h1 class="text-center fw-bold"></h1> -->

                            <div class="card-body">
                                <h4 class="card-title text-center mb-4"><?= $article['title'] ?></h4>
                                <p class="card-text"><?= $article['content'] ?></p>
                                <a href="/articles/<?php echo $article["id"]; ?>" class="btn btn-primary">Détails</a>
                            </div>

                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Fin SECTION -->

    <?php $title = "Accueil"; ?>
    
<?php $content = ob_get_clean(); ?>


<?php require("../templates/base.php"); ?>