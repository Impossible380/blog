# Bonne pratique

* uniquement des requêtes paramétré pour le SQL
* encoder le password

# Reste à faire (fonctionnalités)
## visiteurs
* la page de connexion OK
* la page d'inscription OK
* la page d'accueil OK
** ensemble des post
* la page affichant un blog post  ==> A faire
** détail du post
** la liste des commentaires qui sont validés
** un formulaire pour ajouter un commentaire
* la page de contact ==> En cours (envoi de mail à faire)
## admin
* la liste des articles
* la liste des utilisateurs 
** valider un utilisateur (voir à la fin pour faire ça, ajouter un statut)
* la liste des commentaires à valider

# description des taches à faire pour pouvoir le Faire
* bdd: créer une table des commentaires
** auteur du commentaire (foreign key sur la table utilisateur)
** article du commentaire (foreign key sur la table articles)
** contenu du commentaire 
** la date de création du commentaire
** statut: est-ce que le commentaire est validé par un admin
* créer le CommentaireRepository avec une fonction findAll()
* modifier le controller ArticleController::articledetail()
** aller chercher les commentaires en base de donnée
* modifier la vue article_detail.php