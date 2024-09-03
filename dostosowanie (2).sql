-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Wrz 03, 2024 at 07:26 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dostosowanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostosowania`
--

CREATE TABLE `dostosowania` (
  `id_dost` int(11) NOT NULL,
  `text` text NOT NULL,
  `id_kat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dostosowania`
--

INSERT INTO `dostosowania` (`id_dost`, `text`, `id_kat`) VALUES
(58, 'slabo slyszy', 1),
(59, 'nie slyszy', 2),
(60, 'slabo widzi', 3),
(61, 'nic nie widzi', 2),
(69, 'afazja2', 9),
(72, 'zagrozenie niedostosowaniem', 10),
(73, 'niedostosowany', 2),
(74, 'xdggchfchvc', 1),
(75, 'asperger1', 9),
(78, 'nie rusza sie', 9),
(79, 'troche sie rusza', 1),
(80, 'autyzm1', 1),
(81, 'autyzm2', 1),
(109, 'afazja1', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id_kat` int(11) NOT NULL,
  `nazwa_kat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id_kat`, `nazwa_kat`) VALUES
(1, 'Sposób dostosowania wymagań wynikających z realizowanego programu nauczania'),
(2, 'Warunki organizacji kształcenia, dostosowanie przestrzeni edukacyjnej do potrzeb ucznia\r\n'),
(3, ' Metody i formy pracy z uczniem'),
(9, 'Środki dydaktyczne'),
(10, 'Sposoby sprawdzania osiągnięć edukacyjnych');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasy`
--

CREATE TABLE `klasy` (
  `id_klasa` int(11) NOT NULL,
  `numer` varchar(5) NOT NULL,
  `poziom` int(11) NOT NULL,
  `skrot` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasy`
--

INSERT INTO `klasy` (`id_klasa`, `numer`, `poziom`, `skrot`) VALUES
(1, '2TP', 2, 'TP'),
(2, '3TI', 3, 'TI'),
(3, '1TE', 1, 'TE'),
(4, '5TI', 5, 'TI'),
(5, '1TP', 1, 'TP'),
(8, '2TE', 2, 'TE'),
(10, '3TP', 3, 'TP'),
(11, '4TP', 4, 'TP'),
(12, '5TP', 5, 'TP'),
(13, 'A', 6, 'A'),
(15, '3TE', 3, 'TE');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `npspr`
--

CREATE TABLE `npspr` (
  `id_npspr` int(11) NOT NULL,
  `nazwa` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `npspr`
--

INSERT INTO `npspr` (`id_npspr`, `nazwa`) VALUES
(22, 'Afazja'),
(24, 'Autyzm'),
(25, 'Zespół aspergera'),
(26, 'zagrożenie niedostosowaniem społecznym'),
(27, 'Słabosłyszący'),
(28, 'Słabowidzący'),
(29, 'Niepełnosprawność ruchowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `npspr_dost`
--

CREATE TABLE `npspr_dost` (
  `id` int(11) NOT NULL,
  `id_npspr` int(11) NOT NULL,
  `id_dost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `npspr_dost`
--

INSERT INTO `npspr_dost` (`id`, `id_npspr`, `id_dost`) VALUES
(111, 28, 60),
(113, 27, 58),
(115, 25, 74),
(116, 26, 72),
(117, 25, 75),
(118, 27, 59),
(119, 28, 61),
(120, 26, 73),
(122, 29, 78),
(123, 29, 79),
(124, 24, 80),
(125, 24, 81),
(129, 22, 69),
(194, 22, 109);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `id_przedmiot` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `przedmiot`
--

INSERT INTO `przedmiot` (`id_przedmiot`, `nazwa`) VALUES
(1, 'matematyka'),
(2, 'polski'),
(3, 'biologia'),
(7, 'chemia'),
(8, 'fizyka'),
(9, 'programowanie'),
(10, 'informatyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rok_szkolny`
--

CREATE TABLE `rok_szkolny` (
  `rok` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rok_szkolny`
--

INSERT INTO `rok_szkolny` (`rok`) VALUES
('2024/2025');

--
-- Wyzwalacze `rok_szkolny`
--
DELIMITER $$
CREATE TRIGGER `archiwizacja` AFTER UPDATE ON `rok_szkolny` FOR EACH ROW INSERT INTO `zapisy_archiwa` SELECT * FROM `zapisy` where `zapisy`.`rok_szkolny` not LIKE (SELECT * from`rok_szkolny`)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `archiwizacja2` AFTER UPDATE ON `rok_szkolny` FOR EACH ROW DELETE from `zapisy` where `rok_szkolny` not like (SELECT * from `rok_szkolny`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `symptomy`
--

CREATE TABLE `symptomy` (
  `id_sympt` int(11) NOT NULL,
  `tekst` text NOT NULL,
  `id_npspr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptomy`
--

INSERT INTO `symptomy` (`id_sympt`, `tekst`, `id_npspr`) VALUES
(3, 'Trudności w koncentracji uwagi', 25),
(4, 'Kłopot z dosłownym rozumieniem komunikatów', 25),
(5, 'Trudności z rozumieniem przenośni, aluzji, przysłów', 25),
(6, 'Problem z rozumieniem norm społecznych', 25),
(7, 'Obsesyjne zainteresowania', 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczniowie`
--

CREATE TABLE `uczniowie` (
  `id_ucznia` int(11) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `id_klasa` int(11) NOT NULL,
  `rok_szkolny` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uczniowie`
--

INSERT INTO `uczniowie` (`id_ucznia`, `imie`, `nazwisko`, `id_klasa`, `rok_szkolny`) VALUES
(5, 'Maria', 'Kornik', 4, '2023/2024'),
(45, 'Anna', 'Muł', 5, '2023/2024'),
(176, 'Beata', 'Buk', 2, '2025/2026');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczn_dost`
--

CREATE TABLE `uczn_dost` (
  `id` int(11) NOT NULL,
  `id_ucznia` int(11) NOT NULL,
  `id_dost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uczn_dost`
--

INSERT INTO `uczn_dost` (`id`, `id_ucznia`, `id_dost`) VALUES
(3138, 5, 63),
(3317, 5, 62),
(3458, 5, 72),
(3459, 5, 59),
(3460, 5, 58),
(3463, 5, 79),
(3464, 5, 78),
(3465, 45, 75),
(3705, 176, 74),
(3706, 176, 80),
(3707, 176, 81),
(3708, 176, 69),
(3710, 176, 109),
(3711, 176, 75),
(3712, 176, 73),
(3713, 176, 72),
(3714, 176, 58),
(3715, 176, 59),
(3717, 176, 61),
(3718, 176, 60),
(3720, 176, 79),
(3722, 176, 78),
(3751, 5, 75),
(3800, 5, 80),
(3801, 5, 81),
(3817, 5, 61),
(3818, 5, 73),
(3819, 5, 74),
(3821, 5, 109),
(3828, 5, 65),
(3829, 5, 69),
(3830, 5, 60);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczn_npspr`
--

CREATE TABLE `uczn_npspr` (
  `id` int(11) NOT NULL,
  `id_ucznia` int(11) NOT NULL,
  `id_npspr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uczn_npspr`
--

INSERT INTO `uczn_npspr` (`id`, `id_ucznia`, `id_npspr`) VALUES
(70, 45, 25),
(83, 5, 22),
(84, 5, 24),
(85, 5, 25),
(86, 5, 26),
(87, 5, 28),
(90, 176, 22),
(91, 176, 24),
(92, 176, 25),
(93, 176, 26),
(94, 176, 27),
(95, 176, 28);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `rola` varchar(10) NOT NULL,
  `haslo` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `imie`, `nazwisko`, `rola`, `haslo`) VALUES
(7, 'Super', 'Admin', 'superadmin', '9ee32e2bd5e0b256893eb664460898ef'),
(8, 'Witlod', 'Koral', 'Nauczyciel', 'ed71c5d55af657bc2413020e5580d4dd'),
(10, 'Anna', 'Joanna', 'Nauczyciel', 'daa9bda719032ae88abadb9cda4aa846'),
(11, 'Kamil', 'Pedagog', 'Pedagog', '4bc0550cd0afc7bbe97be48a36303f6e');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_klasa`
--

CREATE TABLE `user_klasa` (
  `id` int(11) NOT NULL,
  `id_klasa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_klasa`
--

INSERT INTO `user_klasa` (`id`, `id_klasa`, `id_user`) VALUES
(1, 3, 8),
(2, 1, 8),
(3, 4, 8),
(4, 5, 10),
(5, 2, 10),
(6, 1, 10),
(11, 2, 11),
(15, 8, 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zapisy`
--

CREATE TABLE `zapisy` (
  `id_zapis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ucznia` int(11) NOT NULL,
  `id_przedmiot` varchar(50) NOT NULL,
  `dostosowania` varchar(120) NOT NULL,
  `uwagi` text NOT NULL,
  `data` varchar(20) NOT NULL,
  `rok_szkolny` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zapisy`
--

INSERT INTO `zapisy` (`id_zapis`, `id_user`, `id_ucznia`, `id_przedmiot`, `dostosowania`, `uwagi`, `data`, `rok_szkolny`) VALUES
(524, 8, 5, '|2', '80|', '', '30/08/2024 10:16', '2024/2025'),
(540, 8, 5, '|1', '61|73|74|69|109|', 'rrr', '30/08/2024 10:33', '2024/2025');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zapisy_archiwa`
--

CREATE TABLE `zapisy_archiwa` (
  `id_zapis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ucznia` int(11) NOT NULL,
  `id_przedmiot` varchar(30) NOT NULL,
  `dostosowania` varchar(100) NOT NULL,
  `uwagi` text NOT NULL,
  `data` varchar(20) NOT NULL,
  `rok_szkolny` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zapisy_archiwa`
--

INSERT INTO `zapisy_archiwa` (`id_zapis`, `id_user`, `id_ucznia`, `id_przedmiot`, `dostosowania`, `uwagi`, `data`, `rok_szkolny`) VALUES
(520, 8, 5, '|7|2', '65|69|60|', 'czczc', '30/08/2024 10:28', '2023/2024');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dostosowania`
--
ALTER TABLE `dostosowania`
  ADD PRIMARY KEY (`id_dost`),
  ADD KEY `kategoria` (`id_kat`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeksy dla tabeli `klasy`
--
ALTER TABLE `klasy`
  ADD PRIMARY KEY (`id_klasa`);

--
-- Indeksy dla tabeli `npspr`
--
ALTER TABLE `npspr`
  ADD PRIMARY KEY (`id_npspr`);

--
-- Indeksy dla tabeli `npspr_dost`
--
ALTER TABLE `npspr_dost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `npspr` (`id_npspr`),
  ADD KEY `dost` (`id_dost`);

--
-- Indeksy dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`id_przedmiot`);

--
-- Indeksy dla tabeli `symptomy`
--
ALTER TABLE `symptomy`
  ADD PRIMARY KEY (`id_sympt`),
  ADD KEY `npspr1` (`id_npspr`);

--
-- Indeksy dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD PRIMARY KEY (`id_ucznia`);

--
-- Indeksy dla tabeli `uczn_dost`
--
ALTER TABLE `uczn_dost`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uczn_npspr`
--
ALTER TABLE `uczn_npspr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uczen` (`id_ucznia`),
  ADD KEY `npspr_key` (`id_npspr`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_klasa`
--
ALTER TABLE `user_klasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_user`),
  ADD KEY `klasa` (`id_klasa`);

--
-- Indeksy dla tabeli `zapisy`
--
ALTER TABLE `zapisy`
  ADD PRIMARY KEY (`id_zapis`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `uczen` (`id_ucznia`),
  ADD KEY `przedmiot` (`id_przedmiot`);

--
-- Indeksy dla tabeli `zapisy_archiwa`
--
ALTER TABLE `zapisy_archiwa`
  ADD PRIMARY KEY (`id_zapis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dostosowania`
--
ALTER TABLE `dostosowania`
  MODIFY `id_dost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `klasy`
--
ALTER TABLE `klasy`
  MODIFY `id_klasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `npspr`
--
ALTER TABLE `npspr`
  MODIFY `id_npspr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `npspr_dost`
--
ALTER TABLE `npspr_dost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `id_przedmiot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `symptomy`
--
ALTER TABLE `symptomy`
  MODIFY `id_sympt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `id_ucznia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `uczn_dost`
--
ALTER TABLE `uczn_dost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3831;

--
-- AUTO_INCREMENT for table `uczn_npspr`
--
ALTER TABLE `uczn_npspr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_klasa`
--
ALTER TABLE `user_klasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `zapisy`
--
ALTER TABLE `zapisy`
  MODIFY `id_zapis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;

--
-- AUTO_INCREMENT for table `zapisy_archiwa`
--
ALTER TABLE `zapisy_archiwa`
  MODIFY `id_zapis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `npspr_dost`
--
ALTER TABLE `npspr_dost`
  ADD CONSTRAINT `dost` FOREIGN KEY (`id_dost`) REFERENCES `dostosowania` (`id_dost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `npspr` FOREIGN KEY (`id_npspr`) REFERENCES `npspr` (`id_npspr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `symptomy`
--
ALTER TABLE `symptomy`
  ADD CONSTRAINT `npspr1` FOREIGN KEY (`id_npspr`) REFERENCES `npspr` (`id_npspr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uczn_npspr`
--
ALTER TABLE `uczn_npspr`
  ADD CONSTRAINT `npspr_key` FOREIGN KEY (`id_npspr`) REFERENCES `npspr` (`id_npspr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uczen` FOREIGN KEY (`id_ucznia`) REFERENCES `uczniowie` (`id_ucznia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_klasa`
--
ALTER TABLE `user_klasa`
  ADD CONSTRAINT `klasa` FOREIGN KEY (`id_klasa`) REFERENCES `klasy` (`id_klasa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
