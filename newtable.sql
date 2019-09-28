DROP TABLE IF EXISTS `rock_paper_scissors`;
CREATE TABLE `rock_paper_scissors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `win` enum('yes','no','tie') NOT NULL,
  PRIMARY KEY (`id`)
);
