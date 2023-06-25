-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Cze 2023, 13:25
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `school_diary`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `classes`
--

CREATE TABLE `classes` (
  `class_id` int(10) UNSIGNED NOT NULL,
  `class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `classes`
--

INSERT INTO `classes` (`class_id`, `class`) VALUES
(1, '1A'),
(2, '1B'),
(5, '2A'),
(6, '2B'),
(8, '3A'),
(9, '3B'),
(11, '-');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grades`
--

CREATE TABLE `grades` (
  `operation_id` int(10) UNSIGNED NOT NULL,
  `grade` int(10) UNSIGNED NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `subject` int(10) UNSIGNED NOT NULL,
  `student` int(10) UNSIGNED NOT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1, 'administrator'),
(2, 'nauczyciel'),
(3, 'uczeń');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher` int(10) UNSIGNED NOT NULL,
  `class` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `subjects`
--

INSERT INTO `subjects` (`id`, `teacher`, `class`, `name`) VALUES
(11, 27, 1, 'język polski'),
(12, 27, 2, 'język polski'),
(13, 24, 5, 'język polski'),
(14, 27, 6, 'język polski'),
(15, 24, 8, 'język polski'),
(16, 24, 9, 'język polski'),
(17, 25, 1, 'matematyka'),
(18, 25, 2, 'matematyka'),
(19, 26, 5, 'matematyka'),
(20, 26, 6, 'matematyka'),
(21, 26, 8, 'matematyka'),
(22, 26, 9, 'matematyka'),
(23, 23, 1, 'język angielski'),
(24, 23, 8, 'język angielski'),
(25, 23, 9, 'język angielski'),
(26, 28, 2, 'język angielski'),
(27, 28, 5, 'język angielski'),
(28, 28, 6, 'język angielski'),
(29, 22, 1, 'wychowanie fizyczne'),
(30, 22, 2, 'wychowanie fizyczne'),
(31, 22, 5, 'wychowanie fizyczne'),
(32, 22, 8, 'wychowanie fizyczne'),
(33, 28, 6, 'wychowanie fizyczne'),
(34, 28, 9, 'wychowanie fizyczne'),
(35, 21, 1, 'plastyka'),
(36, 21, 2, 'plastyka'),
(37, 21, 5, 'plastyka'),
(38, 21, 6, 'plastyka'),
(39, 21, 8, 'plastyka'),
(40, 21, 9, 'plastyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `types_of_grades`
--

CREATE TABLE `types_of_grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `grade` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `types_of_grades`
--

INSERT INTO `types_of_grades` (`id`, `grade`) VALUES
(1, 1),
(2, 1.5),
(3, 2),
(4, 2.5),
(5, 3),
(6, 3.5),
(7, 4),
(8, 4.5),
(9, 5),
(10, 5.5),
(11, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(50) NOT NULL,
  `class` int(10) UNSIGNED NOT NULL,
  `role` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `birthday`, `email`, `password`, `login`, `class`, `role`) VALUES
(9, 'admin', 'admin', '2023-05-05', 'admin@admin.com', '$2y$10$98s6Y.XyUI.1LoIheTefseafcXrE/j1PRzoWTVT8doWuvgVEhQwHO', 'admin', 11, 1),
(21, 'Marta', 'Kowalska', '1994-06-15', 'mkowalska@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$VVhRZWQ1QUNUV3YyV1QwMQ$aWoRtuRZVeBs6u6HTskrh4rMJ3zM2sRSbx1SvZnMlQw', 'mkowalska', 11, 2),
(22, 'Piotr', 'W&oacute;jcik', '2023-05-04', 'pwojcik@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$cmVLOHpncGZkUGRyZjNRSA$LO/16GXe9qBzxQqi0vQQhwuG4iHqJpvIfxA/k+aE1ZU', 'pwojcik', 11, 2),
(23, 'Anna', 'Mazur', '2023-05-05', 'amazur@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$Nk1RcHJkRHBMSUVpcXkxWQ$Hay/6eK3LJG6ScmcLiJbDvPtMEVVCewYKIXAWHqqc0M', 'amazur', 11, 2),
(24, 'Aleksandra', 'Sadowska', '2023-05-04', 'asadowska@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$L3dBSFVsdkg2ZWVRZlJBeA$ezT9CuB1TkqdHKlnf1jVsvjoXfa1yKppAP2N9ooM4XY', 'asadowska', 11, 2),
(25, 'Tomasz', 'Lewandowski', '2023-02-24', 'tlewandowski@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$YUlvY3FZOUNwcHZ6aFg4TA$Ir74Aaq+WvQIz/Z8Ay2mDG6f2afVtSX6MzulgFr0Q2k', 'tlewandowski', 11, 2),
(26, 'Katarzyna', 'Woźniak', '2023-02-16', 'kwozniak@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$dlFGQ3h6RGhlTGtOenA4OA$coT5sYLVfS3K4XqIGB8B7Rg2CxKvyd7vfubaHXa1qhc', 'kwozniak', 11, 2),
(27, 'Grzegorz', 'Kaczmarek', '2023-03-09', 'gkaczmarek@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$d0dlRXgzc2dyV2labWxsWg$UG0dAYUZ28TeuiF+Dabj0o7sBDGoqvLbUfbl+LI5KpI', 'gkaczmarek', 11, 2),
(28, 'Ewa', 'Pawlak', '2023-02-09', 'epawlak@koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$Q3dUSUEudDN6SDhSNE5WSg$Mt/Fo4Y/lIyZogXydsYQacxNSm/AJoYYZI36Zz1Eq10', 'epawlak', 11, 2),
(29, 'Agata', 'Kucharska', '2023-03-30', 'akucharska@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$UldrZHRmQ2puTzZmL3dOOQ$QCVOykuD4VgedtEDlZZ0Q+j+bOSmqEXDJX/J1PZYpYw', 'akucharska', 1, 3),
(30, 'Borys', 'Baranowski', '2023-04-25', 'bbaranowski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$eWNCblB6T2ltQXRjY01GTQ$f1N0gKLgzVQt1dkYDhILrf0zWfp7hdvVyfrqkOLgPSg', 'bbaranowski', 1, 3),
(31, 'Adrian', 'Szewczyk', '2023-05-11', 'aszewczyk@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$M3RqbFlVNVhTZ0ZjU1c5Mg$SMZjFxJl1OI+TCr0Cgf5vGJ544vMdz8QdYzfBsKrIrU', 'aszewczyk', 1, 3),
(32, 'Gabriel', 'Krajewski', '2023-05-02', 'gkrajewski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$V2RyVGdFVzd3dVdLWE41WA$doFyQCs2Cl3kiJWwn+BRPT41dd2A7j4O6Y8JLeQGlGg', 'gkrajewski', 1, 3),
(33, 'Arkadiusz', 'Krajewski', '2023-03-09', 'akrajewski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$T0JnVnVYSUlFcDVzS0NNSQ$EqOZEyruXBXMQt2jyAt0eEyB5gigQiYHX2m8p/T4+OU', 'akrajewski', 1, 3),
(34, 'Błażej', 'Lewandowski', '2023-01-12', 'blewandowski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$LnVlSjdKOWxCaEJ0ZW1oSw$vBoELqHg3r6DYkKpYXRBhKSdoyNhBiFnY6/DkR/XlBU', 'blewandowski', 1, 3),
(35, 'Wiktoria', 'Krawczyk', '2023-02-09', 'wkrawczyk@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$Y210dFBhc0pBWnRVUHZXdw$NgrHiRauOJb2IQNzKA8AF4mFUe2OeAE0OnFlBLl8qUc', 'wkrawczyk', 1, 3),
(36, 'Ryszard', 'Sikorski', '2023-01-06', 'rsikorski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$TDdFVW1ITFdmSTV4Q0ZSNA$NQDJGGxSADzkniXEnbEhg8W0BYfhEz0CLS6mdXOCxVU', 'rsikorski', 1, 3),
(37, 'Kamila', 'Lewandowska', '2022-10-06', 'klewandowska@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$bW5tRmdJdkpmUE01RE5KZQ$OMX/3YcsSTjgiBV89uHpBdAz876qYJBbitnNsNq3loU', 'klewandowska', 1, 3),
(38, 'Łukasz', 'Kaczmarczyk', '2023-02-03', 'lkaczmarczyk@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$N2YxR3hKOElwL3BpN3NCSA$8jwD21c2WZ7iU+bGTt3SHr2KAqH9aGddATPYqOAE1HA', 'lkaczmarczyk', 1, 3),
(39, 'Eliza', 'Wr&oacute;blewska', '2022-12-06', 'ewroblewska@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$cjNVWkxMcnpYTEJBSDFjZw$U8uGHIugSLn3N/So4HUs08YTGbGlFCbLMV0ASU0BV/I', 'ewroblewska', 2, 3),
(40, 'Marcel', 'Kamiński', '2022-12-05', 'mkaminski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$bEMzWmwySHV1SDZDV1BRWg$/He8l5g6ihN1kSHQJucDyX4ya+0vmkyqLoUWiUAzZCg', 'mkaminski', 2, 3),
(41, 'Maciej', 'Głowacki', '2022-10-04', 'mglowacki@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$ajNwVkI3c1dvWjdhcjJRRw$BU9JpaeLDWGMFZknpuL93n26ISl7J/E2Zx2BEvm8+Ag', 'mglowacki', 2, 3),
(42, 'Marek', 'Wr&oacute;blewski', '2022-03-09', 'mwroblewski@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$NjlGVmx1Y01KVnRFNHp3aA$T10zZS5fyfrPuch7/gM8B1W6TUEOFbchM1LPqMyqqCo', 'mwroblewski', 2, 3),
(43, 'Patrycja', 'Janowska', '2022-12-28', 'pjanowska@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$L05VeGZ3dFcveVZTR01FVQ$iuTgng2FYKbxOY/QnkYApBRqbVxL0Fm1g76rcGsAlgE', 'pjanowska', 2, 3),
(44, 'Wiktor', 'Pietrzak', '2022-07-08', 'wpietrzak@edu.koalaschool.com', '$argon2id$v=19$m=65536,t=4,p=1$YTRLbUFkWTFiZVE4TXd1Lg$MjB/IC7TPaiUHF9OkA8eVdhqYhtY0EnP7LPxDJt0N+Q', 'wpietrzak', 2, 3),
(45, 'Szymon', 'Pawłowski', '2000-11-11', 'spawlowski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$cy5RWXQ2djZTL25UMWJkWA$MiEKBtqZMxHeIuVK0dpSrn2TdxkH9b2sX4j15mA+8PE', 'spawlowski', 2, 3),
(46, 'Mariusz', 'Mazurek', '2004-11-11', 'mmazurek@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$TDZ4VHZVM1JDNHlLWUkxNg$OHnTcPAWYgg2qPeQrXilgres1OyAPeFTtrHokTad6oc', 'mmazurek', 2, 3),
(47, 'Jan', 'Duda', '2004-01-23', 'jduda@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$M0NmR1drOFlJMlJ2Z0FIVA$iRk67EhSobY+D2OKFBI5BIWvJGOjDhcBVVG8BQoh+Xo', 'jduda', 2, 3),
(48, 'Ernest', 'Sikorski', '2001-03-31', 'esikorski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$bjRPblpSOUliSjMxNGRXdA$9NKlBTgcvuTpFcoJLavf7AOdM3Y5lp+syi6NNiwiXo8', 'esikorski', 2, 3),
(49, 'Apolonia', 'Kalinowska', '2001-04-30', 'akalinowska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$cFJkZld4UVYzVmZjSjd3bA$uyTDTnYZx+AbUUOhCCBOx2e/07Oy6vWics7rW+UqVcY', 'akalinowska', 5, 3),
(50, 'Olaf', 'Olszewski', '2004-08-12', 'oolszewski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$Z1ZNNEl2OC5SY2Ixa0lRaQ$OFBZ5NbucZN/VmorlwIpJ5CgxU75ZsV7z0loGeCwdEg', 'oolszewski', 5, 3),
(51, 'Julian', 'Kr&oacute;l', '2004-08-12', 'jkrol@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$bDRRMEI5SmY0Z3FIOHJsSw$6iL99uWE7B1lhB99/xWhPiGqIeheW1/Rco+Xv7/ThcI', 'jkrol', 5, 3),
(52, 'Patrycja', 'G&oacute;rska', '2001-03-09', 'pgorska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$bHJYelNjczRaYWJlUTl5bg$sQsKQtI4rs1henuufA9/lgiYAUMSIMtrt3xUNkMJrWg', 'pgorska', 5, 3),
(53, 'Fryderyk', 'Jabłoński', '2001-03-09', 'fjablonski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$YUhaSHlmUHlRNFFpQTU4VQ$EwkduMxwJF0vVkzVOtVcTUizaSUVfRBjuybaRH9wqqA', 'fjablonski', 5, 3),
(54, 'Patryk', 'Mazurek', '2001-01-05', 'pmazurek@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$dGswcE1WNVhpc2ovMWxZaA$HmQy2obvrQcJ+EwLuYxX1fcFu/h/GDdOItJMqPiLTDE', 'pmazurek', 5, 3),
(55, 'Nataniel', 'Szymański', '2004-05-03', 'nszymanski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$bDFTS3QvMEFPRTdGZEdxeA$mJQ/pJpQbgg4BGqbF3TpIJMo2/GpA/jZIsP5/91ozNs', 'nszymanski', 5, 3),
(56, 'Nadia', 'Czerwińska', '2004-05-03', 'nczerwinska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$R01VZUtNaWo0WGZ2WUlJdw$eJ7kcUByA4iSreGMTGGjML9QCnPp2rdGp0LL/iwhL+0', 'nczerwinska', 5, 3),
(57, 'Grzegorz', 'Głowacki', '2004-10-03', 'gglowacki@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$Zk5vQVNsOWo4eThOS0J6RA$3/57KU0OMonodr003qYI1RYhkt5vHwMF/6y++4Zyr1M', 'gglowacki', 5, 3),
(58, 'Gustaw', 'Cieślak', '2004-10-26', 'gcieslak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$N3U5ME9NcElVSEViSExyLw$hU8TqNzZDIfXk+Fi6t5o1VT2x5IaI3etpxxvdMkXUhc', 'gcieslak', 5, 3),
(59, 'Igor', 'Lewandowski', '2004-05-28', 'ilewandowski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$TUs4eC91N0FoRG5Dck9tbQ$QR4MbEax1UMaPk4lvnCeSlenohSBejK3Xgp1wB8uAG8', 'ilewandowski', 6, 3),
(60, 'Stefan', 'Kołodziej', '2002-04-29', 'skolodziej@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$aGlqdm5jOW15RUJzVUs4Ng$1+0jmVvY87Hfh5NC0dyuG9Gbu5miDNMZ3mFQXfncvh4', 'skolodziej', 6, 3),
(61, 'Dagmara', 'Gajewska', '2003-07-18', 'dgajewska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$YkxFampxUUhLYjZabUMxeQ$1tcuh9RTBDurDTliJHTLZYyLSLBoWrctk/6gASyEzuo', 'dgajewska', 6, 3),
(62, 'Wiktor', 'Czarnecki', '2003-07-18', 'wczarnecki@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$VTlodFJpUVpwanJQbFZicA$o2Xo76bJI50FjSft748b3yneumoDuBnzBHUMdpR3kOs', 'wczarnecki', 6, 3),
(63, 'Krystyna', 'Przybylska', '2003-08-04', 'kprzybylska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$czU5cWV5WE5DVGJwT0dpcg$Cc/xLWIHHJMkgpOOeEG2ETqpPA9dCsCCZZupn3lnEOI', 'kprzybylska', 6, 3),
(64, 'Anastazja', 'Makowska', '2003-08-04', 'amakowska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$RTk4cjhiTVNZRWJ3RGRKRQ$FTdhu1YXWlP8AYAv3V3rLjonicKYP/vADagNfY5AKHc', 'amakowska', 6, 3),
(65, 'Radosław', 'Kr&oacute;l', '2005-08-04', 'rkrol@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$ZFNQT2ZhWUd5YnUyNjR3MA$QNNWkYQBOD5Ophcx5ncuUdpq3Xdh7b+Y8gSGaLHHpJg', 'rkrol', 6, 3),
(66, 'Karol', 'Przybylak', '2005-08-04', 'kprzybylak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$bGZZb2YvOHJ0d2ZHSzJudw$pRPGdemrPl92WXUPZ+Rf+J0Yzbc6RujEbpdY2TMpvFQ', 'kprzybylak', 6, 3),
(67, 'Rafał', 'Piotrowski', '2001-02-12', 'rpiotrowski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$NHlkSlRUQng3bE11Rk0wQg$Iu4b+Ll1wB7LFMrvKLkqDOM0TwflwG6HUyhsaAdxDxY', 'rpiotrowski', 6, 3),
(68, 'Nataniel', 'Malinowski', '2001-02-12', 'nmalinowski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$UTdMSE5PNFJHWUpFSE9vdA$KfcgGBzmuG+loQR/t28WyPgCCwv+k8nlDiksM70WjCc', 'nmalinowski', 6, 3),
(69, 'Wojciech', 'Tomaszewski', '2001-02-12', 'wtomaszewski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$VEFZL2NFMk4ySHNkbXVkdA$OxNmqnnqbKJmxCmUlLS0fVKMLu/tmiz2sll9mQuCfUA', 'wtomaszewski', 6, 3),
(70, 'Nikodem', 'Jabłoński', '2001-02-12', 'njablonski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$YkdoRWpWTXpCRWUyQkIuTA$xoaHH3QNXiXiM4Pwghdh/qxk/ZTNNjn6ulKh7PBqy1Q', 'njablonski', 8, 3),
(71, 'Leon', 'Michalak', '2001-02-12', 'lmichalak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$N056bWh4c285Rm5XeGxkSw$sVIUNWCBuF6msG+Dsjnia4wPdeBlk/sUgnOUEamBOx0', 'lmichalak', 8, 3),
(72, 'Dorota', 'Jaworska', '2003-05-12', 'djaworska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$U3JPbTNsTEo3cFAzMy5sNw$Wq+120jOe8RfTkCMZws1+oKC8+zxLKwugqx7kxlu3qA', 'djaworska', 8, 3),
(73, 'Konstanty', 'Szymczak', '2003-05-12', 'kszymczak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$cm9mYTZyc0Rwb2dma0JDTw$i8izf2uFPxMvGENVpQJTsfGn1J9/TDk8F7tVxRgsTUM', 'kszymczak', 8, 3),
(74, 'Maria', 'Sawicka', '2003-05-12', 'msawicka@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$R2FLYXVXTkNaNTFpaEFiQg$EVNXfVtBtXQKE5oZnPjkluW4n0LuXt+qH0pGyQoD9o0', 'msawicka', 8, 3),
(75, 'Alicja', 'Makowska', '2003-05-12', 'amakowska2@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$MVYudHkyOXo4cllBZkYzLg$/LFI3hOZ+Dp59+2xCucKeUfYq4IlmxTmksZ7VaAZ7Nw', 'amakowska2', 8, 3),
(76, 'Stanisław', 'Bąk', '2003-05-12', 'sbak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$YXZzTk1EZWs4OU82UzZHNQ$UErVINAOKZrsXz6obZLSDHjCSn/o0nZFUSNo47wfC7o', 'sbak', 8, 3),
(77, 'Sandra', 'Sobczak', '2003-05-12', 'ssobczak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$SkQuMkRmZ2xQZzVrQjY1Yw$A6e3yRkwEYQiJf5OOmJ1xZXioZSx8fL5AxuTRbOncZQ', 'ssobczak', 8, 3),
(78, 'Karolina', 'Włodarczyk', '2003-05-12', 'kwlodarczyk@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$RExXZi5kYVdKSmZaendOSg$lOa8RkIogKkiuuIkp46whHQIgzWCl3Y/9vaIO+gGFr4', 'kwlodarczyk', 8, 3),
(79, 'Oliwia', 'Wojciechowska', '2002-08-05', 'owojciechowska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$V1g4b0E0dnIxTXFnWEYzbQ$ZwYo6z8Ps9Dg158ggrkdpUIjyUgYW9xYOWbPzB6Wz3M', 'owojciechowska', 9, 3),
(80, 'Filip', 'Michalski', '2002-08-05', 'fmichalski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$OVJkbFZaemYuUy9rNk5KMQ$qDDDpow1VMuZSHWi/NvUTgrj/pyY3RChhMjCQ42XDCs', 'fmichalski', 9, 3),
(81, 'Maks', 'Chmielewski', '2002-08-05', 'mchmielewski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$TXZKdFh0YThVRGhEdGhmZQ$0kOIFjS9qz28u6gKql+SoSVuM5wKg8KttF1wnMZVhzg', 'mchmielewski', 9, 3),
(82, 'Martyna', 'Zakrzewska', '2002-08-05', 'mzakrzewska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$OVVLZU9lQ3ptTmZwbWlIYw$FHZ68zogb/H3CEV1VJEzZonl1YeSrDZVlkxf25ndIqI', 'mzakrzewska', 9, 3),
(83, 'Rozalia', 'Mazur', '2004-05-22', 'rmazur@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$MVZpaXRyaml2RWtJQ0l3dg$2EL5HnqfZfxd2DbCgGEqqQvrfytnpEfJ2YFJ6zM173w', 'rmazur', 9, 3),
(84, 'Adrian', 'Sobczak', '2004-05-22', 'asobczak@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$L1hmNGFkTEVYVDBNbGhISg$su36eigkD7Ocwa1Sd/MwR4cb5/K2alYd9jWHWX4V67k', 'asobczak', 9, 3),
(85, 'Nikodem', 'Szymański', '2004-05-22', 'nszymanski2@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$UjcyaDRJWnhIa3ByUjIxbA$S1lZKZ58eMPvSAtucEsJdb1FTHmM9S2Y2qH7Uqp26lU', 'nszymanski2', 9, 3),
(86, 'Maciej', 'Krajewski', '2004-05-22', 'mkrajewski@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$ZkdTRUN0YUU0RUZLS0wxUA$Z7OzUaGgfA5saojFmjvWSeCnl2KVgVRQNmyJgivZTKg', 'mkrajewski', 9, 3),
(87, 'Marcin', 'Adamczyk', '2004-05-22', 'madamczyk@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$QU1LaDE3NzRaNW9xUUNEZw$zupYIt4q3XID6Tny/x8v2xhcMCUc1IcQokG/2h1ERuw', 'madamczyk', 9, 3),
(88, 'Eliza', 'Krajewska', '2004-05-22', 'ekrajewska@edu.koalaschool.pl', '$argon2id$v=19$m=65536,t=4,p=1$cDJrT2w2VGNwblV1NUMxbw$qFH3js990Z0zhTHtZcIIzrXLQxGwj0sRdVeW5tp7T5I', 'ekrajewska', 9, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indeksy dla tabeli `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`operation_id`),
  ADD KEY `student` (`student`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `grade` (`grade`),
  ADD KEY `subject` (`subject`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeksy dla tabeli `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `class` (`class`);

--
-- Indeksy dla tabeli `types_of_grades`
--
ALTER TABLE `types_of_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `grades`
--
ALTER TABLE `grades`
  MODIFY `operation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `types_of_grades`
--
ALTER TABLE `types_of_grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`student`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `grades_ibfk_5` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `grades_ibfk_6` FOREIGN KEY (`grade`) REFERENCES `types_of_grades` (`id`),
  ADD CONSTRAINT `grades_ibfk_7` FOREIGN KEY (`subject`) REFERENCES `subjects` (`id`);

--
-- Ograniczenia dla tabeli `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`class`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `subjects_ibfk_3` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`class`) REFERENCES `classes` (`class_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
