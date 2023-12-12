<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid justify-content-center">
        
        <img src="/images/logo.jpg" id="logo">

        <a class="navbar-brand nav-link disabled ms-3" aria-disabled="true" href="#">Parker Press</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                </li>
                <li class="nav-item mb-2 mb-lg-0 me-lg-3">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>

                <?php if ($_SESSION["user_connected"]) { ?>

                    <li class="nav-item dropdown bg-dark">
                        <a class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <?php echo "". $_SESSION["user"]["firstname"] ."  ". $_SESSION["user"]["lastname"] .""; ?>
                            
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark">
                            <li><a class="dropdown-item text-warning" href="/admin/articles">Liste des blogs posts</a></li>
                            <li><a class="dropdown-item text-warning" href="#">Paramètres d'utilisateur</a></li>
                            <li><hr class="dropdown-divider border-warning"></li>
                            <li><a class="dropdown-item text-warning" href="/logout">Se déconnecter</a></li>
                        </ul>
                    </li>

                <?php } else { ?>

                    <li class="nav-item bg-dark">
                        <a class="nav-link text-warning" aria-current="page" href="/login">Se connecter</a>
                    </li>

                <?php } ?>
                
            </ul>
        </div>
        
    </div>
</nav>