/* 1) SELECT title, content FROM `article` WHERE author_id=3

2) SELECT title, content, user.firstname, user.lastname
FROM article
JOIN user
ON user.id = article.author_id
WHERE author_id=3

3) SELECT user.firstname, user.lastname, COUNT(*) AS number_articles
FROM article
JOIN user
ON user.id = article.author_id
GROUP BY user.firstname, user.lastname

4) SELECT user.firstname, user.lastname, COUNT(*) AS number_articles
FROM article
JOIN user
ON user.id = article.author_id
GROUP BY user.firstname, user.lastname
ORDER BY user.lastname, user.firstname

5) INSERT INTO `user`(`email`, `password`, `firstname`, `lastname`)
VALUES ('email@gmail.com','test','Julien','Dupont') */