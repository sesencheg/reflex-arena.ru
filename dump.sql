-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 14 2024 г., 14:57
-- Версия сервера: 10.6.19-MariaDB-deb11
-- Версия PHP: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sesen_reflex`
--

-- --------------------------------------------------------

--
-- Структура таблицы `duels`
--

CREATE TABLE `duels` (
  `id` int(11) NOT NULL,
  `gameGuid` varchar(255) NOT NULL,
  `sv_hostname` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `map_title` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `match_stats`
--

CREATE TABLE `match_stats` (
  `id` int(11) NOT NULL,
  `duel_id` int(11) NOT NULL,
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
  `mmrNew` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `match_weaponstats`
--

CREATE TABLE `match_weaponstats` (
  `id` int(11) NOT NULL,
  `duel_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `weaponName` varchar(255) NOT NULL,
  `pickedUp` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `shotsFired` int(11) NOT NULL,
  `shotsHit` int(11) NOT NULL,
  `damageDone` int(11) NOT NULL,
  `secondsHeld` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `steamId` varchar(255) NOT NULL,
  `mmr` int(11) NOT NULL,
  `mmrBest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `duels`
--
ALTER TABLE `duels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `match_stats`
--
ALTER TABLE `match_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `duel_id` (`duel_id`);

--
-- Индексы таблицы `match_weaponstats`
--
ALTER TABLE `match_weaponstats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `duel_id` (`duel_id`);

--
-- Индексы таблицы `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `duels`
--
ALTER TABLE `duels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `match_stats`
--
ALTER TABLE `match_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `match_weaponstats`
--
ALTER TABLE `match_weaponstats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `match_stats`
--
ALTER TABLE `match_stats`
  ADD CONSTRAINT `match_stats_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `match_stats_ibfk_3` FOREIGN KEY (`duel_id`) REFERENCES `duels` (`id`);

--
-- Ограничения внешнего ключа таблицы `match_weaponstats`
--
ALTER TABLE `match_weaponstats`
  ADD CONSTRAINT `match_weaponstats_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `match_weaponstats_ibfk_3` FOREIGN KEY (`duel_id`) REFERENCES `duels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
