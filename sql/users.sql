-- Structure
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('accepted', 'waiting', 'rejected') NOT NULL DEFAULT 'waiting',
  PRIMARY KEY (`id`)
);
-- 'on hold' = 'en attente'

-- Données
INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'jopark@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'John', 'Parker'),
(2, 'willhend@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'William', 'Henderson'),
(3, 'balmon@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'Balthazar', 'Montmirail'),
(4, 'corilag@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'Corinne', 'Lagrange'),
(5, 'materri@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'Maëlys', 'Terrier'),
(6, 'aliver@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'Alice', 'Vermeil'),
(7, 'judont@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'Julien', 'Dupont'),
(8, 'ezp@gmail.com', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'Elfe', 'Zap'),
(9, 'fdfdsfd@sdffds.ggsdgsd', '$2y$10$dZo4hTRN.WxjRfEBVfpxNeLIWxMPpC8oG6XxgHT8JG6ynDntIjpvO', 'fdsd', 'fddfsdf');