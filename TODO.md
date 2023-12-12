# 25/11/2023

* Mettre en place le systeme avec base.php et ob_get_clean sur toutes les pages
* Mettre en place la redirection avec le header('location: ');
* Mettre en place les messages avec le $_SESSION['message'] sur toutes les pages

* Si tu as le temps commencer à regarder pour la gestion des utilisateurs

# 27/11/2023
## Pendant la session:
* Afficher les infos de l'article dans le formulaire quand on modifie un article
* Les requêtes préparées
* formulaire de login ?
## A faire pour la prochaine fois
* modifier toutes requêtes en requêtes préparées
* formulaire login avec email et password
* quand on soumet le formulaire, verifier dans la bdd que le user et son mot de passe existe avec un select
--> si on trouve il faut mettre dans la variable $_SESSION['user'] le user qu'on a récupérer de la base de données
--> si on trouve pas le user on affiche un message pour dire que les informations d'identification sont incorrectes.

# 30/11/2023
## Pendant la session
* Revue de code
* quelque corrections
* introduction aux classes et programmation orienté objet
## A faire pour la prochaine fois
* Afficher le nom de l'utilisateur connecté
* Gérer l'inscription d'un utilisateur
* Modifier la création d'un article (l'author_id doit être l'utilisateur connecté)

# 04/12/2023
## Pendant la session
```bash
php -S localhost:8080 -t public
```
/ --> page d'accueil
/articles --> liste des articles
/articles/1 --> détails de l'article 1
/articles/1/modify --> modification de l'article 1
/articles/1/delete --> suppression de l'article 1
/articles/new --> création d'un article
/login --> se connecter
/logout --> se déconnecter
/users --> liste des utilisateurs

# 07/12/2023
## Pendant la session
* Partie visiteur
/ --> page d'accueil
/articles --> liste des articles
/articles/1 --> détails de l'article 1
/login --> se connecter
/logout --> se déconnecter
* Partie administrateur
/admin/articles --> list des articles
/admin/articles/1/modify --> modification de l'article 1
/admin/articles/1/delete --> suppression de l'article 1
/admin/users --> list des utilisateurs
/admin/users/1/modify --> modification d'un utilisateur
/admin/users/1/delete --> suppression d'un utilisateur

# 09/12/2023
Lien Figma : https://www.figma.com/file/Lx9BxEjPkpqCERcMb06WFE/Untitled?type=design&mode=design&t=xsAXJ96fVSAZSRXv-0

# 11/12/2023
## Pendant la session
MVC = Modèle / Vue / Controller
* Modèle = Modèle de donnée (toutes les requetes SQL)
* Vue = Template HTML
* Conroller = récupère les infos de l'url -> demande les données au Modèle -> demande d'afficher à la Vue
C'est une façon d'écrire du code pour le web
ça permet de séparer le code php des vues html

## A faire
Utiliser les alertes Bootstrap pour afficher les messages et faire en sorte que la couleur soit 
* **danger** pour les erreurs 
* **info** pour les message d'information (connection...)
* **success** pour la réussite d'une modification, d'un ajout ou d'une suppression
Créer la page contact

