-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 26 2014 г., 00:12
-- Версия сервера: 5.5.27
-- Версия PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ratio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `login_levels`
--

CREATE TABLE IF NOT EXISTS `login_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(255) NOT NULL,
  `sort` int(1) NOT NULL,
  `level_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '100.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `login_levels`
--

INSERT INTO `login_levels` (`id`, `level_name`, `sort`, `level_disabled`, `price`) VALUES
(1, 'Администраторы', 1, 0, 100.00),
(2, 'Пользователи', 2, 0, 100.00);

-- --------------------------------------------------------

--
-- Структура таблицы `login_users`
--

CREATE TABLE IF NOT EXISTS `login_users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_level` varchar(2555) NOT NULL,
  `restricted` int(1) NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) NOT NULL,
  `edit_days` int(11) NOT NULL DEFAULT '20',
  `dr` date NOT NULL DEFAULT '1975-01-01',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `login_users`
--

INSERT INTO `login_users` (`user_id`, `user_level`, `restricted`, `username`, `fname`, `lname`, `email`, `password`, `timestamp`, `price`, `edit_days`, `dr`) VALUES
(1, '1', 0, 'Administrator', 'Администратор', '', 'ok.sulde@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2014-08-15 16:52:30', 0.00, 20, '1975-01-01'),
(2, '2,1', 0, 'admin', '', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '2014-08-15 16:53:27', 1.00, 20, '1975-01-01');

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `safe_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `safe_name`) VALUES
(1, 'Main Menu', 'main_menu'),
(2, 'Footer Menu', 'footer_menu');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(3) NOT NULL,
  `lft` int(3) NOT NULL,
  `rgt` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_safe` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `type` varchar(12) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `lft`, `rgt`, `title`, `title_safe`, `class_name`, `type`, `content`) VALUES
(1, 6, 3, 4, 'Terms', 'terms', '', 'url', '/terms'),
(2, 1, 9, 10, 'Contact Us', 'contact_us', '', 'url', '/contact'),
(3, 1, 6, 7, 'Team', 'team', '', 'content', '|2|'),
(4, 1, 4, 5, 'History', 'history', '', 'content', '|1|'),
(5, 1, 3, 8, 'About Us', 'about_us', '', 'separator', '|-|'),
(6, 1, 1, 2, 'Home', 'home', '', 'url', '/'),
(7, 6, 1, 2, 'Privacy', 'privacy', '', 'url', '/privacy');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_access` varchar(2555) NOT NULL,
  `url` varchar(255) NOT NULL,
  `safe_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `level_access`, `url`, `safe_name`) VALUES
(1, '', 'core/inc/blank.php', 'blank_page');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
