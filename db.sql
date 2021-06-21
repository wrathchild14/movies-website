drop database if exists cinema;
create database cinema;
use cinema;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

CREATE TABLE `user` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `role` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;


CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `seat` int(11) NOT NULL,
  `username` varchar(45),
  `movieID` int(11),
  `userID` int(11)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;


INSERT INTO `movie` (`id`, `title`, `image`, `description`) VALUES
(1, 'Batman (11:00)', 'batman.png', 'Action, Fantasy'),
(2, 'Joker (14:30)', 'joker.jpg', 'Psychological horror'),
(3, 'Endgame (17:00)', 'endgame.jpg', 'Adventure, Superhero'),
(4, 'Black Panther (10:00)', 'black_panther.jpg', 'Superhero, Action'),
(5, 'Breakfast Club (12:00)', 'breakfast_club.png', 'Teen, Drama'),
(6, 'Justice League (18:00)', 'justice.jpeg', 'Superhero, Action, Dark'),
(7, 'Us (20:00)', 'us.jpg', 'Horror, Drama'),
(8, 'Hereditary (21:00)', 'hereditary.jpg', 'Horror'),
(9, 'Midsommar (17:00)', 'midsommar.png', 'Horror, Drama');

ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `title` (`title`,`description`);


ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;


ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

ALTER TABLE `reservation`
  ADD FOREIGN KEY (`movieID`) REFERENCES `movie`(`id`),
  ADD FOREIGN KEY (`userID`) REFERENCES `user`(`id`);

INSERT INTO `user` VALUES 
(1,'user', 'password', ''),
(2, 'admin', 'admin', 'admin'); 

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
