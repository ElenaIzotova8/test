-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `testdb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `testdb`;

DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `patronymic` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `authors` (`id`, `first_name`, `patronymic`, `last_name`, `created`, `last_modified`) VALUES
(1,	'Лев',	'Николаевич',	'Толстой',	'2021-11-25 09:22:29',	'2021-11-28 14:15:50'),
(9,	'Джон',	'',	'Толкин',	'2021-11-28 16:20:30',	'2021-11-28 14:21:22'),
(10,	'Александр',	'Сергеевич',	'Пушкин',	'2021-11-28 16:22:23',	'2021-11-28 16:22:23'),
(11,	'Иван',	'Иванович',	'Иванов',	'2021-11-28 16:22:59',	'2021-11-28 16:22:59');

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(1000) COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `books` (`id`, `author_id`, `name`, `created`, `last_modified`) VALUES
(2,	1,	'\"Война и мир\"',	'2021-11-27 14:06:13',	'2021-11-28 14:14:41'),
(4,	1,	'\"Анна Каренина\"',	'2021-11-27 14:07:16',	'2021-11-28 14:16:54'),
(31,	9,	'\"Властелин колец\"',	'2021-11-28 16:21:40',	'2021-11-28 16:21:40'),
(32,	10,	'\"Руслан и Людмила\"',	'2021-11-28 16:23:19',	'2021-11-28 16:23:19'),
(33,	10,	'\"Пиковая Дама\"',	'2021-11-28 16:23:30',	'2021-11-28 14:24:04');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `status` char(5) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `login`, `password`, `status`) VALUES
(1,	'test',	'098f6bcd4621d373cade4e832627b4f6',	'adm');

-- 2021-11-28 16:24:52
