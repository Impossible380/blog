
# Partie 1: Créer la base de données

Créer une nouvelle base de données sur le foot

Créer une table **Equipe**
* Id (INT) => cocher la case Auto Increment (AI)
* Nom de l'équipe (VARCHAR(255))

Créer une table **Joueur**
avec les champs:
* Id (INT) => cocher la case Auto Increment (AI)
* Nom (VARCHAR(255))
* Prénom (VARCHAR(255))
* Date de naissance (format DATE ou DATETIME)
* Id de l'équipe (INT)

Créer une table **Match**
* Id (INT) => cocher la case Auto Increment (AI)
* Id de l'équipe A (INT)
* Buts pour l'équipe A (INT)
* Id de l'équipe B (INT)
* Buts pour l'équipe B (INT)

# Partie 2 : Insérer les données

Insérer les données avec du code SQL

Insérer 4 équipes
Insérer 5 joueurs par équipes
Insérer 6 matchs (tous les matchs aller-retour)

# Partie 3 : Selection des données

1. Sélectionner toutes les équipes (nom de l'équipe)
2. Sélectionner tous les joueurs de l'équipe 1 (nom, prénom)
3. Sélectionner tous les matchs
4. Sélectionner tous les matchs (ajouter une colonne avec le nom de l'équipe gagnante)
5. Sélectionner toutes les équipes (en ajoutant une colonne pour le nombre total de buts marqués)
6. Sélectionner toutes les équipes (en ajoutant une colonne pour le nombre moyen de buts marqués)




# Réponses


1. SELECT `nom`
FROM `equipes`


2. SELECT `joueurs`.`nom`, `prenom`
FROM `joueurs`
JOIN `equipes`
ON `joueurs`.`id_equipe` = `equipes`.`id`
WHERE `id_equipe` = 1


3. SELECT `id_equipe_a`, `id_equipe_b`, `buts_pour_equipe_a`, `buts_pour_equipe_b`
FROM `matchs`


4. SELECT 
    `id_equipe_a`,
    `id_equipe_b`,
    `buts_pour_equipe_a`,
    `buts_pour_equipe_b`,
    CASE
        WHEN `buts_pour_equipe_a` > `buts_pour_equipe_b` THEN `id_equipe_a`
        WHEN `buts_pour_equipe_a` < `buts_pour_equipe_b` THEN `id_equipe_b`
        ELSE NULL
    END AS `equipe_gagnante_id`,
    `nom`
FROM `matchs`
LEFT JOIN `equipes`
ON (CASE
        WHEN `buts_pour_equipe_a` > `buts_pour_equipe_b` THEN `id_equipe_a`
        WHEN `buts_pour_equipe_a` < `buts_pour_equipe_b` THEN `id_equipe_b`
        ELSE NULL
    END) = `equipes`.`id`
    

5. SELECT `equipes`.`id`, `equipes`.`nom`, SUM(`buts`.`buts_pour`)
FROM `equipes`
JOIN (
    SELECT `matchs`.`id_equipe_a` AS `id_equipe`, `matchs`.`buts_pour_equipe_a` AS `buts_pour`
    FROM `matchs`
    UNION ALL
    SELECT `matchs`.`id_equipe_b`, `matchs`.`buts_pour_equipe_b`
    FROM `matchs`
) `buts`
ON `buts`.`id_equipe` = `equipes`.`id`
GROUP BY `equipes`.`id`, `equipes`.`nom`
ORDER BY SUM(`buts`.`buts_pour`) DESC


6. SELECT `equipes`.`id`, `equipes`.`nom`, AVG(`buts`.`buts_pour`)
FROM `equipes`
JOIN (
    SELECT `matchs`.`id_equipe_a` AS `id_equipe`, `matchs`.`buts_pour_equipe_a` AS `buts_pour`
    FROM `matchs`
    UNION ALL
    SELECT `matchs`.`id_equipe_b`, `matchs`.`buts_pour_equipe_b`
    FROM `matchs`
) `buts`
ON `buts`.`id_equipe` = `equipes`.`id`
GROUP BY `equipes`.`id`, `equipes`.`nom`
ORDER BY AVG(`buts`.`buts_pour`) DESC