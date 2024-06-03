-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Jún 03. 23:25
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `kutyamenhely`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allatok`
--

CREATE TABLE `allatok` (
  `id` int(11) NOT NULL,
  `nev` text NOT NULL,
  `nem` text NOT NULL,
  `csipszam` int(11) NOT NULL,
  `fajta` text NOT NULL,
  `tipus` text NOT NULL,
  `egeszsegiallapot` text NOT NULL,
  `fogazat` text NOT NULL,
  `kor` int(11) NOT NULL,
  `viselkedes` text NOT NULL,
  `egyeb` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `allatok`
--

INSERT INTO `allatok` (`id`, `nev`, `nem`, `csipszam`, `fajta`, `tipus`, `egeszsegiallapot`, `fogazat`, `kor`, `viselkedes`, `egyeb`) VALUES
(12, 'aáeéiíuúű', 'Hím', 1, 'aáeéiíuúű', 'aáeéiíuúű', '', '', 0, '', 'aáeéiíuúű'),
(15, 'űűűű', 'Nőstény', 0, 'űőüüó', 'valami', '', '', 0, '', 'asc'),
(16, 'kiskutya', 'Nőstény', 0, '', '', '', '', 0, '', ''),
(17, 'valsmi', 'Hím', 0, '', '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `jogosultsag` enum('admin','dolgozo','orvos','latogato') NOT NULL,
  `felhasznalonev` text NOT NULL,
  `jelszo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `jogosultsag`, `felhasznalonev`, `jelszo`) VALUES
(17, 'admin', 'Admin', '$2y$10$0ildXABSo9KQDr3rGPT3h.GPDatIYnajr5nHXip63UzbprjTwvfmy'),
(19, 'latogato', 'Látogató', '$2y$10$hJps62Vyw.X6nSSlCHD3GOMbl8La4N7usdidrBKMkwno6cYh.zDTC'),
(20, 'dolgozo', 'Dolgozó', '$2y$10$M7v3Tk5.0Hqsx2Y0v13YX.CDMaOqAXPJbVERzwPxQ1rGmFgBclgv.'),
(22, 'dolgozo', 'Hahó', '$2y$10$H55OYA3syJYyAkmZnDw.heZBYA0MtfYQ8suK6btkxD4.XHIPI88um'),
(23, 'dolgozo', 'Hahóó', '$2y$10$5ffniGxB0LDTb1XGRTXgVujAut5x2/9ritMyipO62lwk51qlwYvtO'),
(24, 'latogato', 'látogató', '$2y$10$sNyttEUO3GV1IDzRsYj51.gbNZIeIA1nxHXLwUd1i9Gx6Kv6ISVia'),
(26, 'orvos', 'Orvos', '$2y$10$evL8t06eugRRBUnp4TO/Q.9100wAJqetHUI30MHEdX8SvoQqB7erS');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allatok`
--
ALTER TABLE `allatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allatok`
--
ALTER TABLE `allatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
