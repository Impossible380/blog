-- Structure
CREATE TABLE `articles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `author_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
);

-- Données
INSERT INTO `articles` (`id`, `title`, `content`, `author_id`, `date`) VALUES
(1, 'Bricolage et mécanique', 'Bonjour à toutes et à tous ! Je suis passionné de bricolage et de mécanique.', 1, '2020-12-07'),
(2, 'À table !', 'Salut mes chers invités ! Qu\'est-ce que vous voudriez boire ou manger ?', 2, '2021-03-03'),
(3, 'Renforcement de deux lignes de bus dans ma ville', 'Salut à tous ! Deux lignes de bus du réseau de ma ville ont été renforcées en 2020.', 3, '2021-05-07'),
(4, 'On ne sait jamais...', 'Bonjour à toutes et à tous ! Nous disposons de plein de remèdes efficaces pour soigner certaines maladies.', 4, '2021-09-09'),
(5, 'Je ne vais pas les laisser tomber...', 'Salut à tous ! Je suis à la recherche d\'une personne pour garder mes deux chats pendant 5 jours. Merci de votre compréhension.', 5, '2021-11-22'),
(6, 'Courage ! On peut le faire.', 'Salut à tous, les amis ! Vous aimez le sport ? Moi aussi, notamment la course !', 6, '2022-02-14'),
(7, 'Profitons de la campagne...', 'Bonjour les amis ! Si nous n\'avons pas de commerce à proximité à la campagne, l\'environnement est plus calme et moins pollué.', 2, '2022-06-24'),
(8, 'Amateur de vélo tout-terrain', 'Salut les amis ! Je fais parfois du vélo tout-terrain en ville ou en forêt.', 3, '2022-10-10'),
(9, 'Passionné de football', 'Salut les amis ! Je joue au football en compétition.', 3, '2023-01-12'),
(10, 'Passionné de bâtiments', 'Salut à tous ! Je suis passionné de bâtiments.', 7, '2023-04-26'),
(11, 'dfdsffdsfdfsd', 'sfdfs', 9, '2024-01-04');