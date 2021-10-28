-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Okt 28. 18:39
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `zene`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `zenek`
--

CREATE TABLE `zenek` (
  `id` int(11) NOT NULL,
  `cim` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `eloado` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `stilus` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `hossz` float NOT NULL,
  `megjelenes_datuma` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `zenek`
--

INSERT INTO `zenek` (`id`, `cim`, `eloado`, `stilus`, `hossz`, `megjelenes_datuma`) VALUES
(1, 'Total Eclipse of the Heart', 'Bonnie Tyler', 'rock', 4.3, '1983-05-26'),
(2, 'Waterloo', 'ABBA', 'europop', 2.46, '1974-03-04'),
(3, 'Zitti e Buoni', 'Maneskin', 'rock', 3.19, '2021-03-03'),
(4, 'Titanium', 'Sia', 'pop', 4.05, '2011-11-26'),
(5, 'We Will Rock You', 'Queen', 'rock', 2.01, '1977-10-07');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `zenek`
--
ALTER TABLE `zenek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `zenek`
--
ALTER TABLE `zenek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
