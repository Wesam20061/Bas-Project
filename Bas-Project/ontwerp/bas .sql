-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 mei 2025 om 23:07
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelen`
--

CREATE TABLE `artikelen` (
  `artId` int(11) NOT NULL,
  `artOmschrijving` varchar(50) NOT NULL,
  `artInkoop` decimal(6,2) DEFAULT NULL,
  `artVerkoop` decimal(6,2) DEFAULT NULL,
  `artVoorraad` int(11) NOT NULL,
  `artMinVoorraad` int(11) NOT NULL,
  `artMaxVoorraad` int(11) NOT NULL,
  `artLocatie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikelen`
--

INSERT INTO `artikelen` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`) VALUES
(1, 'Aardbeienjam', 1.20, 2.00, 15, 10, 100, 1),
(2, 'Toiletpapier', 0.50, 1.00, 30, 15, 200, 2),
(3, 'Pasta', 0.80, 1.50, 25, 10, 150, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporders`
--

CREATE TABLE `inkooporders` (
  `inkOrdId` int(11) NOT NULL,
  `levId` int(11) DEFAULT NULL,
  `artId` int(11) DEFAULT NULL,
  `inkOrdDatum` date DEFAULT NULL,
  `inkOrdBestAantal` int(11) DEFAULT NULL,
  `inkOrdStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inkooporders`
--

INSERT INTO `inkooporders` (`inkOrdId`, `levId`, `artId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 1, 1, '2025-05-25', 90, 1),
(2, 2, 2, '2025-05-26', 150, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(45) DEFAULT NULL,
  `klantEmail` varchar(45) NOT NULL,
  `klantAdres` varchar(45) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Win', 'win@gmail.com', 'Slige', '1234 W', 'Rotterdam'),
(2, 'Hiiii', 'Hi@gmail.com', 'Latte', '4321', 'Rotterdam'),
(3, 'bbb', 'bbb', '', NULL, NULL),
(4, 'eee', 'eee', '', NULL, NULL),
(5, 'eee', 'eee', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE `leveranciers` (
  `levId` int(11) NOT NULL,
  `levNaam` varchar(50) NOT NULL,
  `levContact` varchar(50) DEFAULT NULL,
  `levEmail` varchar(50) NOT NULL,
  `levAdres` varchar(50) DEFAULT NULL,
  `levPostcode` varchar(6) DEFAULT NULL,
  `levWoonplaats` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'VoedselGroothandel BV', 'Klaas de Boer', 'klaas@voedselgroothandel.nl', 'Groothandellaan 5', '3456GH', 'Delft'),
(2, 'NonFood BV', 'Anita van Dijk', 'anita@nonfood.nl', 'Industriestraat 8', '2345KL', 'Rotterdam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkooporders`
--

CREATE TABLE `verkooporders` (
  `verkOrdId` int(11) NOT NULL,
  `klantId` int(11) DEFAULT NULL,
  `artId` int(11) DEFAULT NULL,
  `verkOrdDatum` date DEFAULT NULL,
  `verkOrdBestAantal` int(11) DEFAULT NULL,
  `verkOrdStatus` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verkooporders`
--

INSERT INTO `verkooporders` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(1, 1, 1, '2025-05-27', 2, 1),
(2, 2, 2, '2025-05-27', 4, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artId`);

--
-- Indexen voor tabel `inkooporders`
--
ALTER TABLE `inkooporders`
  ADD PRIMARY KEY (`inkOrdId`),
  ADD KEY `levId` (`levId`),
  ADD KEY `artId` (`artId`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`levId`);

--
-- Indexen voor tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD PRIMARY KEY (`verkOrdId`),
  ADD KEY `klantId` (`klantId`),
  ADD KEY `artId` (`artId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `inkooporders`
--
ALTER TABLE `inkooporders`
  MODIFY `inkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `levId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  MODIFY `verkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `inkooporders`
--
ALTER TABLE `inkooporders`
  ADD CONSTRAINT `inkooporders_ibfk_1` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`),
  ADD CONSTRAINT `inkooporders_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`);

--
-- Beperkingen voor tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD CONSTRAINT `verkooporders_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klant` (`klantId`),
  ADD CONSTRAINT `verkooporders_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
