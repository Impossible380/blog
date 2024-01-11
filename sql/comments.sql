-- Structure
CREATE TABLE `comments` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `content` text NOT NULL,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `article_id` int(11) NOT NULL,
    `author_id` int(11) NOT NULL,
    `status` enum('accepted', 'waiting', 'rejected') NOT NULL DEFAULT 'waiting',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
);

-- Données
INSERT INTO `articles` (`id`, `content`, `author_id`, `article_id`, `date`) VALUES