-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.6.25-0ubuntu0.15.04.1 - (Ubuntu)
-- SE du serveur:                debian-linux-gnu
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour pool_php_rush
CREATE DATABASE IF NOT EXISTS `rushmvc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `rushmvc`;


-- Export de la structure de table pool_php_rush. categories
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
    `content` varchar(255) DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `banned` boolean DEFAULT NULL,
  `accountactivation` boolean DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `modificationdate` date DEFAULT NULL,
  `supression` varchar(255) DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





INSERT INTO `articles`  VALUES
(1,'La mer de glace sous le soleil', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus turpis augue, condimentum non placerat in, molestie vel felis. Duis at purus quis felis vehicula lacinia sed sit amet dolor. Sed vestibulum, mauris et pharetra efficitur, neque tellus viverra nulla, vitae feugiat arcu massa vel tortor. Fusce eu diam a risus egestas volutpat. Cras scelerisque eget sem euismod hendrerit. Morbi laoreet lectus in elit tempus molestie. Donec pharetra nunc id leo sollicitudin, et ornare odio semper. Ut egestas arcu eget sollicitudin convallis. Aliquam sapien nulla, porta non arcu ac, euismod eleifend massa. Aenean placerat rhoncus ligula, ac porttitor erat tempor ut. Etiam sit amet orci ligula.');
INSERT INTO `articles`  VALUES
(2,'Un vestige de la préhistoire découvert sous la glace', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus turpis augue, condimentum non placerat in, molestie vel felis. Duis at purus quis felis vehicula lacinia sed sit amet dolor. Sed vestibulum, mauris et pharetra efficitur, neque tellus viverra nulla, vitae feugiat arcu massa vel tortor. Fusce eu diam a risus egestas volutpat. Cras scelerisque eget sem euismod hendrerit. Morbi laoreet lectus in elit tempus molestie. Donec pharetra nunc id leo sollicitudin, et ornare odio semper. Ut egestas arcu eget sollicitudin convallis. Aliquam sapien nulla, porta non arcu ac, euismod eleifend massa. Aenean placerat rhoncus ligula, ac porttitor erat tempor ut. Etiam sit amet orci ligula.');
INSERT INTO `articles`  VALUES
(3,'Il est minuit sur le pic du midi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus turpis augue, condimentum non placerat in, molestie vel felis. Duis at purus quis felis vehicula lacinia sed sit amet dolor. Sed vestibulum, mauris et pharetra efficitur, neque tellus viverra nulla, vitae feugiat arcu massa vel tortor. Fusce eu diam a risus egestas volutpat. Cras scelerisque eget sem euismod hendrerit. Morbi laoreet lectus in elit tempus molestie. Donec pharetra nunc id leo sollicitudin, et ornare odio semper. Ut egestas arcu eget sollicitudin convallis. Aliquam sapien nulla, porta non arcu ac, euismod eleifend massa. Aenean placerat rhoncus ligula, ac porttitor erat tempor ut. Etiam sit amet orci ligula.');
INSERT INTO `articles`  VALUES
(4,'Des traces de pas dans la neige intriguantes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus turpis augue, condimentum non placerat in, molestie vel felis. Duis at purus quis felis vehicula lacinia sed sit amet dolor. Sed vestibulum, mauris et pharetra efficitur, neque tellus viverra nulla, vitae feugiat arcu massa vel tortor. Fusce eu diam a risus egestas volutpat. Cras scelerisque eget sem euismod hendrerit. Morbi laoreet lectus in elit tempus molestie. Donec pharetra nunc id leo sollicitudin, et ornare odio semper. Ut egestas arcu eget sollicitudin convallis. Aliquam sapien nulla, porta non arcu ac, euismod eleifend massa. Aenean placerat rhoncus ligula, ac porttitor erat tempor ut. Etiam sit amet orci ligula.');
INSERT INTO `articles`  VALUES

(5,'Le printemps dans les Alpes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus turpis augue, condimentum non placerat in, molestie vel felis. Duis at purus quis felis vehicula lacinia sed sit amet dolor. Sed vestibulum, mauris et pharetra efficitur, neque tellus viverra nulla, vitae feugiat arcu massa vel tortor. Fusce eu diam a risus egestas volutpat. Cras scelerisque eget sem euismod hendrerit. Morbi laoreet lectus in elit tempus molestie. Donec pharetra nunc id leo sollicitudin, et ornare odio semper. Ut egestas arcu eget sollicitudin convallis. Aliquam sapien nulla, porta non arcu ac, euismod eleifend massa. Aenean placerat rhoncus ligula, ac porttitor erat tempor ut. Etiam sit amet orci ligula.');
INSERT INTO `users`  VALUES

(1, 'nadia', 'a2e8cea3392da09d1d31be3fca68efed','nadia@nadia.fr','admin', false, true,'1999-04-02', 'date',0);
INSERT INTO `users`  VALUES
(2, 'margaux', 'b8702063b3bd173aaaa20e5c16b350bf','margaux@margaux.fr','admin', false, true,'date', 'date',0);
INSERT INTO `users`  VALUES
(3, 'toto', 'f71dbe52628a3f83a77ab494817525c6','toto@toto.fr','writer', false, true,'date', 'date',0);
INSERT INTO `users`  VALUES
(4, 'tata', '49d02d55ad10973b7b9d0dc9eba7fdf0','tata@tata.fr','reader', false, true,'date', 'date',0);
INSERT INTO `users`  VALUES
(5, 'titi', '5d933eef19aee7da192608de61b6c23d','titi@titi.fr','writer', false, true,'date', 'date',0);
INSERT INTO `users`  VALUES
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3','admin@admin.fr','admin', true, false,'date', 'date',0);




