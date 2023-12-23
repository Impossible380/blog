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
* Controller = récupère les infos de l'url -> demande les données au Modèle -> demande d'afficher à la Vue
C'est une façon d'écrire du code pour le web
ça permet de séparer le code php des vues html

## A faire
Utiliser les alertes Bootstrap pour afficher les messages et faire en sorte que la couleur soit 
* **danger** pour les erreurs 
* **info** pour les message d'information (connection...)
* **success** pour la réussite d'une modification, d'un ajout ou d'une suppression
Créer la page contact

# 14/12/2023
https://www.figma.com/file/Lx9BxEjPkpqCERcMb06WFE/Maquette-Blog?type=design&node-id=0-1&mode=design&t=wn8m1NQoMeNwnsBz-0
## Pendant la session
* Corriger la route register
* Améliorer le système de messages
* Requêtes préparées
## Prochaine session
* Concept Model
## A faire
Modifier toutes les requêtes pour que ce soit des requêtes préparées

## 16/12/2023
## Pendant la session
* déroulement pas à pas de comment php traite une requête http (GET ou POST)
# A faire
* Mettre les urls dans le action des formulaires
* Mettre les cards des articles dans la page d'accueil
## Prochaines sessions
* Bien expliquer le dossier public
* Concept Model

## 18/12/2023
## Pendant la session
* Concept Model
# A faire
* Créer l'entity Article
* Créer le repository ArticleRepository
* Modifier le ArticleController pour utiliser le ArticleRepository
* Attention à bien modifier les templates.
## Prochaines sessions
* Bien expliquer le dossier public
* Encoder le password

# 21/12/2023
## Pendant la session
* Review des modification de la partie Model du MVC
* Gestion du nom et prénom de l'utilisateur
# A faire:
* ...
## Prochaines sessions
* Bien expliquer le dossier public
* Encoder le password
* Mieux gérer le problème de suppression d'un utilisateur avec des articles liés

# 23/12/2023
## Pendant la session
* Encoder le password
* Mieux gérer le password (faire le select uniquement si besoin)
# A faire
* Corriger le problème du password qui s'affiche sur la page article_details
* Afficher en plus jolie la page User Parameter
* Afficher en plus jolie la page Article Détail
# Prochaines sessions
* Bien expliquer le dossier public
* Mieux gérer le problème de suppression d'un utilisateur avec des articles liés