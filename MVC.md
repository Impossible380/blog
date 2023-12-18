## d'ou vient le $user qu'on utilise dans le template edit_user.php ?
## Affichage du formulaire de modification d'un user

1. requête **GET** http://localhost:8080/admin/users/8/edit

2. php lit ==> public/index.php
* autoload pour charger les classes automatiquement.
* chargement du fichier src/lib.php
* **chargement du fichier src/app.php** (routeur)

3. php lit --> src/app.php
* la route correspond à la regex : /^\/admin\/users\/(?<id>\d+)\/edit$/
* On créer un object UserController
* On appelle la méthode edit() de ce controller

4. php execute la fonction UserController->edit($id)
* On vérfie que le user est connecté
* On cherche le user à modifié dans la base de données
* On met ce user dans la variable $user
* On require le template edit_user.php

5. php execute le template edit_user.php
* On utilise la variable $user qui a été créer dans le controller

## a quoi sert la condition if (!empty($_POST)) dans la fonction UserController->edit($id)
## que se passe t'il quand on valide le formulaire

1. On appelle l'url **POST** http://localhost:8080/admin/users/8/edit

2. php lit ==> public/index.php
* autoload pour charger les classes automatiquement.
* chargement du fichier src/lib.php
* **chargement du fichier src/app.php** (routeur)

3. php lit --> src/app.php
* la route correspond à la regex : /^\/admin\/users\/(?<id>\d+)\/edit$/
* On créer un object UserController
* On appelle la méthode edit() de ce controller

4. php execute la fonction UserController->edit($id)
* On vérfie que le user est connecté
* comme on appelle l'url en post, on rentre dans le if (!empty($_POST))
* On met à jour le user
* Puis on redirige vers /admin/users