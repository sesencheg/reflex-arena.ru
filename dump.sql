-- Adminer 4.8.1 MySQL 5.5.5-10.6.10-MariaDB-1:10.6.10+maria~deb11 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `matches`;
CREATE TABLE `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameGuid` varchar(255) NOT NULL,
  `sv_hostname` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `map_title` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `match_stats`;
CREATE TABLE `match_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `forfeit` int(11) NOT NULL,
  `disconnected` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `team` varchar(255) NOT NULL,
  `takenRA` int(11) NOT NULL,
  `takenYA` int(11) NOT NULL,
  `takenGA` int(11) NOT NULL,
  `takenMega` int(11) NOT NULL,
  `flagsCaptured` int(11) NOT NULL,
  `flagsPickedUp` int(11) NOT NULL,
  `flagsReturned` int(11) NOT NULL,
  `totalDeaths` int(11) NOT NULL,
  `secondsHeldQuad` int(11) NOT NULL,
  `secondsHeldResist` int(11) NOT NULL,
  `totalHealthPickedUp` int(11) NOT NULL,
  `totalDamageReceived` int(11) NOT NULL,
  `distanceTravelled` float NOT NULL,
  `mmrNew` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `match_id` (`match_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `match_stats_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`),
  CONSTRAINT `match_stats_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `match_weaponstats`;
CREATE TABLE `match_weaponstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `weaponName` varchar(255) NOT NULL,
  `pickedUp` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `shotsFired` int(11) NOT NULL,
  `shotsHit` int(11) NOT NULL,
  `damageDone` int(11) NOT NULL,
  `secondsHeld` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `match_id` (`match_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `match_weaponstats_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`),
  CONSTRAINT `match_weaponstats_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `steamId` varchar(255) NOT NULL,
  `mmr` int(11) NOT NULL,
  `mmrBest` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2024-02-23 16:50:41
